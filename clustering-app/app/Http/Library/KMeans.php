<?php

namespace App\Http\Library;

use App\Models\ClusterType;
use Illuminate\Support\Facades\Log;

class KMeans
{
    private $data;
    private $k;
    private $centroids;
    private $clusters;
    private $initCentroid;
    private $iteration;
    private $centroidsLoop;
    private $inertia;

    public function __construct($data, $k)
    {
        $this->data = $data;
        $this->k = $k;
        $this->centroids = [];
        $this->clusters = [];
        $this->initCentroid = [];
        $this->iteration = 0;
        $this->centroidsLoop = [];
    }

    function initializeCentroidsOld()
    {

        $centroid = [];

        for ($i = 0; $i < count($this->data[0]['data']); $i++) {
            for ($j = 0; $j < count($this->data); $j++) {
                $centroid[$i][] = $this->data[$j]['data'][$i];
            }
        }
        $data = $this->data;

        $sums = [];
        foreach ($centroid as $key => $value) {
            array_push($sums, array_sum($value));
        }

        $newArr = array_map(function ($sum) use ($data) {
            return $sum / count($data);
        }, $sums);

        return $newArr;

        $this->centroids = $centroid;
        $this->initCentroid = $centroid;
    }
    function initializeCentroids()
    {

        $centroid = [];
        $randomIndices = array_rand($this->data, $this->k);
        foreach ($randomIndices as $key => $index) {
            array_push($centroid, [
                'label' => ++$key,
                'value' => $this->data[$index]['data'],
            ]);
        }

        $this->centroids = $centroid;
        $this->initCentroid = $centroid;
    }

    //menghitung jarak
    private function calculateEuclideanDistance($point1, $point2)
    {
        $distance = 0;

        for ($i = 0; $i < count($point1); $i++) {
            $distance += pow($point1[$i] - $point2[$i], 2);
        }

        return sqrt($distance);
    }

    //memasukan data kedalam cluster
    public function assignDataToClusters()
    {
        $this->clusters = [];

        foreach ($this->data as $dataPoint) {
            $closestCentroid = null;
            $minDistance = PHP_INT_MAX;

            foreach ($this->centroids as $key => $centroid) {

                $distance = $this->calculateEuclideanDistance($dataPoint['data'], $centroid['value']);


                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $closestCentroid = $centroid['label'];
                }
            }


            $this->clusters[$closestCentroid][] = $dataPoint;
        }
    }

    private function updateCentroids()
    {

        foreach ($this->clusters as $label => $cluster) {

            $centroid = $this->centroids[$label - 1]['value'];

            if (!empty($cluster)) {
                $dimensions = count($centroid);
                $sums = array_fill(0, $dimensions, 0);

                foreach ($cluster as $dataPoint) {
                    for ($i = 0; $i < $dimensions; $i++) {
                        $sums[$i] += $dataPoint['data'][$i];
                    }
                }


                $newCentroid = array_map(function ($sum) use ($cluster) {
                    return $sum / count($cluster);
                }, $sums);


                $this->centroids[$label - 1]['value'] = $newCentroid;
                $this->centroidsLoop[$this->iteration] = $this->centroids;
            }
        }
    }

    public function run($maxIterations = 1000)
    {
        $this->centroid_rata_rata();

        $iterations = 0;
        $maxIterations = $maxIterations;

        $oldCentroids = $this->centroids;
        while ($iterations < $maxIterations) {

            $this->iteration = ++$iterations;

            $this->assignDataToClusters();
            $this->updateCentroids();

            if ($oldCentroids === $this->centroids) {
                break;
            }

            $oldCentroids = $this->centroids;
        }
    }
    
    private function calculateInertia($cluster)
    {
        $centroid = $this->centroids[$cluster - 1]['value'];
        $inertia = 0;

        foreach ($this->clusters[$cluster] as $dataPoint) {
            $distance = $this->calculateEuclideanDistance($dataPoint['data'], $centroid);
            $inertia += pow($distance, 2);
        }

        return $inertia;
    }

    private function calculateSilhouetteCoefficient($dataPoint, $currentCluster)
    {
        $a = 0;
        $b = PHP_INT_MAX;

        foreach ($this->clusters[$currentCluster] as $point) {


            if ($point !== $dataPoint) {
                $distance = $this->calculateEuclideanDistance($dataPoint, $point['data']);
                $a += $distance;
            }
        }

        foreach ($this->clusters as $clusterLabel => $cluster) {
            if ($clusterLabel !== $currentCluster) {
                $meanDistance = 0;

                foreach ($cluster as $point) {
                    $distance = $this->calculateEuclideanDistance($dataPoint, $point['data']);
                    $meanDistance += $distance;
                }

                $meanDistance /= count($cluster);
                $b = min($b, $meanDistance);
            }
        }

        $a /= (count($this->clusters[$currentCluster]));

        return ($b - $a) / max($a, $b);
    }

    //perhitungan matrix
    public function evaluateClusters()
    {
        $clusterMetrics = [];

        foreach ($this->clusters as $label => $cluster) {
            $inertia = $this->calculateInertia($label);
            $silhouetteCoefficients = [];

            foreach ($cluster as $dataPoint) {
                $silhouetteCoefficient = $this->calculateSilhouetteCoefficient($dataPoint['data'], $label);
                $silhouetteCoefficients[] = $silhouetteCoefficient;
            }

            $meanSilhouetteCoefficient = array_sum($silhouetteCoefficients) / count($silhouetteCoefficients);
            $clusterMetrics[$label] = [
                'inertia' => $inertia,
                'silhouette' => $meanSilhouetteCoefficient,
            ];
        }

        // uasort($clusterMetrics, function ($a, $b) {
        //     return $a['silhouette'] <=> $b['silhouette'];
        // });


        return $clusterMetrics;
    }

    private function checkConvergence($newCentroids)
    {
        foreach ($newCentroids as $label => $centroid) {
            if ($this->calculateEuclideanDistance($this->centroids[$label], $centroid) > 0.0001) {
                return false;
            }
        }
        return true;
    }

    public function displayResults()
    {


        echo "Centroid Awal: <br>";
        foreach ($this->initCentroid as $key => $value) {
            echo "Centroid " . $value['label'] . ": ";
            echo implode(", ", $value['value']);
            echo "<br>";
        }

        echo "<br>";

        echo "Centroids:<br>";
        foreach ($this->centroidsLoop as $key => $centroid) {

            echo "Perulangan Ke-{$key} : <br>";
            foreach ($centroid as $value) {
                echo "Centroid " . $value['label'] . ": ";
                echo implode(", ", $value['value']);
                echo "<br>";
            }
            echo "<br>";
        }

        echo "<br>";

        echo "Centroids Akhir:<br>";
        foreach ($this->centroids as $centroid) {
            echo "Centroid " . $centroid['label'] . ": ";
            echo implode(", ", $centroid['value']);
            echo "<br>";
        }

        echo "<br>";

        echo "Final Clusters:<br>";
        foreach ($this->clusters as $label => $cluster) {
            echo "Cluster {$label}:<br>";
            foreach ($cluster as $dataPoint) {
                echo implode(", ", $dataPoint['data']) . "<br>";
            }
            echo "<br>";
        }

        echo "<br>";

        echo "Clusters:<br>";
        foreach ($this->clusters as $label => $cluster) {
            echo "Cluster {$label}:<br>";
            foreach ($cluster as $dataPoint) {
                echo $dataPoint['faskes_id'] . "<br>";
            }
            echo "<br>";
        }

        echo "<br>";

        echo "Cluster Metrics:<br>";
        $clusterMetrics = $this->evaluateClusters();
        foreach ($clusterMetrics as $label => $metrics) {
            echo "Cluster {$label}:<br>";
            echo "Inertia: {$metrics['inertia']}<br>";
            echo "Silhouette Coefficient: {$metrics['silhouette']}<br>";
            echo "<br>";
        }

        echo "Jumlah Perulangan {$this->iteration}";
    }

    //insert data ke databaase
    function result($survey_id)
    {
        $clusterMetrics = $this->swapClusterLabels();


        $bestClusterLabels = ClusterType::all()->pluck('id_cluster_type')->toArray();


        $result = [];

        foreach ($this->clusters as $key => $value) {

            foreach ($value as $item) {

                array_push($result, [
                    'faskes_id' => $item['faskes_id'],
                    'survey_id' => $survey_id,
                    'cluster_type_id' => $bestClusterLabels[$item['label'] - 1],
                ]);
            }

        }
        return  $result;
    }

    //centroid awal
    function centroid_rata_rata()
    {
        $central = $step = round(sizeof($this->data) / $this->k, 0);
        $dimensi = sizeof($this->data[0]['data']);
        $cek = $c = 0;
        $i = 1;
        for ($z = 0; $z < sizeof($this->data); $z++) {
            $temp = [];
            for ($d = 0; $d < $dimensi; $d++) {
                $temp[] = $this->data[$z]['data'][$d];
            }
            if ((($z % $central) < $central && $z % $central != 0) || $z == 0) {
                $temp_centroid_awal[$c][$z] = $temp;
            } else {
                if ($c + 1 < $this->k) {
                    $c++;
                }
                $temp_centroid_awal[$c][$z] = $temp;
            }
        }
        foreach ($temp_centroid_awal as $key => $value) {
            $temp = [];
            foreach ($value as $keys => $values) {
                for ($d = 0; $d < $dimensi; $d++) {
                    $temp[$d][] = $temp_centroid_awal[$key][$keys][$d];
                }
            }
            $temps[$key] = $temp;
        }

        foreach ($temp_centroid_awal as $key => $value) {

            $centroid_awal[$key]['label'] = $i++;

            for ($d = 0; $d < $dimensi; $d++) {

                $centroid_awal[$key]['value'][] = array_sum($temps[$key][$d]) / count($temps[$key][$d]);
            }
        }

        $this->centroids = $this->initCentroid  = $centroid_awal;
    }

    //mengurutkan cluster
    public function swapClusterLabels($evaluationMetric = 'inertia')
    {
        $clusterMetrics = $this->evaluateClusters();


        if ($evaluationMetric === 'inertia') {
            uasort($clusterMetrics, function ($a, $b) {
                return $a['inertia'] < $b['inertia'] ? -1 : 1;
            });
        } elseif ($evaluationMetric === 'silhouette') {
            uasort($clusterMetrics, function ($a, $b) {
                return $a['silhouette'] <=> $b['silhouette'];
            });
        }


        $bestClusterLabels = array_keys($clusterMetrics);




        foreach ($this->clusters as $label => &$cluster) {
            $newLabel = $bestClusterLabels[$label - 1];
            foreach ($cluster as &$dataPoint) {
                $dataPoint['label'] = $newLabel;
            }
        }
    }
}

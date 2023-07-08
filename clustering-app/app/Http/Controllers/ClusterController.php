<?php

namespace App\Http\Controllers;

use App\Http\Library\KMeans;
use App\Http\Repository\SurveyResultRepository;
use App\Models\Cluster;
use App\Models\ClusterType;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {

            $result = (new SurveyResultRepository($request))->getByFaskes();
            $data = [];
            foreach ($result as $key => $value) {
                array_push($data, [
                    'faskes_id' => $value->id_faskes,
                    'data' => $value->result->toArray()
                ]);
            }

            $k = ClusterType::count();

            $kmeans = new KMeans($data, $k);

            // return $kmeans->centroid_rata_rata();
            $kmeans->run();


            $cluster = $kmeans->result($request->survey_id);


            return  Cluster::insert($cluster);
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage() . $th->getLine()];
        }
    }
}

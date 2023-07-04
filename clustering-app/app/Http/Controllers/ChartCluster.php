<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartCluster extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {

            $result =  DB::select("SELECT x.cluster_type_name AS label ,COALESCE(y.data,0) AS data FROM
            (SELECT id_cluster_type, cluster_type_name FROM  t_cluster_type) x LEFT JOIN (SELECT COUNT(*) AS data,cluster_type_id FROM t_cluster WHERE survey_id = ? GROUP BY cluster_type_id) y ON x.id_cluster_type = y.cluster_type_id", [$request->survey_id]);

            return $result;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }
}

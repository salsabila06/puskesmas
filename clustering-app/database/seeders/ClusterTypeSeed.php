<?php

namespace Database\Seeders;

use App\Models\ClusterType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClusterTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cluster_type = [
            [
                'cluster_type_name' => 'Layak'
            ],
            [
                'cluster_type_name' => 'Kurang Layak'
            ],
        ];

        ClusterType::insert($cluster_type);
    }
}

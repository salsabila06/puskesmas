<?php

namespace Database\Seeders;

use App\Models\FaskesType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaskesTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faskes_type = [
            [
                'faskes_type_name' => 'Inap'
            ],
            [
                'faskes_type_name' => 'Non Inap'
            ],

        ];

        FaskesType::insert($faskes_type);
    }
}

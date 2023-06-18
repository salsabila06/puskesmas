<?php

namespace Database\Seeders;

use App\Models\Faskes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaskesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faskes::create([
            'faskes_name' => 'Puskesmas Lohbener',
            'faskes_type_id' => 2,
            'faskes_code' => 'FSC-00001',
            'faskes_establish' => date('Y-m-d H:i:s'),
            'district_id' => 24
        ]);
    }
}

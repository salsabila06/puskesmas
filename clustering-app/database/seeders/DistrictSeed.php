<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $district = [
            ["district_name" => "Haurgeulis"], ["district_name" => "Gantar"], ["district_name" => "Kroya"], ["district_name" => "Gabuswetan"], ["district_name" => "Cikedung"], ["district_name" => "Terisi"], ["district_name" => "Lelea"], ["district_name" => "Bangodua"], ["district_name" => "Tukdana"], ["district_name" => "Widasari"], ["district_name" => "Kertasemaya"], ["district_name" => "Sukagumiwang"], ["district_name" => "Krangkeng"], ["district_name" => "Karangampel"], ["district_name" => "Kedokan Bunder"], ["district_name" => "Juntinyuat"], ["district_name" => "Sliyeg"], ["district_name" => "Jatibarang"], ["district_name" => "Balongan"], ["district_name" => "Indramayu"], ["district_name" => "Sindang"], ["district_name" => "Cantigi"], ["district_name" => "Pasekan"], ["district_name" => "Lohbener"], ["district_name" => "Arahan"], ["district_name" => "Losarang"], ["district_name" => "Kandanghaur"], ["district_name" => "Bongas"], ["district_name" => "Anjatan"], ["district_name" => "Sukra"], ["district_name" => "Patrol"],
        ];

        District::insert($district);
    }
}

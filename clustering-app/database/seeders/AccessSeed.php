<?php

namespace Database\Seeders;

use App\Models\Access;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $access = [
            [

                'menu_id' => DASHBOARD,
                'role_id' => ROLE_DINAS
            ],
            [

                'menu_id' => PARAMETER,
                'role_id' => ROLE_DINAS
            ],
            [

                'menu_id' => PERTANYAAN,
                'role_id' => ROLE_DINAS
            ],
            [

                'menu_id' => SURVEY,
                'role_id' => ROLE_DINAS
            ],
            [

                'menu_id' => DATA,
                'role_id' => ROLE_DINAS
            ],
            [

                'menu_id' => HASIL,
                'role_id' => ROLE_DINAS
            ],
            [

                'menu_id' => DASHBOARD,
                'role_id' => ROLE_FASKES
            ],
            [

                'menu_id' => ISI_SURVEY,
                'role_id' => ROLE_FASKES
            ],
        ];

        Access::insert($access);
    }
}

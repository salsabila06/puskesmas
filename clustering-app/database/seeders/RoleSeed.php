<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            [
                'role_name' => 'Dinas'
            ],
            [
                'role_name' => 'Puskesmas'
            ],
        ];

        Role::insert($role);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = [
            [
                'fullname' => 'Dinas',
                'username' => 'dinas',
                'password' => bcrypt('1sampai8'),
                'email' => 'dinas@mail.com',
                'role_id' => 1,
                'faskes_id' => null
            ],
            [
                'fullname' => 'Faskes',
                'username' => 'faskes',
                'password' => bcrypt('1sampai8'),
                'email' => 'faskes@mail.com',
                'role_id' => 2,
                'faskes_id' => 1
            ],
        ];
        User::insert($user);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DistrictSeed::class, FaskesTypeSeed::class, RoleSeed::class, FaskesSeed::class, UserSeed::class, MenuSeed::class, AccessSeed::class
        ]);
    }
}

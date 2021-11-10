<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        if ($_SERVER['argv'][1] !== 'tenants:migrate') {
            return $this->call(LandlordSeeder::class);
        }

        return $this->call(UserSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LandlordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tenant::create([
            'name' => 'tenant1',
            'domain' => 'tenant1.laravel.test',
            'database' => 'multitenant_tenant1'
        ]);

        \App\Models\Tenant::create([
            'name' => 'tenant2',
            'domain' => 'tenant2.laravel.test',
            'database' => 'multitenant_tenant2'
        ]);

    }
}

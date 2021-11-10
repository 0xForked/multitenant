<?php

namespace Tests\Feature;

use Illuminate\Contracts\Console\Kernel;
use Tests\TestCase;

class MultiTenantTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.connections.landlord' => [
               'driver' => 'sqlite',
               'database' => ':memory:'
            ],
            'database.connections.tenant' => [
                'driver' => 'sqlite',
                'database' => ':memory:'
            ]
        ]);

        $this->artisan('migrate --database=landlord --path=database/migrations/landlord');
        $this->artisan('migrate --database=tenant');

        $this->app[Kernel::class]->setArtisan(null);
    }

    /**
     * @test
     */
    public function isReturnCurrentTenantAndListOfItsUsers()
    {
        $tenant = \App\Models\Tenant::factory()->create();

        $tenant->use();

        \App\Models\User::factory()->count(3)->create();

        $response = $this->getJson('/users');

        $response->assertJsonCount(3, 'users');

        $response->assertJsonFragment([
            'name' => $tenant->name,
            'domain' => $tenant->domain
        ]);
    }
}

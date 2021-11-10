<?php

namespace App\Console\Commands;

use App\Console\Commands\Concerns\HasDatabase;
use App\Console\Commands\Concerns\HasFolder;
use App\Models\Tenant;
use Illuminate\Console\Command;

class TenantMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate {tenant?} {--fresh} {--seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the database migrations for tenant';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->argument('tenant')) {
            $tenant = Tenant::find($this->argument('tenant'));

            $this->migrate($tenant);
        } else {
            Tenant::all()->each(
              fn($tenant) => $this->migrate($tenant)
            );
        }
    }

    public function migrate(Tenant $tenant)
    {
        HasDatabase::existOrCreate($tenant->database);

        HasFolder::existOrCreate($tenant->domain);

        $tenant->configure()->use();

        $this->line('');
        $this->info("--- Migrating tenant #$tenant->id ($tenant->name) database ---");

        $options = ['--force' => true];

        if ($this->option('seed')) {
            $options ['--seed'] = true;
        }

        $this->call(
            $this->option('fresh') ? 'migrate:fresh' : 'migrate',
            $options
        );
    }
}

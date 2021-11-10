<?php

namespace App\Console\Commands;

use App\Console\Commands\Concerns\HasDatabase;
use Illuminate\Console\Command;

class LandlordMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'landlord:migrate {--fresh} {--seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the database migrations for landlord';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        HasDatabase::existOrCreate(null);

        return $this->migrate();
    }

    public function migrate()
    {
        $this->info('--- Migrating landlord database ---');

        $options = [
            '--force' => true,
            '--database' => 'landlord',
            '--path' => 'database/migrations/landlord'
        ];

        if ($this->option('seed')) {
            $options ['--seed'] = true;
        }

        $this->call(
            $this->option('fresh') ? 'migrate:fresh' : 'migrate',
            $options
        );
    }
}

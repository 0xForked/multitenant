<?php

namespace App\Console\Commands\Concerns;

use DB;

trait HasDatabase
{
    public static function existOrCreate(?string $tenant): bool
    {
        $options = [
            'schema' => config('database.connections.landlord.database'),
            'charset' => config('database.connections.landlord.charset', 'utf8mb4'),
            'collation' => config('database.connections.landlord.collation', 'utf8mb4_unicode_ci')
        ];

        if (! is_null($tenant)) {
            $options = [
                'schema' => $tenant,
                'charset' => config('database.connections.tenant.charset', 'utf8mb4'),
                'collation' => config('database.connections.tenant.collation', 'utf8mb4_unicode_ci')
            ];
        }

        return (DB::statement("CREATE DATABASE
            IF NOT EXISTS {$options['schema']}
            CHARACTER SET {$options['charset']}
            COLLATE {$options['collation']};"));
    }
}

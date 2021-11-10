<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Schema;

class Tenant extends Model
{
    use HasFactory;

    protected $connection = 'landlord';

    protected $guarded = [];

    protected $fillable = [
        'name',
        'domain',
        'database',
    ];

    public function configure(): Tenant
    {
        config([
            'database.connections.tenant.database' => $this->database,
            'session.files' => storage_path("framework/sessions/$this->domain"),
            'cache.prefix' => $this->domain
        ]);

        DB::purge('tenant');

        app('cache')->purge(config('cache.default'));

        return $this;
    }

    public function use(): Tenant
    {
        app()->forgetInstance('tenant');

        app()->instance('tenant', $this);

        return $this;
    }
}

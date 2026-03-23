<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait UsesMySqlDatabase
{
    protected function useMySqlDatabase(): void
    {
        config()->set('database.default', 'mysql');
        config()->set('database.connections.mysql.host', env('DB_HOST', 'mysql'));
        config()->set('database.connections.mysql.port', (int) env('DB_PORT', 3306));
        config()->set('database.connections.mysql.database', 'desafio-ot');
        config()->set('database.connections.mysql.username', 'ot');
        config()->set('database.connections.mysql.password', 'password');
        config()->set('queue.default', 'database');
        config()->set('queue.failed.database', 'mysql');

        Artisan::call('migrate', ['--database' => 'mysql', '--force' => true]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ([
            'failed_jobs',
            'job_batches',
            'jobs',
            'market_data',
            'upload_processed_chunks',
            'uploads',
            'personal_access_tokens',
            'users',
        ] as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

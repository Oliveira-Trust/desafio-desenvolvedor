<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PDO;

trait UsesMySqlDatabase
{
    protected function useMySqlDatabase(): void
    {
        $testDatabase = env('DB_DATABASE_TEST', 'desafio-ot-test');

        $this->ensureTestingDatabaseExists($testDatabase);

        config()->set('database.default', 'mysql');
        config()->set('database.connections.mysql.host', env('DB_HOST', 'mysql'));
        config()->set('database.connections.mysql.port', (int) env('DB_PORT', 3306));
        config()->set('database.connections.mysql.database', $testDatabase);
        config()->set('database.connections.mysql.username', env('DB_USERNAME', 'ot'));
        config()->set('database.connections.mysql.password', env('DB_PASSWORD', 'password'));
        config()->set('queue.default', 'database');
        config()->set('queue.failed.database', 'mysql');

        DB::purge('mysql');

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

    private function ensureTestingDatabaseExists(string $databaseName): void
    {
        $host = env('DB_HOST', 'mysql');
        $port = (int) env('DB_PORT', 3306);
        $rootUser = env('DB_ROOT_USERNAME', 'root');
        $rootPassword = env('DB_ROOT_PASSWORD', 'root');

        $pdo = new PDO(
            sprintf('mysql:host=%s;port=%d;charset=utf8mb4', $host, $port),
            $rootUser,
            $rootPassword,
        );

        $pdo->exec(sprintf(
            'CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci',
            str_replace('`', '``', $databaseName)
        ));

        $appUser = env('DB_USERNAME', 'ot');

        $pdo->exec(sprintf(
            "GRANT ALL PRIVILEGES ON `%s`.* TO '%s'@'%%'",
            str_replace('`', '``', $databaseName),
            str_replace("'", "\\'", $appUser),
        ));
        $pdo->exec('FLUSH PRIVILEGES');
    }
}

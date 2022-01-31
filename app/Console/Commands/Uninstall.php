<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Uninstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = app_path('');
        echo shell_exec("cd {$path}");
        echo shell_exec('php artisan migrate:rollback --path=database/migrations/relations/');
        echo shell_exec('php artisan migrate:rollback --path=database/migrations/customer_migrations/');
        echo shell_exec('php artisan migrate:rollback --path=database/migrations/admin_migrations/');
    }
}

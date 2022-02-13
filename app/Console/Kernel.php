<?php

declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /** @var string[] */
    protected $commands = [
        'App\Console\Commands\KeyGenerateCommand'
    ];

    protected function schedule(Schedule $schedule): void
    {
    }
}

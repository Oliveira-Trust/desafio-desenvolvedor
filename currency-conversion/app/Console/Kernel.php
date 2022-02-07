<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('instagram:insights')->cron('* * * * *');#->dailyAt('00:00')

        # Exemmplo de definição de Cron Job:
        # .---------------- minuto (0 - 59)
        # |  .------------- hora   (0 - 23)
        # |  |  .---------- dia do mês (1 - 31)
        # |  |  |  .------- mes (1 - 12) OR jan,fev,mar,abr ...
        # |  |  |  |  .---- day da semana (0 - 6) (Domingo=0 or 7) Ou sun,mon,tue,wed,thu,fri,sat
        # |  |  |  |  |
        # *  *  *  *  * user-name  command to be executed
        #$schedule->command('comando:acao')->cron('* * * * *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

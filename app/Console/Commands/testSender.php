<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\WhastappService;

class testSender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('TEste de envio');
        $sess = $this->ask('Qual a sesão?','lelele')      ;  
        $num = $this->ask('Quakl o numero?','559581074892@s.whatsapp.net');
        
         WhastappService::sender($sess,$num, 'teste e envio');       
                
        return Command::SUCCESS;
    }
}

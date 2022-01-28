<?php
namespace App\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class PurchaseMailSubscriber extends Command
{
    protected $signature = 'purchase:subscribe';

    protected $description = 'Subscribe to a purchase channel';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Redis::psubscribe(['send-purchase-mail'], function ($message) {
            echo $message;
        });
    }
}

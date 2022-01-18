<?php
namespace App\Libs\Http;

use Illuminate\Support\Facades\Facade;

class AwesomeApiFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'awesomeapi';
    }
}

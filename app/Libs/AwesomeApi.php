<?php

namespace App\Libs;

use Illuminate\Support\Facades\Http;

class AwesomeApi
{
    private $host;

    public function __construct()
    {
        $this->host = config('awesome.host');
    }

    private function mountUrl($path)
    {
        return $this->host.$path;
    }

    public function getAvaliable()
    {
        $response = Http::get($this->mountUrl('/json/available/uniq'));
        $avaliables = $response->json();

        $newAvaliables = [];

        foreach($avaliables as $key => $value) {
            $newAvaliables[] = ['code' => $key, 'name' => $value];
        }

        return $newAvaliables;
    }

    public function converter($combination)
    {
        $response = Http::get($this->mountUrl('/last/'.$combination));

        return $response->json();
    }
}

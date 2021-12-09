<?php

namespace App\Services;

use Exception;
use Selene\Http\Client;
use App\Exceptions\CurrencyConvertException;

final class CurrencyConvertService
{
    private mixed $using;
    private float $value;

    public function using(mixed $using): self
    {
        $this->using = $using;
        return $this;
    }

    public function withValue(float $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function apply(): array
    {
        try {
            $request = (new Client('https://economia.awesomeapi.com.br'))->request(Client::GET, "/json/last/{$this->using}-BRL");

            if ($request->hasError()) {
                throw new CurrencyConvertException();
            }

            $data = $request->asArray();
            $data = reset($data);

            return [
                'codein' => 'BRL',
                'code' => $this->using,
                'bid' => $data['bid'],
                'description' => $data['name'],
                'value' => $this->value
            ];
        } catch (Exception $e) {
            throw $e;
        }
    }
}

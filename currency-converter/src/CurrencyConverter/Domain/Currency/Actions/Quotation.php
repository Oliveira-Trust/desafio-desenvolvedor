<?php

namespace CurrencyConverter\Domain\Currency\Actions;

use \CurrencyConverter\Domain\Currency\DTOs\FormData as ConvertDTO;
use CurrencyConverter\Domain\Currency\Services\CurrencyService;

/**
 * Class Convert
 * @package CurrencyConverter\Domain\Currency\Actions
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class Quotation
{
    public function __invoke(ConvertDTO $dto)
    {
        $service = app(CurrencyService::class);
        return $service->getQuotation($dto);
    }
}

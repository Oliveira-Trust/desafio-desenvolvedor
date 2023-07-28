
<?php
// app/Presenters/ConvertCurrencyPresenterInterface.php

namespace App\Presenters;

use App\Domain\Entities\ConversionResult;

interface ConvertCurrencyPresenterInterface
{
    public function present(ConversionResult $conversionResult): array;
}

<?php

declare(strict_types=1);

use Module\Broker\Entities\ConversionValuesForRatesGreaterThanThreeThousand;
use Module\Broker\Entities\FeeConversionValuesLessThanThreeThousand;
use Module\Broker\Entities\Invoice;

it('should calculate fee conversion when amount or invoice less than 300000', function () {
    $calculateFeeConversion = new FeeConversionValuesLessThanThreeThousand(new ConversionValuesForRatesGreaterThanThreeThousand(null));
    $total = $calculateFeeConversion->apply(Invoice::create('EUR', 200000, 'bank_slip'));
    expect($total)->toEqual(4000);
});

it('should calculate fee conversion when amount or invoice greater than 300000', function () {
    $calculateFeeConversion = new FeeConversionValuesLessThanThreeThousand(new ConversionValuesForRatesGreaterThanThreeThousand(null));
    $total = $calculateFeeConversion->apply(Invoice::create('EUR', 500000, 'bank_slip'));
    expect($total)->toEqual(5000);
});

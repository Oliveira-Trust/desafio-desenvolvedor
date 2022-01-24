<?php

use App\Support\Money;

test('it can add fee to amount', function () {
    $amount = new Money(5000);
    $fees = $amount->addFees(1);


    $this->assertEquals(50, $fees);
});

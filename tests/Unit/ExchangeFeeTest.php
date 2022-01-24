<?php

use App\Models\ExchangeFee;

use Database\Seeders\ExchangeFeeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(ExchangeFeeSeeder::class);
});

test('adds two percent fee to amount between 1000 BRL and 3000 BRL', function () {
    $amount = 1000;
    $exchangeFee = ExchangeFee::getFeeByAmount($amount)->calculateFee($amount);
    expect($exchangeFee)->toBe(20.00);
    $amount2 = 3000;
    $exchangeFee2 = ExchangeFee::getFeeByAmount($amount2)->calculateFee($amount2);
    expect($exchangeFee2)->toBe(60.00);

});

test('adds one percent fee to amount between 3000 BRL and 100000 BRL', function () {
    $amount = 3001;
    $exchangeFee = ExchangeFee::getFeeByAmount($amount)->calculateFee($amount);
    $amount2 = 100_000;
    $exchangeFee2 = ExchangeFee::getFeeByAmount($amount2)->calculateFee($amount2);

    expect($exchangeFee)->toBe(30.01);
    expect($exchangeFee2)->toBe(1000.00);

});

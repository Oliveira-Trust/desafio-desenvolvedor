<?php

namespace App\Domain\Fee\Factories;
use App\Domain\Fee\Strategies\DefaultFee;
use App\Domain\Fee\Repositories\FeeRepository;

class FeeFactory {

    public static function createNewClass($name)
    {
        $newClass = "App\\Domain\\Fee\\Strategies\\" . $name;

        return new $newClass(app()->make(FeeRepository::class));
    }

    public static function instantiateDefaultFeeClass($feeRepository)
    {
        return new DefaultFee($feeRepository);
    }

}

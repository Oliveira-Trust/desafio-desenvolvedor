<?php
namespace App\Http\Application\UseCases;

use App\Models\Conversion;
use App\Domain\Repositories\ConversionRepositoryInterface;

class ConversionUseCase
{
    /**
     * @var ConversionRepositoryInterface
     */    private ConversionRepositoryInterface $conversionRepositoryInterface;

    public function __construct(ConversionRepositoryInterface $conversionRepositoryInterface)
    {

        $this->conversionRepositoryInterface = $conversionRepositoryInterface;
    }

    public function execute(string $origin_currency,  string $destination_currency, float $conversion_value, float $converted_value, string $payment_method): Conversion
    {
        return $this->conversionRepositoryInterface->create($origin_currency,  $destination_currency, $conversion_value, $converted_value, $payment_method);
    }
    public function getConversionHistorybyUserId(int $userid): Array
    {
        return $this->conversionRepositoryInterface->getConversionHistory($userid);
    }
}
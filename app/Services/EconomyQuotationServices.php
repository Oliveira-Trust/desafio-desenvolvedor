<?php

declare(strict_types=1);

namespace App\Services;

use App\Builders\Conversion\Conversion;
use App\Enumerators\Domain;
use App\Facades\Helpers;
use App\Mail\ConversionMail;
use App\Reads\ConversionValues;
use App\Repository\EconomyQuotationsRepository;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EconomyQuotationServices
{
    private EconomyQuotationsRepository $economyQuotationRepository;

    public function __construct(EconomyQuotationsRepository $economyQuotationRepository)
    {
        $this->economyQuotationRepository = $economyQuotationRepository;
    }

    /** @throws \Throwable */
    public function translations(): Collection
    {
        $combinations = $this->economyQuotationRepository->findAllCombinations()->json();
        $translations = $this->economyQuotationRepository->findAllCurrencyTranslations()->collect();

        return $translations->filter(function (string $value, string $key) use ($combinations) {
            $combinationKey = Domain::DEFAULT_CURRENCY->value . '-' . $key;
            return $combinations[$combinationKey] ?? false;
        });
    }

    /** @throws \Throwable */
    public function combinations(): Response
    {
        return $this->economyQuotationRepository->findAllCombinations();
    }

    /** @throws \Throwable */
    public function conversion(array $attributes): array
    {
        $conversionValues = (new ConversionValues($attributes));
        $quotation =  $this->economyQuotationRepository
            ->getQuotation(currencies: $conversionValues->currencies())
            ->json();

        $conversion = (new Conversion($conversionValues, $quotation))->result();

        $this->sendEmail($conversion);

        return $conversion;
    }

    private function sendEmail(array $conversion): void
    {
        $now = Carbon::now()->format('Y-m-d-H:i:s');
        $fileName = "conversion-{$now}.csv";

        $user = Helpers::authUser();

        Mail::to($user->email)->send(new ConversionMail(
            conversion: $conversion,
            user: $user,
            fileName: $fileName
        ));

        Storage::delete("exports/{$fileName}");
    }
}

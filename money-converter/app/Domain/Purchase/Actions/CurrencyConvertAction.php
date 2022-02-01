<?php

namespace Domain\Purchase\Actions;

use App\Core\Exceptions\HttpException;
use GuzzleHttp\Exception\ClientException;
use Infra\AwesomeApi\AwesomeApiClient;

final class CurrencyConvertAction
{
    private AwesomeApiClient $awesomeApiClient;

    public function __construct(AwesomeApiClient $awesomeApiClient)
    {
        $this->awesomeApiClient = $awesomeApiClient;
    }

    /**
     * @throws HttpException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __invoke(array $combination, float $value): array
    {
        try {
            $combinationString = implode('-', $combination);
            $combinationJoinString = implode('', $combination);

            $response = $this->awesomeApiClient->request('GET', "json/last/{$combinationString}");
            $responseToArray = json_decode($response->getBody(), true);

            $quotation = $responseToArray[$combinationJoinString];

            $bidValue = floatval($quotation['bid']);

            return [
                'quotation' => $bidValue,
                'converted' => ($value * $bidValue),
            ];
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseArray = json_decode($response->getBody()->getContents(), JSON_BIGINT_AS_STRING);

            throw new HttpException($responseArray['message'], $responseArray['status']);
        }
    }
}

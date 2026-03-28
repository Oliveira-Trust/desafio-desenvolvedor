<?php

namespace Database\Factories;

use App\Models\Instrument;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Instrument>
 */
class InstrumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'upload_history_id' => \App\Models\UploadHistory::factory(),
            'RptDt' => $this->faker->date('Y-m-d'),
            'TckrSymb' => $this->faker->unique()->bothify('???####'),
            'Asst' => $this->faker->word(),
            'AsstDesc' => $this->faker->sentence(3),
            'SgmtNm' => $this->faker->word(),
            'MktNm' => $this->faker->word(),
            'SctyCtgyNm' => $this->faker->word(),
            'XprtnDt' => $this->faker->optional()->date('Y-m-d'),
            'XprtnCd' => $this->faker->optional()->bothify('##'),
            'TradgStartDt' => $this->faker->optional()->date('Y-m-d'),
            'TradgEndDt' => $this->faker->optional()->date('Y-m-d'),
            'BaseCd' => $this->faker->optional()->numberBetween(1, 999),
            'ConvsCritNm' => $this->faker->optional()->word(),
            'MtrtyDtTrgtPt' => $this->faker->optional()->numberBetween(1, 365),
            'ReqrdConvsInd' => $this->faker->optional()->randomElement(['S', 'N']),
            'ISIN' => $this->faker->optional()->bothify('BR??????????'),
            'CFICd' => $this->faker->optional()->bothify('??#####'),
            'DlvryNtceStartDt' => $this->faker->optional()->date('Y-m-d'),
            'DlvryNtceEndDt' => $this->faker->optional()->date('Y-m-d'),
            'OptnTp' => $this->faker->optional()->randomElement(['CALL', 'PUT']),
            'CtrctMltplr' => $this->faker->optional()->randomFloat(2, 1, 1000),
            'AsstQtnQty' => $this->faker->optional()->numberBetween(1, 10000),
            'AllcnRndLot' => $this->faker->optional()->numberBetween(1, 100),
            'TradgCcy' => $this->faker->optional()->currencyCode(),
            'DlvryTpNm' => $this->faker->optional()->word(),
            'WdrwlDays' => $this->faker->optional()->numberBetween(0, 30),
            'WrkgDays' => $this->faker->optional()->numberBetween(1, 30),
            'ClnrDays' => $this->faker->optional()->numberBetween(1, 60),
            'RlvrBasePricNm' => $this->faker->optional()->word(),
            'OpngFutrPosDay' => $this->faker->optional()->numberBetween(1, 10),
            'SdTpCd1' => $this->faker->optional()->bothify('##'),
            'UndrlygTckrSymb1' => $this->faker->optional()->bothify('???####'),
            'SdTpCd2' => $this->faker->optional()->bothify('##'),
            'UndrlygTckrSymb2' => $this->faker->optional()->bothify('???####'),
            'PureGoldWght' => $this->faker->optional()->randomFloat(2, 0.1, 100),
            'ExrcPric' => $this->faker->optional()->randomFloat(2, 1, 1000),
            'OptnStyle' => $this->faker->optional()->randomElement(['AMERICANO', 'EUROPEU', 'BERMUDENSE']),
            'ValTpNm' => $this->faker->optional()->word(),
            'PrmUpfrntInd' => $this->faker->optional()->randomElement(['S', 'N']),
            'OpngPosLmtDt' => $this->faker->optional()->date('Y-m-d'),
            'DstrbtnId' => $this->faker->optional()->numberBetween(1, 9999),
            'PricFctr' => $this->faker->optional()->numberBetween(1, 100),
            'DaysToSttlm' => $this->faker->optional()->numberBetween(0, 5),
            'SrsTpNm' => $this->faker->optional()->word(),
            'PrtcnFlg' => $this->faker->optional()->randomElement(['S', 'N']),
            'AutomtcExrcInd' => $this->faker->optional()->randomElement(['S', 'N']),
            'SpcfctnCd' => $this->faker->optional()->bothify('SPC###'),
            'CrpnNm' => $this->faker->optional()->company(),
            'CorpActnStartDt' => $this->faker->optional()->date('Y-m-d'),
            'CtdyTrtmntTpNm' => $this->faker->optional()->word(),
            'MktCptlstn' => $this->faker->optional()->numberBetween(1000000, 1000000000),
            'CorpGovnLvlNm' => $this->faker->optional()->word(),
        ];
    }
}

<?php

namespace App\Business;

use App\Repositories\MoedaRepository;
use GuzzleHttp\Exception\TransferException;

class ConversionBusiness
{
    /**
     * @var MoedaRepository
     */
    private $moedaRepository;

    public function __construct(MoedaRepository $moedaRepository)
    {
        $this->moedaRepository = $moedaRepository;
    }

    public function getMoedaSelecionada($moeda){
        try {
            return $this->moedaRepository->getMoeda($moeda);
        } catch (TransferException $e) {

        } catch (\Exception $e) {

        }
    }
}

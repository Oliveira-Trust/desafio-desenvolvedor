<?php
namespace App\Domain\Repositories;

interface ConversionRepositoryInterface{
    public function create(Array $paramsToConversion); 

    public function getConversionHistory(int $idUser): Array;
}
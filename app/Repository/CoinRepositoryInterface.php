<?php
/**
 * Created by PhpStorm.
 * User: Thainan
 * Date: 05/01/2022
 * Time: 10:02
 */

namespace App\Repository;

use Illuminate\Http\Request;

interface CoinRepositoryInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function convert(Request $request);

    /**
     * @param null
     * @return Response
     */
    public function getCoins();

}

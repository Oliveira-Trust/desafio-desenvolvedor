<?php
/**
 * Created by PhpStorm.
 * User: Thainan
 * Date: 05/01/2022
 * Time: 10:02
 */

namespace App\Repository;

use Illuminate\Http\Request;

interface HistoryRepositoryInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function setHistory(Request $request);

    /**
     * @param null
     * @return Response
     */
    public function getHistory();

}

<?php
/**
 * Created by PhpStorm.
 * User: Thainan
 * Date: 05/01/2022
 * Time: 10:02
 */

namespace App\Repository;

use Illuminate\Http\Request;


interface UserRepositoryInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request);

    /**
     * @param Request $request
     * @return Response
     */
    public function register(Request $request);

    /**
     * @param null
     * @return Response
     */
    public function logout();
}

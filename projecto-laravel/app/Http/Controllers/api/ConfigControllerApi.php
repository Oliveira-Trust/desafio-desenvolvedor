<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigControllerApi extends Controller
{
    public function changeConfig()
    {

        $fee_limit_level_one = request()->fee_limit_level_one;
        $fee_level_one = request()->fee_level_one;
        $fee_level_two = request()->fee_level_two;
        $min_value_convertion = request()->min_value_convertion;
        $max_value_convertion = request()->max_value_convertion;

        $config = Config::first();
        if($fee_limit_level_one && $config->fee_limit_level_one != $fee_limit_level_one) {
            $config->fee_limit_level_one = $fee_limit_level_one;
        }
        if($fee_level_one && $config->fee_level_one != $fee_level_one) {
            $config->fee_level_one = $fee_level_one;
        }
        if($fee_level_two && $config->fee_level_two != $fee_level_two) {
            $config->fee_level_two = $fee_level_two;
        }
        if($min_value_convertion && $config->min_value_convertion != $min_value_convertion) {
            $config->min_value_convertion = $min_value_convertion;
        }
        if($max_value_convertion && $config->max_value_convertion != $max_value_convertion) {
            $config->max_value_convertion = $max_value_convertion;
        }

        $res = $config->save();

        return ["status" => $res, 'message' => $res ? trans('config.resultchange.success'):trans('config.resultchange.fail')];
    }
}

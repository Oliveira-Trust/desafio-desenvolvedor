<?php

namespace App\Http\Controllers;

use App\Services;
use Validator;
use App\Services\Order;
use App\Services\Exchange;
use Illuminate\Http\Request;

use AWS;

use Illuminate\Support\Facades\Http;

class ExchangeController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'source' => 'required|string|max:3',
            'target' => 'required|string|max:3',
            'method' => 'required|string|max:20',
            'amount' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($value < 1000 OR $value > 100000) {
                        $fail('This AMOUNT is not within the quotation limit');
                    }
                }]
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $order = new Order(
            $request->get('source'),
            $request->get('target'),
            $request->get('amount'),
            $request->get('method'),
            $request->get('token'),
        );

        $exchange = new Exchange($order);
        $exchange->calculete();
        
        return response()->json($order->result());
    }

    public function asyncContation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'source' => 'required|string|max:3',
            'target' => 'required|string|max:3',
            'method' => 'required|string|max:20',
            'amount' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($value < 1000 OR $value > 100000) {
                        $fail('This AMOUNT is not within the quotation limit');
                    }
                }]
        ]);
        
        if ($validator->fails()) {
            $error = $validator->errors();
        }

        $order = new Order(
            $request->get('source'),
            $request->get('target'),
            $request->get('amount'),
            $request->get('method'),
            $request->get('token'),
        );


        $exchange = new Exchange($order);
        $exchange->calculete();
        $result = isset($error) ? $error : $order->result();
        $result["token"] = $request->get('token');

        $aws = AWS::createClient('sns', ['endpoint' => 'localstack:4566']);

        $aws->publish([
            'Message'=> json_encode($result),
            'TopicArn' => 'arn:aws:sns:sa-east-1:000000000000:notification'
        ]);

        return response()->json(['status' => 'ok'], 201); 
    }
}
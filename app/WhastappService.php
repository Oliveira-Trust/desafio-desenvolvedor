<?php

namespace App;

use App\Order;
use App\User;
use App\Extras;
use App\Models\Variants;
use App\Address;
use App\Models\OrderHasItems;
use App\Models\WhatsappMessage;
use App\Models\MyModel;

class WhastappService {

    public static function getMobileInfo($name) {
        $protocol = env("WHATSAPP_PROTOCOL", "somedefaultvalue");
        $hostname = env("WHATSAPP_URL", "somedefaultvalue");
        $port = env("WHATSAPP_PORT", "somedefaultvalue");


//        $protocol+'://'+$hostname+':'+$port+'/getHostDevice

        $ch = curl_init($protocol . '://' . $hostname . ':' . $port . '/getHostDevice');
# Setup request to send json via POST.
        $payload = json_encode(array(
            "SessionName" => $name,
            "AuthorizationToken" => "podecolocarqualquercoisa"
                )
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
//# Return response instead of printing.
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15); //timeout in seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//# Send request.
        $result = curl_exec($ch);
        dd($result);
        $result = json_decode($result, true);
        curl_close($ch);


        $device = array(
            'session' => $result['wid']['user'],
            'hw' => $result['phone']['device_manufacturer'] . ' - ' . $result['platform'],
            'batt' => $result['plugged'] ? $result['battery'] . '-' . 'Carregando' : $result['battery'] . '-' . 'Descarregando',
            'respond' => $result['isResponse'] ? 'Está Respondendo' : 'Não Responde',
        );

//# Print response. 
        return $device;
    }

    public static function isConnected($name, $status = false) {

        $protocol = env("WHATSAPP_PROTOCOL", "somedefaultvalue");
        $hostname = env("WHATSAPP_URL", "somedefaultvalue");
        $port = env("WHATSAPP_PORT", "somedefaultvalue");

        $ch = curl_init($protocol . '://' . $hostname . ':' . $port . '/sessions/' . $name);
# Setup request to send json via POST.
//# Return response instead of printing
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15); //timeout in seconds

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//# Send request.
        $result = curl_exec($ch);
        $result = json_decode($result, true);
    //    dd($result);

        if(isset($result['message'] ) && $result['message'] == 'Session found') return true;
        else return false;

        curl_close($ch);
    }

    public static function sendMessageReward($order, $cupom) {
        $name = $order->restorant->getFormmatedWhatsapp();
        $client_phone = User::find($order->client_id)->getFormmatedPhone();
        $message .= "\n " . WhastappService::generateTextReward($cupom);
        WhastappService::sender($name, $client_phone, $message);
    }

    public static function sendMessage($order, $status) {

        $name = $order->restorant->getFormmatedWhatsapp();

        if (WhastappService::isConnected($name)) {
//          dd('enviada');

            $message = WhatsappMessage::
                    where('restorant_id', $order->restorant->id)->
                    where('parameter', $status)->
                    first();

            if (isset($message) || $status == 'fail' || $status == 'paid' || $status == 14) {
//                dd('enviada');
                $message = $message->message;

                if ($status == 1) {

//                    $message = $message->message ;
                    $message .= "\n " . WhastappService::generateTextOrder($order);
                }
                if ($status == 'fail') {

//                    $message = $message->message ;
                    $message .= "\n " . WhastappService::generateTextOrderFail($order);
                }
                if ($status == 'paid') {

//                    $message = $message->message ;
                    $message .= "\n " . "Confirmamos que recebemos o pagamento do seu pedido e iremos iniciar o preparo dele";
                }

                $client_phone = User::find($order->client_id)->getFormmatedPhone();

                WhastappService::sender($name, $client_phone, $message);
            }
            return false;
        } else {
            return false;
        }
    }

    public static function sender($name, $client_phone, $message,$image = null) {
        $protocol = env("WHATSAPP_PROTOCOL", "somedefaultvalue");
        $hostname = env("WHATSAPP_URL", "somedefaultvalue");
        $port = env("WHATSAPP_PORT", "somedefaultvalue");
        $ch = curl_init($protocol . '://' . $hostname . ':' . $port . '/' . $name . '/messages/send');
# Setup request to send json via POST.
//                dd($client_phone);
//                dd($result) ;
// dd(getimagesize($image) );
if(isset($image)){
          
    if(getimagesize($image)!= false)    
    $data = array(
        "type" => "number",
        'jid' => $client_phone, // NUMERO A SER ENVIADO EM FORMATO WHATSAPP            
        'message' => [
            'image' => ['url' => env('APP_URL').'/'.$image, ]
                ,'caption' => $message
        ]// MENSAGEM PARA SER ENVIADA   
            );
            else
            $data = array(
                "type" => "number",
                'jid' => $client_phone, // NUMERO A SER ENVIADO EM FORMATO WHATSAPP            
                'message' => [
                    'video' => ['url' => env('APP_URL').'/'.$image, ]
                        ,'caption' => $message
                ]// MENSAGEM PARA SER ENVIADA   
                    );
}else
    $data = array(
            "type" => "number",
            'jid' => $client_phone, // NUMERO A SER ENVIADO EM FORMATO WHATSAPP            
            'message' => ['text' => $message]// MENSAGEM PARA SER ENVIADA   
                )
        ;

        $payload = json_encode($data);
//dd($message);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15); //timeout in seconds

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
        );
//# Return response instead of printing.
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//# Send request.

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);
//# Print response.
        return true;
    }


    public static function senderBulk($name, $data) {
        $protocol = env("WHATSAPP_PROTOCOL", "somedefaultvalue");
        $hostname = env("WHATSAPP_URL", "somedefaultvalue");
        $port = env("WHATSAPP_PORT", "somedefaultvalue");
        $ch = curl_init($protocol . '://' . $hostname . ':' . $port . '/' . $name . '/messages/send/bulk');
# Setup request to send json via POST.
//                dd($client_phone);
//                dd($result) ;
        // dd(json_encode($data));


        // $payload = json_encode($data);
        $payload = json_encode($data);
//dd($message);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15); //timeout in seconds

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
        );
//# Return response instead of printing.
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//# Send request.

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);
//# Print response.
        return true;
    }

    public static function generateTextReward($cupom) {

        $value = $cupom->type == 0 ? "R$" . $cupom->price : $cupom->price . "%";
        $title = 'PARABÉNS ' . $cupom->client()->name . "\n\n";
        $price = 'Você acabou de ganhar um cupom de ' . $value . "\n";
        $price .= 'Ao completar o programa de fidelidade do restaurante ' . $cupom->restorant()->name . "\n";
        $price .= 'Utilize o código - ' . $cupom->code . ' em qualquer compra no restaurante '
                . 'para aproveitar o benefício' . "\n";
        $price .= 'Você tem 90 dias para aproveitar, depois desse periodo ele expira :(' . "\n";
        $final = $title . $price;

        return $final;
    }

    public static function generateTextOrderFail($order) {
        $title = 'Pedido ' . $order->id . ' #' . "\n\n";
        $price = 'Desculpe, ocorreu algum erro no seu pagamento' . "\n";
        $price .= 'Para tanto confira no link abaixo o que você pode fazer:' . "\n";
        $price .= 'borapedi.com/order/' . $order->id . '/fail:' . "\n";
        $final = $title . $price;

        return $final;
    }

    public static function generateTextOrder($order) {
        $title = '\nNovo Pedido' . $order->id . ' #' . "\n\n";


        $price = '*Preço: R$' . $order->getOrderPrice() . "\n\n";
        if ($order->coupom_id != null) {
            $price .= '*Cupom Aplicado:' . $order->coupom()->first() . "\n\n";
        }
        $price .= '*Taxa de Entrega: R$' . $order->delivery_price . ' ' . config('settings.cashier_currency') . "\n\n";

        $items = '*Detalhes:' . "\n";

        $list = OrderHasItems::where('order_id', $order->id)->get();
//            dd($list[0]->item()->id,$list[1]->item()->id);
        foreach ($list as $item_k) {
//            dd($item_k);
            $item = $item_k->item();
            $restID = $item->category->restorant->id;
            $cartItemPrice = $item->price;
            $cartItemName = $item->name;
            $theElement = '';
            //                vartiant
            if ($item_k->variant_name != '') {
                $res = explode(',', $item_k->variant_name);
                $variant = Variants::
                        where('item_id', '=', $item->id);
                foreach ($res as $val) {
                    $variant = $variant->where('options', 'like', "%" . $val . "%");
                }
                $variant = $variant->first();
                if ($variant->item->id == $item->id) {
                    $cartItemPrice = $variant->price;

                    //For each option, find the option on the
                    $cartItemName = $item->name . ' ' . $variant->optionsList;
                    //$theElement.=$value." -- ".$item->extras()->findOrFail($value)->name."  --> ". $cartItemPrice." ->- ";
                    $variant = $variant->id;
                } else
                    $variant = '';
            } else
                $variant = '';
//                fim variant                
//                Exctras    
//            dd($item_k->extras);
            if ($item_k->extras != '[]') {
                $res = explode(',', str_replace(']', '', str_replace('[', '', str_replace('"', '', $item_k->extras))));
//                    dd($res);
                foreach ($res as $key => $value) {
                    $extras = explode('+', $value);
                    $extra = Extras::where('item_id', '=', $item->id)->
                                    where('name', '=', $extras[0])->first();
//                         dd($extra);

                    $cartItemName .= "\n " . $extra->name;
                    $cartItemPrice += $extra->price;
                    $theElement .= $extra->name . ' -- ' . $extra->name . '  --> ' . $cartItemPrice . ' ->- ';
                }
            }
            $items .= strval($item_k->qty) . ' x ' . $cartItemName . " - R$" . $cartItemPrice . " por cada item" . "\n";
        }
        $items .= "\n";
        $final = $title . $price . $items;
        $address = Address::find($order->address_id)->address;
        if ($address != null) {
            $final .= '*Endereço de Entrega:' . "\n" . $address . "\n\n";
        }

        if ($order->comment != null) {
            $final .= '*Comentário:' . "\n" . $order->comment . "\n\n";
        }
//        dd($final);
        return $final;
    }

}

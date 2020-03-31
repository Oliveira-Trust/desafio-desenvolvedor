<?php

namespace App\MyClass\Contracts;

use Danganf\MyClass\Curl;

abstract class Requests {

    protected $curl, $pathUrl, $serviceName, $isPaginate = false;
    private $header = [], $returnHeader = null, $requestCode=400, $msgErro;

    public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }

    public function setPathUrl($url,$overWrite=true){
        if(empty($this->pathUrl) || $overWrite) {
            $this->pathUrl = $url . $this->serviceName;
        } else {
            $this->pathUrl .= $this->serviceName;
        }
    }

    public function setContentType($type){
        $this->setHeader('Content-Type', 'application/'.$type);
        return $this;
    }

    public function send($host,$options){

        $this->msgErro = null;

        \LogDebug::request('',[
            'host'       => $host,
            'options'    => $options
        ]);

        $return = $this->curl->send($host, $options);
        $result = null;
        if (is_array($return)) {
            $result = json_decode( $return['RESULT'], true );
            $error = false;
            if( is_array( $result ) ) {
                if ( key_exists('error', $result) ) {
                    $error = true;
                } else if ( array_has( $result, 'resource' ) ) {
                    $result = current($result);
                }

            } else if( empty( $result ) ){
                $result = $return['RESULT'];
                $error  = true;
            }

            if($error){
                \LogDebug::error($return['RESULT']);
                $this->setErroMsg($result);
            } else if ( array_get( $return, 'HEADER_RETURN' ) ){
                $this->returnHeader = $return['HEADER_RETURN'];
            }
        }

        if( array_has( $return, 'HTTP_CODE' ) ){
            $this->requestCode = $return['HTTP_CODE'];
        }

        return $result;

    }

    private function setErroMsg($sendResult){
        if( is_array( $sendResult ) && array_has( $sendResult, 'error' ) ){
            $msg = array_get( $sendResult, 'detail' );
            $msg = !empty( $msg ) ? $msg : array_get( $sendResult, 'message' );
            $msg = !empty( $msg ) ? $msg : array_get( $sendResult, 'messages' );
            if( !empty( $msg ) ){
                $this->msgErro = $msg;
            }
        } else if( !empty( $sendResult ) ) {
            $this->msgErro = $sendResult;
        }
    }

    public function getMsgErro(){
        return $this->msgErro;
    }

    public function getRequestCode(){
        return $this->requestCode;
    }

    public function getHeaderReturn(){
        $return = $this->returnHeader;
        $this->returnHeader = null;
        return $return;
    }

    public function getHeader(){
        return $this->header;
    }

    public function setHeader($label, $value){
        $this->header[] = "$label: $value";
        return $this;
    }

}
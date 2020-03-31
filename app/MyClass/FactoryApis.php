<?php

namespace App\MyClass;

use App\MyClass\Contracts\Requests;
use Danganf\MyClass\Curl;
use Illuminate\Http\Request;

/**
 * Class FactoryApis
 * ABASTRAÇÃO DO ENDPOINT... DESSA FORMA, FICA FACIL A SEPARAÇÃO DO BACKEND EM UM SERVIÇO SEPARADO
 * @package App\MyClass
 */
class FactoryApis extends Requests {

    private $options, $request, $method, $paramsGet=[], $msgError=null, $timeCache=0, $nameCache;

    public function __construct(Curl $curl)
    {
        parent::__construct($curl);
        $this->setOptions();
    }

    /**
     * setando parametros gets na consulta utilizando uma entrada array
     * @param $filterArray
     * @return $this
     */
    public function setFilters($filterArray){
        foreach ( $filterArray as $key => $value ){
            $this->setParamsGet( $key, $value );
        }
        return $this;
    }

    /**
     * forçando o reset dos paramentros get
     * @return $this
     */
    public function resetParamsGet(){
        $this->paramsGet=[];
        return $this;
    }

    /**
     * setando parametros gets na consulta
     * @param $param
     * @param $value
     * @return $this
     */
    public function setParamsGet($param,$value){
        //\Log::info($value);
        if( !is_array( $value ) ) {
            $this->paramsGet[$param] = htmlentities(urlencode($value));
        }
        return $this;
    }

    /**
     * setando o $request Laravel da consulta atual
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request){
        $this->request = $request;
        return $this;
    }

    /**
     * metodo mágico utilizando para resolver o verbo que será utilizado na consulta
     * ->get() = METHOD GET
     * ->post() = METHOD POST
     * ->put() = METHOD PUT
     * ->delete() = METHOD DELETE
     *
     * exemplo de uma chamada:
     * $factoryApis->get('customer','avaible')
     * Ele ira executar uma chamada get na rota customer/avaible
     *
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args) {
        $this->method = strtoupper($method);
        $this->processService($args[0]);
        unset($args[0]);
        return $this->{'Call'.ucfirst(strtolower($method))}($args);
    }

    /**
     * trata e coloca no padrão o nome do serviço e seta a url do endpoint
     * @param $srvName
     */
    private function processService($srvName){
        $this->serviceName = str_replace(['@','#'],'/', $srvName);
        $this->setPathUrl(config('app.url_api_endpoint'));
    }

    /**
     * save o resulta da consuta no cache, que tenha sido solicitado
     * @param $returnGet
     */
    private function saveResultInCache( $returnGet ){
        if( !empty( $this->timeCache ) ){
            \DashCache::setTime( $this->timeCache )->create( $this->nameCache, $returnGet );
        }
        $this->timeCache = 0;
        $this->nameCache = null;
    }

    /**
     * obtem o resulta de uma consulta salva no cache
     * @return bool
     */
    private function getResultInCache(){

        $return    = FALSE;
        //if( isProduction() ){
        $cacheName = search_like_in_array( $this->getHeader(), config('app.x_header_cache_name').':' );
        if( $cacheName ){

            $time = search_like_in_array( $this->getHeader(), config('app.x_header_cache_time').':' );
            if( $time ){
                $cacheName  = trim( str_replace(config('app.x_header_cache_name').':', '', current( $cacheName ) ) );
                $time       = (int) trim( str_replace(config('app.x_header_cache_time').':', '', current( $time ) ) );
                $cacheName .= '-s-' . \Request::get('store_id');

                if( $time > 0 ){

                    if( \DashCache::has( $cacheName ) ){
                        $return = \DashCache::get( $cacheName );
                    } else {
                        $this->timeCache = $time;
                        $this->nameCache = $cacheName;
                    }
                } else {
                    !\DashCache::forget( $cacheName );
                }
            }
        }
        //}
        \Request::except( [ config('app.x_header_cache_name'), config('app.x_header_cache_time') ] );
        return $return;

    }

    /**
     * método mágico get
     * @param null $path
     * @return array|bool|mixed|string|null
     */
    public function CallGet($path=null){//dd($this->getHeader(),$this->processPath($path), $this->processOptions());

        $return = $this->getResultInCache();
        if( $return === FALSE ) {
            $return = $this->send($this->processPath($path), $this->processOptions());
        }

        if( is_string( $return ) || array_has( $return, 'error' ) ) {
            $return         = is_string( $return ) ? [ 'messages' => $return ] : $return;
            $this->msgError = array_get($return, 'messages', null);
            $this->msgError = !empty($this->msgError) ? $this->msgError : array_get($return, 'message', null);
            $return         = [];
        }
        else if ( !is_array( $return ) ) {
            $return = [];
        } else {
            $this->saveResultInCache( $return );
        }

        $this->isPaginate = FALSE;
        $this->timeCache  = FALSE;
        $this->nameCache  = NULL;

        return $return;

    }

    /**
     * obtem a mensagem de erro
     * @return |null
     */
    public function getError(){
        return $this->msgError;
    }

    /**
     * método mágico post
     * @param null $path
     * @return array|mixed|null
     */
    public function CallPost($path=null) {
        return $this->CallPut($path);
    }

    /**
     * método mágico patch
     * @param null $path
     * @return array|mixed|null
     */
    public function CallPatch($path=null) {
        return $this->CallPut($path);
    }

    /**
     * informa que o resulta deverá ser cacheado
     * @param $nameCache
     * @param int $minutes
     * @return $this
     */
    public function onCache($nameCache, $minutes=5){
        $this->setHeader(config('app.x_header_cache_name'),$nameCache);
        $this->setHeader(config('app.x_header_cache_time'),$minutes);
        return $this;
    }

    /**
     * método mágico put
     * @param null $path
     * @return array|mixed|null
     */
    public function CallPut($path=null) {//dd($this->processPath($path), $this->processOptions());

        $url    = $this->processPath($path);
        $return = $this->send( $url, $this->processOptions() );
        if ( !is_array( $return ) || array_has( $return, 'error' ) ) {
            $this->processError($return);
            $return = [];
        }

        return $return;
    }

    /**
     * método mágico delete
     * @param null $path
     * @return array|mixed|null
     */
    public function CallDelete($path=null) {//dd($this->processPath($path), $this->processOptions());

        $url = $this->processPath($path);

        $return = $this->send( $url, $this->processOptions() );
        if ( !is_array( $return ) || array_has( $return, 'error' ) ) {
            $this->processError($return);
            $return = [];
        }

        return $return;
    }

    /**
     * trata possiveis retorno de erro do endpoint
     * @param $return
     */
    private function processError($return){
        if( is_array( $return ) ){

            if( array_has( $return, 'error.status_code' ) ){
                try{
                    $message = array_get( $return, 'error.message' );
                    if( !empty( $message ) ){

                        $message = mb_convert_encoding($message, "UTF-8", "HTML-ENTITIES");
                        if( isJson( $message) ){
                            $message = json_decode( $message, true );
                            if( is_array( $message ) && array_has( $message, 'messages' ) ){
                                $this->msgError = array_get($message, 'messages', null);
                            }
                        } else {
                            $this->msgError = $message;
                        }
                    }
                } catch (\Exception $e){
                    //
                }
            } else {
                $this->msgError = array_get($return, 'messages', null);
                $this->msgError = !empty( $this->msgError ) ? $this->msgError : array_get($return, 'detail', null);
                $this->msgError = !empty( $this->msgError ) ? $this->msgError : array_get($return, 'message', null);
            }
        } else if( !empty( $return ) ) {
            $this->msgError = $return;
        }
    }

    /**
     * Monta a url que será executada
     * @param null $path
     * @return string
     */
    private function processPath($path=null){

        $queryString = '';
        if( $this->method == 'GET' && ( $this->request instanceof Request || !empty( $this->paramsGet ) ) ){

            if( empty( $this->paramsGet ) ) {
                $values = $this->request->all();
                array_pull($values, 'routeName');
                array_pull($values, 'cssFiles');
                array_pull($values, 'jsFiles');
            } else {
                $values = $this->paramsGet;
                $this->resetParamsGet();
            }

            $queryString = implodeArrayQueryString( $values );
            $queryString = (empty($queryString) ? '' : '?'.$queryString);
        }

        $path = is_array( $path ) ? current( $path ) : $path;
        $path = ( empty( $path ) ? '' : $path );

        return $this->pathUrl.'/'.str_replace(['@','/'],'/', $path).$queryString;
    }

    /**
     * prepara os dados request que serão enviados
     * @return mixed
     */
    private function processOptions(){

        $this->setOptions();
        if( $this->method !== 'GET' ){
            $this->options['method'] = $this->method;
            if( $this->request instanceof Request && !empty($this->request->all()) ) {

                $requestData = $this->request->all();
                array_pull($requestData, '_token');
                array_pull($requestData, 'cssFiles');
                array_pull($requestData, 'jsFiles');

                $this->options['data'] = json_encode($requestData, JSON_UNESCAPED_UNICODE);
                $this->options['json'] = true;
            }
        }
        return $this->options;
    }

    /**
 * seta as opçoes do header
     */
    private function setOptions(){
        $this->options = [ 'header' => $this->getHeader() ];
    }

}

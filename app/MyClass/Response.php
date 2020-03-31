<?php

namespace App\MyClass;

use Illuminate\Http\Request;

class Response
{
    private $params;
    private $return = [];
    private $code   = 200;
    private $method;

    public function __construct(Request $request){
        $this->params = $request->all();
    }

    public function factory(\Exception $e){

        $retorno      = $e;
        $method       = get_class($e);
        $this->method = $method;

        #VERIFICANDO SE TEM NAMESPACE
        if( strpos($method, '\\') !== FALSE ){
            $method = last( explode( '\\', $method ) );
        }

        if( method_exists($this,$method) ){
            $retorno = $this->{$method}($e);
        }
        return $retorno;
    }

    private function Unauthorized(\Exception $e){
        $this->setError();
        $this->code401();
        return $this->render(\Lang::get('default.unauthorized'),$e->getMessage());
    }

    private function MethodNotAllowedHttpException(\Exception $e){
        $this->setError();
        $this->code405();
        return $this->render(\Lang::get('default.NotAllowedHttpException'),$e->getMessage());
    }

    private function FatalErrorException(\Exception $e){
        $this->setError();
        $this->code500();
        return $this->render(\Lang::get('default.FatalErrorException'),$e->getMessage());
    }

    private function InvalidArgumentException(\Exception $e){
        $this->setError();
        $this->code500();
        return $this->render(\Lang::get('default.internal_server_error'),$e->getMessage());
    }

    private function FatalThrowableError(\Exception $e){
        return $this->InvalidArgumentException($e);
    }

    private function HttpException(\Exception $e){
        return $this->Unauthorized($e);
    }

    private function ReflectionException(\Exception $e){
        return $this->InvalidArgumentException($e);
    }

    private function FileNotFoundException(\Exception $e){
        return $this->InvalidArgumentException($e);
    }

    private function PostTooLargeException(\Exception $e){
        return $this->InvalidArgumentException($e);
    }

    private function Swift_TransportException(\Exception $e){
        return $this->InvalidArgumentException($e);
    }

    private function QueryException(\Exception $e){
        return $this->InvalidArgumentException($e);
    }

    private function Oci8Exception(\Exception $e){
        return $this->InvalidArgumentException($e);
    }

    private function ErrorException(\Exception $e){
        return $this->InvalidArgumentException($e);
    }

    private function BadMethodCallException(\Exception $e){
        return $this->InvalidArgumentException($e);
    }

    private function ApiException(\Exception $e){
        return $this->InvalidArgumentException($e);
    }

    private function NotFoundHttpException(\Exception $e){
        $this->setError();
        $this->code404();
        return $this->render(\Lang::get('default.notfound'),$e->getMessage());
    }

    private function code404(){$this->code = 404;}
    private function code405(){$this->code = 405;}
    private function code500(){$this->code = 500;}
    private function code401(){$this->code = 401;}

    private function setError(){
        $this->return = array_add( $this->return, 'error', 1 );
    }

    private function render($message,$detail=''){
        $this->return['message'] = $message;
        $this->return['detail']  = $detail;
        $return = [ 'messages' => $this->return, 'code' => $this->code ];
        return $return;
    }
}
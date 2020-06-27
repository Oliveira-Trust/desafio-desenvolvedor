<?php







class ControllerCliente extends Controller{




    public function __construct()
    {
        parent::__construct(new modelCliente(), new validaCliente());
    }


}
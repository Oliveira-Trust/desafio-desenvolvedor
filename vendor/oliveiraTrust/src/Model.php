<?php

    namespace Main;

    class Model{



    private $values = [];




       public function __call($name, $args)
       {

            $method =substr($name,0,3);

            $fieldname = substr($name,3,strlen($name));


       // private $vales ={
         
        //}



        switch($method){
            
            case 'set':
                $this->values[$fieldname] = $args[0];
                break;
             break;

            case 'get':
                return  ( isset( $this->values[$fieldname] ) ) ? $this->values[$fieldname] : NULL;
            break;

        }



      
         
       }




       public function setData($data){
                foreach($data as $key => $value){
                    $this -> {"set".$key}($value);
                
                } 
         }//EndMethod

         public function getData(){

            return $this->values;

         }//EndMethod









    }//Fim Class

?>
<?php

use Main\Model\Purchase;
use \Main\PageAdmin;
use \Main\Model\User;

 


     




  $app->get('/admin'.'/', function($request, $response, $name){     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
    
    //Autenticação de ADM
      User::verifyLogin();

      $user = User::getFromSession();
    
    $purchase = new Purchase();
   
      

      $page = new PageAdmin();                  
      $page -> setTpl("index",[

          'user' => $user->getData(),
          'sucess'=> User::getSucess(),
          'results'=> $purchase ->getAllPurchases(),
          'error'=>User::getError()
        ]); 
        

      return $response;
  });            
  
  


  


?>


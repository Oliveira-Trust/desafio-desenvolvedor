<?php

use Main\Model\Products;
use \Main\Page;
use \Main\Model\User;
         

       
$app->get('/', function($request, $response, $name){
                            
         $results = User::listAll();      

         $products = new Products();
         $Allproducts = $products->getAllProducts();

         $user = User::getFromSession();

         if(User::checkLogin()){
            $isAdmin = $user->getinadmin();
         }else{$isAdmin = 0;}
       

         $page = new Page();                  
         $page -> setTpl("index", [
         'results' => $results,
         'products' => $Allproducts,
         'sucess' => User::getSucess(),
         'error' => User::getError(),
         'logged' => User::checkLogin(),
         'checkadm' => $isAdmin
         ]);
         return $response;

});





?>
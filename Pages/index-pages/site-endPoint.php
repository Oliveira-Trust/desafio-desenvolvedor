<?php

use \Main\Model\User;
         


$app->get('/endpoint/hash/{CodeToHash}', function($request, $response, $hash){
                
    $despassword = $hash['CodeToHash']; 
    $Hash = User::setPasswordHashing(   $despassword   );
  
    echo '<pre>';
    var_dump($Hash);
    exit;

    return $response;
    });

 

    $app->get('/endpoint/base/{CodeToBase64}', function($request, $response, $hash){               
  
        $value = $hash['CodeToBase64'];     
        $base = base64_encode($value);
    
        echo '<pre>';
        var_dump($base);
        exit;
   
        return $response;
        });
    



?>
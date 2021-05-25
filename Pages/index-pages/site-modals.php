<?php

use Main\Model\Products;
use \Main\Page;
use \Main\Model\User;
         



$app->get('/modal-produtos/{idproduct}', function($request, $response, $idproduct){
                
 
    $productID = getHash($idproduct['idproduct']) ;

    $page = new Page([
        'header' => false,
        'footer' => false
    ]);         



    $product = new Products();

   
 
    $productArray = $product->get($productID);
                                   
     //CONTAGEM DAS IMAGEMS (COMEÇANDO A PARTIR DO 1 E NÃO DO 0)
     $imgsCount = count( unserialize(base64_decode($productArray[0]['desimages'] ) ) ) ;
                            
     //CHECAR SE ALGUMA DAS IMAGENS TEM MAIS DE 3MB
     for($i = 0; $i <= $imgsCount - 1; $i++){      
       $Images[$i] =  unserialize(base64_decode($productArray[0]['desimages'] ) )[$i];
    }

    

    $img_link_1 =  $product->SetIMGLink($Images, 0);
    $img_link_2 =  $product->SetIMGLink($Images, 1);
    $img_link_3 =  $product->SetIMGLink($Images, 2);
    $img_link_4 =  $product->SetIMGLink($Images, 3);


    $page -> setTpl("produto-modal",[

        'produto' => $productArray[0],
 
        'img_link_1' => $img_link_1 ,
        'img_link_2' => $img_link_2 ,
        'img_link_3' => $img_link_3 ,
        'img_link_4' => $img_link_4 

    ]);

    return $response;
    });




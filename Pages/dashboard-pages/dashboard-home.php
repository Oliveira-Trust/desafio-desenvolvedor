<?php

use \Main\PageDashboard;
use \Main\Model\User;







$app->get('/dashboard/ver-anuncio', function($request, $response, $name){                             
                        
            
    //Autenticação de ADM
    User::verifyLogin(false);

    $user = User::getFromSession();

    $page = new PageDashboard();                  
    $page -> setTpl("ver-anuncio",[

        'user'=>$user->getData()    

    ]);    

    return $response;
    });     


















$app->get('/dashboard/atualizacoes', function($request, $response, $name){                             
                        
            
    //Autenticação de ADM
    User::verifyLogin(false);

    $user = User::getFromSession();

    $page = new PageDashboard();                  
    $page -> setTpl("atualizacoes",[

        'user'=>$user->getData()    

    ]);    

    return $response;
    });     





















    $app->get('/dashboard/produtos', function($request, $response, $name){                             
                    
        
        //Autenticação de ADM
        User::verifyLogin(false);

        $user = User::getFromSession();

        $page = new PageDashboard();                  
        $page -> setTpl("products",[

            'user'=>$user->getData()    

        ]);    

        return $response;
        });                       









        
 $app->get('/dashboard', function($request, $response, $name){                             
                   
    
    //Autenticação de ADM
    User::verifyLogin(false);

    $user = User::getFromSession();

   

    $page = new PageDashboard();                  
    $page -> setTpl("index",[

        'user'=>$user->getData(),    
        'error' => $user->getError(),
        'results' => getWhoBuyBYID($user->getiduser()),
        'sucess' => $user->getSucess()
    ]);    

    return $response;
    });                       




?>
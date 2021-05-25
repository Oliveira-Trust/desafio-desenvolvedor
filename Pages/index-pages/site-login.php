<?php

use \Main\Page;
use Main\Validate;
use \Main\Rule;
use \Main\Model\User;




    $app->get('/logout', function($request, $response, $name){     //Adicionar Hashcode no endereço (ex = 5152151251Admin/Login) para evitar ataques SQL INJECT                         
                
        User::logout();
        header("Location: /");
        exit;
    
        return $response;
    });//end            



    
    $app->get('/login-modal', function($request, $response, $name){
                
  
        $name = 'Rodrigo Faro';
    
        //Passar nome pelo URL ?nome=Pedro
        if( isset($_GET['nome']) && $_GET['nome'] != ''){
         $name = ucwords(strtolower($_GET['nome']));
        }
    
        $page = new Page([

            'header' =>false,
            'footer' =>false,

        ]);                  
        $page -> setTpl("login-modal",[
    
            'name' => $name,
            'error' => User::getError()
        ]);
    
        return $response;
        });
    
    








    $app->post('/logar', function($request, $response, $name){     //Adicionar Hashcode no endereço (ex = 5152151251Admin-Login) para evitar ataques maliciosos                          
              
        

    if( !isset($_POST['deslogin']) || $_POST['deslogin'] == '' ){


            User::setError(Rule::ERROR_EMAIL);
            header("Location: /logar");
            exit;

    }
 
    if( ( $deslogin = Validate::ValidateEmail($_POST['deslogin'] ) ) === false){

             User::setError(Rule::VALIDATE_EMAIL);
            header("Location: /logar");
            exit;

    }


    if( !isset($_POST['despassword']) || $_POST['despassword'] == '' ){

        User::setError(Rule::ERROR_PASSWORD);
        header("Location: /logar");
        exit;

    }

    if( ( $despassword = Validate::validatePassword($_POST['despassword'] ) ) === false){
      
            User::setError(Rule::VALIDATE_PASSWORD);
            header("Location: /logar");
            exit;

    }




    try{   
     User::login( $deslogin, $despassword );
    }//EndTry
    catch( \Exception $e){
      
        User::setError($e->getMessage());

    }//EndTry

    header("Location: /dashboard");
    exit;




    return $response;
    });  //end  






    






$app->get('/logar', function($request, $response, $name){
                
 

    $page = new Page();                  
    $page -> setTpl("login",[

      'error' => User::getError()
    
  
      ]);

      return $response;
    });



?>
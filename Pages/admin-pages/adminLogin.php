<?php


use \Main\PageAdmin;
use Main\Validate;
use \Main\Rule;
use \Main\Model\User;









    $app->get('/admin/logout', function($request, $response, $name){     //Adicionar Hashcode no endereço (ex = 5152151251Admin/Login) para evitar ataques SQL INJECT                         
                
        User::logout();
        header("Location: /admin/login ");
        exit;
    
        return $response;
    });  //end            




    $app->post('/admin/login', function($request, $response, $name){     //Adicionar Hashcode no endereço (ex = 5152151251Admin/Login) para evitar ataques SQL INJECT                         
                     
    if( !isset($_POST['deslogin']) || $_POST['deslogin'] == '' ){


            User::setError(Rule::ERROR_EMAIL);
            header("Location: /admin/login");
            exit;

    }


    if( ( $deslogin = Validate::ValidateEmail( $_POST['deslogin'] ) ) === false){

             User::setError(Rule::VALIDATE_EMAIL);
            header("Location: /admin/login");
            exit;

    }



    if( !isset($_POST['despassword']) || $_POST['despassword'] == '' ){

        User::setError(Rule::ERROR_PASSWORD);
        header("Location: /admin/login");
        exit;

    }



    if( ( $despassword = Validate::validatePassword($_POST['despassword'] ) ) === false){
      
            User::setError(Rule::VALIDATE_PASSWORD);
            header("Location: /admin/login");
            exit;

    }




    try{   
     User::login( $deslogin, $despassword );
    }//EndTry
    catch( \Exception $e){
      
        User::setError($e->getMessage());

    }//EndTry


    header("Location: /admin/");
    exit;




    return $response;
    });  //end 











$app->get('/admin/login', function($request, $response, $name){     //Adicionar Hashcode no endereço (ex = 5152151251Admin/Login) para evitar ataques SQL INJECT                         
              
  


    $page = new PageAdmin([
        'header' => false,
        'footer' => false
    ]);                  
    $page -> setTpl("login",[

        'date' => date("Y"),
        'error' => User::getError()

    ]);    
  
        return $response;
});  //end                  


?>


<?php


use \Main\PageAdmin;
use \Main\Model\User;
use Main\Validate;
use Main\Rule;




    
    $app->post('/admin/mudar-senhaADM', function ( $request, $response) {     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
        
      //Autenticação de ADM
      User::verifyLogin();
     
      $user = User::getFromSession();
      
 
    
      if( !isset($_POST['current_pass']) || $_POST['current_pass'] == '' ){

        User::setError(Rule::ERROR_CURRENT_PASS);
        header("Location: /admin/mudar-senhaADM");
        exit;

    }

    if( ( $current_pass = Validate::validatePassword($_POST['current_pass'] ) ) === false){
      
            User::setError(Rule::VALIDATE_PASSWORD);
            header("Location: /admin/mudar-senhaADM");
            exit;

    }



      if( !isset($_POST['new_pass']) || $_POST['new_pass'] == '' ){

        User::setError(Rule::ERROR_CURRENT_PASS);
        header("Location: /admin/mudar-senhaADM");
        exit;

    }

    if( ( $new_pass = Validate::validatePassword($_POST['new_pass'] ) ) === false){
      
            User::setError(Rule::VALIDATE_PASSWORD);
            header("Location: /admin/mudar-senhaADM");
            exit;

    }


    if( !isset($_POST['new_pass_confirm']) || $_POST['new_pass_confirm'] == '' ){

      User::setError(Rule::ERROR_PASSWORD);
      header("Location: /admin/mudar-senhaADM");
      exit;

  }

  if( $_POST['new_pass'] !== $_POST['new_pass_confirm'] ){

    User::setError(Rule::INCORRECT_CONFIRM);
    header("Location: /admin/mudar-senhaADM");
    exit;

   }



  

   if( $_POST['new_pass'] == $_POST['current_pass'] ){

    User::setError(Rule::VERIFY_CURRENT_PASS);
    header("Location: /admin/mudar-senhaADM");
    exit;

   }


   if ( !(password_verify($current_pass, $user->getdespassword()) )  ) 
   {
        User::setError(Rule::VERIFY_PASSWORD);
        header("Location: /admin/mudar-senhaADM");
        exit;
   }

     $user->setdespassword( User::setPasswordHashing($new_pass) );
    
     $user->update();

     $user->setToSession();

     User::setSucess(Rule::SUCESS_PASSWORD);
     header("Location: /admin/");
     exit;

      return $response;
    });     





$app->get('/admin/mudar-senhaADM', function ( $request, $response ) {     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
        
  //Autenticação de ADM
  User::verifyLogin();
 
  $user = User::getFromSession();
  

  $page = new PageAdmin();                  
  $page -> setTpl("password",[

      'user' => $user->getData(),  
      'error' => User::getError(),

      
  ]); 
  

  return $response;
});      












?>
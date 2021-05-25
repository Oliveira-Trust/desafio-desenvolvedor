<?php


use \Main\PageAdmin;
use \Main\Model\User;
use Main\Validate;
use Main\Rule;






$app->post('/admin/usuarios/editar/{UserID_HASHED}', function ( $request, $response, $hash ) {     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
        
  //Autenticação de ADM
  User::verifyLogin();
 
  $user = User::getFromSession();
  

  $RealID =  Validate::getHash( $hash['UserID_HASHED'] );

  if( is_bool($RealID) && $RealID === false ){
    User::setError(Rule::ERROR_NOTFOUNDED);
      header("Location: /admin/usuarios");
      exit;
  }


    if ( !is_numeric($RealID) ) {
      User::setError(Rule::ERROR_NOTFOUNDED);
      header("Location: /admin/usuarios");
      exit;
    }


      if( !isset($_POST['inseller']) || $_POST['inseller'] == '' ){


        User::setError(Rule::ERROR_BOOL);
        header("Location: /admin/usuarios/editar/".$RealID);
        exit;

      }

      if( ( $inseller = Validate::ValidateBoolean($_POST['inseller'] ) ) === false){
      
        User::setError(Rule::VALIDATE_BOOL);
        header("Location: /admin/usuarios/editar/".$RealID);
        exit;

    }



    if( !isset($_POST['inbuyer']) || $_POST['inbuyer'] == '' ){


      User::setError(Rule::ERROR_BOOL);
      header("Location: /admin/usuarios/editar/".$RealID);
      exit;

    }

    if( ( $inbuyer = Validate::ValidateBoolean($_POST['inbuyer'] ) ) === false){
    
      User::setError(Rule::VALIDATE_BOOL);
      header("Location: /admin/usuarios/editar/".$RealID);
      exit;

  }


    
    if( !isset($_POST['instatus']) || $_POST['instatus'] == '' ){


      User::setError(Rule::ERROR_BOOL);
      header("Location: /admin/usuarios/editar/".$RealID);
      exit;

    }

    if( ( $instatus = Validate::ValidateBoolean($_POST['instatus'] ) ) === false){
    
      User::setError(Rule::VALIDATE_BOOL);
      header("Location: /admin/usuarios/editar/".$RealID);
      exit;

  }


  if( !isset($_POST['inautostatus']) || $_POST['inautostatus'] == '' ){


    User::setError(Rule::ERROR_BOOL);
    header("Location: /admin/usuarios/editar/".$RealID);
    exit;

  }

  if( ( $inautostatus = Validate::ValidateBoolean($_POST['inautostatus'] ) ) === false){
  
    User::setError(Rule::VALIDATE_BOOL);
    header("Location: /admin/usuarios/editar/".$RealID);
    exit;

}



  $RegularUser = new User();


  $RegularUser->get( (int)$RealID );

  if ( (int)$RegularUser->getiduser() === 0) {
    User::setError(Rule::ERROR_NOTFOUNDED);
    header("Location: /admin/usuarios");
    exit;
  }

  if ( (int)$RegularUser->getiduser() > 0 ) {
          
    $RegularUser -> setinseller( $inseller );
    $RegularUser -> setinbuyer( $inbuyer );
    $RegularUser -> setinstatus( $instatus );
    $RegularUser -> setinautostatus( $inautostatus );
  
  
  
    $RegularUser->update();
  
    User::setSucess(Rule::UPDATE_ITEM);
  
    header("Location: /admin/usuarios");
    exit;

  } else {   
    header("Location: /admin/usuarios");
    exit;    
  }
    
 



  return $response;
});      
































$app->get('/admin/usuarios/editar/{UserID_HASHED}', function ( $request, $response, $hash ) {     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
        
        //Autenticação de ADM
        User::verifyLogin();
       
        $user = User::getFromSession();
        
  
        $RealID =  Validate::getHash( $hash['UserID_HASHED'] );
    

     
        if( is_bool($RealID) && $RealID === false ){
            User::setError(Rule::ERROR_NOTFOUNDED);
            header("Location: /admin/usuarios");
            exit;
        }


        if ( !is_numeric($RealID) ) {
          User::setError(Rule::ERROR_NOTFOUNDED);
          header("Location: /admin/usuarios");
          exit;
        }


       $RegularUser = new User();


       $RegularUser->get( (int)$RealID );

       if ( (int)$RegularUser->getiduser() === 0) {
        User::setError(Rule::ERROR_NOTFOUNDED);
        header("Location: /admin/usuarios");
        exit;
      }

        $page = new PageAdmin();                  
        $page -> setTpl("users-update",[

            'user' => $user->getData(),  
            'error' => User::getError(),
            'sucess' => User::getSucess(),
            'RegularUser' => $RegularUser->getData()     
            
        ]); 
        

        return $response;
    });      





















    
    
    $app->post('/admin/usuarios/mudar-senha/{UserID_HASHED}', function ( $request, $response, $hash ) {     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
        
      //Autenticação de ADM
      User::verifyLogin();
     
      $user = User::getFromSession();
      
    
      $RealID =  Validate::getHash( $hash['UserID_HASHED'] );
    
    
      if( is_bool($RealID) && $RealID === false ){
        User::setError(Rule::ERROR_NOTFOUNDED);
          header("Location: /admin/usuarios");
          exit;
      }
    
      if ( !is_numeric($RealID) ) {
        User::setError(Rule::ERROR_NOTFOUNDED);
        header("Location: /admin/usuarios");
        exit;
      }
    
      if( !isset($_POST['new_pass']) || $_POST['new_pass'] == '' ){

        User::setError(Rule::ERROR_PASSWORD);
        header("Location: /admin/usuarios/mudar-senha/".$hash['UserID_HASHED']);
        exit;

    }

    if( ( $new_pass = Validate::validatePassword($_POST['new_pass'] ) ) === false){
      
            User::setError(Rule::VALIDATE_PASSWORD);
            header("Location: /admin/usuarios/mudar-senha/".$hash['UserID_HASHED']);
            exit;

    }


    if( !isset($_POST['new_pass_confirm']) || $_POST['new_pass_confirm'] == '' ){

      User::setError(Rule::ERROR_PASSWORD);
      header("Location: /admin/usuarios/mudar-senha/".$hash['UserID_HASHED']);
      exit;

  }

  if( $_POST['new_pass'] !== $_POST['new_pass_confirm'] ){

    User::setError(Rule::INCORRECT_CONFIRM);
    header("Location: /admin/usuarios/mudar-senha/".$hash['UserID_HASHED']);
    exit;

   }



     $RegularUser = new User();
    
    
     $RegularUser->get( (int)$RealID );
    
     if ( (int)$RegularUser->getiduser() === 0) {
      User::setError(Rule::ERROR_NOTFOUNDED);
      header("Location: /admin/usuarios");
      exit;
    }

     $RegularUser->setdespassword( User::setPasswordHashing($new_pass) );
    
     $RegularUser->update();

     User::setSucess(Rule::SUCESS_PASSWORD);
     header("Location: /admin/usuarios");
     exit;

      return $response;
    });     




































$app->get('/admin/usuarios/mudar-senha/{UserID_HASHED}', function ( $request, $response, $hash ) {     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
        
  //Autenticação de ADM
  User::verifyLogin();
 
  $user = User::getFromSession();
  

  $RealID =  Validate::getHash( $hash['UserID_HASHED'] );


  if( is_bool($RealID) && $RealID === false ){
    User::setError(Rule::ERROR_NOTFOUNDED);
      header("Location: /admin/usuarios");
      exit;
  }

  if ( !is_numeric($RealID) ) {
    User::setError(Rule::ERROR_NOTFOUNDED);
    header("Location: /admin/usuarios");
    exit;
  }


 $RegularUser = new User();


 $RegularUser->get( (int)$RealID );

if ( (int)$RegularUser->getiduser() === 0) {
    User::setError(Rule::ERROR_NOTFOUNDED);
    header("Location: /admin/usuarios");
    exit;
  }
  
  $page = new PageAdmin();                  
  $page -> setTpl("users-password",[

      'user' => $user->getData(),  
      'error' => User::getError(),
      'RegularUser' => $RegularUser->getData()     
      
  ]); 
  

  return $response;
});      






























  $app->get('/admin/usuarios', function($request, $response, $name){     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
    
    //Autenticação de ADM
    User::verifyLogin();

    $user = User::getFromSession();
    
   $page =( isset ( $_GET['pagina'] ) ) ? Validate::validatePagination($_GET['pagina']) : 1 ;
 

    if ( is_bool( $page ) && $page === false ) {
      $page = 1;
    }//end if



    $search =( isset ( $_GET['buscar'] ) ) ? Validate::validateString($_GET['buscar'], true, true, true, true, false) : '' ;
 

    if ( is_bool( $search ) && $search === false )
     { $search = ''; }//end if   



    $pagination = User::getPagination( $search, $page, Rule::PAGINATION_ITENSPERPAGE, 0 ); //end else



    $pages = [];
    $url_query = [];


    for ($x = 0; $x < $pagination['pages']; $x++) 
    {

      if ($search == '') 
      {
        $url_query = [
          'pagina'=>$x+1
        ];
      } 
      else 
      {
        $url_query = [
          'pagina'=>$x+1,
          'buscar'=>$search
        ];
      }
      
     
    



      array_push($pages, [ 
    
        'href'=>'/admin/usuarios?' . http_build_query( $url_query ),

        'page_number'=>$x+1
   

     ]);
 
   
    
    }//end for


    $page = new PageAdmin();                  
    $page -> setTpl("users",[

        'user' => $user->getData(),
        'results' => $pagination['results'],
        'pages' => $pages,
        'search' => $search,
        'nrtotal' => $pagination['nrtotal'],
        'error' => User::getError(),
        'sucess' => User::getSucess()

      ]); 
      

    return $response;
  });                 

       


?>


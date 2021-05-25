<?php

use \Main\Page;
use \Main\Model\User; 
use \Main\Rule;
use \Main\Validate;
use \Main\Mailer;









$app->post('/cadastrar', function($request, $response, $name){
                
    $_SESSION[User::REGISTER_VALUES] = $_POST;





      if( !isset($_POST['desperson']) || $_POST['desperson'] == '' ){
      
        User::setError(Rule::ERROR_NAME);
        header("Location: /logar");
        exit;

        }

       


        if( ( $desperson = Validate::validateString($_POST['desperson'], false, true, false, false, true ) )  === false){

                User::setError(Rule::VALIDATE_NAME);
                header("Location: /logar");
                exit;

        }



        if( !Validate::validateFullName($desperson) ){
            User::setError(Rule::VALIDATE_FULL_NAME);
            header("Location: /logar");
            exit;
        }







        if( !isset($_POST['deslogin']) || $_POST['deslogin'] == '' ){

            User::setError(Rule::ERROR_EMAIL);
            header("Location: /logar");
            exit;

        }

  

        if( ( $deslogin = Validate::ValidateEmail($_POST['deslogin'] ) )  === false){
        
                User::setError(Rule::VALIDATE_EMAIL);
                header("Location: /logar");
                exit;

        }












        if( !isset($_POST['deslogin_confirm']) || $_POST['deslogin_confirm'] == '' ){

            User::setError(Rule::ERROR_EMAIL_CONFIRM);
            header("Location: /logar");
            exit;

        }

        
        if( ( $deslogin_confirm = Validate::ValidateEmail($_POST['deslogin_confirm'] ) ) === false){
        
                User::setError(Rule::VALIDATE_EMAIL_CONFIRM);
                header("Location: /logar");
                exit;

        }
        

            if ($_SERVER['HTTP_HOST'] !== Rule::DEVELOPMENT) 
            {
            
                //AMBIENTE DE PRODUÇÃO

                //=============================
              
                //ESSE IF SERVE PARA VER SE O SITE ESTÁ NO AR OU NÃO
                //SE MÃO ESTIVER NO AR ELE VAI RODAR O QUE ESTIVER AQUI DENTRO


               
                //=============================
                 
            }//END IF
        
         

            if( User::checkLoginExists($deslogin) )
            {

                User::setError(Rule::CHECK_USER_EXISTS);
                header("Location: /logar");
                exit;
    
            }//END IF



        if( $deslogin !== $deslogin_confirm ){

            User::setError(Rule::VALIDATE_EMAIL_CONFIRM);
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



        if( !isset($_POST['interms']) || $_POST['interms'] == '' || (int)$_POST['interms'] != '1' ){

            User::setError(Rule::ERROR_INTERMS);
            header("Location: /logar");
            exit;
    
        }


        $desnick = Validate::sanitazeNickname($desperson);

        if( is_bool($desnick) && $desnick === false ){    
              User::setError(Rule::VALIDATE_FULL_NAME);
              header("Location: /admin/usuarios");
              exit;
          }

        $timezone = new \DateTimeZone('America/Sao_Paulo');

        $dt_now = new \DateTime( 'now' );

        $dt_now->setTimezone($timezone);

        $user = new User();

        $user->setData([
      
            'deslogin' => $deslogin,
            'despassword' => User::setPasswordHashing($despassword),
            'inadmin' => RULE::DEFAULT_INADMIN,
            'inseller' =>RULE::DEFAULT_INSELLER,
            'inbuyer' =>RULE::DEFAULT_INBUYER,
            'inregister' =>0,
            'instatus' =>RULE::DEFAULT_INSTATUS,
            'inautostatus' =>RULE::DEFAULT_INAUTOSTATUS,
            'interms' => $_POST['interms'],
            'desipterms' =>$_SERVER['REMOTE_ADDR'],
            'dtterms' => $dt_now->format('Y-m-d H:i:s'),

            'desperson' => $desperson, 
            'desnick' =>$desnick,
            'desemail' =>$deslogin,
            'nrcountryarea' =>RULE::DEFAULT_COUNTRY_AREA,
            'nrddd' =>NULL,
            'nrphone' =>NULL,
            'intypedoc' =>RULE::DEFAULT_INTYPEDOC,
            'desdocument' =>NULL,
            'dtbirth' =>NULL

        ]);

        $user->update();



        if( (int)$user->getiduser() > 0 )
        {

            try
            {
                $user -> setRegister();
            } 
            catch (\Exception $e) 
            {
                User::setError($e->getMessage());
                header("Location: /logar");
                exit;
            }



            $user->setinregister(1);
            $user->update();

            if ( isset ( $_SESSION[User::REGISTER_VALUES] ) ) unset( $_SESSION[User::REGISTER_VALUES] ); 
           


            if ($_SERVER['HTTP_HOST'] !== Rule::DEVELOPMENT) 
            {      
                $link = Rule::WEBSITE_ROOT_ADRESS;      

            }//END IF
            else{
                $link = Rule::DEVELOPMENT; 
            }
        




            $mailer = new Mailer(

                Rule::EMAIL_REGISTER_SUCCESS,

                "emailRegisterSuccess",
              
                array(

                    "user"=>$user->getData(),
                    "link"=>array(
                        "login"=>$link."/".Rule::URI_USER_LOGIN,
                        "support"=>$link."/".Rule::URI_SUPPORT
                    )

                ),

                $user->getdeslogin(),

                $user->getdesperson()

            );

           $mailer ->send();

           if( (bool)User::checkLogin() )  User::logout();      
              
           $user->setToSession();

           header("Location: /dashboard");
           


         

        }
        else
        {
            User::setError(Rule::ERROR_REGISTER);
            header("Location: /logar");
            exit;

        }
       


 
    $page = new Page();                  
    $page -> setTpl("login",[

        'error' => User::getError()

    ]);

    return $response;
    });










    




    // $app->get('/cadastrar', function($request, $response, $name){
                
  

    //     $page = new Page();                  
    //     $page -> setTpl("login",[
    
    //         'error' => User::getError(),
    //         'register_values' => (isset ( $_SESSION [User::REGISTER_VALUES] ) )  ?  $_SESSION [User::REGISTER_VALUES]  : [

    //             'desperson' => '',
    //             'deslogin' => '',
    //             'deslogin_confirm' => ''

    //         ]

    //     ]);
    
    //     return $response;
    //     });
    
    
    
    // ?>







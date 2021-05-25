<?php

use \Main\PageDashboard;
use \Main\Model\User;
use \Main\DB\Sql;
use Main\Model\Address;
use \Main\Rule;
use \Main\Validate;






$app->post('/dashboard/Atualizar-Senha', function($request, $response, $name){                             
                        
            
    //Autenticação de usuário
    User::verifyLogin(false);
   

    $user = User::getFromSession();
    
//============================>
    if( !isset($_POST['current_pass']) || $_POST['current_pass'] == '' ){

        User::setError(Rule::ERROR_CURRENT_PASS);
        
        header("Location: /dashboard/mudar-informacao");
        exit;

    }
            if( ( $current_pass = Validate::validatePassword($_POST['current_pass'] ) ) === false){    
                    User::setError(Rule::VALIDATE_PASSWORD);
                    header("Location: /dashboard/mudar-informacao");
                    exit;
                }
//============================>

            if( !isset($_POST['new_pass']) || $_POST['new_pass'] == '' ){
                User::setError(Rule::ERROR_CURRENT_PASS);
                header("Location: /dashboard/mudar-informacao");
                exit;
            }
                    if( ( $new_pass = Validate::validatePassword($_POST['new_pass'] ) ) === false){             
                            User::setError(Rule::VALIDATE_PASSWORD);
                            header("Location: /dashboard/mudar-informacao");
                            exit;
                    }

//============================>
            if( !isset($_POST['new_pass_confirm']) || $_POST['new_pass_confirm'] == '' ){

                User::setError(Rule::ERROR_PASSWORD);
                header("Location: /dashboard/mudar-informacao");
                exit;

            }
                if( $_POST['new_pass'] !== $_POST['new_pass_confirm'] ){
                User::setError(Rule::INCORRECT_CONFIRM);
                header("Location: /dashboard/mudar-informacao");
                exit;
                }
//============================>

            if( $_POST['new_pass'] == $_POST['current_pass'] ){
                User::setError(Rule::VERIFY_CURRENT_PASS);
                header("Location: /dashboard/mudar-informacao");
                exit;
            }
                if ( !(password_verify($current_pass, $user->getdespassword()) )  ) 
                {
                    User::setError(Rule::VERIFY_PASSWORD);
                    header("Location: /dashboard/mudar-informacao");
                    exit;
                }

//============================>
   $user->setdespassword( User::setPasswordHashing($new_pass) );
   $user->update();
   $user->setToSession();

   User::setSucess(Rule::SUCESS_PASSWORD);
   header("Location: /dashboard/mudar-informacao");
   exit;

return $response;
});     











$app->post('/dashboard/alterar-dados', function($request, $response, $name){                             
                        
            
    //Autenticação de usuário
    User::verifyLogin(false);

    $user = User::getFromSession();
   




    $desperson = $_POST['desperson'];
//============================> 
    if( isset( $desperson ) ){
        if( !Validate::validateFullName($desperson) ){
            User::setError(Rule::VALIDATE_FULL_NAME);
            header("Location: /dashboard/mudar-informacao");
            exit;
        }
    }
//============================>
    if( !isset($_POST['desdocument']) || ($desdocument = $_POST['desdocument']) == '' ){
        User::setError(Rule::INCORRECT_FIELDS);
        header("Location: /dashboard/mudar-informacao");
        exit;
    }
//============================>
    if( !isset($_POST['desdtbirth']) || ( $dtbirth = $_POST['desdtbirth'] == '' ) ){
        User::setError(Rule::INCORRECT_FIELDS);
        header("Location: /dashboard/mudar-informacao");
        exit;
    }

//============================>
    if( !isset($_POST['desphonenumber']) || $_POST['desphonenumber'] == '' ){
        User::setError(Rule::INCORRECT_FIELDS);
        header("Location: /dashboard/mudar-informacao");
        exit;
    }
//============================>
    $nrddd = substr ( $_POST['desphonenumber'],1,2);
    $desValidatedNumber = substr ( $_POST['desphonenumber'],4,11);
//============================>
 

    $sql = new Sql();
    



    $finalDate =  str_replace(array("/"), '-', FormatDateFORDASHBOARD($dtbirth) );

    $id = $user->getidperson();

    $query = "

    UPDATE tb_persons
    SET desperson = :desperson, 
    desdocument = :desdocument, 
    dtbirth = :dtbirth,
    nrddd = :nrddd,
    nrphone = :nrphone
    WHERE idperson = :idperson;

    ";
 
  
          $sql->QuerySQL($query,[
            ':desperson' => $desperson,
            ':desdocument' => $desdocument,
            ':dtbirth' =>  $finalDate,  
            ':nrddd' => $nrddd,
            ':nrphone' => $desValidatedNumber,
            ':idperson' => $id      
        ]);
        

        //LEMBRAR DE ARRUMAR SE DER TEMPO ! -> UTILIZAR O MÉTODO 'SET-TO-SESSION' 
        $_SESSION[User::SESSION]['desperson'] = $desperson;
        $_SESSION[User::SESSION]['desdocument'] = $_POST['desdocument'];
        $_SESSION[User::SESSION]['dtbirth'] = $finalDate;
        $_SESSION[User::SESSION]['nrddd'] = $nrddd;
        $_SESSION[User::SESSION]['nrphone'] = $desValidatedNumber;
    

       User::setSucess(Rule::SUCCES_UPDATE_INFO);
       header("Location: /dashboard/mudar-informacao");
       exit;
  

return $response;
});     











$app->post('/dashboard/alterar-endereco', function($request, $response, $name){                             
                        
            
    //Autenticação de ADM
    User::verifyLogin(false);

    $user = User::getFromSession();
   

        try{
                        $address = new Address();
                        $address->get((int)$user->getiduser());
                    

            //===========================>
                        if( !isset($_POST['descepaddress']) || ( $descepaddress = $_POST['descepaddress'] )== '' )
                        {   
                            User::setError(Rule::ADDRESS_ERROR);
                            header("Location: /dashboard/mudar-informacao");
                            exit;
                        }   
            //===========================>
                        if(  !isset($_POST['desaddress']) || ( $desaddress = $_POST['desaddress'] )== '' )
                        {      
                            User::setError(Rule::ADDRESS_ERROR);
                            header("Location: /dashboard/mudar-informacao");
                            exit;
                        }         
            //===========================>      
                        if(  !isset($_POST['descity']) || ( $descity = $_POST['descity'] )== '' )
                        {
                            User::setError(Rule::ADDRESS_ERROR);
                            header("Location: /dashboard/mudar-informacao");
                            exit;
                        }
            //===========================>              
                        if( !isset($_POST['desstreet']) || ( $desstreet = $_POST['desstreet'] )== '' )
                        {  
                            User::setError(Rule::ADDRESS_ERROR);
                            header("Location: /dashboard/mudar-informacao");
                            exit;
                        }
            //===========================>             
                        if( !isset($_POST['deshousenumber']) || ( $deshousenumber = $_POST['deshousenumber'] )== '' )
                        {
                            User::setError(Rule::ADDRESS_ERROR);
                            header("Location: /dashboard/mudar-informacao");
                            exit;
                        }
            //===========================>                         
                        if( !isset($_POST['desaddresextra']) || ( $desaddresextra = $_POST['desaddresextra'] )== '' )
                        {  
                            User::setError(Rule::ADDRESS_ERROR);
                            header("Location: /dashboard/mudar-informacao");
                            exit;
                        } 
            //===========================>             
                

                        $address->setData([

                            'idaddress' => $address->getidaddress(),
                            'iduser' => $user->getiduser(),
                            'deszipcode' => $descepaddress,
                            'desaddress' => $desaddress,
                            'desnumber' => $deshousenumber,
                            'descomplement' => $desaddresextra,
                            'desdistrict' => $desstreet,
                            'idcity' => NULL,
                            'descity' => $descity,
                            'idstate' =>$address->getidstate(),
                            'desstate' => $address->getdesstate(),
                            'desstatecode' => $address->getdesstatecode(),
                            'descountry' => 'BRASIL',
                            'descountrycode' => 'BRA'
                                
                ]);


                $address->update();
                

                    User::setSucess(Rule::ADDRESS_UPDATED);
                    header("Location: /dashboard/mudar-informacao");
                    exit;
            }

        catch(\Exception $e){
                User::setError(Rule::ADDRESS_ERROR);
                header("Location: /dashboard/mudar-informacao");
                exit;
        }



return $response;
});     










$app->get('/dashboard/mudar-informacao', function($request, $response, $name){                             
                        
        //Autenticação de ADM
        User::verifyLogin(false);
        $user = User::getFromSession();

        $normaldate = $user->getdtbirth();
        $finalDate = FormatDate($normaldate);


        $sql = new Sql();
        
        $query = "
        SELECT * FROM tb_addresses a
        INNER JOIN tb_users b ON a.iduser = b.iduser
        WHERE a.iduser = :iduser;   
        ";

       //Pegar dados do endereço sem acessar o objeto
        $ThisUser = $sql->select($query,[
        ':iduser' => $user->getiduser()
        ]);


        $page = new PageDashboard();                  
        $page -> setTpl("mudar-informacao",[

            'user'=>$user->getData(), 
            'sucess'=> User::getSucess(),
            'error'=>User::getError(), 
            'FormatedDate' =>  $finalDate,
            'UserAddress'=>$ThisUser[0]

        ]);    

    return $response;
});                           
                    
                    
                    
                    
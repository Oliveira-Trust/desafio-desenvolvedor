<?php

namespace Main\Model;
use \Main\DB\Sql; 
use \Main\Mailer;
use \Main\Model;
use Main\Rule;
use Main\Validate;

class User extends Model{

         
            const SESSION = 'projetologin-user';
            const ERROR = 'projetlogin-user-error';
            const SUCESS = 'projetologin-user-sucess';
            const SECRET = 'projetologin-user-secret';
            const REGISTER_VALUES = 'projetologin-user-register-values';

            public function update(){


                $sql = new Sql();
              
                $query = "CALL sp_users_update(

                 :iduser,
                 :deslogin,
                 :despassword,
                 :inadmin,
                 :inseller,
                 :inbuyer,
                 :inregister,
                 :instatus,
                 :inautostatus,
                 :interms,
                 :desipterms,
                 :dtterms,

                 :desperson, 
                 :desnick,
                 :desdescription,
                 :desemail,
                 :nrcountryarea,
                 :nrddd,
                 :nrphone,
                 :intypedoc,
                 :desdocument,
                 :dtbirth
                

                );";

               $results = $sql->select($query, [

                    ':iduser'=>$this->getiduser(),
                    ':deslogin'=>$this->getdeslogin(),
                    ':despassword'=>$this->getdespassword(),
                    ':inadmin'=>$this->getinadmin(),
                    ':inseller'=>$this->getinseller(),
                    ':inbuyer'=>$this->getinbuyer(),
                    ':inregister'=>$this->getinregister(),
                    ':instatus'=>$this->getinstatus(),
                    ':inautostatus'=>$this->getinautostatus(),
                    ':interms'=>$this->getinterms(),
                    ':desipterms'=>$this->getdesipterms(),
                    ':dtterms'=>$this->getdtterms(),


                    ':desperson'=>$this->getdesperson(),
                    ':desnick'=>$this->getdesnick(),
                    ':desdescription'=>$this->getdesdescription(),
                    ':desemail'=>$this->getdesemail(),
                    ':nrcountryarea'=>$this->getnrcountryarea(),
                    ':nrddd'=>$this->getnrddd(),
                    ':nrphone'=>$this->getnrphone(),
                    ':intypedoc'=>$this->getintypedoc(),
                    ':desdocument'=>$this->getdesdocument(),
                    ':dtbirth'=>$this->getdtbirth()

                ]);

                if( count($results) > 0 ){

                    $this -> setData( $results[0] );

                }//endif
                
            }//endmethod









            public function get($iduser){

                    $sql = new Sql();

                    $query = "  
                    
                        SELECT * FROM tb_users a
                        INNER JOIN tb_persons b ON a.idperson = b.idperson
                        WHERE a.iduser = :iduser
                        ORDER BY a.dtregister DESC
                        LIMIT 1;

                    ";

                    $results = $sql -> select($query, [

                        ':iduser' => $iduser

                    ]);

                    if (count($results) > 0 ) {
                        
                        $this->setData( $results[0] );
                        
                    }

            }


            public static function getRecovery( $code ){


        
                $ivAndEncryptedMessage = Validate::getHash($code);


                if( is_bool($ivAndEncryptedMessage) && $ivAndEncryptedMessage === false ){
                    throw new \Exception (Rule::ERROR_GET_RECOVERY);  
                  }
                


                $iv = mb_substr(

                    $ivAndEncryptedMessage,

                    0,

                    openssl_cipher_iv_length( 'AES-256-CBC' ),

                    '8bit'

                );


                $encryptedMessage = mb_substr(

                    $ivAndEncryptedMessage,

                    openssl_cipher_iv_length('AES-256-CBC'),

                    null,

                    '8bit'

                );

                $idRecovery = openssl_decrypt(

                    $encryptedMessage,

                    'AES-256-CBC',

                    User::SECRET,

                    0,

                    $iv

                );



                if ( (int)$idRecovery === 0  ) {
                   throw new \Exception(Rule::ERROR_GET_RECOVERY);
                }
                else
                {
                    $sql = new Sql();

                    $query = "
                    
                        SELECT * FROM tb_recoveries a
                        INNER JOIN tb_users b ON a.iduser = b.iduser
                        INNER JOIN tb_persons c ON b.idperson = c.idperson
                        WHERE a.idrecovery = :idrecovery AND
                        a.dtrecovery IS NULL AND
                        DATE_ADD( a.dtregister, INTERVAL 1 HOUR ) >= NOW();

                    ";

                    $results = $sql->select( $query, [

                        ':idrecovery' => $idRecovery

                    ]);

                    if(  count($results) === 0 )
                    {
                        throw new \Exception(Rule::ERROR_GET_RECOVERY);
                    }
                    else
                    {
                        return $results[0];
                    }


                    // echo "<pre>";       
                    // var_dump($results);
                    // var_dump($idRecovery);
                    // exit;
    
                }






              

            }

           


















            public static function setRecovery($deslogin, $inadmin = true){

                $sql = new Sql();

                $query ="
                    SELECT * FROM tb_users a
                    INNER JOIN tb_persons b ON a.idperson = b.idperson
                    WHERE a.deslogin = :deslogin
                    ORDER BY a.dtregister DESC
                    LIMIT 1;
                ";

               $results = $sql->select($query, [

                    ':deslogin'=>$deslogin

                ]);


                 if (count($results) === 0) {
                     throw new \Exception (Rule::ERROR_SET_RECOVERY);            
                 }              
                else{

                    $dataUser = $results[0];

                    $queryStorageProcedure = "
                    
                    CALL sp_recoveries_save(  :iduser, :desip  );
                    
                    ";

                    $resultsStorageProcedure = $sql->select($queryStorageProcedure, [

                        ':iduser'=>$dataUser['iduser'],
                        ':desip'=>$_SERVER['REMOTE_ADDR']

                    ]);
                   
                    if (count($resultsStorageProcedure) === 0)
                     {
                        throw new \Exception (Rule::ERROR_SET_RECOVERY);            
                     } //end if
                     else
                      {


                        $dataRecovery = $resultsStorageProcedure[0];
                      
    
                        $iv = random_bytes(openssl_cipher_iv_length('AES-256-CBC') );
    
                        
                        $encryptedMessage = openssl_encrypt(
    
                            $dataRecovery['idrecovery'],
                           
                           
                            'AES-256-CBC',

    
                            User::SECRET,
    
                            0,
    
                            $iv
                            
                        );
    
                        $SecretCode = Validate::setHash($iv . $encryptedMessage);


                        if( is_bool($SecretCode) && $SecretCode === false ){
                            throw new \Exception (Rule::ERROR_SET_RECOVERY);  
                          }
                        



                        if (  !$inadmin  ) 
                        {
                           //Usuário Comum
                           $Link = Rule::WEBSITE_ROOT_ADRESS . "/".                       
                           Rule::URI_RECOVERY . "/" . 
                           Rule::URI_RECOVERYSENT . "/?codigo=$SecretCode";

                        } 
                        else 
                        {
                            //Usuário Administrador
                             $Link = Rule::WEBSITE_ROOT_ADRESS . "/".
                             Rule::URI_ADMIN ."/". 
                             Rule::URI_RECOVERY . "/" . 
                             Rule::URI_RECOVERYSENT . "?codigo=$SecretCode";
                        }
                        

                        $mailer = new Mailer(

                            Rule::EMAIL_RECOVERY_SUBJECT,

                            "emailTemplate",
                          
                            array(

                                "user"=>$dataUser,
                                "link"=>$Link

                            ),

                            $dataUser['deslogin'],
                            $dataUser['desperson']

                        );

                       $mailer ->send();

                       return $dataUser; //Se quiser usar depois


                     }  //end else


                

                }//end else

              

            }//end Method









            

            public static function getPagination($search, $page = 1, $itensPerPage = 10, $inadmin = 0){

                $start = ($page - 1) * $itensPerPage;

                $sql = new Sql();

                $params = [];

                if ($search == '') 
                {//Não está sendo realizada uma busca
                  

                        if ( !(bool)$inadmin  ) {
                                
                                    //Usuários Comuns                        
                                    $querry = " 
                                
                                        SELECT SQL_CALC_FOUND_ROWS *
                                        FROM tb_users a
                                        INNER JOIN tb_persons b ON a.idperson = b.idperson
                                        INNER JOIN tb_addresses c ON a.iduser = c.iduser    
                                        WHERE a.inadmin = :inadmin
                                        ORDER BY a.dtregister DESC
                                        LIMIT $start, $itensPerPage;
                                
                                    ";

                        }
                        else
                        {

                                    //Usuários Administradores
                                    $querry = " 

                                    SELECT SQL_CALC_FOUND_ROWS *
                                    FROM tb_users a
                                    INNER JOIN tb_persons b ON a.idperson = b.idperson
                                    WHERE a.inadmin = :inadmin
                                    ORDER BY a.dtregister DESC
                                    LIMIT $start, $itensPerPage;

                                
                                    "; 
                         }


                                $params = [
                                    ':inadmin'=>$inadmin
                                ];
                

                }//end if
                else 
                { //Está sendo realizada uma busca
                    


                        if ( !(bool)$inadmin ) {
                        
                                //Usuários Comuns
                                
                                $querry = " 
                            
                                SELECT SQL_CALC_FOUND_ROWS *
                                FROM tb_users a
                                INNER JOIN tb_persons b ON a.idperson = b.idperson       
                                INNER JOIN tb_addresses c ON a.iduser = c.iduser    
                                WHERE a.inadmin = :inadmin 
                                AND a.deslogin = :search                      
                                OR a.inadmin = :inadmin  
                                AND b.desperson 
                                LIKE :searchlike            
                                ORDER BY a.dtregister DESC
                                LIMIT $start, $itensPerPage;
                            
                                ";

                        }else{

                                //Usuários Administradores

                                $querry = " 

                                SELECT SQL_CALC_FOUND_ROWS *
                                FROM tb_users a
                                INNER JOIN tb_persons b ON a.idperson = b.idperson
                                WHERE a.inadmin = :inadmin 
                                AND a.deslogin = :search
                                OR a.inadmin = :inadmin 
                                AND b.desperson
                                LIKE :searchlike
                                ORDER BY a.dtregister DESC
                                LIMIT $start, $itensPerPage;

                            
                                "; 
                            }


                            $params =  [
                                ':inadmin'=>$inadmin,
                                ':search'=>$search,
                                ':searchlike'=>'%'.$search.'%'
                            ];

                }//end else
                
                


                $results = $sql->select( $querry, $params);

                $results2 = $sql->select("SELECT FOUND_ROWS() AS nrtotal");

              
                return [

                    'results' => $results,
                    'nrtotal' => (int)$results2[0]['nrtotal'],
                    'pages' => (int)ceil( $results2[0]['nrtotal'] / $itensPerPage)

                ];        

            }















            public static function listAll($inadmin = 0){

                                $sql = new Sql();

                                if( !(bool)$inadmin  )                                                                  
                                {

                                    //SE NÃO FOR ADMINISTRADOR

                                    $querry = "SELECT * FROM tb_users a 
                                    INNER JOIN tb_persons b 
                                    ON a.idperson = b.idperson 
                                    INNER JOIN tb_addresses c
                                    ON a.iduser = c.iduser
                                    WHERE a.inadmin = :inadmin
                                    ORDER BY a.dtregister DESC";
    
                                    $results = $sql->select($querry, [
    
                                        ':inadmin' => $inadmin
    
                                    ]);
                                   
                                } 
                                else {


                                   //SE  FOR ADMINISTRADOR

                                   $querry = "SELECT * FROM tb_users a 
                                   INNER JOIN tb_persons b 
                                   ON a.idperson = b.idperson                                
                                   WHERE a.inadmin = :inadmin
                                   ORDER BY a.dtregister DESC";
                                   
                                }
                                

                          
                            
                    if( count($results) > 0){
                        return $results;    
                    }
                         
            }//Fim

            public static function setPasswordHashing( $despassword ){
                        return password_hash(
                            $despassword,

                            PASSWORD_DEFAULT,
                            [
                                'cost' => 12,
                                
                            ]);                                     
            }//end Method
                 
            











            public static function setDateRecovery($idRecovery)
            {
               $sql = new Sql();

               $query = "
                            
               UPDATE tb_recoveries 
               SET dtrecovery = NOW()
               WHERE idrecovery = :idRecovery;
               
               ";

               $sql->QuerySQL($query, [
                'idRecovery' => $idRecovery
               ]);


            }



            //PARA O REGISTRO DE NOVOS USUÁRIOS
            public static function checkLoginExists ($deslogin)
            {
                $sql = new Sql();

                $query = "
                
                    SELECT * FROM tb_users
                    WHERE deslogin = :deslogin
                    ORDER BY dtregister DESC
                    LIMIT 1
                
                ";

                $results = $sql->select($query,[

                    ':deslogin' => $deslogin

                ]);

                return ( count ($results) ) > 0   ;
            }








            public static function login($deslogin, $despassword){

                $sql = new Sql();

                $query = "
                SELECT * FROM tb_users a INNER JOIN tb_persons b 
                ON a.idperson = b.idperson 
                WHERE a.deslogin = :deslogin 
                ORDER BY a.dtregister 
                DESC 
                LIMIT 1
                ";
                  
               $results = $sql -> select( $query, [

                    ':deslogin' =>$deslogin,
             
                  
                ] );

               
            

                if(count($results) === 0){
                    
                    if ( (bool)User::checkLogin() ) {
                        User::logout();
                    }
                    

                    throw new \Exception(Rule::ERROR_LOGIN);               
                } 
 
                $dataUser = $results[0];


                //=========================================================

                if(password_verify($despassword, $dataUser['despassword'])){


                        $user = new User();

                        $user -> setData($dataUser);

                        if (

                            (int)$user->getinadmin() === 0
                            &&
                            (int)$user->getinregister() === 0 

                        ) 
                        {
                           
                            $user->setRegister();

                            $user->setinregister(1);

                            $user->update();

                        }//end if
                                          
                        $user -> setToSession();
              
                         return $user;
                }

                //=========================================================

                else{
                    
                    User::logout();
                    throw new \Exception(Rule::ERROR_LOGIN);}
               






            }//EndMethod



























            public static function getFromSession(){


                if ( User::checkLogin() )    
                {
                    $user = new User();

                    $user-> setData( $_SESSION[User::SESSION] );
    
                    return $user;  
                    
                }//EndIf 
                else
                 {
                    return false;
                    
                }//EndElse
                        
            }

            public static function checkLogin(){
              
                if (                
                    !isset( $_SESSION[User::SESSION] ) 
                    || 
                    !$_SESSION[User::SESSION] 
                    ||
                    !(int)$_SESSION[User::SESSION]['iduser'] > 0 
                   )
                               {return false;}
                                    else
                                {return true;}               
            }//EndMethod

























            public static function verifyLogin($routeAdmin = true){

                if ( !User::checkLogin() )
                {
                    
                    if ( $routeAdmin ) 
                    {
                        header("Location: /admin/login");
                        exit;

                    }//EndIf 
                    else 
                    {
                       header("Location: /logar");
                       exit;
                    }//EndElse
                    

                }//EndIf 
                else
                {

                    if (!$routeAdmin) {
                     
                        //ROTA DO USUÁRIO

                        if ( !(bool)$_SESSION[User::SESSION]['inadmin'] )
                        {

                          return true;
                    
                        }//EndIf 
                        else
                        {

                            User::logout();
                            header("Location: /admin/login");
                            exit;

                        }//EndElse
                        


                    }//EndIf 

                    else {
                      

                          //ROTA DO ADMIN

                          if ( (bool)$_SESSION[User::SESSION]['inadmin']  ) { 
                         
                           return true;
                        
                          }//EndIf 
                          else {

                               User::logout();
                               header("Location: /logar");
                               exit;

   
                          }//EndElse
                          

                    }//EndElse
                    



                }//EndElse

            }//EndMethod
           










            public static function logout(){

                $_SESSION[User::SESSION] =  NULL;

            }//EndMethod




            public function setToSession(){

                $_SESSION[User::SESSION] = $this->getData();

            }



            public static function setError($msg){

                $_SESSION[User::ERROR] = $msg;

            }//EndMethod



            public static function getError(){

                $msg = ( isset(  $_SESSION[User::ERROR] ) && $_SESSION[User::ERROR] != "" ) ?  $_SESSION[User::ERROR] : '';
                            
                User::clearError();

                return $msg;

            }//EndMethod



            public static function clearError(){
                $_SESSION[User::ERROR] = NULL;
            }



            public static function setSucess($msg){

                $_SESSION[User::SUCESS] = $msg;

            }//EndMethod 




            public static function getSucess(){

            $msg = ( isset(  $_SESSION[User::SUCESS] ) && $_SESSION[User::SUCESS] != "" ) ?  $_SESSION[User::SUCESS] : '';
                            
            User::clearSucess();

            return $msg;

            }//EndMethod


            public static function clearSucess(){
                $_SESSION[User::SUCESS] = NULL;
            }


            public function setRegister(){


                $address = new Address();

                $address -> get( (int)$this->getiduser() );


                $address ->setData([

                 'idaddress' => $address->getidaddresses(),
                 'iduser' => $this->getiduser(),
                 'deszipcode' => NULL,
                 'desaddress' => NULL,
                 'desnumber' => NULL,
                 'descomplement' => NULL,
                 'desdistrict' => NULL,
                 'idcity' => NULL,
                 'descity' => NULL,
                 'idstate' => NULL,
                 'idstate' => NULL,
                 'desstate' => NULL,
                 'desstatecode' => NULL,
                 'descountry' => NULL,
                 'descountrycode' => NULL
          


                ]);



                $address->update();


                    
                if ( (int)$address->getidaddress() === 0) {
                        throw new \Exception(Rule::ERROR_ENTITIES);
                }


            }


    }


?>

<?php
use \Main\PageDashboard;
use \Main\Model\User;
use \Main\Model\Products;
use \Main\DB\Sql;
use \Main\Validate;
use \Main\Rule;
use \Main\Model\Address;




$app->post('/dashboard/anuncios/editar/{ServiceID}', function($request, $response, $ServiceID){                             
  
    
    //Autenticação de ADM
    User::verifyLogin(false);
  

    $ID = getHash($ServiceID['ServiceID']);  
    $user = User::getFromSession();
    $sql = new Sql();
    $productOBJ = new Products();
    $product = ($productOBJ->get($ID))[0];

   


          
          //==========================================>
          //==========================================>
          $productOBJ->CheckCharacterErrorADMIN($_POST['service_name'], Rule::ERROR_SERVICE_NAME, $ID);      
          $service_name = $productOBJ->CheckValidateErrorADMIN(Validate::validateString($_POST['service_name'], false, true, false, true, true), Rule::ERROR_SERVICE_VALIDATE_NAME,$ID);                      
          //==========================================>
          //==========================================>
          $productOBJ->CheckCharacterErrorADMIN($_POST['service_resume'], Rule::ERROR_SERVICE_RESUME, $ID);
          $service_resume = $productOBJ->CheckValidateErrorADMIN(Validate::validateString($_POST['service_resume'], false, true, true, true, false), Rule::ERROR_SERVICE_VALIDATE_RESUME,$ID);    
          //==========================================>
          //==========================================>
          $productOBJ->CheckCharacterErrorADMIN($_POST['service_description'], Rule::ERROR_SERVICE_DESCRIPTION, $ID);
          $service_description = $productOBJ->CheckValidateErrorADMIN(Validate::validateString($_POST['service_description'], false, true, true, true, false), Rule::ERROR_SERVICE_VALIDATE_DESCRIPTION,$ID);                             
          //==========================================>
          //==========================================>              
          $productOBJ->CheckCharacterErrorADMIN($_POST['service_objective'], Rule::ERROR_SERVICE_OBJECTIVE, $ID);
          $service_objective = $productOBJ->CheckValidateErrorADMIN(Validate::validateString($_POST['service_objective'], false, true, true, false, false), Rule::ERROR_SERVICE_VALIDATE_OBJECTIVE,$ID);     
          //==========================================>
          //==========================================>
          $productOBJ->CheckCharacterErrorADMIN($_POST['service_category'], Rule::ERROR_SERVICE_CATEGORY, $ID);
          $service_category =  $productOBJ->CheckValidateErrorADMIN(Validate::validateString($_POST['service_category'], false, true, true, true, false), Rule::ERROR_SERVICE_VALIDATE_CATEGORY,$ID);            
          //==========================================>
          //==========================================>     
          $productOBJ->CheckCharacterErrorADMIN($_POST['service_tags'], Rule::ERROR_SERVICE_TAGS, $ID);
          $service_tags = $productOBJ->CheckValidateErrorADMIN(Validate::validateString($_POST['service_tags'], false, true, true, true, false ), Rule::ERROR_SERVICE_VALIDATE_TAGS,$ID);          
          //==========================================>
          //==========================================>    
          $productOBJ->CheckCharacterErrorADMIN($_POST['service_price'], Rule::ERROR_SERVICE_PRICE, $ID);
          $FinalServicePrice =  str_replace(array('R','$',',',' '), array('','','.',''), $_POST['service_price']);    
          //==========================================>
          //==========================================>
          
                                          

          //CONTAGEM DAS IMAGEMS (COMEÇANDO A PARTIR DO 1 E NÃO DO 0)
          $imgsCount = count( (array)$_FILES );           
          $user = User::getFromSession();

          //============================>            
              $query = "SELECT * FROM tb_products WHERE idproduct = :idproduct";                 
              $results = $sql->select($query, [':idproduct' => $ID])[0];              
          //============================>

          $dir = 'user-id-' . $results['iduser'];  

          $dirService = removeEspecialCharsAndBlankSpaces($results['desproduct']);

          $SendedDir = removeEspecialCharsAndBlankSpaces($_POST['service_name']);

 
  
          $folderPath = 'res/UsersUploads/products_images/'. $dir .'/'. $dirService .'/';


       
     
      
          try {
                                                    
                      for($i = 0; $i < $imgsCount ; $i++){ 
                      
                        //PEGAR AS IMAGENS QUE FORAM ENVIADAS CASO EXISTAM
                          if(isset($_FILES[$i]['type']) && $_FILES[$i]['type'] != NULL )
                          {                    
                           $type = explode('/',$_FILES[$i]['type'])[1];                                     
                           $file = $folderPath . $i . '-' . uniqid() . '-' . $dirService .'.'. $type; 
                            
                           $enviadas[$i] = $file;                           
                           $folderPatchs[$i] = $file;    
                           
                           move_uploaded_file($_FILES[$i]['tmp_name'], $file);       
                          }

                     
                          //VERIFICA SE A POSIÇÃO DA IMAGEM ATUAL EXISTE JUNTO COM A POSIÇÃO DA IMAGEM DO BANCO DE DADOS
                          //SE A POSIÇÃO DA IMAGEM ATUAL FOR IGUAL QUE A DO BD, ENTÃO SIGNIFICA QUE A IMAGEM DO BD IRÁ SER ATUALIZADA
                          //SE A IMAGEM DO BANCO DE DADOS FOR ATUALIZADA, ENTÃO REMOVE A IMAGEM ANTIGA DO DIRETÓRIO.
                          if( isset($folderPatchs[$i]) && isset(unserialize(base64_decode($results['desimages']) )[$i]) )                        
                          {
                            unlink(unserialize(base64_decode($results['desimages']) )[$i]);
                          }


                          //SOBREESCREVER IMAGEMS DO BANCO DE DADOS COM AS ATUAIS ENVIADAS
                          if(!isset($folderPatchs[$i])){
                                      
                            if( isset( unserialize(base64_decode($results['desimages']) )[$i]  ) )
                              {  
                                
                                $folderPatchs[$i] =  unserialize(base64_decode($results['desimages'] ) )[$i];                         
                              }
                                              
                          }


                          //VAI DAR UM EXPLODE NO ARRAY DO FOLDER PATCH E SUBSTITUIR O NOME DA PASTA, PELO NOVO NOME ENVIADO
                          $separated[$i] = explode("/", $folderPatchs[$i]);
                          $separated[$i][4] = $SendedDir;
                          if(isset($folderPatchs[$i])){
                            $folderPatchs[$i] = implode("/",$separated[$i]);
                          }
                         

        
                     }
                   
                   

               
                  
                     
                     
            

                  // ============================================
                  // ============================================
                  // ============================================             
                    $x_sr = base64_encode(serialize($folderPatchs));
                                                                                   
                    $productOBJ->setData([
                  
                              'idproduct' => $results['idproduct'],
                              'iduser' => $results['iduser'],
                              'incategory' => $_POST['service_category'],
                              'desproduct' => $_POST['service_name'],
                              'desresume' => $_POST['service_resume'],
                              'desdescription' => $_POST['service_description'],
                              'desreason' => $_POST['service_objective'],
                              'destags' => $_POST['service_tags'],
                              'vlprice' => $FinalServicePrice,
                              'vtaxa' => Rule::VALOR_TAXA_SERVICO,
                              'desimages' => $x_sr,
                              'dtregister' => ''
                              
                          ]);

                 
                      $productOBJ->update();
                      if($dirService != $SendedDir ){    
                        rename('res/UsersUploads/products_images/'. $dir .'/'. $dirService .'/' , 'res/UsersUploads/products_images/'.$dir.'/'. $SendedDir   )   ;                        
                    }
                

                  //TUDO OK -> RETORNO EM JSON
                  User::setSucess(Rule::PRODUCT_SUCCEFUL_UPDATED);
                  header("Location: ".findCorrectRedirect(false)."/editar-servico/".setHash($ID));
                  exit;

          }
          catch (\Exception $e) {
              $productOBJ->setErrorADMIN(Rule::ERROR_SERVICE_IMAGES_UPLOAD, $user->getiduser());                  
          }









    return $response;
   
});                       










$app->get('/dashboard/editar-servico/{ServiceID}', function($request, $response, $ServiceID){                             
  
    
    //Autenticação de ADM
    User::verifyLogin(false);
  

    $ID = getHash($ServiceID['ServiceID']);  
    $user = User::getFromSession();

    $productOBJ = new Products();
    $product = ($productOBJ->get($ID))[0];

 


    if( $user->getiduser() != $product['iduser'] )
    {  
        User::setError(Rule::ERROR_UNAUTHORIZED_SERVICE);
        header("Location: /dashboard");
        exit;
    }





   
    if(!isset($product)){
        User::setError('Não foi possível encontrar este produto');
        header("Location: ".findCorrectRedirect(false)."/visualizar-anuncios");
        exit;
      }
  
              
      //CONTAGEM DAS IMAGEMS (COMEÇANDO A PARTIR DO 1 E NÃO DO 0)
      $imgsCount = count( (array)unserialize(base64_decode($product['desimages'] ) ) ) ;
    
   
      //CHECAR SE ALGUMA DAS IMAGENS TEM MAIS DE 3MB
      for($i = 0; $i <= $imgsCount; $i++){      
     
        if(isset( unserialize(base64_decode($product['desimages'] ) )[$i]) ){
          $Images[$i] = unserialize(base64_decode($product['desimages'] ) )[$i];
        }
        
      }
   
      $img_link_1 =  $productOBJ->SetIMGLink($Images, 0);
      $img_link_2 =  $productOBJ->SetIMGLink($Images, 1);
      $img_link_3 =  $productOBJ->SetIMGLink($Images, 2);
      $img_link_4 =  $productOBJ->SetIMGLink($Images, 3);
     


    $page = new PageDashboard();                  
    $page -> setTpl("meu-servico",[

        'user'=>$user->getData(),   
        'error'=>$user->getError(),     
        'sucess' => $user->getSucess(),
        'product' => $product,
        'img_link_1' => $img_link_1,
        'img_link_2' => $img_link_2,
        'img_link_3' => $img_link_3,
        'img_link_4' => $img_link_4

    ]);    

   
    return $response;
   
});                       







$app->get('/dashboard/gerenciar-anuncios', function($request, $response, $name){                             
                        
            
    //Autenticação de ADM
    User::verifyLogin(false);
    $user = User::getFromSession();

    $sql = new Sql();

    $query = "
    
        SELECT * FROM tb_products
        WHERE iduser = :iduser
        ORDER BY dtregister;

    ";

    $results = $sql->select($query,[

        ':iduser' => $user->getiduser()

    ]);

    $user = User::getFromSession();


    $page = new PageDashboard();                  
    $page -> setTpl("ver-produtos",[

        'user'=>$user->getData(),
        'error' => $user->getError(),
        'sucess' => $user->getSucess(),
        'results' => $results
    
      
    ]);    

    return $response;
    });     




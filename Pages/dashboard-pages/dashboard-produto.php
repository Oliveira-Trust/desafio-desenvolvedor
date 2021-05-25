<?php
use \Main\PageDashboard;
use \Main\Model\User;
use \Main\Model\Products;
use \Main\DB\Sql;
use \Main\Validate;
use \Main\Rule;
use \Main\Model\Address;








$app->post('/dashboard/publicar-anuncio', function($request, $response, $name){                             
                        
            
                    //Autenticação de ADM
                    User::verifyLogin(false);
                    $Products = new Products();


                    //==========================================>
                    //==========================================>
                    $Products->CheckCharacterError($_POST['service_name'], Rule::ERROR_SERVICE_NAME);      
                    $service_name = $Products->CheckValidateError(Validate::validateString($_POST['service_name'], false, true, true, true, true), Rule::ERROR_SERVICE_VALIDATE_NAME);                      
                    //==========================================>
                    //==========================================>
                    $Products->CheckCharacterError($_POST['service_resume'], Rule::ERROR_SERVICE_RESUME);
                    $service_resume = $Products->CheckValidateError(Validate::validateString($_POST['service_resume'], false, true, true, true, false), Rule::ERROR_SERVICE_VALIDATE_RESUME);    
                    //==========================================>
                    //==========================================>
                    $Products->CheckCharacterError($_POST['service_description'], Rule::ERROR_SERVICE_DESCRIPTION);
                    $service_description = $Products->CheckValidateError(Validate::validateString($_POST['service_description'], false, true, true, true, false), Rule::ERROR_SERVICE_VALIDATE_DESCRIPTION);                             
                    //==========================================>
                    //==========================================>              
                    $Products->CheckCharacterError($_POST['service_objective'], Rule::ERROR_SERVICE_OBJECTIVE);
                    $service_objective = $Products->CheckValidateError(Validate::validateString($_POST['service_objective'], false, true, true, false, false), Rule::ERROR_SERVICE_VALIDATE_OBJECTIVE);     
                    //==========================================>
                    //==========================================>
                    $Products->CheckCharacterError($_POST['service_category'], Rule::ERROR_SERVICE_CATEGORY);
                    $service_category =  $Products->CheckValidateError(Validate::validateString($_POST['service_category'], false, true, true, true, false), Rule::ERROR_SERVICE_VALIDATE_CATEGORY);            
                    //==========================================>
                    //==========================================>     
                    $Products->CheckCharacterError($_POST['service_tags'], Rule::ERROR_SERVICE_TAGS);
                    $service_tags = $Products->CheckValidateError(Validate::validateString($_POST['service_tags'], false, true, true, true, false ), Rule::ERROR_SERVICE_VALIDATE_TAGS);          
                    //==========================================>
                    //==========================================>    
                    $Products->CheckCharacterError($_POST['service_price'], Rule::ERROR_SERVICE_PRICE);
                    $FinalServicePrice =  str_replace(array('R','$',',',' '), array('','','.',''), $_POST['service_price']);    
                    //==========================================>
                    //==========================================>


                    //CHECAR SE TEM PELO MENOS UMA IMAGEM
                    if( !isset($_POST['images']) ) { $Products->setError(Rule::ERROR_SERVICE_IMAGES,rand(1,1000)); }            
                                        
                    //CONTAGEM DAS IMAGEMS (COMEÇANDO A PARTIR DO 1 E NÃO DO 0)
                    $imgsCount = count( (array)$_POST['images'] );
                            
                    //CHECAR SE ALGUMA DAS IMAGENS TEM MAIS DE 3MB
                    for($i = 0; $i <= $imgsCount - 1; $i++){              
                        $fileBase64_validate = $_POST["images"][$i]["dataURL"];
                        if( getBase64ImageSize($fileBase64_validate) >= Rule::MaxSizeOfImages  )  { $Products->setError(Rule::ERROR_IMAGE_SIZE,rand(1,1000)); }                                 
                    }

                    //CHECAR SE PASSOU DO LIMITE DE IMAGENS
                    if($imgsCount > Rule::MaxNumberOfImages ){ $Products->setError(Rule::ERROR_IMAGE_MAX,rand(1,1000));} 
                     
                    //==========================================
                    //==========================================





                    $user = User::getFromSession();
                    $dir = 'user-id-' . $user->getiduser();

                    $dirService = removeEspecialCharsAndBlankSpaces($_POST['service_name']);



                    
                    //VERIFICA SE A PASTA COM O ID DO USUÁRIO JÁ EXISTE.
                    if( is_dir('res/UsersUploads/products_images/'.$dir) === false ){mkdir('res/UsersUploads/products_images/'.$dir);}     
                    $folderMainPatch = 'res/UsersUploads/products_images/'. $dir . '/';
            
                    //VERIFICA SE JÁ EXISTE UMA PASTA COM O NOME DO MESMO SERVIÇO
                    if( is_dir($folderMainPatch . $dirService) === false ){mkdir($folderMainPatch . $dirService);}  
                    $folderPath = $folderMainPatch . $dirService .'/';
                  

                    try {
                                                             
                                for($i = 0; $i <= $imgsCount - 1; $i++){ 

                                    $fileName = $_POST["images"][$i]['upload']['filename'];
                                    $fileBase64 = $_POST["images"][$i]["dataURL"];

                                    //SEPARA O TIPO E FORMATO (EXEMPLO : ' data:image/jpeg;base64, ' )
                                    $image_parts = explode(";base64,", $fileBase64 );

                                    //SEPARA O FORMATO DA IMAGEM ATRAVÉS DE UM EXPLODE
                                    $image_type_aux = explode("image/", $image_parts[0]);

                                    //PEGA O FORMATO DA IMAGEM ATRAVÉS DE UM EXPLODE
                                    $image_type = '.' . $image_type_aux[1];
                                                                          
                                    //PEGA O BASE64 DA IMAGEM E UTILIZA UM DECODE PARA FORMAR A IMAGEM DO ARQUIVO
                                    $image_base64 = base64_decode($image_parts[1]);

                                    //GERA O NOME FINAL DO ARQUIVO
                                    $file = $folderPath . $i . '-' . uniqid() . '-' . $dirService . $image_type;

                                    $folderPatchs[$i] = $file;

                                    //ADICIONA A IMAGEM NO DIRETÓRIO
                                    file_put_contents($file, $image_base64);

                                    
                            }
                            //============================================
                            //============================================
                            //============================================
 

                              $x_sr = base64_encode(serialize($folderPatchs));
                                                                                                   
                              $Products->setData([
                            
                                        'idproduct' => $Products->getidproduct(),
                                        'iduser' => $user->getiduser(),
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

                                
                                $Products->update();
                   
                
                            //TUDO OK -> RETORNO EM JSON
                            header('Content-Type: application/json; charset=UTF-8');
                            die(json_encode(array('message' => Rule::SUCCESS_CREATED, 'code' => 17)));

                    }
                    catch (\Exception $th) {
                        $Products->setError(Rule::ERROR_SERVICE_IMAGES_UPLOAD, 17);                  
                    }

                    
                

    return $response;
});     









$app->get('/dashboard/deletar-produto/{ID}', function($request, $response, $name){                             
                        
    $ID = getHash($name['ID']);

    $sql = new Sql();

    $SELECTquery = " 
    SELECT * FROM tb_products
    WHERE idproduct = :idproduct
    ";
  

    $DELETEquery = " 
    DELETE FROM tb_products
    WHERE idproduct = :idproduct
    ";
  

    try 
    {
          $results = $sql->select($SELECTquery,[
            ':idproduct' => $ID
          ]);

          $sql->QuerySQL($DELETEquery,[
            ':idproduct' => $ID
          ]);      
    }
    catch (\Throwable $th) 
    {
          User::setError(Rule::ERROR_PRODUCT_DELETED);
          header("Location: /admin/visualizar-anuncios");
          exit;
    }
                
              
        
      //CONTAGEM DAS IMAGEMS (COMEÇANDO A PARTIR DO 1 E NÃO DO 0)
      $imgsCount = count( (array)unserialize(base64_decode($results[0]['desimages'] ) ) ) ;
                            
      //SALVAR A URL DAS IMAGENS
      for($i = 0; $i <= $imgsCount - 1; $i++){      
        $Images[$i] =  (array)unserialize(base64_decode($results[0]['desimages'] ) )[$i];
    }
  
    
    $products = new Products();
    $products -> DeleteProduct($Images, false);
    
    return $response;
    });     
















$app->get('/dashboard/publicar-anuncio', function($request, $response, $name){                             
                        
            
    //Autenticação de ADM
    User::verifyLogin(false);

    $user = User::getFromSession();

    $page = new PageDashboard();                  
    $page -> setTpl("publicar-anuncio",[

        'user'=>$user->getData()    

    ]);    

    return $response;
    });     





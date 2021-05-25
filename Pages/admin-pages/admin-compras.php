<?php


use \Main\PageAdmin;
use \Main\Model\User;
use \Main\Model\Purchase;
use \Main\DB\Sql;







$app->get('/admin/compras/deletar/{IDBUY}', function($request, $response, $name){     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
      
  //Autenticação de ADM
    User::verifyLogin();
    $ID = getHash($name['IDBUY']);
  
    $user = User::getFromSession();  
    $sql = new Sql();
    $purchase = new Purchase();

    

    $query = "DELETE FROM tb_purchases WHERE idrecibo = :idrecibo";
    
    try 
    {
      $sql->QuerySQL($query,[':idrecibo' => $ID]);   
    } 
    catch (\Throwable $th) 
    {
      User::setError(\Main\Rule::PURCHASE_DELETED_ERROR);
      header("Location: /admin/visualizar-compras");
      exit;
    }
  


    User::setSucess(\Main\Rule::PURCHASE_DELETED_SUCCESS);
    header("Location: /admin/visualizar-compras");
    exit;
    
    return $response;
});            







$app->post('/admin/compras/editar/{IDBUY}', function($request, $response, $name){     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
      
  //Autenticação de ADM
    User::verifyLogin();
    $ID = getHash($name['IDBUY']);
  
    $user = User::getFromSession();  

    $purchase = new Purchase();
    $results = getAllPurchaseInfo($ID);

    try {
      $purchase->setData([                      
        'idrecibo' => $results['idrecibo'],
        'iduser' => $results['iduser'],
        'idseller' => $results['idseller'],
        'idproduct' => $results['idproduct'],
        'desbuystate' => $_POST['desbuystate'],
        'despayament' => $_POST['despayament'],
        'desmethod' => $_POST['desmethod'],
        'desip' => $results['desip'],
        'dtbuy' => $results['dtbuy']
    ]);
      $purchase->update();
    } catch (\Exception $th) {
      User::setError(\Main\Rule::UPDATE_BUY_ERROR);
      header("Location: /admin/compras/editar/".setHash($ID));
      exit;
    }
      User::setSucess(\Main\Rule::SUCCESS_UPDATED_INFO);
      header("Location: /admin/visualizar-compras");
      exit;
    
    return $response;
});            








  $app->get('/admin/compras/editar/{IDBUY}', function($request, $response, $name){     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
      
    //Autenticação de ADM
      User::verifyLogin();
 
      if($name['IDBUY'] == 01 )
      {
          User::setError("Não encontramos esse recibo");
          header("Location: /admin/visualizar-compras");
          exit;
      }


      $ID = getHash($name['IDBUY']);

      // echo "<pre>";
      // var_dump($ID);
      // var_dump(getAllPurchaseInfo($ID));
      // exit;
    
      $user = User::getFromSession();  


      $page = new PageAdmin();                  
      $page -> setTpl("editar-compras",[

        'user' => $user->getData(),
        'results' => getAllPurchaseInfo($ID),
        'error' => User::getError(),
        'sucess' => User::getSucess()

        ]); 
        

      return $response;
  });            




  






  $app->get('/admin/visualizar-compras', function($request, $response, $name){     //Adicionar Hashcode no endereço para evitar ataques SQL INJECT                         
    
    //Autenticação de ADM
      User::verifyLogin();

      $user = User::getFromSession();


      
 
  

    
      $sql = new Sql();

      $purchase = new Purchase();

    // echo "<pre>"; 
    // var_dump(getPurchaseInfo(21,'desdescription')) ;
    // exit;

      $page = new PageAdmin();                  
      $page -> setTpl("visualizar-compras",[

        'user' => $user->getData(),
        'results' => $purchase->getAllPurchases(),
        'error' => User::getError(),
        'sucess' => User::getSucess()

        ]); 
        

      return $response;
  });            

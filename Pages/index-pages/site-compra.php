<?php

use \Main\DB\Sql;
use \Main\Model\Products;
use \Main\Model\Purchase;
use \Main\Model\User;
use \Main\Rule;

        
       
$app->get('/comprar-produto/{IDPRODUCT}/{STATE}', function($request, $response, $name){
             


        if( !User::checkLogin() )
        {
            User::setError(Rule::NOT_CONNECTED_USER_BUY);
            header("Location: /");
            exit;
        }
        
 


         //VARIAVEIS "GLOBAIS" DESSA ROTA
         $ID = getHash($name['IDPRODUCT']);
         $STATE = $name['STATE'];

         $sql = new Sql();
         $products = new Products();
         $purchases = new Purchase();
         $user = User::getFromSession();

        //QUERY PRA PEGAR AS INFORMAÇÕES DO USUÁRIO E DO PRODUTO (QUE ESTÃO VENDENDO O PRODUTO)
        $query="
        SELECT * FROM tb_users a
        INNER JOIN tb_persons b 
        INNER JOIN tb_products c
        ON a.idperson = b.idperson AND
        a.iduser = c.iduser
        WHERE idproduct = :idproduct
        ";

        $SellerResults =  $sql->select($query,[
            ':idproduct' => $ID
        ])[0];

   

        if($SellerResults['iduser'] == $user->getiduser()){
            User::setError(Rule::SAMEUSER_BUY_TRY);
            header("Location: /");
            exit;
        }

        if($user->getinadmin() == 1){
            User::setError(Rule::ADMIN_TRY_BUY);
            header("Location: /");
            exit;
        }


     

        //=============================>
        //PASSOU DE TODAS AS VALIDAÇÕES
        //=============================>

        $purchases->setData([
                            
            'idrecibo' => $purchases->getidrecibo(),
            'iduser' => $user->getiduser(),
            'idseller' => $SellerResults['iduser'],
            'idproduct' => $ID,
            'desbuystate' => $STATE,
            'despayament' => '1X Sem Juros',
            'desmethod' => 'Cartão de Crédito',
            'desip' => $_SERVER['REMOTE_ADDR'],
            'dtbuy' =>  date("Y-m-d H:i:s")
  
            
        ]);

    
        $purchases->update();

        if($STATE == "Aprovado"){
            User::setSucess(Rule::SUCCEFULL_PURCHASED_APROVADO);
            header("Location: /");
            exit;
        }else if($STATE == "Pendente"){
            User::setSucess(Rule::SUCCEFULL_PURCHASED_PENDENTE);
            header("Location: /");
            exit;
        }else{
            User::setSucess(Rule::SUCCEFULL_PURCHASED_CANCELADO);
            header("Location: /");
            exit;
        } 
     

         return $response;

});





?>
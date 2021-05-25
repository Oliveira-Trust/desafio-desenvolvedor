<?php

      require_once 'db_connect.php';

     if(isset($_POST['name'])){
       
        $MyName = $_POST['name'];
        $MyEmail = $_POST['email'];
        $MyUSER = $_POST['user'];
        $MyQuantity = $_POST['FollowQuantity'];
        $MyPrice = $_POST['FollowPrice'];
              

        
               // Insert into Database     

               $stmt = $mysql->prepare("INSERT INTO despacotes (name,email, username, FollowQuantity, FollowPrice) VALUES (:nome_cliente, :email_cliente, :usuario_cliente, :valor_pacote, :valor_price)");
               $stmt->bindParam(":nome_cliente", $MyName , PDO::PARAM_STR);
               $stmt->bindParam(":email_cliente", $MyEmail , PDO::PARAM_STR);		
               $stmt->bindParam(":usuario_cliente", $MyUSER , PDO::PARAM_STR);		
               $stmt->bindParam(":valor_pacote", $MyQuantity , PDO::PARAM_STR);	
               $stmt->bindParam(":valor_price", $MyPrice , PDO::PARAM_STR);	
               $stmt->execute();
               
         
       
     
     }
     
 
  
?>
<?php
    require_once 'db_connect.php';
    session_start(); 

    $Clientpassword = $_POST['password'];

    
 

    $stmt = $mysql->prepare("SELECT * FROM clubedafama_admin ");
    $stmt ->execute();     
 
    while($row = $stmt->fetch()){      
      $ServerLogin =  ($row['desLogin']) ;
      $Serverpassword  =  ($row['desPassword']) ;
    } 


     if(password_verify($Clientpassword, $Serverpassword)) {
     
            header("Location: ../AdminPage.php");
            $_SESSION['ServerLOGIN'] = $ServerLogin;

   }else{ header("Location: ../login.php?error=Usuário ou senha incorretos");}

        
   
?>
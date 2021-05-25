<?php
    session_start();
    require_once("vendor/autoload.php");   
    // ob_start();
    //use \Main\Page;
    //use \Main\Model\User;
    use Slim\Factory\AppFactory;


    $app = AppFactory::create();

    //Functions PRECISA estar acima de TODAS as outras na hierarquia!
        require_once('functions.php');
       
        require_once('Pages/admin-pages/admin-compras.php');
        require_once('Pages/admin-pages/admin-produtos.php');
        require_once('Pages/admin-pages/admin-password.php');
        require_once('Pages/admin-pages/admin-users.php');
        require_once('Pages/admin-pages/adminLogin.php');  
        require_once('Pages/admin-pages/admin-home.php');
        
        require_once('Pages/dashboard-pages/dashnoard-config-anuncio.php');
        require_once('Pages/dashboard-pages/dashboard-produto.php');
        require_once('Pages/dashboard-pages/dashboard-config.php');
        require_once('Pages/dashboard-pages/dashboard-home.php');
        require_once('Pages/dashboard-pages/minha-conta.php');

       
        require_once('Pages/index-pages/site-compra.php');
        require_once('Pages/index-pages/site-modals.php');
        require_once('Pages/index-pages/site-endPoint.php');  //FAZER HASH MANUAL (APENAS PARA TESTES)
        require_once('Pages/index-pages/site-register.php');    
        require_once('Pages/index-pages/site-login.php');           
        require_once('Pages/index-pages/site.php');    
        
        //MODIFICACAO

    
     
      
                    
                    
                   
        $app -> run();   
    ?>


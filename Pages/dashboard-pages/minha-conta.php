<?php
use \Main\PageDashboard;
use \Main\Model\User;
use \Main\DB\Sql;
use \Main\Rule;
use \Main\Model\Address;










$app->post('/dashboard/minha-conta', function($request, $response, $name){                             
  

         //Autenticação de ADM
         User::verifyLogin(false);

         $user = User::getFromSession();
         $Sql = new Sql(); 
         $address = new Address;
         $address -> get( (int)$user->getiduser() );
    
   
         $idstate = $_POST['desstate'];
         $query = "SELECT * FROM tb_states  WHERE idstate = :idstate ";
         $SelectedState = $Sql -> select($query,[':idstate' => $idstate]);


        //========================================
        $user->setdesnick($_POST['desnickname']);
        $user->setdtbirth($_POST['desdtbirth']);
        $user->setdesdescription($_POST['desaboutme']);
        //========================================
        $address->setidstate($SelectedState[0]['idstate']);
        $address->setdesstate($SelectedState[0]['desstate']);
        $address->setdesstatecode($SelectedState[0]['desstatecode']);
         //========================================
        
      
            
        try 
        {
            $address->update();
            $user->update();
            $user->setToSession();

            User::setSucess(Rule::SUCCES_UPDATE_INFO);
            header("Location: /dashboard");
            exit;

        } 
        catch (\Throwable $th)
        {
            User::setError(Rule::ERROR_UPDATE_INFO);
            header("Location: /dashboard");
            exit;
        }
        



    return $response;
    });                       


  









$app->get('/dashboard/minha-conta', function($request, $response, $name){                             
  
    
    //Autenticação de ADM
    User::verifyLogin(false);
  
    $user = User::getFromSession();




    //=============================
    $Sql = new Sql(); 
    //=============================
    $states_query = "SELECT * FROM tb_states";
    $getStates = $Sql->select($states_query);
    //=============================


    



    $address = new Address;

    $address -> get( (int)$user->getiduser() );
    

    $page = new PageDashboard();                  
    $page -> setTpl("minha-conta",[

        'user'=>$user->getData(),     
        'address' => $address->getData(),
        'states' => $getStates,   
        'error' => $user->getError(),
        'YearsOld'=> GetMyYearsOld($user->getdtbirth()),
        'sucess' => $user->getSucess()

    ]);    

    return $response;
    });                       









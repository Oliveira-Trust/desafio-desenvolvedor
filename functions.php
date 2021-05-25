<?php

use Main\Validate;







function FormatDate($date){

        return date('d/m/Y', strtotime($date));

    }







    function FormatDateFORDASHBOARD($date){

        return date('Y/d/m', strtotime($date));

    }







    function FomartDateShortYear($date){

        return date('d/m/y', strtotime($date)); 

    }







    function GetMyYearsOld($dtBirth)
    {

        return date('Y') - date('Y', strtotime($dtBirth))  ;

    }


    





    function FormatGeneralDate($date){
        return date('d/m/Y [H:i:s]', strtotime($date)); 
    }








    function GetActualDate(){
        return date('d/m/Y');
    }









    function GetYear(){
        return date('Y');
    }






    function setHash($value){

        return Validate::setHash( $value );

    }






    function getHash($value){

        return Validate::getHash( $value );

    }











    function getBase64ImageSize($base64Image){ //return memory size in B, KB, MB
        try{
            $size_in_bytes = (int) (strlen(rtrim($base64Image, '=')) * 3 / 4);
            $size_in_kb    = $size_in_bytes / 1024;
            $size_in_mb    = $size_in_kb / 1024;
    
            return $size_in_mb;
        }
        catch(Exception $e){
            return $e;
        }
    }









    function getArrayFromProducts($base64){

         $file = unserialize(base64_decode($base64));
         return $file[0];
    }











    function ConvertVirgulaToPonto($value){
      
        $count = strlen($value);
        // str_replace('.', ',', $value, $calculate);
        $scalculate = $count - 3;
        $fcalculate =  ( $count - ($count - 3) );
        
        $svalue = strrev(substr(strrev($value), $fcalculate));

        $fvalue = str_replace('.',',',substr($value, $scalculate) );
        

        $fsvalue = $svalue . $fvalue ;

   
        return $fsvalue;

        
    }










    function removeEspecialCharsAndBlankSpaces($value){
        
        $comAcento = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç','È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');

        $semAcento = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
    

        $removeBlankSpace =  str_replace(' ', '', $value);
        return utf8_encode( str_replace($comAcento, $semAcento, $removeBlankSpace) );
    }
















    function findCorrectRedirect($isRouteAdmin) {

        $user = new \Main\Model\User();

        if(!$isRouteAdmin){
            return "/dashboard";
        }
        else{  return "/admin"; }

    }














    function getAllPurchaseInfo($idrecibo) {

        $sql = new \Main\DB\Sql();


        $query = "
      
        SELECT * FROM tb_purchases a 
        INNER JOIN tb_products b
        INNER JOIN tb_users c
        INNER JOIN tb_persons d
        ON a.idproduct = b.idproduct AND
        c.idperson = d.idperson
        WHERE a.idrecibo = :idrecibo AND
        a.idseller = c.iduser
        LIMIT 1
      
      ";

      return $sql->select($query,[
        ":idrecibo" => $idrecibo
      ])[0];

      
     
    }









                //Este método serve apenas para o ADMIN-COMPRAS  INDEX COMPRAS
                function getPurchaseInfoAndReturnHashOnURL($idrecibo) {

                    $sql = new \Main\DB\Sql();

                  
                      
                   
                  
                    $query = "
                
                    SELECT * FROM tb_purchases a 
                    INNER JOIN tb_products b
                    INNER JOIN tb_users c
                    INNER JOIN tb_persons d
                    ON a.idproduct = b.idproduct AND
                    c.idperson = d.idperson
                    WHERE a.idrecibo = :idrecibo AND
                    a.idseller = c.iduser
                    LIMIT 1
                
                ";

                $resultsForTest = $sql->select($query,[
                    ":idrecibo" => $idrecibo
                ]);

                if($resultsForTest == NULL){
                    return '/admin/compras/editar/01';
                    exit;
                }
            

                $results = $sql->select($query,[
                    ":idrecibo" => $idrecibo
                ])[0];


                
                return '/admin/compras/editar/'.setHash($results['idrecibo']);
                }







    //Este método serve apenas para o INDEX ADM e para o INDEX DASHBOARD
    function getPurchaseInfoAndReturnHash($idrecibo) {

        $sql = new \Main\DB\Sql();


        $query = "
      
        SELECT * FROM tb_purchases a 
        INNER JOIN tb_products b
        INNER JOIN tb_users c
        INNER JOIN tb_persons d
        ON a.idproduct = b.idproduct AND
        c.idperson = d.idperson
        WHERE a.idrecibo = :idrecibo AND
        a.idseller = c.iduser
        LIMIT 1
      
      ";

      $results = $sql->select($query,[
        ":idrecibo" => $idrecibo
      ])[0];

  
      
      return setHash($results['idproduct']);
    }








     function getPurchaseInfo($idrecibo,$Key) {

        $sql = new \Main\DB\Sql();


        $query = "
      
        SELECT * FROM tb_purchases a 
        INNER JOIN tb_products b
        INNER JOIN tb_users c
        INNER JOIN tb_persons d
        ON a.idproduct = b.idproduct AND
        c.idperson = d.idperson
        WHERE a.idrecibo = :idrecibo AND
        a.idseller = c.iduser
        LIMIT 1
      
      ";
      
      $resultsForTest = $sql->select($query,[
        ":idrecibo" => $idrecibo
      ]);
      if($resultsForTest == NULL){
          return 'Não encontrado';
      }

      $results = $sql->select($query,[
        ":idrecibo" => $idrecibo
      ])[0];




    

  
      
      return $results[$Key];
    }






        //======================================>
        //PARA DASHBOARD DE USUÁRIO COMUM
        //======================================>



        function getWhoBuyBYID($iduser) {

            $sql = new \Main\DB\Sql();


            $query = "
        
            SELECT * FROM tb_purchases 
            WHERE idseller = :iduser
       
        
        ";

        return $sql->select($query,[
            ":iduser" => $iduser
        ]);

        
      
        }



                

            function getAllPurchasesBYID($iduser) {

                $sql = new \Main\DB\Sql();


                $query = "
            
                SELECT * FROM tb_purchases 
                WHERE iduser = :iduser
           
            
            ";

            return $sql->select($query,[
                ":iduser" => $iduser
            ]);

            
          
            }


?>
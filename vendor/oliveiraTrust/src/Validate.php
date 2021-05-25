<?php

    namespace Main;

             

    class Validate{








        public static function validateEmail( $emailString, $checkdns = false, $may_be_empty = false )
        {
         
            
         
         
            $emailString = trim( $emailString );
            /*
            Retira os espaços em branco antes e depois da string, 
            e se vier uma string só de espaços em branco vai cortar tudo deixando
            só vazio
            */
         
            if( $emailString == '' && $may_be_empty === true )
            {
         
                /*
                echo "<pre>";
                echo "emailstring é vazio e pode ser vazio <br>";
                var_dump($emailString);
                exit;
                */
         
         
         
         
                
                return $emailString;
                /*
                Se for vazio depois do trim() e puder ser vazio, 
                retorna vazio mesmo
                */
               
         
            }//end if
            elseif( $emailString == '' && $may_be_empty === false )
            {
         
                /*
                echo "<pre>";
                echo "emailstring é vazio e NÃO pode ser vazio <br>";
                var_dump($emailString);
                exit;
                */
         
         
         
         
                return false;
                /*
                Se for vazio depois do trim(), mas não puder ser vazio,
                retorna false (é inválido)
                */
         
         
         
            }//end elseif
            elseif( !preg_match( '/\s/', $emailString ) )
            {
         
                /*
                !preg_match( '/\s/', $emailString )
                Verificar se não tem espaços em branco DENTRO
                da String (trim() só tira os espaços antes e depois,
                naõ os do meio)
                */
                  
                
         
                if ( substr_count( $emailString, '@' ) >= 1 ) 
                {
         
                    /*
                    substr_count( $emailString, '@' ) >= 1
                    Verifica se tem ao menos 1 arroba na String
                     */
         
         
         
         
                    $lastArrobaPosition = strrpos( $emailString, '@' );
                    /*Verifica a posição da última Arroba*/
         
                    $local = substr( $emailString, 0, $lastArrobaPosition );
                    $domain = substr( $emailString, $lastArrobaPosition+1 );
                    /*
                    Usa a posição da última arroba para dividiar a String na
                    Parte Local ($local) e no Domínio ($domain) 
                    */
         
                    $localLenght = strlen($local);
                    $domainLenght = strlen($domain);
                    /*Pega o tamanho da Parte Local e do Dominio */              
         
         
                    
         
         
                    if (
         
         
                        $localLenght > 0
                        &&
                        $localLenght <= 64
                        &&
                        $domainLenght > 0
                        &&
                        $domainLenght <= 190
         
         
         
                    ) 
                    {
         
                        /*
                        Se $localLenght = 0 então o Arroba seria o PRIMEIRO caracter do String, 
                        e não pode, por isso tem que ser maior que zero
         
                        Se $domainLenght = 0 então o Arroba seria o ÚLTIMO caracter do String, 
                        e não pode, por isso tem que ser maior que sero
         
                        $localLenght <= 64 verifica o tamanho máximo da Parte Local
         
                        $domainLenght <= 190 verifica o tamanho máximo do Domínio
         
                        */
         
                   
          
         
         
         
         
                        if (
         
         
                            preg_match( '/^[a-z0-9_\.\-]+$/', $local )
                            &&
                            preg_match( '/^[a-z0-9\.\-]+$/', $domain )
         
         
         
                        ) 
                        {
         
         
                            /*
                            preg_match( '/^[a-z0-9_\.\-]+$/', $local ) verifica os 
                            caracteres permitidos na Parte Local
         
                            preg_match( '/^[a-z0-9\.\-]+$/', $domain ) verifica os 
                            caracteres permitidos no Domínio
         
                             */
         
         
         
         
         
         
         
         
         
         
                            if ( substr_count( $domain, '.' ) > 0 ) 
                            {
         
                                /* 
                                substr_count( $domain, '.' ) > 0
                                Verifica se tem pelo menos 1 ponto no Domínio 
                                */
         
         
         
         
         
         
                                if (
         
         
                                    !preg_match( '/\.\./', $local )
                                    &&
                                    !preg_match( '/\.\./', $domain )
                                    &&
                                    $local[0] != '.'
                                    &&
                                    substr( $local, -1 ) != '.'
                                    &&
                                    $domain[0] != '.'
                                    &&
                                    substr( $domain, -1 ) != '.'
         
         
                                ) 
                                {
         
                                    /*
                                    $local[0] != '.'
                                    $domain[0] != '.'
                                    Verifica se o Ponto não é a PRIMEIRA
                                    Letra da Parte Local e do Domínio
         
         
                                    substr( $local, -1 ) != '.'
                                    substr( $domain, -1 ) != '.'
                                    Verifica se o Ponto não é a ÚLTIMA
                                    Letra da Parte Local e do Domínio
                                    
         
                                    !preg_match( '/\.\./', $local )
                                    !preg_match( '/\.\./', $domain )
                                    Verifica se não tem pontos CONSECUTIVOS dentro da 
                                    Parte Local e do Domínio
         
                                    */
         
         
         
         
         
         
                                    $domainExploded = explode( '.', $domain );
                                    /*
                                    Faz um explode do Domínio e cria um Array ($domainExploded)
                                    onde cada índice é um Label do Domínio, para podermos
                                    analisar os Labels separadamente abaixo
                                    */
         
         
         
                                    foreach ($domainExploded as $row) 
                                    {
         
                                        if(
         
                                            !preg_match( '/^[a-z][a-z0-9\-]*$/', $row )
                                            ||
                                            substr( $row, -1 ) == '-'
                                            ||
                                            strlen($row) > 63
         
         
                                        )
                                        {
         
         
                                            /*
                                            echo "<pre>";
                                            echo "Formato inválido <br>";
                                            var_dump($emailString);
                                            var_dump($local);
                                            var_dump($domain);
                                            exit;
                                            */
         
                                            return false;
         
         
         
         
                                        }//end if
         
         
         
         
         
                                    }//end foreach
                                    
                                    /*
                                    Dentro do foreach, cada $row é equivalente a
                                    um Label, onde a gente vai analisar cada um
                                    separadamente
         
                                
                                    !preg_match( '/^[a-z][a-z0-9\-]*$/', $row )
                                    Essa expressão regular só deixa passar o Label que
                                    começa com uma Letra minúscula, e depois pode ter
                                    letras, números ou o hífen
         
         
                                    substr( $row, -1 ) == '-'
                                    Não deixa passar Labels que terminam
                                    com hífen
         
         
                                    strlen($row) > 63
                                    Não deixa passar tamamhos maiores que o 
                                    tamanho máximo do Label
         
                                    */
         
                                    
         
         
         
                                    if ( !$checkdns ) 
                                    {
                                        /*
                                        Essa é a última verificação
         
                                        !checkdns é a flag que a gente recebe
                                        como argumento do Método
         
                                        Se for false, ou seja, não queremos checar os 
                                        registros DNS, então !checkdns vai ser igual a true e
                                        entra dentro deste if, encerrando as checagens e
                                        retornando direto o emailString com o formato válido
         
                                        Se for true, ou seja, quero checar os registros
                                        DNS, então !checkdns vai ser igual a false e
                                        cai no else
         
                                        */
         
         
         
         
         
                                        /*
                                        echo "<pre>";
                                        echo "Formato valido mas checkdns é false <br>";
                                        var_dump($emailString);
                                        var_dump($local);
                                        var_dump($domain);
                                        exit;
                                        */
                                        
         
                                        return $emailString;
                                        /*Retorna $emailString com o formato válido*/
         
                                        
                                    }//end if
                                    else 
                                    {
         
                                        /*
                                        Se cair nesse else é porque $checkdns é igual a true
                                        e quero fazer a checagem dos registros DNS
                                        */
                                       
         
                                        
         
                                        if ( checkdnsrr( $domain, "MX" ) || checkdnsrr( $domain, "A" ) ) 
                                        {   
         
                                            /*
                                            Analisa primeiro o Registro de tipo 'MX', apenas em caso de
                                            falha deste, é que fará a análise do Registro de tipo 'A'
                                            */
         
         
         
         
         
         
                                            /*
                                            echo "<pre>";
                                            echo "Formato valido com DNS <br>";
                                            var_dump($emailString);
                                            var_dump($local);
                                            var_dump($domain);
                                            exit;
                                            */
                                            
         
                                            
                                            return $emailString;
                                            /*Retorna $emailString com o formato válido*/
         
         
         
         
                                        }//end if
                                        else 
                                        {
         
                                            /*
                                            echo "<pre>";
                                            echo "Formato invalido com DNS <br>";
                                            var_dump($emailString);
                                            var_dump($local);
                                            var_dump($domain);
                                            exit;
                                            */
         
                                            return false;
                                            
                                        }//end else
         
         
         
         
         
                                        /*
                                        echo "<pre>";
                                        echo "Formato invalido e checkdns é false <br>";
                                        var_dump($emailString);
                                        var_dump($local);
                                        var_dump($domain);
                                        exit;
                                        */
                                        
         
         
                                        
                                    }//end else
                                    
         
         
         
         
         
         
         
         
                                    /*
                                    echo "<pre>";
                                    echo "Formato váido <br>";
                                    var_dump($emailString);
                                    var_dump($local);
                                    var_dump($domain);
                                    //var_dump($domainExploded);
                                    exit;
                                    */
         
                                    
                                }//end if
                                else 
                                {
         
                                    /*
                                    echo "<pre>";
                                    echo "Formato inválido <br>";
                                    var_dump($emailString);
                                    var_dump($local);
                                    var_dump($domain);
                                    exit;
                                    */
         
                                    return false;
                                    
                                }//end else
                                
         
         
         
                                /*
                                echo "<pre>";
                                echo "Tem pelo menos 1 ponto no Domínio <br>";
                                var_dump($emailString);
                                var_dump($local);
                                var_dump($domain);
                                exit;
                                */
                                
                            }//end if
                            else 
                            {
         
                                /*
                                echo "<pre>";
                                echo "Não tem nenhum ponto no Domínio <br>";
                                var_dump($emailString);
                                var_dump($local);
                                var_dump($domain);
                                exit;
                                */
         
                                return false;
         
                            }//end else
                            
         
         
                            /*
                            echo "<pre>";
                            echo "Apenas caracteres válidos na parte local e no domínio <br>";
                            var_dump($emailString);
                            var_dump($local);
                            var_dump($domain);
                            exit;
                            */
         
                            
                        }//end if
                        else 
                        {
         
                            /*
                            echo "<pre>";
                            echo "caracteres inválidos na parte local ou no domínio <br>";
                            var_dump($emailString);
                            var_dump($local);
                            var_dump($domain);
                            exit;
                            */
         
                            return false;
         
                        }//end else
                        
         
         
         
                        /*
                        echo "<pre>";
                        echo "Parte Local e Domínio têm mais que 1 caracter <br>";
                        var_dump($emailString);
                        var_dump($local);
                        var_dump($domain);
                        exit;
                        */
                        
                    }//end if
                    else 
                    {
         
                        /*
                        echo "<pre>";
                        echo "Ou Parte Local Ou Domínio têm 0 caracter <br>";
                        var_dump($emailString);
                        var_dump($local);
                        var_dump($domain);
                        exit;
                        */
                        
                        
         
         
                        return false;
         
         
                        
                    }//end else
                    
         
         
         
         
         
         
                    
                    /*
                    echo "<pre>";
                    echo "Uma arroba ou mais <br>";
                    var_dump($emailString);
                    var_dump($local);
                    var_dump($domain);
                    exit;
                    */
                    
         
                }//end if
                else 
                {
         
                    /*
                    echo "<pre>";
                    echo "Sem arrobas <br>";
                    var_dump($emailString);
                    exit;
                    */
         
         
                    return false;
                    
                }//end else
                
         
                /*
                echo "<pre>";
                echo "Sem espaços em branco <br>";
                var_dump($emailString);
                exit;
                */
         
         
            }//end elseif
            else{
         
         
                /*
                echo "<pre>";
                echo "não é válido <br>";
                var_dump($emailString);
                exit;
                */
         
         
                return false;
         
         
            }//end else
         
         
         
            
         
            
            
         
        }//end method


























     public static function validatePassword($password){

        $password = trim($password);

        if($password != ''){

            $password = preg_replace('/\s/','', $password);

            $passwordLenght = strlen($password);

            if(

                $passwordLenght >= Rule::PASSWORD_LENGHT_MIN 
                &&
                $passwordLenght <= Rule::PASSWORD_LENGHT_MAX


            ){

                return $password;


            }else{return false;}

        }else{
            return false;
        }

     }


     public static function ValidateBoolean($bool){

        if (preg_match( '/^([0-1]{1})$/', $bool )) {
          
            return $bool;

        } else {

           return false;

        }
        

     }















     public static function validatePagination($value){

        $value = trim($value);

        if ( $value != '') 
        {
           

            if (preg_match('/^[0-9]+$/', $value))
            {
               

                    if ( (int)$value >= Rule::PAGINATION_MINNUMBER && (int)$value <= Rule::PAGINATION_MAXNUMBER ) 
                    {
                       return $value;
                    }//end if
                    else
                    {
                        return false;
                    }//end else
                    



            } //end if
            else 
            {
               return false;
            }//end else
            


        }//end if
        else 
        {
          return false;
        }//end else
        

     }







     public static function sanitizerTagScript($value)
     {
         if ( preg_match('/<script/',$value) )
        {
           return false;
        } 
        else 
        {
           return true;
        }
         
     }



     public static function sanitazeStringUcWords($value){

      
            $value = trim($value);

            if ($value != '')          
            {
                $value = strtolower($value);
                $itemArray = explode( ' ',$value);

                $arrayHandler = [];

                foreach ($itemArray as &$term) {
                   
                    if ( $term == '') continue; 

                    $term = trim($term);

                    $term = ucwords($term);

                    array_push($arrayHandler, $term);
                }//end foreach

                $value = implode(' ', $arrayHandler);

                return $value;

            } 
            else {
               return false;
            }
            
        

     }




     public static function validateString(

        $value,
        $may_be_empty = false,
        $may_have_accent = true,
        $may_have_number = true,
        $may_have_special_character = true,
        $must_have_ucwords = false
        ){

         

            $value = trim($value);

           

            if( $value == '' && $may_be_empty == true )
            {

                /*echo '<pre>';
                echo '<br>';
                echo 'É Vazio e pode'; echo '<br>';
                echo 'Value : '; var_dump($value); echo '<br>';
                echo 'may_be_empty : '; var_dump($may_be_empty); echo '<br>';
                echo 'may_have_accent : '; var_dump($may_have_accent); echo '<br>';
                echo 'may_have_number : '; var_dump($may_have_number); echo '<br>';
                echo 'may_have_special_character : '; var_dump($may_have_special_character); echo '<br>';
                echo 'must_have_ucwords : '; var_dump($must_have_ucwords); echo '<br>';   
                exit;*/
                 
             

                    return $value;
            }//end if



            elseif ( $value == '' && $may_be_empty == false )
            {  
                return false;
            }//end else


            
            elseif( Validate::sanitizerTagScript($value) )
            {
                
                if( preg_match('/^[A-Za-z0-9\ç\Ç\s\_\-\á\Á\â\Â\à\À\ä\Ä\ã\Ã\é\É\ê\Ê\è\È\ë\Ë\í\Í\î\Î\ì\Ì\ï\Ï\ó\Ó\ô\Ô\ò\Ò\ö\Ö\õ\Õ\ú\Ú\û\Û\ù\Ù\ü\Ü\ñ\Ñ\!\?\@\#\$\%\&\>\<\,\.\;\:\*]+$/',$value) )
                {


                    if($may_have_accent === false && preg_match('/[\á\Á\â\Â\à\À\ä\Ä\ã\Ã\é\É\ê\Ê\è\È\ë\Ë\í\Í\î\Î\ì\Ì\ï\Ï\ó\Ó\ô\Ô\ò\Ò\ö\Ö\õ\Õ\ú\Ú\û\Û\ù\Ù\ü\Ü\ñ\Ñ]/',$value) )
                    {
                        return false;
                    }//end if 



                    if($may_have_number === false && preg_match('/[0-9]/',$value) )
                    {
                        return false;
                    }//end if 




                    if( $may_have_special_character === false && preg_match('/[\!\?\@\#\$\%\&\>\<\'\*\.\,\;\:]/',$value)) 
                    {

                        $value = Validate::sanitazeStringUcWords($value);
                       
                        return false;
                    }//end if 



                    if( $must_have_ucwords  )
                    {
                        $value = Validate::sanitazeStringUcWords($value);
                        if ( is_bool( $value ) && $value === false ) {
                            return false;
                        }//end if
                                
                    }//end if 



                    return $value;

                }//end if 
              
                else
                {
                    return false;
                }//end else 
         
            
            }//end elseif  
            else
            {
                return false;
            }//end else 
            



          




     }//endMethod



    public static function validateFullName($value)
    {
        $value = trim( $value );

        if(  $value != ''  ) 
        {
          if (preg_match('/\\s/', $value)) 
          {
            return true;
          } 
          else 
          {
             return false;
          }
          
        }//end if
        else 
        {
           return false;
        }//end else
        
    }













    
    public static function sanitazeNickname($value)
    {
        $value = trim( $value );

        if(  $value != ''  ) 
        {
            $nickarray = explode( ' ', $value );
            return $nickarray[0];

        }//end if
        else 
        {
           return false;
        }//end else
        
    }












     public static function setHash( $value ){

        try{

            $value = base64_encode($value);

            if( (bool)$value === false ) 
            {
                return false;
            }

            $value = strtr( $value, '+/', '-_' );

            return rtrim($value, '=');


        }//endTry
        catch(\Exception $e){

            return false;

        }//endCatch

     }

     
     public static function getHash( $value ){

        try{
            
            $value =  strtr($value, '-_', '+/');

            if( (bool)$value === false ) 
            {
                return false;
            }
            return base64_decode($value);


        }//endTry
        catch(\Exception $e){

            return false;

        }//endCatch

     }


    }



?>
<?php


                    $host = "localhost"; 
                    $name = "clubedafama";
                    $user = "root";
                    $password = "";
                    
                    $conn = mysqli_connect($host, $user, $password, $name);
                    
                    try{
                        $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $password);
                    } catch (PDOException $e){
                        echo "SQL Error: ".$e->getMessage();
                    }



?>
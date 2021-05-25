<?php

    namespace Main\Model;

    use \Main\Model;
    use \Main\DB\Sql;

    class Address extends Model
    {




        public function update(){


            $sql = new Sql();
          

         
     

            
            $query = "CALL sp_addresses_update(

             :idaddress,
             :iduser,
             :deszipcode,
             :desaddress,
             :desnumber,
             :descomplement,
             :desdistrict,
             :idcity,
             :descity,
             :idstate,
             :desstate,
             :desstatecode,
             :descountry, 
             :descountrycode
    

            );";

           $results = $sql->select($query, [

                ':idaddress'=>$this->getidaddress(),
                ':iduser'=>$this->getiduser(),
                ':deszipcode'=>$this->getdeszipcode(),
                ':desaddress'=>$this->getdesaddress(),
                ':desnumber'=>$this->getdesnumber(),
                ':descomplement'=>$this->getdescomplement(),
                ':desdistrict'=>$this->getdesdistrict(),
                ':idcity'=>$this->getidcity(),
                ':descity'=>$this->getdescity(),
                ':idstate'=>$this->getidstate(),
                ':desstate'=>$this->getdesstate(),
                ':desstatecode'=>$this->getdesstatecode(),
                ':descountry'=>$this->getdescountry(),
                ':descountrycode'=>$this->getdescountrycode()
     

            ]);  


            

            if( count($results) > 0 ){

                $this -> setData( $results[0] );

            }//endif
            
        }//endmethod









        public function get($iduser){




                $sql = new Sql();

                $query = "  
                
                    SELECT * FROM tb_addresses a
                    INNER JOIN tb_users b ON a.iduser = b.iduser  
                    WHERE a.iduser = :iduser
                    ORDER BY a.dtregister DESC
                    LIMIT 1;

                ";

                $results = $sql -> select($query, [

                    ':iduser' => $iduser

                ]);
          

                if (count($results) > 0 ) {
                    
                    $this->setData( $results[0] );
                    
                }

        }//END FUNCTION




    }//END CLASS



?>
<?php

namespace Main\Model;
use \Main\Model;
use \Main\DB\Sql;
use Main\Rule;

class Purchase extends Model
    {




        public function update(){


            $sql = new Sql();
          

        
            
            $query = "CALL sp_purchases_update(

             :idrecibo,
             :iduser,
             :idseller,
             :idproduct,
             :desbuystate,
             :despayament,
             :desmethod,
             :desip,
             :dtbuy
        
    
            );";

           $results = $sql->select($query, [

                ':idrecibo'=>$this->getidrecibo(),
                ':iduser'=>$this->getiduser(),
                ':idseller'=>$this->getidseller(),
                ':idproduct'=>$this->getidproduct(),
                ':desbuystate'=>$this->getdesbuystate(),
                ':despayament'=>$this->getdespayament(),
                ':desmethod'=>$this->getdesmethod(),
                ':desip'=>$this->getdesip(),          
                ':dtbuy'=>$this->getdtbuy()
               
            ]);  


          

            if( count($results) > 0 ){

                $this -> setData( $results[0] );

            }//endif
            
        }//endmethod











        public function get($buyid){




                $sql = new Sql();

                $query = "  
                
                SELECT * FROM tb_purchases 
                WHERE idrecibo = :idrecibo
                ORDER BY dtbuy DESC
                LIMIT 1;

                 
                ";

             return $results = $sql -> select($query, [

                    ':idrecibo' => $buyid

                ]);
          

                if (count($results) > 0 ) {
                    
                    $this->setData( $results[0] );
                    
                }

        }//END FUNCTION









        public function getAllPurchases(){
           
            $sql = new Sql();
        
    
            $query = "  
            
            SELECT * FROM tb_purchases        
            ORDER BY dtbuy DESC
                   
            ";

           return $sql->select($query);

        }


    

            


    }//END CLASS



?>
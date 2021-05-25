<?php

namespace Main;


        class PageAdmin extends Page{


            public function __construct( $opts = array(), $tpl_Dir = 'views'.DIRECTORY_SEPARATOR."admin")
            {
                
                parent::__construct( $opts, $tpl_Dir ); //Chama a montagem Principal

            }




        }

      
        

?>
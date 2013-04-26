<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Conexcao{
    
   public $conec; 
   
   function __construct($servidorBase,$sbNameBase,$usuario,$senha) {
       //temporariamente sem tratar erros
       $stringConeccaoBase ='mysql:host='.$servidorBase.';dbname='.$sbNameBase;
       $this->conec = new PDO($stringConeccaoBase,$usuario, $senha);  
     
       
       
   }

}

?>

<?php 

class Link{

 public $id;
 public $link;
 public $descricao;

 public function __construct($id,$link,$descricao) {
        
	$this->id = $id;
	$this->link = $link;
	$this->descricao = $descricao;
	}
 public function __set($name, $value) {
        	$this->$name = $value;
        }

 public function __get($name) {
        return 	$this->$name;
	}

}

?>
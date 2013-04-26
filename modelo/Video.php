<?php 

class Video{

 public $id;
 public $titulo;
 public $descricao;
 public $link;

 public function __construct($id,$titulo,$descricao,$link) {
        
	$this->id = $id;
	$this->titulo = $titulo;
	$this->descricao = $descricao;
	$this->link = $link;

	}
 public function __set($name, $value) {
        	$this->$name = $value;
        }

 public function __get($name) {
        return 	$this->$name;
	}

}

?>
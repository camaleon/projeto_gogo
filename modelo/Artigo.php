<?php 

class Artigo{

 public $id;
 public $titulo;
 public $conteudo;
 public $link;
 public $data;


 public function __construct($id,$titulo,$conteudo,$link,$data) {
        
	$this->id = $id;
	$this->titulo = $titulo;
	$this->conteudo = $conteudo;
        $this->link = $link;
        $this->data = $data;
	}
 public function __set($name, $value) {
        	$this->$name = $value;
        }

 public function __get($name) {
        return 	$this->$name;
	}

}

?>
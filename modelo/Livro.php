<?php 

class Livro{

 public $id;
 public $nome;
 public $resumo;
 public $caracteristicas;
 public $capa;
 public $livro;

 public function __construct($id,$nome,$resumo,$caracteristicas,$capa,$livro) {
        
	$this->id = $id;
	$this->nome = $nome;
	$this->resumo = $resumo;
	$this->caracteristicas = $caracteristicas;
        $this->capa = $capa;
        $this->livro =$livro;
	}
 public function __set($name, $value) {
        	$this->$name = $value;
        }

 public function __get($name) {
        return 	$this->$name;
	}

}

?>
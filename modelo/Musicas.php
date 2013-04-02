<?php 

class Musicas{

 public $id;
 public $tituloAlbum;
 public $faixa;
 public $nomeMusica;

 public function __construct($id,$tituloAlbum,$faixa,$nomeMusica) {
        
	$this->id = $id;
	$this->tituloAlbum = $tituloAlbum;
	$this->faixa = $faixa;
	$this->nomeMusica = $nomeMusica;

	}
 public function __set($name, $value) {
        	$this->$name = $value;
        }

 public function __get($name) {
        return 	$this->$name;
	}

}

?>
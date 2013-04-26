<?php

/*
 * configura e envia emails sem autenticação
 * usada para pagina de contatos
 * 
 */
class Mail{
    public $nome;
    //de onde se origina o email
    public $email;
    public $empresa;
    public $cidade;
    public $estado;
    public $telefone;
    public $assunto;
    public $mensagem;
    public $corpoMensagem;
    //para onde será enviado o email
    public $emailDestino;
    public $checkSend;
    public $dataMensagem;
    
    function __construct($nome = "",$email = "",$empresa = ""
            ,$cidade = "",$estado = "",$telefone = "",$assunto = ""
            ,$mensagem = "",$emailDestino = "") {
        
    $this->nome = $nome;
    $this->email = $email;
    $this->empresa = $empresa;
    $this->cidade = $cidade;
    $this->estado = $estado;
    $this->telefone = $telefone;
    $this->assunto = $assunto;
    $this->mensagem = $mensagem;
    $this->emailDestino ='<'.$emailDestino.'>';
    $this->dataMensagem = date("d/m/Y");
    
    }

function criaMensagem(){
    $this->corpoMensagem = "Nome : ".$this->nome."\r\n"."\r\n".
            "\r\n"."\r\n"."Cidade/Estado : ".$this->cidade." - ".
           $this->estado."\r\n"."\r\n"."\r\n"."\r\n"."\r\n"."\t".$this->mensagem;    
}

function enviaMesnsagem(){
    $temp = mail($this->emailDestino,utf8_decode(@$this->assunto), utf8_decode(@$this->corpoMensagem),
            'From :'.utf8_decode(@$this->email));
    
    if($temp){
        $this->checkSend = true;
    }else{
        $this->checkSend = false;
    }
}
   
    }

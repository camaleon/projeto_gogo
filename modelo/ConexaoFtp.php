<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConexaoFtp
 *
 * @author HP
 */
class ConexaoFtp {
    
   //dados ftp
    private $hostFtp;
    private $loginFtp;
    private $passwdFtp;
    //Erro ao fazer conecção ftp
    public $errorFtpLogin;
    //conecção ftp
    public $conecFTP;
    
    function __construct($hostFtp,$loginFtp,$passwdFtp) {               
        $this->hostFtp = $hostFtp;
        $this->loginFtp = $loginFtp;
        $this->passwdFtp = $passwdFtp;
    }
    function conectar(){       
        $this->conecFTP = ftp_connect($this->hostFtp);
        if($this->conecFTP != FALSE){
            $temp = ftp_login($this->conecFTP,$this->loginFtp,$this->passwdFtp);
            //verifica se existe erro ao fazer login ftp;
            if($temp){
                $this->errorFtpLogin = 0;
            }else{
                $this->errorFtpLogin = 1;
            }
        }
    }
    
    function desconectar(){
        ftp_close($this->conecFTP);
    }
}

?>

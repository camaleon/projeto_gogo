<?php

/*
 * para toda pagina que necessitar de seguraça apos login
 * checa e ver se a existe a sesão criada com a classe login existe
 */
class VerificaNivelAcesso{
    private $ip;
    private $timeSession;
    private $seccao;
    public $acesso;
    private $pagina;
 

    function __construct($pagina) {
        $this->pagina = $pagina;
        if(isset($_SESSION['login'])){
            $temp = explode("-", $_SESSION['login']); 
            $this->ip = $temp[0];
            $this->timeSession = $temp[1];
            $this->seccao = true;
            $this->verificaSessaoExpirou();
        }else{

                echo "<meta http-equiv='refresh' content='0; url=".$this->pagina."'>";
                

        }

    }
    //verifica se secçaõ expirou, se sim retona a index principal
    //se naum acessa a pagina
    function verificaSessaoExpirou(){
        if($this->seccao){

            if($this->ip = $_SERVER["REMOTE_ADDR"]){
                $temp =(string)time();
                if($this->timeSession > $temp){
                    $this->acesso = true;
                //se tempo naum expirou    
                }else{
                    unset($_SESSION['login']);
                    $this->acesso = false;
                        }
                
                //se ip e o mesmo que criou a seccao
            }else{
                $this->acesso = false;
            }
        
        //seccao existe        
        }else{
            $this->acesso = false;           
        }
        
        if($this->acesso == false){
                $pagina="../principal"; 
                echo "<meta http-equiv='refresh' content='0; url=".$this->pagina."'>";
        }
    }
}
?>

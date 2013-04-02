<?php
//inclir tratamento de erros
//escrever configuração do banco
//falta numero de online

/*
 * Contador de Acesso
 * verifica se ip esta cadastrado no banco se não
 * adiciona,Gera numero de acessos e Numero de
 * falta implementar Usuarios online
 */
require_once('lib/PHP/fpdf.php');

class ContadorDeAcesso{
    public $numeroAcessos;
    public $numeroAcessoOnline;
    
    //para iniciar verifica necessita como argumento do
    //construtor uma conecção pdo
    function __construct($conecxao,$ipAcesso) {
        $this->consultarAcesso($conecxao,$ipAcesso);      
    }
    
    //Verifica se ip ja esta na base de dados se naum adiciona
    public function consultarAcesso($con,$ip){
        $tempIpAdd = 0;
        $ipTotal = 0;
        $tempResult = $con->query("SELECT ipAcessado FROM contadoracesso");
        //verifica se ip ja cadastrado banco de dados
        foreach ($tempResult as $value) {
            if($ip==$value['ipAcessado']){
                $tempIpAdd = 1;
            }
        }
        
        //se não esta no banco adiciona o mesmo
        if($tempIpAdd==0){
            $query ="INSERT INTO contadoracesso (ipAcessado) VALUES('$ip')";
            $con->query($query);
        }
        
        //conta numero de ip cadastrados no banco
        $tempResult = $con->query("SELECT ipAcessado FROM contadoracesso");
        foreach ($tempResult as $value) {
            $ipTotal = $ipTotal+1;
        }
        //carrega no atributo o numero de acessos
        $this->numeroAcessos = $ipTotal;
        echo($this->numeroAcessos);
    }
    
}
?>

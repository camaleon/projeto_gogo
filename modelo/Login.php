<?php

/*
 * Verifica se usuario e senha cadastrado no banco se sim cria uma session
 * com o ip e tempo para expirar
 * 
 */

class Login{
    private $login;
    private $senha;
    private $conecxao;
    private $resultado;
    public $status;
    
                
    function __construct($login,$senha,$conexcao) {
        $this->login = $login;
        $this->senha = $senha;
        $this->conecxao = $conexcao;
        $this->resultado = array();
        $this->status = false;

    }
       
   function __get($atributo) {
       return $this->$atributo;
   }
   function __set($atributo, $valor) {
       
       $this->$atributo = $valor;
   }
    
    function logar(){
        //codifica para padrão sha .
        $TempCodificada = hash('sha512',$this->senha);
   try
        {
   //executa a instrução de consulta
     try{  
        $this->resultado = $this->conecxao->conec->query("SELECT * FROM login");
     }catch(PDOException $e){
         //temporariamente sem tratameto
     }
    
        if($this->resultado)
    {
        //percorre os resultados via o laço foreach
        foreach($this->resultado as $linha){
            if($linha['login'] == $this->login){
                if($linha['password']== $TempCodificada){
                    $temp = (string) time()+1200;
                    $temp1 = $_SERVER["REMOTE_ADDR"];
                    //cria secção tempo para expirar + ip
                    $_SESSION['login'] = $temp1."-".$temp;
                    $_SESSION['user'] = $this->login;
                    $this->status = true;
                     
                }else{
                        //gerar alerta e direcionar para index
                      $this->status = false;
                }
            }          
        }
    }
    }catch (PDOException $i){
    //se houver exceção, exibe
    echo "Erro: <code>" . $i->getMessage() . "</code>";
    }
    }
        
        
    
}
?>

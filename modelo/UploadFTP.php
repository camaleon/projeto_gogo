<?php

/*
 *Classe usada para otimizar upload ao servidor.
 * Para o correto funcionamento a tag form deve 
 * ter o atributo enctype="multipart/form-data".
 */

/**
 * Exucuta upload de arquivos 
 *  Para correto funcionamento o form tera obrigatoriamente que ter um do tipo file,
 *  e o a tag <form> ter o atributo enctype="multipart/form-data".
 * @author Antônio Paulo
 */
class UploadFTP extends Upload{
    
    
    //nomo dfinal do arquivo
    private $nomeFinalArquivo;
    // caminho portabilizado para a plataforma
    private $portbalizar;
    //diretorio destino
    private $dirDestinoArquivo;
    //atributo name do campo tipo file do form.
    private $nameForm;
    //extensao do arquivo.
    private $extensao;
    //tamanhao do arquivo.
    private $tamanho;
    //erro ao transferir arquivo para servidor
    private $error;
    //verifica se arquivo foi enviado ao diretorio.
    public $statusTransferir;
    //conecção ftp
    private $conecFTP;
    //separadador de diretorios idependente da plataforma.
    private $DS = DIRECTORY_SEPARATOR;
 

    /**
     * $arrayTypeFile e um array do tipo $_FILE.
     * 
     * $nomeFinalArquivo e o nome final do arquivo,se passado um string vazia o mesmo
     * será automaticamente atribuido.
     * 
     * $dirDestinoArquivo e o dirotorio final do arquivo a partir da raiz do projeto.
     *  
     * @array type $arrayTypeFile
     * @string type $nomeFinalArquivo
     * @stirng type $dirDestinoArquivo
     */
    function __construct($ftpConec,$arrayTypeFile,$nomeFinalArquivo,$dirDestinoArquivo) {
        
        $this->conecFTP = $ftpConec;
        //nome do campo file formulario          
        $this->nameForm = $arrayTypeFile['name'];
        $this->portabilizar($dirDestinoArquivo);
        $this->getError($arrayTypeFile['error']);
        $this->getExtension($arrayTypeFile['name']);
        $this->getSizeFile($arrayTypeFile['size']);
        $this->renameFile($nomeFinalArquivo,$arrayTypeFile['tmp_name']);
        $this->createDirD($this->portbalizar);
        $this->transferirArquivo($arrayTypeFile);
       
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    /**
     * Método portabiliza os separadores de diretorio idenpenente da 
     * plataforma.
     * 
     * $dirDestinoArquivo e um string com o caminho final do arquivo.
     * 
     * @string type $dirDestinoArquivo
     */
    function portabilizar($dirDestinoArquivo){
        $tempPort = $dirDestinoArquivo;
               
        if(substr_count($tempPort,"/")>0){
            $tempPort = str_replace("/",$this->DS,$tempPort);
        }
        
        if(substr_count($tempPort,"\\")>0){
            $tempPort= str_replace("\\",$this->DS,$tempPort);
        }
        $this->portbalizar = $tempPort;
    }

    /**
     *Método para tranferir o arquivo para diretorio destino 
     * @array type $arrayArquivo
     */
    function transferirArquivo($arrayArquivo){
        //verifica se arquivo foi enviado ao servidor
        if(!empty($arrayArquivo['tmp_name'])){  
           ftp_put($this->conecFTP,$this->dirDestinoArquivo,$arrayArquivo['tmp_name'],FTP_BINARY);
            $this->statusTransferir = true;
        }else{
            $this->statusTransferir = false;
        }
        
    }
    
    /**
     * Método para criar a string do caminho destino do arquivo.
     * 
     * @string type $dirDestinoArquivo
     */
    function createDirD($dirDestinoArquivo){
        $this->dirDestinoArquivo = $this->DS.$dirDestinoArquivo.$this->DS.$this->nomeFinalArquivo;
    }
    
    /**
     * Método recupera a extensão original do arquivo
     * 
     * @string type $nomeArquivo
     */
    function getExtension($nomeArquivo){       
        if(!($this->nameForm = null)){
            $temp = explode(".", $nomeArquivo);
            $this->extensao = $temp[1];
        }
    }
    
    /**
     * Método renomeia o arquivo casa passado um string
     * se string vazia o metodo automaticamente atribuirá um nome.
     * 
     * @string type $nomeFinalArquivo
     * @string type $tempNameFile
     */
    function renameFile($nomeFinalArquivo,$tempNameFile){      
        if($nomeFinalArquivo == null){         
            $temp = $tempNameFile;
            $tempExplode = explode($this->DS, $temp);
            $temp = $tempExplode[count($tempExplode)-1];
            $temp = explode(".", $temp);
            $this->nomeFinalArquivo = $temp[0].".".$this->extensao;
            
        }else{       
            $this->nomeFinalArquivo = $nomeFinalArquivo;                  
        }
    }
    
    /**
     * Método recupera tamanho do arquivo em Kbytes.
     * @int type $tamanhoArquivo
     */
    function getSizeFile($tamanhoArquivo){
            $this->tamanho = $tamanhoArquivo/1000;
    }
    
    /**
     * Método recupera erro ao enviar o arquivo para servidor
     * @int type $error
     */
    function getError($error){
            $this->error = $error;
    }
    
}

?>

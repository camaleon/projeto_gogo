<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfessorDAO
 *
 * @author HP
 */
class MusicasDAO {
    
    public $cds;
    public $message;
    public $con;
    
    
    public function __construct($con) {
       $this->con = $con;
    }   
    public function __set($name, $value) {
        $this->$name = $value ;
    }
    public function __get($name) {
        return $this->$name;
    }
      
   
    //antes de adicionar consultar se os intesn ja existem
    public function adicionarAlbum($objCd,$status){

       if($status == 0){
           
            $sql = "INSERT INTO cds(cds_id,
                cds_tituloAlbun,
                cds_faixa,
                cds_nomeMusica)
                VALUES(:cds_id,
                :cds_tituloAlbun,
                :cds_faixa,
                :cds_nomeMusica)";
            
            $stmt = $this->con->prepare($sql);
            
            $stmt->bindValue(':cds_id', utf8_decode($objCd->id));
            $stmt->bindValue(':cds_tituloAlbun', utf8_decode($objCd->tituloAlbum));
            $stmt->bindValue(':cds_faixa', utf8_decode($objCd->faixa));
            $stmt->bindValue(':cds_nomeMusica', utf8_decode($objCd->nomeMusica));
            $stmt->execute();
            if($stmt->rowCount()>0){
                $this->message = "Dados inserido com sucesso.";
            }
       }else{
               $this->message = "Album já cadastrado(a).";
       }
    }   
    
    //deleta item
    public function deletarAlbum($idCd){       
       
        $sql = "DELETE FROM cds WHERE cds_id=:cds_id" ;
        $stmt = $this->con->prepare($sql);
        
        $stmt->bindValue(':cds_id', $idCd);
        $stmt->execute();
        
        if($stmt->rowCount()>0){            
            $this->message = "Dados excluidos com sucesso.";
        }else{
            $this->message = "Dados não foram encontrados ou não podem ser excluidos."; 
        }
        
    }
   
    //consultar item
    public function consultarAlbumPorTitulo($tituloAlbum){
        
        //selsciona todos os itens da tabela ou um especifico
        $this->cds = Array();
        $sql = "SELECT * FROM cds";

        $resultado = $this->con->query($sql);  
        if(count($resultado)>0){
            foreach ($resultado as $value) {
                    //var_dump(mb_detect_encoding($tituloAlbum.'x', 'UTF-8, ISO-8859-1'));
                    //var_dump(mb_detect_encoding(utf8_encode($value['cds_tituloAlbun']).'x', 'UTF-8, ISO-8859-1'));
                if(strcasecmp(utf8_encode($value['cds_tituloAlbun']), $tituloAlbum)== 0){
                    
                    $musica = new Musicas($value['cds_id'],
                            $value['cds_tituloAlbun'],
                            $value['cds_faixa'],
                            $value['cds_nomeMusica']);
                    array_push($this->cds, $musica);
               
                }
            } 
            $this->message = "Foram encontados ".$resultado->rowCount()." album(s)."; 
        }else{
            $this->message = "A consulta não encontrou nenhum album"; 
        }
        //carrega array de nome e descrição 
      
    }
  
        public function consultarAlbumPorId($id){
        
        //selsciona todos os itens da tabela ou um especifico
        $this->cds =  Array();
        $sql = "SELECT * FROM cds WHERE cds_id =".$id." ORDER BY cds_id";
         
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
                    $musica = new Musicas($value['cds_id'],
                            $value['cds_tituloAlbun'],
                            $value['cds_faixa'],
                            $value['cds_nomeMusica']);
                    array_push($this->cds, $musica);
            } 
            $this->message = "Foram encontados ".$resultado->rowCount()." album(s)."; 
        }else{
            $this->message = "A consulta não encontrou nenhum album"; 
        }
        //carrega array de nome e descrição 

        
    }
 
        
    public function consultarTodasAlbuns(){
        $this->cds = Array();
        $sql = "SELECT * FROM cds ORDER BY cds_id ASC";
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
                    $musica = new Musicas($value['cds_id'],
                            $value['cds_tituloAlbun'],
                            $value['cds_faixa'],
                            $value['cds_nomeMusica']);
                    array_push($this->cds, $musica);
            }      
    }
}


    public function getMaximoId(){
    $sql = "select MAX(cds_id) FROM cds";
    $resultado = $this->con->query($sql);

            foreach ($resultado as $value) {
                //verifica produto idependente de maiusculas e minusculas
                $temp = $value['MAX(cds_id)'];
            }
       return $temp;

    }
    
    public function getNumeroMusicas(){
    $sql = "select COUNT(cds_faixa) FROM cds";
    $resultado = $this->con->query($sql);

            foreach ($resultado as $value) {
                //verifica produto idependente de maiusculas e minusculas
                $temp = $value['COUNT(cds_faixa)'];
            }
       return $temp;

    }
 
    
    //seleciona todos os albuns retirando repeticoes        
    public function consultarNomeTodosAlbuns(){
        $this->cds = Array();
        $sql = "SELECT DISTINCT cds_tituloAlbun FROM cds ";
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
                    $cd = $value['cds_tituloAlbun'];
                    array_push($this->cds, $cd); 
            }      
    }
    


}
}
?>

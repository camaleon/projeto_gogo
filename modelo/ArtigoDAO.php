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
class ArtigoDAO {
    
    public $artigos;
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
    public function adicionarArtigo($objArtigo,$status){

       if($status == 0){
           
            $sql = "INSERT INTO artigos(id,
                titulo,
                conteudo,
                data)
                VALUES(:id,
                :titulo,
                :conteudo,
                :data)";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':id',utf8_decode($objArtigo->id));
            $stmt->bindValue(':titulo',utf8_decode($objArtigo->titulo));
            $stmt->bindValue(':conteudo',utf8_decode($objArtigo->conteudo));
            $stmt->bindValue(':data',utf8_decode($objArtigo->data));
            $stmt->execute();
            if($stmt->rowCount()>0){
                $this->message = "Dados inserido com sucesso.";
            }
       }else{
               $this->message = "artigo já cadastrado(a).";
       }
    }   
 //alterar
   public function alterarArtigo($id,$objArtigo){

    $sql = "UPDATE artigos SET 
        titulo=:titulo,
        conteudo=:conteudo,
        data=:data
        WHERE id=:id";
    
    $stmt = $this->con->prepare($sql);
        
    $stmt->bindValue(":id",$id);
    $stmt->bindValue(":titulo",utf8_decode($objArtigo->titulo));
    $stmt->bindValue(":conteudo",utf8_decode($objArtigo->conteudo));
    $stmt->bindValue(":data",$objArtigo->data);
   
    $stmt->execute();                 

    if($stmt->rowCount()>0){
            $this->message = "Dados alterados com sucesso.";
    }else{
            $this->message = "Dados não podem ser alterados ou modificados";
        }
    }
  
//alterar    
    //deleta item
    public function deletarArtigo($idArtigo){       
       
        $sql = "DELETE FROM artigos WHERE id=:id" ;
        $stmt = $this->con->prepare($sql);
        
        $stmt->bindValue(':id', $idArtigo);
        $stmt->execute();
        
        if($stmt->rowCount()>0){            
            $this->message = "Dados excluidos com sucesso.";
        }else{
            $this->message = "Dados não foram encontrados ou não podem ser excluidos."; 
        }
        
    }
   
    //consultar item
    public function consultarArtigoPorTitulo($tituloArtigo){
        
        //selsciona todos os itens da tabela ou um especifico
        $this->artigos = Array();
        $sql = "SELECT * FROM artigos";

        $resultado = $this->con->query($sql);  
        if(count($resultado)>0){
            foreach ($resultado as $value) {
                if(strcasecmp($value['titulo'], utf8_decode($tituloArtigo))== 0){                
                    
                    $artigo = new Artigo($value['id'],
                            $value['titulo'],
                            $value['conteudo'],
                            $value['data']);
                    
                    array_push($this->artigos, $artigo);
               
                }
            } 
            $this->message = "Foram encontados ".$resultado->rowCount()." artigo(s)."; 
        }else{
            $this->message = "A consulta não encontrou nenhum artigo"; 
        }
        //carrega array de nome e descrição 
      
    }
  
        public function consultarArtigoPorId($id){
        
        //selsciona todos os itens da tabela ou um especifico
        $this->artigos =  Array();
        $sql = "SELECT * FROM artigos WHERE id =".$id." ORDER BY id";
         
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
             $artigo = new Artigo($value['id'],
                    $value['titulo'],
                    $value['conteudo'],
                     $value['data']);
            array_push($this->artigos, $artigo);

            } 
            $this->message = "Foram encontados ".$resultado->rowCount()." artigo(s)."; 
        }else{
            $this->message = "A consulta não encontrou nenhum artigo"; 
        }
        //carrega array de nome e descrição 
        
    }
        
    public function consultarTodosArtigos(){
        $this->artigos = Array();
        $sql = "SELECT * FROM artigos";
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
             $artigos = new Artigo($value['id'],
                    $value['titulo'],
                    $value['conteudo'],
                    $value['data']);
            array_push($this->artigos, $artigos);

            }      
    }
}

    public function getMaximoId(){
    $sql = "select MAX(id) FROM artigos";
    $resultado = $this->con->query($sql);

            foreach ($resultado as $value) {
                //verifica produto idependente de maiusculas e minusculas
                $temp = $value['MAX(id)'];
            }
       return $temp;

    }
    
    //seleciona todos os albuns retirando repeticoes        
    public function consultarNomeTodosArtigos(){
        $this->artigos = Array();
        $sql = "SELECT DISTINCT titulo FROM artigos ";
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
                    $artigo = $value['titulo'];
            array_push($this->artigos, $artigo); 
            }      
    }
   
}
}
?>

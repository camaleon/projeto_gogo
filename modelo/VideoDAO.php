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
class VideoDAO {
    
    public $videos;
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
    public function adicionarVideo($objVideo,$status){

       if($status == 0){
           
            $sql = "INSERT INTO videos(id,
                titulo,
                descricao,
                link)
                VALUES(:id,
                :titulo,
                :descricao,
                :link)";
            
            $stmt = $this->con->prepare($sql);
            
            $stmt->bindValue(':id', utf8_decode($objVideo->id));
            $stmt->bindValue(':titulo', utf8_decode($objVideo->titulo));
            $stmt->bindValue(':descricao', utf8_decode($objVideo->descricao));
            $stmt->bindValue(':link', utf8_decode($objVideo->link));
            $stmt->execute();
            if($stmt->rowCount()>0){
                $this->message = "Dados inserido com sucesso.";
            }
       }else{
               $this->message = "Video já cadastrado(a).";
       }
    }   
    
    //deleta item
    public function deletarVideo($idVideo){       
       
        $sql = "DELETE FROM videos WHERE id=:id" ;
        $stmt = $this->con->prepare($sql);
        
        $stmt->bindValue(':id', $idVideo);
        $stmt->execute();
        
        if($stmt->rowCount()>0){            
            $this->message = "Dados excluidos com sucesso.";
        }else{
            $this->message = "Dados não foram encontrados ou não podem ser excluidos."; 
        }
        
    }
   
    //consultar item
    public function consultarVideoPorTitulo($tituloVideo){
        
        //selsciona todos os itens da tabela ou um especifico
        $this->videos = Array();
        $sql = "SELECT * FROM videos";

        $resultado = $this->con->query($sql);  
        if(count($resultado)>0){
            foreach ($resultado as $value) {
                //var_dump($value['titulo']);
                //var_dump(utf8_decode($tituloVideo));
                //var_dump(strcasecmp(utf8_encode($value['titulo']), utf8_encode($tituloVideo)));
                if(strcasecmp($value['titulo'], utf8_decode($tituloVideo))== 0){                
                    $video = new Video($value['id'],
                    utf8_encode($value['titulo']),
                    utf8_encode($value['descricao']),
                    utf8_encode($value['link']));
                    array_push($this->videos, $video);
               
                }
            } 
            $this->message = "Foram encontados ".$resultado->rowCount()." video(s)."; 
        }else{
            $this->message = "A consulta não encontrou nenhum album"; 
        }
        //carrega array de nome e descrição 
      
    }
  
        public function consultarVideoPorId($id){
        
        //selsciona todos os itens da tabela ou um especifico
        $this->videos =  Array();
        $sql = "SELECT * FROM videos WHERE id =".$id." ORDER BY id";
         
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
                    $video = new Video($value['id'],
                            $value['titulo'],
                            $value['descricao'],
                            $value['link']);
                    array_push($this->videos, $video);  
            } 
            $this->message = "Foram encontados ".$resultado->rowCount()." album(s)."; 
        }else{
            $this->message = "A consulta não encontrou nenhum album"; 
        }
        //carrega array de nome e descrição 

        
    }
 
        
    public function consultarTodasVideos(){
        $this->videos = Array();
        $sql = "SELECT * FROM videos ORDER BY id DESC";
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
                    $videos = new Video($value['id'],
                    utf8_encode($value['titulo']),
                    utf8_encode($value['descricao']),
                    utf8_encode($value['link']));
                    array_push($this->videos, $videos); 
            }      
    }
}


    public function getMaximoId(){
    $sql = "select MAX(id) FROM videos";
    $resultado = $this->con->query($sql);

            foreach ($resultado as $value) {
                //verifica produto idependente de maiusculas e minusculas
                $temp = $value['MAX(id)'];
            }
       return $temp;

    }
    
    //seleciona todos os albuns retirando repeticoes        
    public function consultarNomeTodosVideos(){
        $this->videos = Array();
        $sql = "SELECT DISTINCT titulo FROM videos ";
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
                    $video = $value['titulo'];
            array_push($this->videos, $video); 
            }      
    }
    


}
}
?>

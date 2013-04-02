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
class LivrosDAO {
    
    public $livros;
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
    public function adicionarLivro($objLivro,$status){

       if($status == 0){
           
            $sql = "INSERT INTO livros(id,
                nome,
                resumo,
                caracteristicas,
                capa,livro)
                VALUES(:id,
                :nome,
                :resumo,
                :caracteristicas,
                :capa,
                :livro)";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':id',utf8_decode($objLivro->id));
            $stmt->bindValue(':nome',utf8_decode($objLivro->nome));
            $stmt->bindValue(':resumo',utf8_decode($objLivro->resumo));
            $stmt->bindValue(':caracteristicas',utf8_decode($objLivro->caracteristicas));
            $stmt->bindValue(':capa',utf8_decode($objLivro->capa));
            $stmt->bindValue(':livro',utf8_decode($objLivro->livro));
            $stmt->execute();
            if($stmt->rowCount()>0){
                $this->message = "Dados inserido com sucesso.";
            }
       }else{
               $this->message = "livro já cadastrado(a).";
       }
    }   
    
    //deleta item
    public function deletarLivro($idLivro){       
       
        $sql = "DELETE FROM livros WHERE id=:id" ;
        $stmt = $this->con->prepare($sql);
        
        $stmt->bindValue(':id', $idLivro);
        $stmt->execute();
        
        if($stmt->rowCount()>0){            
            $this->message = "Dados excluidos com sucesso.";
        }else{
            $this->message = "Dados não foram encontrados ou não podem ser excluidos."; 
        }
        
    }
   
    //consultar item
    public function consultarLivroPorTitulo($tituloLivro){
        
        //selsciona todos os itens da tabela ou um especifico
        $this->livros = Array();
        $sql = "SELECT * FROM livros";

        $resultado = $this->con->query($sql);  
        if(count($resultado)>0){
            foreach ($resultado as $value) {
                if(strcasecmp($value['nome'], utf8_decode($tituloLivro))== 0){                
                    
                    $livro = new Livro($value['id'],
                            $value['nome'],
                            $value['resumo'],
                            $value['caracteristicas'],
                            $value['capa'],
                            $value['livro']);
                    
                    array_push($this->livros, $livro);
               
                }
            } 
            $this->message = "Foram encontados ".$resultado->rowCount()." livro(s)."; 
        }else{
            $this->message = "A consulta não encontrou nenhum livro"; 
        }
        //carrega array de nome e descrição 
      
    }
  
        public function consultarLivroPorId($id){
        
        //selsciona todos os itens da tabela ou um especifico
        $this->livros =  Array();
        $sql = "SELECT * FROM livros WHERE id =".$id." ORDER BY id";
         
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
             $livro = new Livro($value['id'],
                    $value['nome'],
                    $value['resumo'],
                    $value['caracteristicas'],
                    $value['capa'],
                     $value['livro']);
            array_push($this->livros, $livro);

            } 
            $this->message = "Foram encontados ".$resultado->rowCount()." livro(s)."; 
        }else{
            $this->message = "A consulta não encontrou nenhum livro"; 
        }
        //carrega array de nome e descrição 

        
    }
 
        
    public function consultarTodasLivros(){
        $this->livros = Array();
        $sql = "SELECT * FROM livros";
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
             $livro = new Livro($value['id'],
                    $value['nome'],
                    $value['resumo'],
                    $value['caracteristicas'],
                   $value['capa'],
                     $value['livro']);
            array_push($this->livros, $livro);

            }      
    }
}


    public function getMaximoId(){
    $sql = "select MAX(id) FROM livros";
    $resultado = $this->con->query($sql);

            foreach ($resultado as $value) {
                //verifica produto idependente de maiusculas e minusculas
                $temp = $value['MAX(id)'];
            }
       return $temp;

    }
    
    //seleciona todos os albuns retirando repeticoes        
    public function consultarNomeTodosLivros(){
        $this->livros = Array();
        $sql = "SELECT DISTINCT nome FROM livros ";
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
                    $livro = $value['nome'];
            array_push($this->livros, $livro); 
            }      
    }
    


}
}
?>

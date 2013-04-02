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
class LinksDAO {
    
    public $links;
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
    public function adicionarLink($objLink,$status){

       if($status == 0){
           
            $sql = "INSERT INTO links(id,
                link,
                descricao)
                VALUES(:id,
                :link,
                :descricao)";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':id',utf8_decode($objLink->id));
            $stmt->bindValue(':link',utf8_decode($objLink->link));
            $stmt->bindValue(':descricao',utf8_decode($objLink->descricao));
            $stmt->execute();
            if($stmt->rowCount()>0){
                $this->message = "Dados inserido com sucesso.";
            }
       }else{
               $this->message = "link já cadastrado(a).";
       }
    }   
    
    //deleta item
    public function deletarLink($idLink){       
       
        $sql = "DELETE FROM links WHERE id=:id" ;
        $stmt = $this->con->prepare($sql);
        
        $stmt->bindValue(':id', $idLink);
        $stmt->execute();
        
        if($stmt->rowCount()>0){            
            $this->message = "Dados excluidos com sucesso.";
        }else{
            $this->message = "Dados não foram encontrados ou não podem ser excluidos."; 
        }
        
    }
   
    //consultar item
    public function consultarLinkPorLink($nomeLink){
        
        //selsciona todos os itens da tabela ou um especifico
        $this->links = Array();
        $sql = "SELECT * FROM links";

        $resultado = $this->con->query($sql);  
        if(count($resultado)>0){
            foreach ($resultado as $value) {
                if(strcasecmp($value['link'], utf8_decode($nomeLink))== 0){                
                    
                    $link = new Link($value['id'],
                            $value['link'],
                            $value['descricao']);
                    
                    array_push($this->links, $link);
               
                }
            } 
            $this->message = "Foram encontados ".$resultado->rowCount()." link(s)."; 
        }else{
            $this->message = "A consulta não encontrou nenhum link"; 
        }
        //carrega array de nome e descrição 
      
    }
  
        public function consultarLinkPorId($id){
        
        //selsciona todos os itens da tabela ou um especifico
        $this->links =  Array();
        $sql = "SELECT * FROM links WHERE id =".$id." ORDER BY id";
         
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
             $link = new Link($value['id'],
                    $value['link'],
                    $value['descricao']);
            array_push($this->links, $link);

            } 
            $this->message = "Foram encontados ".$resultado->rowCount()." link(s)."; 
        }else{
            $this->message = "A consulta não encontrou nenhum link"; 
        }
        //carrega array de nome e descrição 
        
    }
        
    public function consultarTodasLinks(){
        $this->links = Array();
        $sql = "SELECT * FROM links";
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
             $links = new Link($value['id'],
                    $value['link'],
                    $value['descricao']);
            array_push($this->links, $links);

            }      
    }
}

    public function getMaximoId(){
    $sql = "select MAX(id) FROM links";
    $resultado = $this->con->query($sql);

            foreach ($resultado as $value) {
                //verifica produto idependente de maiusculas e minusculas
                $temp = $value['MAX(id)'];
            }
       return $temp;

    }
    
    //seleciona todos os albuns retirando repeticoes        
    public function consultarNomeTodosLinks(){
        $this->links = Array();
        $sql = "SELECT DISTINCT link FROM links ";
        $resultado = $this->con->query($sql);
        
        if($resultado->rowCount()>0){
            foreach ($resultado as $value) {
                    $link = $value['link'];
            array_push($this->links, $link); 
            }      
    }
    


}
}
?>

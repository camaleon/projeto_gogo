<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function __autoload($classe){

        require_once'../modelo/'.$classe.'.php';

}

class ControladorAdmin{
    public $pagina;
    private $dadosBanco;
    private $servidorBase;
    private $bancoBase;
    private $usuarioBase;
    private $senhaBase;
    private $ftpHost;
    private $ftpLogin;
    private $ftpSenha;
    public $resultadoConsulta = "";
    public $resultadoConsulta1 = "";
    public $resultadoConsulta2 = "";
    public $resultadoConsulta3 = "";
    public $resultadoConsulta4 = "";
    public $resultadoConsulta5 = "";


    function __construct($pagina) {
    //iconv_set_encoding("input_encoding", "UTF-8");
    //iconv_set_encoding("output_encoding", "UTF-8");
    //iconv_set_encoding("internal_encoding", "UTF-8");
    //var_dump(iconv_get_encoding('all'));    
    $this->dadosBanco = parse_ini_file("config.ini",true);
    
    if($this->dadosBanco['modo']['modo'] == "prod"){
        $this->servidorBase = $this->dadosBanco['prod']['servidor'];
        $this->bancoBase = $this->dadosBanco['prod']['banco'];
        $this->usuarioBase = $this->dadosBanco['prod']['login'];
        $this->senhaBase = $this->dadosBanco['prod']['senha'];    
    }
    
    if($this->dadosBanco['modo']['modo'] == "oper"){
        $this->servidorBase = $this->dadosBanco['oper']['servidor'];
        $this->bancoBase = $this->dadosBanco['oper']['banco'];
        $this->usuarioBase = $this->dadosBanco['oper']['login'];
        $this->senhaBase = $this->dadosBanco['oper']['senha'];
        //informacoes ftp
        $this->ftpHost = $this->dadosBanco['ftp']['host'];
        $this->ftpLogin = $this->dadosBanco['ftp']['login'];
        $this->ftpSenha = $this->dadosBanco['ftp']['senha'];
    }
    
    $this->carregaPagina($pagina);

}
    
function carregaPagina($valorPagina){
//carrega paginas na index
switch ($valorPagina) {
    case 29:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $pagina = "admin_menuSistemas";
    break;
    //logar em sistema virtual
    case 30:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $pagina = "admin_menuSistemaCd";   
    break;
    case 31:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $pagina = "admin_sistemaCdAdicionarAlbum";
    break;
    //trata formulario cadastrar cd
    case 32:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        ini_set('max_execution_time', 0);
        $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase); 
            
        if(!empty($_POST)){
            $tempDir = "albuns/".$_POST['titulo'];
            if(file_exists($tempDir)){                
            }else{
                $tempDir = "albuns/".$_POST['titulo'];
                mkdir($tempDir);
          
            }
            if(!empty($_FILES)){
                $conecFtp = new ConexaoFtp($this->ftpHost,
                        $this->ftpLogin,
                        $this->ftpSenha);
                $conecFtp->conectar(); 
                $caminhoFTP = "www/visao/albuns/".$_POST['titulo'];

                //envia imagen de capa
                $tempSplit = explode(".", $_FILES['imagem']['name']);
                $nomeCapa = "capa.".$tempSplit[1];
                $upload = new UploadFTP($conecFtp->conecFTP,
                        $_FILES['imagem'],
                        $nomeCapa,$caminhoFTP);
               //conta numero de musicas para fazer upload
               $numeroMusicas = count($_FILES)-1;
               $tempCountFaixa = 1;
           
    
               $tempRedim = "albuns/".$_POST['titulo']."/".$nomeCapa;
               $redim = new m2brimagem($tempRedim);
               $valida = $redim->valida();
               if ($valida == 'OK') {
                    $redim->redimensiona(150,140,'');
                    $redim->grava($tempRedim);
                } 
               
               
               //verifica se album existe
              $musicaDao = new MusicasDAO($con->conec);
              $musicaDao->consultarAlbumPorTitulo($_POST['titulo']);
              
              if(count($musicaDao->cds)>0){
                  $tempResult = 1;
                  }else{
                  $tempResult = 0;
              }
    
               //fazendo upload das faixas
               for ($index = 0; $index < $numeroMusicas; $index++) {
                   $tempNome = "musica".$index;
     
                   $caminhoFTP = "www/visao/albuns/".$_POST['titulo'];
                   $upload1 = new UploadFTP($conecFtp->conecFTP,
                        $_FILES[$tempNome],
                        $_FILES[$tempNome]['name'],$caminhoFTP);
                   
                   $musica= new Musicas("",
                           $_POST['titulo'],
                           $tempCountFaixa,
                           $_FILES[$tempNome]['name']);
                           
                   //adiciona referencia ao banco de dados
                   $musicaDao->adicionarAlbum($musica,$tempResult );
         
                 $tempCountFaixa =$tempCountFaixa + 1;          
               }
               //converte album para zip
               //instancia classe zip
               //iconv_set_encoding("output_encoding", "UTF-8");
               //iconv_set_encoding("internal_encoding", "UTF-8");
               //$zip = new PclZip("albuns/".$_POST['titulo'].".zip");
               //$zip = new ZipArchive();
               //if ( $zip->open( "albuns/".$_POST['titulo'].".zip", ZIPARCHIVE::CREATE|ZipArchive::OVERWRITE ) ) {
               //     foreach( glob( "albuns/".$_POST['titulo']."/*.*" ) as $current){
                        
                        //$zip->addFile($current,iconv("UTF-8","CP852",basename( $current )));
                        //$zip->add("albuns/".$_POST['titulo']."/");
                        //echo iconv_get_encoding("internal_encoding")."<br>";
                        //echo iconv_get_encoding("output_encoding")."<br>";
                         //$zip->addFile($current,  utf8_encode(basename( $current )));
     
                    //}
             
                    
                    //}  
                            
            }
        }
         //iconv_set_encoding("output_encoding", "ISO-8859-1");
         //iconv_set_encoding("internal_encoding","ISO-8859-1");
         //$conecFtp->desconectar();
         ini_set('max_execution_time', 30);
         $pagina = "admin_menuSistemas";   
    break;
    //entra para adicionar musia a album
    case 33:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase);
        $musicaDao = new MusicasDAO($con->conec);
        $musicaDao->consultarNomeTodosAlbuns();
        $this->resultadoConsulta='<option value="selecionar">Selecionar</option>';
        foreach ($musicaDao->cds as $value) {
            $this->resultadoConsulta.='<option value="'.$value.'">'.$value.'</option>';
        }
        $pagina = "admin_sistemaCdAdicionarMusica";
    break;
    //envia arquivo ao adicionando musica a album
    case 34:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase);
        
        $conecFtp = new ConexaoFtp($this->ftpHost,
                        $this->ftpLogin,
                        $this->ftpSenha);
        $conecFtp->conectar();
        $musicaDao = new MusicasDAO($con->conec);
        
        if($_POST["album"]!="selecionar"){
            $musicaDao->consultarAlbumPorTitulo($_POST["album"]);
            //verifica numero da ultima faixa
            $numFaixa = count($musicaDao->cds)+1;
            //se existeir arquivo faz upload
            if(!empty($_FILES)){
                $caminhoFTP = "www/visao/albuns/".$_POST['album'];               
               $upload = new UploadFTP($conecFtp->conecFTP,
                       $_FILES['file'],
                       utf8_decode($_FILES['file']['name']),$caminhoFTP);
               //cadastra no banco
               if($upload->statusTransferir){
                    $musica = new Musicas("",
                            $_POST["album"], 
                            $numFaixa, 
                            $_FILES['file']['name']);
                    $musicaDao->adicionarAlbum($musica,0);
                         
               }
               //if(file_exists('albuns/'.$_POST["album"].'zip')){
               //    unlink('albuns/'.$_POST["album"].'zip');
               //}
               
                          
              //$zip = new ZipArchive();
              //if ( $zip->open( "albuns/".$_POST["album"].".zip", ZipArchive::OVERWRITE ) ) {
              //     foreach( glob( "albuns/".$_POST["album"]."/".'*.*' ) as $current){
              //          $zip->addFile($current, basename( $current ));                   
              //      }
              //$zip->close();
                    
                    //}  
               
            }
  }
        $pagina = "admin_menuSistemas";
    break;
    //entra formulario excluir album
    case 37:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
            $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase);
        $musicaDao = new MusicasDAO($con->conec);
        $musicaDao->consultarNomeTodosAlbuns();
        $this->resultadoConsulta='<option value="selecionar">Selecionar</option>';
        foreach ($musicaDao->cds as $value) {
            $this->resultadoConsulta.='<option value="'.utf8_encode($value).'">'.utf8_encode($value).'</option>';
        }
        $pagina = "admin_sistemaCdExcluirAlbum";   
    break;
    //processa formuario excluir album
    case 38:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase);
        $musicaDao = new MusicasDAO($con->conec);
        //acha todas as musicas do albun;
        $musicaDao->consultarAlbumPorTitulo($_POST['album']);
        //deletando musicas do album
        foreach( glob( "albuns/".$_POST['album']."/".'*.*' ) as $current){
                    //deleta o conteudo do album
                    unlink($current);                 
                }
        //deletando o album
        rmdir("albuns/".$_POST['album']);
      

        //deletando musicas do banco de dados
        foreach ($musicaDao->cds as $value) {
            $musicaDao->deletarAlbum($value->id);

        }
       
        
        $pagina = "admin_sistemaCdExcluirAlbum";

    break;
    //sistema Video
    case 39:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $pagina = "admin_menuSistemaVideos";    
    break;
    //cadastrar video
    case 40:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $pagina = "admin_sistemaVideosAdicionar";    
    break;
    //tarta cadastrar video
    case 41:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
            $this->bancoBase,
            $this->usuarioBase,
            $this->senhaBase);
    //cria objeto video    
    $video = new Video("",
            $_POST["titulo"],
            $_POST["descricao"],
            $_POST["link"]);
            
    $videoDao = new VideoDAO($con->conec);
    $videoDao->consultarVideoPorTitulo($_POST['titulo']);
    //adicina video
    if(count($videoDao->videos)==0){
        $videoDao->adicionarVideo($video,0);
    }
    
    $pagina = "admin_menuSistemaVideos";    
    break;
    case 42:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $this->resultadoConsulta = "";
    $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
    $videoDao = new VideoDAO($con->conec);
    $videoDao->consultarNomeTodosVideos();
    foreach ($videoDao->videos as $value) {
        $this->resultadoConsulta .="<option value='".utf8_encode($value)."' >".utf8_encode($value)."</option>";
    }
    $pagina = "admin_sistemaVideoExcluirVideo";    
    break;
    case 43:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
    $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
    $videoDao = new VideoDAO($con->conec);
    $videoDao->consultarVideoPorTitulo($_POST['video']);
    $videoDao->deletarVideo($videoDao->videos[0]->id);
    $pagina = "admin_menuSistemaVideos";    
    break;  
    case 44:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);

        $videoDao = new VideoDAO($con->conec);
        $videoDao->consultarTodasVideos();
        $this->resultadoConsulta1 = '  <table width="100%%">
                                           <tr>
                                           <td align="center" valign="middle">Titulo</td>
                                           <td align="center" valign="middle">Descrição</td>
                                           <td align="center" valign="middle">Link</td>
                                           </tr>
                                           ';

        foreach ($videoDao->videos as $value) {
            $this->resultadoConsulta1 .= ' <tr>
                                           <td align="center" valign="middle">'.$value->titulo.'</td>
                                           <td align="center" valign="middle">'.$value->descricao.'</td>
                                           <td align="center" valign="middle">'.$value->link.'</td>
                                           </tr>
                                           ';

        }
        $this->resultadoConsulta1 .="</table>";
    $pagina ="admin_sistemaVideoListarTodos";
    break;
    //inicia sistema livros
    //admin_menuSistemaLivros
    case 45:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $pagina ="admin_menuSistemaLivros";
    break;
    //entra formulario adcionar livro
    case 46:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $pagina ="admin_sistemaLivroAdicionar";
    break;
    //processa adicionar livro
    case 47:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
       $conecFtp = new ConexaoFtp($this->ftpHost,
        $this->ftpLogin,
        $this->ftpSenha);
        $conecFtp->conectar();
        
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        
        $caminhoFTP = "www/visao/livros/";
        
        $uploadCapa = new UploadFTP($conecFtp->conecFTP,
                $_FILES['capa'],
                utf8_decode($_FILES["capa"]["tmp"]), 
                $caminhoFTP);
        

        
        $uploadLivro = new UploadFTP($conecFtp->conecFTP,
                $_FILES['livro'],
                utf8_decode($_FILES["livro"]["tmp"]), 
                $caminhoFTP);
        
           //pega nome do arquivo da capa     
           $tempoNomeCapa = $_FILES["capa"]["tmp_name"];
           $tempoNomeCapa = explode("/",$tempoNomeCapa);
           $tempoNomeCapa =$tempoNomeCapa[count($tempoNomeCapa)-1];
           
           $extensaoTemp = explode(".",$_FILES["capa"]["name"]);
           $extensaoTemp = $extensaoTemp[count($extensaoTemp)-1];
           $nomeCapaLivro = $tempoNomeCapa.".".$extensaoTemp;
          //fim pega nome capa  
           
            //pega nome do arquivo da livro     
           $tempoNomeLivro = $_FILES["livro"]["tmp_name"];
           $tempoNomeLivro = explode("/",$tempoNomeLivro);
           $tempoNomeLivro =$tempoNomeLivro[count($tempoNomeLivro)-1];
           
           $extensaoTemp1 = explode(".",$_FILES["livro"]["name"]);
           $extensaoTemp1 = $extensaoTemp1[count($extensaoTemp1)-1];
           $nomeLivro = $tempoNomeLivro.".".$extensaoTemp1;
          //fim pega nome livro
           
           
        //redimensona capa do livro
        $tempRedim = "livros/".$nomeCapaLivro;
        $redim = new m2brimagem($tempRedim);
        $valida = $redim->valida();
        if ($valida == 'OK') {
            $redim->redimensiona(200,300,'');
            $redim->grava($tempRedim);
        } 
      
                
        if($uploadCapa->statusTransferir && $uploadLivro->statusTransferir){
            
            //trata nome para usar nome temp        
            $livro = new Livro("",
                    $_POST["nome"],
                    $_POST["resumo"],
                    $_POST["caract"],
                    $nomeCapaLivro,
                    $nomeLivro );
           $livosDao = new LivrosDAO($con->conec);
           
           $livosDao->consultarLivroPorTitulo(utf8_encode($_POST['nome']));
           if(count($livosDao->livros)==0){               
               $tempAdd = 0;
           }else{
               $tempAdd = 1;
           }

           $livosDao->adicionarLivro($livro,$tempAdd);
        }
        
        $conecFtp->desconectar();
        $pagina ="admin_menuSistemaLivros";
    break;
    //entra em excluir livros
    case 48:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        $livrosDao = new LivrosDAO($con->conec);
        $livrosDao->consultarNomeTodosLivros();
        $this->resultadoConsulta = "";
        foreach ($livrosDao->livros as $value) {
            $this->resultadoConsulta.="<option value'".utf8_encode($value)."'>".utf8_encode($value)."</option>";
        }
        $pagina ="admin_sistemaLivroExcluirLivro";
    break;
    case 49:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        $livroDao = new LivrosDAO($con->conec);
        $livroDao->consultarLivroPorTitulo($_POST['livro']);
        $livroDao->deletarLivro($livroDao->livros[0]->id);
        $capa = "livros/".$livroDao->livros[0]->capa;
        unlink($capa);
        $livro = "livros/".$livroDao->livros[0]->livro;
        unlink($livro);
        $pagina = "admin_menuSistemaLivros";  
    break;
    case 50:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);

        $livroDao = new LivrosDAO($con->conec);
        $livroDao->consultarTodasLivros();
        $this->resultadoConsulta1 = '  <table width="100%%">
                                           <tr>
                                           <td align="center" valign="middle">Nome</td>
                                           <td align="center" valign="middle">Resumo</td>
                                           <td align="center" valign="middle">Caracteristicas</td>
                                           <td align="center" valign="middle">Capa</td>
                                           <td align="center" valign="middle">Livro</td>
                                           </tr>
                                           ';

        foreach ($livroDao->livros as $value) {
            $this->resultadoConsulta1 .= ' <tr>
                                           <td align="center" valign="middle">'.$value->nome .'</td>
                                           <td align="center" valign="middle">'.$value->resumo.'</td>
                                           <td align="center" valign="middle">'.$value->caracteristicas.'</td>
                                           <td align="center" valign="middle">'.$value->capa.'</td>
                                           <td align="center" valign="middle">'.$value->livro.'</td>
                                           </tr>
                                           ';

        }
        $this->resultadoConsulta1 .="</table>";
        $pagina ="admin_sistemaLivrosListarTodos";
    break;
    //menu sistemas links
    case 51:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $pagina = "admin_menuSistemaLinks";
    break ;
    //entra em adicionar link
    case 52:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $pagina ="admin_sistemaLinkAdicionar";
    break ;
    //processa adicionar link    
    case 53:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        $link = new Link("",
                $_POST['link'],
                $_POST['descricao']);
        $linkDao = new LinksDAO($con->conec);
        $linkDao->consultarLinkPorLink($_POST['link']);
        if(count($linkDao->links)==0){
            $tempAdd = 0;
        }else{
            $tempAdd = 1;
        }
        $linkDao->adicionarLink($link, $tempAdd);
        $pagina = "admin_menuSistemaLinks";
    break ;
    //entra em excluir item   
    case 54:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        $livrosDao = new LinksDAO($con->conec);
        $livrosDao->consultarNomeTodosLinks();
        $this->resultadoConsulta = "";
        foreach ($livrosDao->links as $value) {
            $this->resultadoConsulta.="<option value'".$value."'>".$value."</option>";
        }
        $pagina = "admin_sistemaLinkExcluirLink";
    break ;
    //processa ecluir item    
    case 55:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        $linksDao = new LinksDAO($con->conec);
        $linksDao->consultarLinkPorLink($_POST['link']);
        $linksDao->deletarLink($linksDao->links[0]->id);  
        $pagina = "admin_menuSistemaLinks";
    break ;
    //lista todos os itens    
    case 56:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);

        $linkDao = new LinksDAO($con->conec);
        $linkDao->consultarTodasLinks();
        $this->resultadoConsulta1 = '  <table width="100%%">
                                           <tr>
                                           <td align="center" valign="middle">Link</td>
                                           <td align="center" valign="middle">Descrição</td>
                                           </tr>
                                           ';

        foreach ($linkDao->links as $value) {
            $this->resultadoConsulta1 .= ' <tr>
                                           <td align="center" valign="middle">'.$value->link .'</td>
                                           <td align="center" valign="middle">'.$value->descricao.'</td>
                                           </tr>
                                           ';

        }
        $this->resultadoConsulta1 .="</table>";
        $pagina = "admin_sistemaLinksListarTodos";
    break ;
    //entrada sistema de artigos
    case 57:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $pagina = "admin_menuSistemaArtigos";
    break;
    //entrada adionar artigo
    case 58:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $pagina = "admin_sistemaArtigoAdicionar";
    break;
    //processa adicionar artigo
    case 59:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        
       $artigo = new Artigo("",
               $_POST['titulo'],
               $_POST['conteudo'],
               $_POST['link'],
               time());
        $artigoDao = new ArtigoDAO($con->conec);
        $artigoDao->consultarArtigoPorTitulo($_POST['titulo']);
        if(count($artigoDao->artigos)==0){
            $tempAdd = 0;
        }else{
            $tempAdd = 1;
        }
        $artigoDao->adicionarArtigo($artigo, $tempAdd);
        $pagina = "admin_menuSistemaArtigos";
    break;
    //entrada editar artigo
    case 60:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $this->resultadoConsulta = "";
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        
        $artigoDao = new ArtigoDAO($con->conec);
        $artigoDao->consultarNomeTodosArtigos();
        foreach ($artigoDao->artigos as $value) {
                $this->resultadoConsulta .="<option value='".utf8_encode($value)."' >".utf8_encode($value)."</option>";
        }
        $pagina = "admin_sistemaArtigoAlterar1";
    break;
    //formulario de edição
    case 61:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        $artigoDao = new ArtigoDAO($con->conec);
        $artigoDao->consultarArtigoPorTitulo($_POST['titulo']);
        $this->resultadoConsulta = $artigoDao->artigos[0];
        $pagina = "admin_sistemaArtigoAlterar2";
    break;
    //processa editar artigo
    case 62:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        
        
        
        $artigoDao = new ArtigoDAO($con->conec);
        $artigo = new Artigo("",
                $_POST['titulo'],
                $_POST['conteudo'],
                $_POST['link'],
                time());
        $artigoDao->alterarArtigo($_POST['id'],$artigo);
        
        $pagina = "admin_menuSistemaArtigos";
    break;
    //entra deletar artigo
    case 63:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        $artigoDao = new ArtigoDAO($con->conec);
        $artigoDao->consultarNomeTodosArtigos();
        $this->resultadoConsulta = "";
        foreach ($artigoDao->artigos as $value) {
            $this->resultadoConsulta.="<option value'".utf8_encode($value)."'>".utf8_encode($value)."</option>";
        }
        $pagina="admin_sistemaArtigoExcluirArtigo";
    break;
    // processsa deletar artigo
    case 64:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);
        $artigoDao = new ArtigoDAO($con->conec);
        $artigoDao->consultarArtigoPorTitulo($_POST['titulo']);
        $artigoDao->deletarArtigo($artigoDao->artigos[0]->id); 
        $pagina = "admin_menuSistemaArtigos";
    break;
    //listar todos artigos
    case 65:
        //$verifica = new VerificaNivelAcesso("index.php?pagina=0");
        $con = new Conexcao($this->servidorBase,
        $this->bancoBase,
        $this->usuarioBase,
        $this->senhaBase);

        $artigoDao = new ArtigoDAO($con->conec);
        $artigoDao->consultarTodosArtigos();
        $this->resultadoConsulta1 = '  <table width="100%%">
                                           <tr>
                                           <td align="center" valign="middle">Tutulo</td>
                                           <td align="center" valign="middle">Conteudo</td>
                                           <td align="center" valign="middle">Link</td>
                                           </tr>
                                           ';

        foreach ($artigoDao->artigos as $value) {
            $this->resultadoConsulta1 .= ' <tr>
                                           <td align="center" valign="middle">'.$value->titulo .'</td>
                                           <td align="center" valign="middle">'.$value->conteudo.'</td>
                                           <td align="center" valign="middle">'.$value->link.'</td>
                                           </tr>
                                           ';

        }
        $this->resultadoConsulta1 .="</table>";
        $pagina = "admin_sistemaArtigosListarTodos";
    break;
   
}
$this->pagina = $pagina;

}

}
?>

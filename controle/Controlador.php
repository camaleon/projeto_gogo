<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function __autoload($classe){

        require_once'../modelo/'.$classe.'.php';

}

class Controlador{
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
    case 0:
        $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase); 
        $livroDao = new LivrosDAO($con->conec);
        $livroDao->consultarNomeTodosLivros();
        //conta numerod e livros
        $this->resultadoConsulta = count($livroDao->livros);
        $artigoDao = new ArtigoDAO($con->conec);
        //conta numero de artigos
        $artigoDao->consultarNomeTodosArtigos();
        $this->resultadoConsulta1 = count($artigoDao->artigos);
        
        $musicaDao = new MusicasDAO($con->conec);
        $this->resultadoConsulta2 = $musicaDao->getNumeroMusicas();
         
        //pegando ultimos tres artigos
        $videosDao = new VideoDAO($con->conec);
        $videosDao->consultarTodasVideos();
        $this->resultadoConsulta3 = $videosDao->videos;
        
        $linksDao =  new LinksDAO($con->conec);
        $linksDao->consultarTodasLinks();
        $this->resultadoConsulta4 = $linksDao->links;
        
        $artigoDao->consultarTodosArtigos();
        $this->resultadoConsulta5 = $artigoDao->artigos;     
          $pagina = "principal"; 
    break;
    case 1:
                $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase); 
        $livroDao = new LivrosDAO($con->conec);
        $livroDao->consultarNomeTodosLivros();
        //conta numerod e livros
        $this->resultadoConsulta = count($livroDao->livros);
        $artigoDao = new ArtigoDAO($con->conec);
        //conta numero de artigos
        $artigoDao->consultarNomeTodosArtigos();
        $this->resultadoConsulta1 = count($artigoDao->artigos);
        
        $musicaDao = new MusicasDAO($con->conec);
        $this->resultadoConsulta2 = $musicaDao->getNumeroMusicas();
        
        //pegando ultimos tres artigos
        $videosDao = new VideoDAO($con->conec);
        $videosDao->consultarTodasVideos();
        $this->resultadoConsulta3 = $videosDao->videos;
        
        $linksDao =  new LinksDAO($con->conec);
        $linksDao->consultarTodasLinks();
        $this->resultadoConsulta4 = $linksDao->links;
          
        $pagina = "quem_sou";
    break;
    case 2:
                $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase); 
        $livroDao = new LivrosDAO($con->conec);
        $livroDao->consultarNomeTodosLivros();
        //conta numerod e livros
        $this->resultadoConsulta = count($livroDao->livros);
        $artigoDao = new ArtigoDAO($con->conec);
        //conta numero de artigos
        $artigoDao->consultarNomeTodosArtigos();
        $this->resultadoConsulta1 = count($artigoDao->artigos);
        
        $musicaDao = new MusicasDAO($con->conec);
        $this->resultadoConsulta2 = $musicaDao->getNumeroMusicas();
        
        //pegando ultimos tres artigos
        $videosDao = new VideoDAO($con->conec);
        $videosDao->consultarTodasVideos();
        $this->resultadoConsulta3 = $videosDao->videos;
        
        $linksDao =  new LinksDAO($con->conec);
        $linksDao->consultarTodasLinks();
        $this->resultadoConsulta4 = $linksDao->links;

        // saida pagina livros
        $livroDao->consultarTodasLivros();
        $this->resultadoConsulta5 = "";        
        $this->resultadoConsulta5 .= '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%" >
                                     <thead>
                                     <tr>
                                     <th>Livro</th>
                                     </tr>
                                    </thead>
                                    <tbody>';
        foreach ($livroDao->livros as $value) {
            $this->resultadoConsulta5 .= '<tr >
                                          <td align="center">            
                                            <table width="100%">
                                            <tr>
                                            <td><img src="livros/'.utf8_encode($value->capa).'"></td>
                                            <td valign=top><b>'.utf8_encode($value->nome).'</b><br>
                                            <br>'.utf8_encode($value->resumo).'
                                            <br>'.utf8_encode($value->caracteristicas).'<br>
                                            <br><a href="#'.utf8_encode($value->livro).'">Baixar</a><br><br><br></td>
                                            </tr>
                                            </table></td>
                                          </tr>';

        }

       $this->resultadoConsulta5 .='</tbody>
                                    </table>';
       
       
        $pagina = "livros";
    break;
    case 3:
                $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase); 
        $livroDao = new LivrosDAO($con->conec);
        $livroDao->consultarNomeTodosLivros();
        //conta numerod e livros
        $this->resultadoConsulta = count($livroDao->livros);
        $artigoDao = new ArtigoDAO($con->conec);
        //conta numero de artigos
        $artigoDao->consultarNomeTodosArtigos();
        $this->resultadoConsulta1 = count($artigoDao->artigos);
        
        $musicaDao = new MusicasDAO($con->conec);
        $this->resultadoConsulta2 = $musicaDao->getNumeroMusicas();
        
        //pegando ultimos tres artigos
        $videosDao = new VideoDAO($con->conec);
        $videosDao->consultarTodasVideos();
        $this->resultadoConsulta3 = $videosDao->videos;
        
        $linksDao =  new LinksDAO($con->conec);
        $linksDao->consultarTodasLinks();
        $this->resultadoConsulta4 = $linksDao->links;
        
        $artigoDao->consultarTodosArtigos();
        $this->resultadoConsulta5 = "";        
        $this->resultadoConsulta5 .= '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%" >
                                     <thead>
                                     <tr>
                                     <th>Artigo</th>
                                     </tr>
                                    </thead>
                                    <tbody>';
        foreach ($artigoDao->artigos as $value) {
            $this->resultadoConsulta5 .= '<tr >
                                          <td align="left"><b>'.utf8_encode($value->titulo)."</b> - ".date("d/m/Y",$value->data)."<br><br>".utf8_encode($value->conteudo).'<br><br></td>    
                                          </tr>';
        }

       $this->resultadoConsulta5 .='</tbody>
                                    </table>';
        $pagina = "artigos";
    break;
    case 4:
                $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase); 
        $livroDao = new LivrosDAO($con->conec);
        $livroDao->consultarNomeTodosLivros();
        //conta numerod e livros
        $this->resultadoConsulta = count($livroDao->livros);
        $artigoDao = new ArtigoDAO($con->conec);
        //conta numero de artigos
        $artigoDao->consultarNomeTodosArtigos();
        $this->resultadoConsulta1 = count($artigoDao->artigos);
        
        $musicaDao = new MusicasDAO($con->conec);
        $musicaDao->consultarNomeTodosAlbuns();
        $albuns = $musicaDao->cds;
        $this->resultadoConsulta2 = $musicaDao->getNumeroMusicas();
        

        
        //pegando ultimos tres artigos
        $videosDao = new VideoDAO($con->conec);
        $videosDao->consultarTodasVideos();
        $this->resultadoConsulta3 = $videosDao->videos;
        
        $linksDao =  new LinksDAO($con->conec);
        $linksDao->consultarTodasLinks();
        $this->resultadoConsulta4 = $linksDao->links;
        
        $this->resultadoConsulta5 = "";        
        $this->resultadoConsulta5 .= '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%" >
                                     <thead>
                                     <tr>
                                     <th>Albuns</th>
                                     </tr>
                                    </thead>
                                    <tbody>';
        
        foreach ($albuns as $value1) {
            $musicaDao->consultarAlbumPorTitulo(utf8_encode($value1));
                        //verifica extensao da capa
            $ePng = file_exists("albuns/".utf8_encode($value1)."/capa.png");
            $eJpg = file_exists("albuns/".utf8_encode($value1)."/capa.jpg");
            $eJpeg = file_exists("albuns/".utf8_encode($value1)."/capa.jpeg");
            $eGif = file_exists("albuns/".utf8_encode($value1)."/capa.gif");
            
            if($ePng){
                $ext = ".png";
            }
            
            if($eJpg){
                $ext = ".jpg";
            }
            
            if($eJpeg){
                $ext = ".jpeg";
            }
            
            if($eGif){
                $ext = ".gif";
            }
            $this->resultadoConsulta5 .= '<tr >
                     <td align="center">            
                        <table width="100%">
                        <tr>
                        <td width="250px"><img src="albuns/'.utf8_encode($value1)."/capa".$ext.'" class="borda_branca_pura"></td>
                        <td valign=top align="left" width="600px"><b>'."Album : ".utf8_encode($value1).'</b> <br>';
                                
         foreach ($musicaDao->cds as $value) {

            $this->resultadoConsulta5 .= '
                                            <br>'."Faixa : ".utf8_encode($value->faixa).'
                                            '." -  ".utf8_encode($value->nomeMusica).'
                                            <br>
                                            <embed width="200" height="20" type="application/x-shockwave-flash" src="lib/jquery_flash/singlemp3player.swf" pluginspage="http://www.adobe.com/go/getflashplayer" flashvars="file=albuns/'.utf8_encode($value->tituloAlbum).'/'.utf8_encode($value->nomeMusica).'"/>
                                            <a href="index.php?pagina=10&arquivo=albuns/'.utf8_encode($value->tituloAlbum).'/'.utf8_encode($value->nomeMusica).'" class="musica_baixar">Baixar</a><br>
                                            ';
                                            //echo mb_detect_encoding($value->tituloAlbum.'x', 'UTF-8, ISO-8859-1')." ";
                                            //$str = mb_convert_encoding($value->tituloAlbum, "ISO-8859-1", "UTF-8, ISO-8859-1");
                                            //echo mb_detect_encoding($str.'x', 'UTF-8, ISO-8859-1')." "; 
                                            //echo iconv("UTF-8","ISO-8859-1",$value->tituloAlbum);
        }
            
            
            
            
            $this->resultadoConsulta5 .= '<br><br></td>
                                            </tr>
                                            </table></td>
                                          </tr>';
  
        }


        

       $this->resultadoConsulta5 .='</tbody>
                                    </table>';
        
         $pagina = "musicas";
    break;
    case 5:
                $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase); 
        $livroDao = new LivrosDAO($con->conec);
        $livroDao->consultarNomeTodosLivros();
        //conta numerod e livros
        $this->resultadoConsulta = count($livroDao->livros);
        $artigoDao = new ArtigoDAO($con->conec);
        //conta numero de artigos
        $artigoDao->consultarNomeTodosArtigos();
        $this->resultadoConsulta1 = count($artigoDao->artigos);
        
        $musicaDao = new MusicasDAO($con->conec);
        $this->resultadoConsulta2 = $musicaDao->getNumeroMusicas();
        
        //pegando ultimos tres artigos
        $videosDao = new VideoDAO($con->conec);
        $videosDao->consultarTodasVideos();
        $this->resultadoConsulta3 = $videosDao->videos;
        
        $linksDao =  new LinksDAO($con->conec);
        $linksDao->consultarTodasLinks();
        $this->resultadoConsulta4 = $linksDao->links;
        
         $pagina = "contato";
    break;

    case 10:
           $arquivo = $_GET["arquivo"];
   
            if(isset($arquivo) && file_exists($arquivo)){ // faz o teste se a variavel não esta vazia e se o arquivo realmente existe
               switch(strtolower(substr(strrchr(basename($arquivo),"."),1))){ // verifica a extensão do arquivo para pegar o tipo
                  case "mp3": $tipo="audio/mpeg"; break;
               }
               header("Content-Type: ".$tipo); // informa o tipo do arquivo ao navegador
               header("Content-Length: ".filesize($arquivo)); // informa o tamanho do arquivo ao navegador
               header("Content-Disposition: attachment; filename=".basename($arquivo)); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
               readfile($arquivo); // lê o arquivo
               exit; // aborta pós-ações
               }
        
    break;
    case 20:
        $con = new Conexcao($this->servidorBase,
                $this->bancoBase,
                $this->usuarioBase,
                $this->senhaBase); 
            
        $login = new Login($_POST['login'],$_POST['senha'], $con);
        $login->logar();
        if ($login->status) {
            header("Location:indexAdmin.php");
        }else{
            $pagina = "principal";
        }
    break;
}
$this->pagina = $pagina;

}

}
?>

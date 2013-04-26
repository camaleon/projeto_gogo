<?php require_once '../controle/modulo.php';?>
<!DOCTYPE html!>
<html lang="pt-br">
<header>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" charset="UTF-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" charset="UTF-8" />

<script src="lib/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="lib/cicle.js" type="text/javascript"></script>
 <script src="script/script.js" type="text/javascript"></script>
<script src="lib/media/js/jquery.js" type="text/javascript"></script>
<script src="lib/media/js/jquery.dataTables.js" type="text/javascript"></script>
<link rel="stylesheet" href="lib/media/css/demo_page.css" type="text/css" charset="UTF-8" />
<link rel="stylesheet" href="lib/media/css/demo_table.css" type="text/css" charset="UTF-8" />

<title>Gogó</title>
</head>

<body>
<div id="ceu"></div>

<div id="pagina">
	<div id="titulo">Roberto Malvezzi</div>

	<div id="violao"><img src="imagens/violao.png"></div>
	<div id="barco"><img id="barco_img" src="imagens/barco.png"></div>
	<div id="menu">
		<div class="home">Home</div>
		<div class="quem_sou">Quem sou</div>
		<div class="contato">Contato</div>
		<div class="livros"><img src="imagens/livros.png" width="12" class ="espaco_imagem">Livros</div>
		<div class="livros_saldo"><?php echo $consulta; ?></div>
		<div class="artigos"><img src="imagens/artigos.png" width="12" class ="espaco_imagem">Artigos</div>
		<div class="artigos_saldo"><?php echo $consulta1; ?></div>
		<div class="musicas"><img src="imagens/musicas.png" width="10" class ="espaco_imagem">Músicas</div>
		<div class="musicas_saldo"><?php echo $consulta2; ?></div>
	</div>
	<div id="foto_malvezzi"><img src="imagens/malvezzi.jpg" ></div>
	<div id="texto_malvezzi">
		Roberto Malvezzi é graduado em Estudos Sociais e em Filosofia pela Faculdade Salesiana de Filosofia Ciências e Letras de Lorena, em São Paulo. Também é graduado em Teologia pelo Instituto 
		Teológico de São Paulo. Atualmente atua na Comissão Pastoral da Terra – CPT. 
		Roberto Malvezzi é graduado em Estudos Sociais e em Filosofia pela Faculdade Salesiana de Filosofia Ciências e Letras de Lorena, em São Paulo. Também é graduado em Teologia pelo Instituto 
		Teológico de São Paulo. Atualmente atua na Comissão Pastoral da Terra... <a ref="#">ler mais</a>
	</div>
        	<div id="conteudo">
	<!-- aqui entra o php  -->
	<?php require_once $carregarPagina.'.php';?>
                <div id="footer"></div>
	</div>

	<div id="chamada_links">Links</div>
		<div id="links_acesso"><img src="imagens/open.png"></div>
		<div id="links_bloco">
		<div class="links">
		       <?php 
                       $temp4 = 0;
                       foreach ($consulta4 as $value) {
                           if($temp4 < 3){
                    ?>    
                <div class="links">
			 <hr><br>
                         <?php echo $value->link;?>
			<div class="origem_link"><?php echo $value->descricao;?></div>		
			
		</div>
                <?php }$temp4 = $temp4 + 1;}?>
                </div>    
			<!-- som -->
		<div id="chamada_videos">Vídeos</div>
		<div id="videos_acesso"><img src="imagens/open.png"></div>
		<div id="videos_bloco">
                 <?php 
                 $temp3 = 0;
                 foreach ($consulta3 as $value) {
                     if($temp3<3){
                     ?>
                    
		<div id="video"><?php echo $value->link;?></div>
                <?php }$temp3 = $temp3 +1;}?>
		</div>
		<!-- som-->
		<div id="chamada_som">Músicas</div>
		<div id="som_bloco">
		<div id="som"><div class="titulo_som">Meu sertão</div><audio src="teste.mp3" controls="true" autoplay="true" /></div>
		<div id="som"><div class="titulo_som">Rio verde</div><audio src="teste.mp3" controls="true" autoplay="true" /></div>
		<div id="som"><div class="titulo_som">O sol e o sertão</div><audio src="teste.mp3" controls="true" autoplay="true" /></div>
		
		
		</div>

		<!--div final link-->


	<!--div de conteudo-->
</div><!-- fim div pagina -->

</body>
</html>
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
		<div class="livros"><img src="imagens/livros.png" width="12">Livros</div>
		<div class="livros_saldo">04</div>
		<div class="artigos"><img src="imagens/artigos.png" width="12">Artigos</div>
		<div class="artigos_saldo">34</div>
		<div class="musicas"><img src="imagens/musicas.png" width="10">Músicas</div>
		<div class="musicas_saldo">24</div>
	</div>
	<div id="foto_malvezzi"><img src="imagens/malvezzi.jpg" ></div>
	<div id="texto_malvezzi">
		Roberto Malvezzi é graduado em Estudos Sociais e em Filosofia pela Faculdade Salesiana de Filosofia Ciências e Letras de Lorena, em São Paulo. Também é graduado em Teologia pelo Instituto 
		Teológico de São Paulo. Atualmente atua na Comissão Pastoral da Terra – CPT. 
		Roberto Malvezzi é graduado em Estudos Sociais e em Filosofia pela Faculdade Salesiana de Filosofia Ciências e Letras de Lorena, em São Paulo. Também é graduado em Teologia pelo Instituto 
		Teológico de São Paulo. Atualmente atua na Comissão Pastoral da Terra... <a ref="#">ler mais</a>
	</div>

	<div id="chamada_links">Links</div>
		<div id="links_acesso"><img src="imagens/open.png"></div>
		<div id="links_bloco">
		<div class="links">
			 <hr><br>
			http://www.mundojovem.com.br/datas-comemorativas/meio-ambiente/edicao-404-entrevista-um-grito-em-defesa-da-agua?dt=1
			<div class="origem_link">Mundo Jovem</div>		
			
		</div>


		<div class="links">
			 <hr><br>
			http://www.mundojovem.com.br/datas-comemorativas/meio-ambiente/edicao-404-entrevista-um-grito-em-defesa-da-agua?dt=1
			<div class="origem_link">Mundo Jovem</div>	
		</div>		

		<div class="links">
			 <hr><br>
			http://www.mundojovem.com.br/datas-comemorativas/meio-ambiente/edicao-404-entrevista-um-grito-em-defesa-da-agua?dt=1
			<div class="origem_link">Globo.com</div>	
			</div>

			<!-- som -->
		<div id="chamada_videos">Vídeos</div>
		<div id="videos_acesso"><img src="imagens/open.png"></div>
		<div id="videos_bloco">
		<div id="video"><iframe width="300" height="225" src="http://www.youtube.com/embed/eJ71zEO4XEE" frameborder="0" allowfullscreen></iframe></div>
		<div id="video"><iframe width="300" height="225" src="http://www.youtube.com/embed/8RxNKl5q1W8" frameborder="0" allowfullscreen></iframe></div>
		<div id="video"><iframe width="300" height="225" src="http://www.youtube.com/embed/t4DfJ7q9lz4" frameborder="0" allowfullscreen></iframe></div>
		</div>
		<!-- som-->
		<div id="chamada_som">Músicas</div>
		<div id="som_bloco">
		<div id="som"><div class="titulo_som">Meu sertão</div><audio src="mus.oga" controls="true" autoplay="true" /></div>
		<div id="som"><div class="titulo_som">Rio verde</div><audio src="mus.oga" controls="true" autoplay="true" /></div>
		<div id="som"><div class="titulo_som">O sol e o sertão</div><audio src="mus.oga" controls="true" autoplay="true" /></div>
		
		</div>

		</div><!--div final link-->


	<!--div de conteudo-->
	<div id="conteudo">
	<!-- aqui entra o php  -->
	<?php require_once $carregarPagina.'.php';?>
<div id="footer"></div>
	</div>

</div><!-- fim div pagina -->



		





</body>
</html>
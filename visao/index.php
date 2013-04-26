<?php require_once '../controle/modulo.php';?>
<!DOCTYPE html!>
<html lang="pt-br">
<header>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" charset="UTF-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" charset="UTF-8" />


<script src="lib/cicle.js" type="text/javascript"></script>
 <script src="script/script.js" type="text/javascript"></script>
<script src="lib/media/js/jquery.js" type="text/javascript"></script>
<script src="lib/jquery_flash/songs.js" type="text/javascript"></script>
<script src="lib/media/js/jquery.dataTables.js" type="text/javascript"></script>
<link rel="stylesheet" href="lib/media/css/demo_page.css" type="text/css" charset="UTF-8" />
<link rel="stylesheet" href="lib/media/css/demo_table.css" type="text/css" charset="UTF-8" />

<title>Roberto Malvezzi</title>
</head>

<body>

<div id="ceu"></div>
<div id="modal"></div>
<div id="box_formulario">
	<div class="fechar">X</div>
	<form align=left>

<b>Contato</b><br><br>

Para entrar em contato bastar usar o formulário abaixo.
<br><br>
 <form name="formulario" method="post" action="index.php?pagina=4" onSubmit="return enviardados();">
      <table width="340" border="0" cellspacing="3" cellpadding="0" align="left">
        <!--DWLayoutTable-->
        <tr bgcolor="#000000">
          <td valign="middle" nowrap bgcolor="#DCDCDC"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td valign="middle" nowrap bgcolor="#DCDCDC"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td bgcolor="#DCDCDC"><!--DWLayoutEmptyCell-->&nbsp;</td>
        </tr>
        <tr bgcolor="#DCDCDC">
          <td width="29" valign="middle" nowrap bgcolor="#DCDCDC"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="81" valign="middle" nowrap bgcolor="#DCDCDC"><font class="texto" >Nome:</font></td>
          <td width="391" bgcolor="#DCDCDC"><input class="form" type="text" name="nome" size="29"></td>
        </tr>
        <tr bgcolor="#DCDCDC">
          <td width="29" valign="middle" nowrap bgcolor="#DCDCDC"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="81" valign="middle" nowrap bgcolor="#DCDCDC"><font class="texto" >E-mail:</font></td>
          <td width="391" bgcolor="#DCDCDC"><input class="form" type="text" name="email" size="29"></td>
        </tr>
              
        <tr bgcolor="#DCDCDC">
          <td align="left" valign="middle" nowrap bgcolor="#DCDCDC"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="left" valign="middle" nowrap bgcolor="#DCDCDC"><font class="texto">Mensagem:</font></td>
          <td bgcolor="#DCDCDC"><textarea class="form" name="mensagem" cols="29" rows="10"></textarea></td>
        </tr>
        <tr bgcolor="#000000">
          <td colspan="3" valign="middle" bgcolor="#DCDCDC"><!-- <font class="texto">* campos obrigatórios</font> -->
            <br>
            <div align="center">
              <input type="submit" name="Enviar" value="Enviar ">
              <input type="reset" name="Limpar" value="Limpar">
            </div></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>
      <div align="left"></div>
   </form>
    
</div>
<div id="pagina">
	<div id="titulo">Roberto Malvezzi</div>

	<div id="violao"><img src="imagens/violao.png"></div>
	<div id="barco"><img id="barco_img" src="imagens/barco.png"></div>
  <div id="borda_menu"></div>
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
	
        	<div id="conteudo">
	<!-- aqui entra o php  -->
	<?php require_once $carregarPagina.'.php';?>
               <!-- <div id="footer"></div>-->
	</div>

	


	<!--div de conteudo-->
</div><!-- fim div pagina -->

<!-- presente -->

</body>
</html>
<div id="ceu"></div>
<br><br>
<div id="conteudo">

<?php
if(empty($_POST['numMusicas'])){
?>
<form method="post" action="indexAdmin.php?pagina=31">
<table width="100%%">
  <tr>
    <td>Numero de Musicas Album</td>
    <td><input type="text" name="numMusicas"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle"><input type="submit" value="Gerar Formulario" size="5"></td>
    <td></td>
  </tr>
</table>
</form>
<?php }else{?>
<form action="indexAdmin.php?pagina=32" method="POST" enctype="multipart/form-data">
<table width="100%%">
  <tr>
    <td>Titulo do Album</td>
    <td><input type="text" name="titulo"></td>
  </tr>
  <tr>
    <td>Imagem Capa do Album</td>
    <td><input type="file" name="imagem"></td>
  </tr>
</table>
<!--Trecho de codigo de repeticao-->
<?php
    $temp = $_POST['numMusicas'];
    for ($index = 0; $index < $temp; $index++) {
        echo'<table width="100%%">
             <tr>
             <td align="left" valign="middle">Musica '.($index+1).' : </td>
             <td align="left" valign="middle"><input type="file" name="musica'.$index.'"></td>
             </tr>
             </table>';
}?>
<!--Fim de repeticao-->

<table width="100%%">
  <tr>
      <td align="left" valign="middle">Tamanho maximo por arquivo :</td>
    <td ><?php echo ini_get('upload_max_filesize');?></td>
  </tr>
</table>
<table width="100%%">
  <tr>
    <td align="left" valign="middle"><input type="submit" value="Salvar Album"></td>
    <td align="left" valign="middle"><a href="indexAdmin.php?pagina=30"><input type="button" value="Voltar"></a></td>
  </tr>
</table>
</form>
<?php
}
?>    
</div>

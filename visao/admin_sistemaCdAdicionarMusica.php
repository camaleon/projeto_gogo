<div id="ceu"></div>
<br><br>
<div id="conteudo">
<form method="post" action="indexAdmin.php?pagina=34" enctype="multipart/form-data">
<table width="100%%">
  <tr>
    <td>Escolha o album a qual deseja adicionar :  </td>
    <td><select name="album"><?php echo $consulta ?></select></td>
  </tr>
  <tr>
    <td>Musica :</td>
    <td><input name="file" type="file"></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><input type="submit" value="Adicionar ao Album"></td>
    <td align="left" valign="middle"><a href="indexAdmin.php?pagina=30"><input type="button" value="Voltar"></a></td>
  </tr>
</table>
</form>
</div>
  


<form name="video" method="post" action="indexAdmin.php?pagina=62" enctype="multipart/form-data">
<table width="100%%">
  <tr>
      <td align="left" valign="middle"><label for="titulo">Título do Artigo :</label></td>
      <td align="left" valign="middle"><input type="text" value="<?php echo $consulta->titulo?>" name="titulo" size ="30"></td>
  </tr>
    <tr>
      <td align="left" valign="middle"><label for="conteudo">Conteúdo :</label></td>
      <td align="left" valign="middle"><textarea name="conteudo"  cols="80" rows="40"><?php echo $consulta->conteudo?></textarea></td>
  </tr>
  <input type="hidden" name="id" value="<?php echo $consulta->id?>">
</table>
<table width="100%%">
  <tr>
    <td align="left" valign="middle"><input type="submit" value="Salvar Artigo"></td>
    <td align="left" valign="middle"><a href="indexAdmin.php?pagina=57"><input type="button" value="Voltar"></a></td>
  </tr>
</table>
</form>
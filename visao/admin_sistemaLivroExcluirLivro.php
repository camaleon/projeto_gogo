
<form method="post" action="indexAdmin.php?pagina=49" enctype="multipart/form-data">
<table width="100%%">
  <tr>
    <td>Escolha o album a qual livro excluir :  </td>
    <td><select name="livro"><?php echo $consulta ?></select></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><input type="submit" value="Excluir Livro"></td>
    <td align="left" valign="middle"><a href="indexAdmin.php?pagina=45"><input type="button" value="Voltar"></a></td>
  </tr>
</table>
</form>
  
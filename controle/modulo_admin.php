<?php



/*

 * To change this template, choose Tools | Templates

 * and open the template in the editor.

 */

session_start();

require_once 'ControladorAdmin.php';



if(empty($_GET['pagina'])){

  $control = new ControladorAdmin(29);
  $carregarPagina = $control->pagina;
  $consulta = $control->resultadoConsulta;
  $consulta1 = $control->resultadoConsulta1;
  $consulta2 = $control->resultadoConsulta2;
  $consulta3 = $control->resultadoConsulta3;
  $consulta4 = $control->resultadoConsulta4;
  $consulta5 = $control->resultadoConsulta5;

}else{

  $control = new ControladorAdmin($_GET['pagina']);
  $carregarPagina = $control->pagina;
  $consulta = $control->resultadoConsulta;
  $consulta1 = $control->resultadoConsulta1;
  $consulta2 = $control->resultadoConsulta2;
  $consulta3 = $control->resultadoConsulta3;
  $consulta4 = $control->resultadoConsulta4;
  $consulta5 = $control->resultadoConsulta5;

}





?>


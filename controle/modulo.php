<?php



/*

 * To change this template, choose Tools | Templates

 * and open the template in the editor.

 */

//session_start();

require_once 'Controlador.php';



if(empty($_GET['pagina'])){

  $control = new Controlador(0);
  $carregarPagina = $control->pagina;
  $consulta = $control->resultadoConsulta;
  $consulta1 = $control->resultadoConsulta1;
  $consulta2 = $control->resultadoConsulta2;
  $consulta3 = $control->resultadoConsulta3;
  $consulta4 = $control->resultadoConsulta4;
  $consulta5 = $control->resultadoConsulta5;

}else{

  $control = new Controlador($_GET['pagina']);
  $carregarPagina = $control->pagina;
  $consulta = $control->resultadoConsulta;
  $consulta1 = $control->resultadoConsulta1;
  $consulta2 = $control->resultadoConsulta2;
  $consulta3 = $control->resultadoConsulta3;
  $consulta4 = $control->resultadoConsulta4;
  $consulta5 = $control->resultadoConsulta5;

}





?>


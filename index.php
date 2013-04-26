<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//lendo modo de ambiente de funcionamento do site 
$config = parse_ini_file("controle/config.ini",TRUE);

//copia arquivos de configuração para serem acessados pelo controlador
if($config['modo']['modo'] == 'prod'){
    //copia arquivos de configuração de cores e renomeia(sistema aluno)
    //copy("visao/aluno/colors/colors.ini","controle/alunoColors.ini");
    //copia arquivos de configuração de cores e renomeia(sistema principal)
    //copy("visao/principal/colors/colors.ini","controle/principalColors.ini");

}

        

header("Location:visao/index.php");

?>

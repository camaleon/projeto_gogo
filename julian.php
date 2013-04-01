<!DOCTYPE html!>
<html lang="pt-br">
<header>
<meta charset="UTF-8">



<title>Julian</title>
</head>

<body>
<div id="t1"></div>
<div id="t2"></div>
<div id="t3"></div>
<div id="t4"></div>


	<?php
//cores que serão usadas
	$azul = "#00FFFF";
	$azul_claro = "#00FFFF";
	$laranja="#0ff";
	$vermelho="#FF0000";
	
	
//sensor 1

	$t1=800;
	if($t1<=300){
		$temperatura1=$azul;

			}
	if($t1<700){
		$temperatura1=$laranja;
		
	}
	else{
		$temperatura1=$vermelho;
	}
//sensor 2

	$t2=800;
	if($t2<=300){
		$temperatura2=$azul;

			}
	if($t2<700){
		$temperatura2=$laranja;
		
	}
	else{
		$temperatura2=$vermelho;
	}
//sensor 3

	$t3=800;
	if($t3<=300){
		$temperatura3=$azul;

			}
	if($t3<700){
		$temperatura3=$laranja;
		
	}
	else{
		$temperatura3=$vermelho;
	}
//sensor 4

	$t4=800;
	if($t4<=300){
		$temperatura4=$azul;

			}
	if($t4<700){
		$temperatura4=$laranja;
		
	}
	else{
		$temperatura4=$vermelho;
	}

	?>


<style type="text/css">
#t1{
	position: absolute;
	width: 500px;
	height: 500px;
	
	/*background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(30,87,153,1)), color-stop(50%,rgba(78,136,193,1)), color-stop(70%,rgba(97,156,209,0)), color-stop(100%,rgba(125,185,232,0))); /* Chrome,Safari4+ */
	/*background: -webkit-linear-gradient(-45deg,  <?php echo $temp1; ?> 0%, <?php echo $temp1_2; ?> 100%); /* Chrome10+,Safari5.1+ */
	background: -webkit-radial-gradient(top left, 500px 600px, <?php echo $temperatura1; ?>,  #fff);
	opacity:0.95;
	-moz-opacity: 0.95;
	filter: alpha(opacity=95);
	z-index: 2;

}
#t2{
	position: absolute;
	width: 500px;
	height: 500px;
	background: -webkit-radial-gradient(top right, 300px 300px, <?php echo $temperatura2; ?>,  #fff);
	opacity:0.75;
	-moz-opacity: 0.75;
	filter: alpha(opacity=75);
	z-index: 3;
	

}
#t3{
	position: absolute;
	width: 500px;
	height: 500px;
	background: -webkit-radial-gradient(bottom right, 300px 300px, <?php echo $temperatura3; ?>,  #fff);
	opacity:0.55;
	-moz-opacity: 0.55;
	filter: alpha(opacity=55);
	z-index: 4;
	

}
#t4{
	position: absolute;
	width: 500px;
	height: 500px;
	background: -webkit-radial-gradient(bottom left, 300px 300px, <?php echo $temperatura4; ?>,  #fff);
	opacity:0.40;
	-moz-opacity: 0.40;
	filter: alpha(opacity=40);
	z-index: 5;
	

}

</style>


</body>
</html>
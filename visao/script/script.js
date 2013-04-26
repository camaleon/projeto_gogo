
window.onload = function(){


 $('#example').dataTable( {
        "oLanguage": {
           "sProcessing":   "Processando...",
    "sLengthMenu":   "Mostrar _MENU_ registros",
    "sZeroRecords":  "Não foram encontrados resultados",
    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
    "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
    "sInfoPostFix":  "",
    "sSearch":       "Buscar:",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "Primeiro",
        "sPrevious": "Anterior",
        "sNext":     "Seguinte",
        "sLast":     "Último"
    }

            
        }
    } );
//setInterval(barco,40000);


$(".livros_saldo").fadeIn(1500);
$(".musicas_saldo").fadeIn(2000);
$(".artigos_saldo").fadeIn(2500);
//$(".musicas").animate({"top":"192px"},900);
$(".livros").mouseover(function() {
     		$(this).css("background-color","#8ed8f8");
     	}).mouseout(function() {
 		$(this).css("background-color","");
     	}).click(function() {
               location.href="index.php?pagina=2";
})


$(".artigos").mouseover(function() {
     		$(this).css("background-color","#8ed8f8");
     	}).mouseout(function() {
 		$(this).css("background-color","");
     	}).click(function() {
               location.href="index.php?pagina=3";
})

$(".musicas").mouseover(function() {
     		$(this).css("background-color","#8ed8f8");
     	}).mouseout(function() {
 		$(this).css("background-color","");
     	}).click(function() {
               location.href="index.php?pagina=4";
})

$(".home").mouseover(function() {
               $(this).css("background-color","#8ed8f8");
          }).mouseout(function() {
          $(this).css("background-color","");
          }).click(function() {
               location.href="index.php?pagina=0";
})
$(".quem_sou").mouseover(function() {
               $(this).css("background-color","#8ed8f8");
          }).mouseout(function() {
          $(this).css("background-color","");
          }).click(function() {
               location.href="index.php?pagina=1";
})
$(".contato").mouseover(function() {
               $(this).css("background-color","#8ed8f8");
          }).mouseout(function() {
          $(this).css("background-color","");
          }).click(function() {
               //location.href="index.php?pagina=5";
               $("#modal").fadeIn(300);
               $("#box_formulario").fadeIn(400);
})
$(".fechar").click(function(){
  $("#modal").fadeOut(400);
  $("#box_formulario").fadeOut(300);
})
var cont_links_acesso=0;
$("#links_acesso").click(function() {

     		$(".links").slideToggle(500);
     		cont_links_acesso=cont_links_acesso+1;
     		if(cont_links_acesso%2==0){
     			$("#links_acesso img").attr({src:"imagens/close.png"});
     					}
     		else{
     			$("#links_acesso img").attr({src:"imagens/open.png"});
     		}
     	})


var cont_videos_acesso=0;
$("#videos_acesso").click(function() {

               $("#videos_bloco").slideToggle(1000);
               cont_videos_acesso=cont_videos_acesso+1;
               if(cont_videos_acesso%2==0){
                    $("#videos_acesso img").attr({src:"imagens/open.png"});
                              }
               else{
                    $("#videos_acesso img").attr({src:"imagens/close.png"});
               }
          })




}


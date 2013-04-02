
window.onload = function(){
 
//setInterval(barco,40000);


$(".livros_saldo").fadeIn(1500);
$(".musicas_saldo").fadeIn(2000);
$(".artigos_saldo").fadeIn(2500);
//$(".musicas").animate({"top":"192px"},900);
$(".livros").mouseover(function() {
     		$(this).css("background-color","#8ed8f8");
     	}).mouseout(function() {
 		$(this).css("background-color","");
     	})

$(".artigos").mouseover(function() {
     		$(this).css("background-color","#8ed8f8");
     	}).mouseout(function() {
 		$(this).css("background-color","");
     	})

$(".musicas").mouseover(function() {
     		$(this).css("background-color","#8ed8f8");
     	}).mouseout(function() {
 		$(this).css("background-color","");
     	})

$(".home").mouseover(function() {
               $(this).css("background-color","#8ed8f8");
          }).mouseout(function() {
          $(this).css("background-color","");
          })
$(".quem_sou").mouseover(function() {
               $(this).css("background-color","#8ed8f8");
          }).mouseout(function() {
          $(this).css("background-color","");
          })
$(".contato").mouseover(function() {
               $(this).css("background-color","#8ed8f8");
          }).mouseout(function() {
          $(this).css("background-color","");
          })
var cont_links_acesso=0;
$("#links_acesso").click(function() {

     		$(".links").slideToggle(500);
     		cont_links_acesso=cont_links_acesso+1;
     		if(cont_links_acesso%2==0){
     			$("#links_acesso img").attr({src:"imagens/open.png"});
     					}
     		else{
     			$("#links_acesso img").attr({src:"imagens/close.png"});
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

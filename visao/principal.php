<div id="chamada_artigos">Últimos artigos</div>
	<div id="artigos_bloco">
            <?php
            $temp5 = 0;
                foreach ($consulta5 as $value) {
                    if($temp5 < 3){
            ?>
		<div class="artigo">
			<div class="titulo_artigo">
				 <hr><br>
                                 <?php echo utf8_encode($value->titulo)." - ".date("d/m/Y",$value->data);?>
			</div>
                        <?php echo utf8_encode($value->conteudo);?>
		</div>
            <?php }$temp5 = $temp5 + 1;}?>
	</div>

    <!-- menu lateral -->

    <div id="foto_malvezzi" class="borda_branca"><img src="imagens/malvezzi.jpg" ></div>
    <div id="texto_malvezzi">
        Roberto Malvezzi é graduado em Estudos Sociais e em Filosofia pela Faculdade Salesiana de Filosofia Ciências e Letras de Lorena, em São Paulo. Também é graduado em Teologia pelo Instituto 
        Teológico de São Paulo. Atualmente atua na Comissão Pastoral da Terra – CPT. 
        Roberto Malvezzi é graduado em Estudos Sociais e em Filosofia pela Faculdade Salesiana de Filosofia Ciências e Letras de Lorena, em São Paulo. Também é graduado em Teologia pelo Instituto 
        Teológico de São Paulo. Atualmente atua na Comissão Pastoral da Terra... <br><br><a href="http://www.robertomalvezzi.com.br/visao/index.php?pagina=1">Ler mais</a>
    </div>
    <div id="chamada_links">Links</div>
        <div id="links_acesso"><img src="imagens/close.png"></div>
        <div id="links_bloco">
        <div class="links">
               <?php 
                       $temp4 = 0;
                       foreach ($consulta4 as $value) {
                           if($temp4 < 3){
                    ?>    
                <div class="links">
             <hr><br>
                         <?php echo $value->link;?>
            <div class="origem_link"><?php echo $value->descricao;?></div>      
            
        </div>
                <?php }$temp4 = $temp4 + 1;}?>
                </div>    
            <!-- som -->
        <div id="chamada_videos">Vídeos</div>
        <div id="videos_acesso"><img src="imagens/open.png"></div>
        <div id="videos_bloco">
                 <?php 
                 $temp3 = 0;
                 foreach ($consulta3 as $value) {
                     if($temp3<3){
                         $value->link = str_replace('320','315',$value->link); 
                         $value->link = str_replace('420','320',$value->link);
                         
                     ?>
                    
        <div id="video"><?php echo $value->link;?></div>
                <?php }$temp3 = $temp3 +1;}?>
        </div>
        <!-- som-->
        <div id="chamada_som">Músicas</div>
        <div id="som_bloco">
        <div id="som"><div class="titulo_som">Meu sertão</div><audio src="teste.mp3" controls="true" autoplay="true" /></div>
        <div id="som"><div class="titulo_som">Rio verde</div><audio src="teste.mp3" controls="true" autoplay="true" /></div>
        <div id="som"><div class="titulo_som">O sol e o sertão</div><audio src="teste.mp3" controls="true" autoplay="true" /></div>
        
        
        </div>

        <!--div final link-->

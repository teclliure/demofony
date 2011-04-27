
	<?
	$type = 'taller';
    $pageId = 'ficha-taller';
    $pageClass = 'ficha';
    include_once('header.php');
    ?>

    <div class="bar-left">
    
    	<div class="box">
    		<div class="box-content show">
    			
    			<div class="box-title color2">
    				<p>Taller Sota Demanda</p>
    			</div>
    			
    			<div class="title">
	    			<h1>Titulo titulo titulo titulo titulo titulo</h1>
	    			<p class="author">
	    				Por <a href="#">Conserjería de Economía</a>, 12 de diciembre de 2011
	    			</p>
	    			<p class="category">
	    				Listada en <a href="#">Economía</a>
	    			</p>
	    			<div class="clear"></div>
	    		</div>
	    		
	    		<div class="content">
	    			<div class="img"></div>
	    			<div class="text">
	    				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac velit quis ligula malesuada sagittis sed sit amet turpis. Sed pellentesque sem quis augue egestas pulvinar. Donec nec dui lectus, vitae sagittis leo. Quisque faucibus urna et lorem fermentum sit amet fermentum nibh elementum. Pellentesque ut purus at dui eleifend consequat. Praesent eleifend ultricies adipiscing. Vivamus mattis elit sit amet ligula condimentum ut aliquet nunc porta. Ut et nisl eget nisi ornare adipiscing non sit amet turpis. Fusce elit eros, venenatis nec tincidunt quis, fringilla nec sem. Curabitur vel ante orci, et tristique odio. Proin eget tellus a augue pretium feugiat non quis purus. Fusce vitae augue felis. Morbi erat metus, dapibus vitae interdum at, pulvinar sed magna. Suspendisse potenti. Cras vel vestibulum mi. Etiam non erat at justo aliquet aliquet. Aliquam erat volutpat.
	    			</div>
	    			<div class="clear"></div>
	    		</div>
	    		
	    		<div class="details">
	    			<div>Donde: <strong>c/Lorem Ipsum 23</strong></div>
	    			<div class="l">Máximo participantes: <strong>35</strong></div>
	    			<div>Cuando: <strong>05/05/2011</strong></div>
	    			<div class="l">Mínimo participantes: <strong>35</strong></div>
	    		</div>
	    		
	    		<div class="clear"></div>
	    		
	    		<div class="map-container">
	    			<div class="map"></div>
	    		</div>
	    		
	    		<div class="share">
		    		<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_tweet"></a>
					</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4da393350f4bddf1"></script>
					<!-- AddThis Button END -->	
		    	</div>
		    	
		    	<div class="clear"></div>
	    		
	    		<div class="box-title color2">
    				<p>Opiniones seleccionadas</p>
    			</div>
    			
    			 <div class="comment selected">
                    <div class="content">
                        <div class="left">
                            <h2>John Doe</h2>
                            <p class="date">17 de enero de 2011</p>
                            <p class="opinion">Opinió a <strong>Favor</strong></p>
                        </div>
                        <div class="right">
                            <div class="text">
                                sa gasdfsdfi usgdifsau dfuas diufa isdgfisgd iyfg isyd gfysgadyifg adisgfi yogsdioyfag disgfiosdiyfag diyos dfsdf sdf sdaf sdfasdfasdfa
                            </div>
                            <div class="footer">
                                <a href="#" class="opino button1">Opino el mateix</a>
                                <div class="stats">
                                    <strong>2 <span class="inline icon-thumb-up"></span></strong>
                                    <strong>2 <span class="inline misc misc-comments"></span></strong>
                                    <strong><a href="#"><span class="inline icon-banned"></span></a></strong>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <span class="icon-quote2 quote quote-left"></span>
                    	<span class="icon-quote1 quote quote-right"></span>
                    </div>
                </div>
                
                <div class="box-title">
    				<p>Opiniones (2)</p>
    			</div>
                
                <?php for($i = 0; $i < 3; $i++): ?>
                <div class="comment">
                    <div class="content">
                        <div class="left">
                            <h2>John Doe</h2>
                            <p class="date">17 de enero de 2011</p>
                            <p class="opinion">Opinió a <strong>Favor</strong></p>
                        </div>
                        <div class="right">
                            <div class="text">
                                sa gasdfsdfi usgdifsau dfuas diufa isdgfisgd iyfg isyd gfysgadyifg adisgfi yogsdioyfag disgfiosdiyfag diyos dfsdf sdf sdaf sdfasdfasdfa
                            </div>
                            <div class="footer">
                                <a href="#" class="opino button1">Opino el mateix</a>
                                <div class="stats">
                                    <strong>2 <span class="inline icon-thumb-up"></span></strong>
                                    <strong>2 <span class="inline misc misc-comments"></span></strong>
                                    <strong><a href="#"><span class="inline icon-banned"></span></a></strong>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <span class="icon-quote2 quote quote-left"></span>
                    	<span class="icon-quote1 quote quote-right"></span>
                    </div>
                </div>
                <? endfor; ?>
    		
    		</div>    
        </div>
    
    </div>
    
    <div class="bar-right">
    
    	<!-- Caja noticias --> 
    	<div class="box color1 no-tabs sign">
    		<span class="icon-box-arrow"></span>
    		<div class="box-content show">
    		
    			<div class="hdr"><span class="icon-ficha_accion_header"></span><strong>Participa</strong></div>
    			<a href="#" class="button1">Inscriu-te</a>
    			<form action="#">
    				<p>¿Què penses d'aquesta acció?</p>
    				<p>¿Què penses d'aquest taller?</p>
    				<p>¿Què penses d'aquesta Notícia?</p>
    				<textarea></textarea>
    				<button class="button1">Enviar</button>
    			</form>
    		
    		</div>
    	</div>
    
    	<div class="box no-tabs">
    		<div class="box-content show">
    		
    			(jquery plugin)
    		
    		</div>
    	</div>
    
    	<div class="box no-tabs comments-by-area">
    		<div class="box-content show">
    		
    			<div class="box-title color2">
    				<p>Opiniones por área</p>
    			</div>
    			
    			<div class="map"></div>

    		
    		</div>
    	</div>
    	
    	<div class="box no-tabs related-inciatives">
    		<div class="box-content show">
    		
    			<div class="box-title color2">
    				<p>Relacionados</p>
    			</div>
    			
				<? for($i = 0; $i < 4; $i++): ?>
                <div class="item">
                    <h1><a href="#">Lorem ipsum y dfas dfas dfsd fsd as</a></h1>
                    <p class="date">23 de marzo de 2011</p>
                </div>
                <? endfor; ?>
    		
    		</div>
    	</div>
    	
    </div>
    
    <? include_once('footer.php'); ?>
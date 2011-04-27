
	<?
    $pageId = 'busqueda';
    include_once('header.php');
    ?>

    <div class="bar-left">
    
    	<div class="box no-tabs">
    		<div class="box-content show">
    
    			<div class="box-title">
    				<p>L'ULTIM</p>
    				<span><strong>45</strong> resultados</span>
    			</div>
    
    			
                <? for($i = 0; $i < 5; $i++): ?>
                	<div class="result <?= $i%2? '' : 'color' ?>">
                                    <div class="letter icon-letter-c">c</div>
                                    <div class="img"></div>
                                    <h1><a href="#">Lorem ipsum y dfas dfas dfsd fsd as</a></h1>
                                    <p class="author">por <a href="#">Manolo</a>, el 23 de marzo en <a href="#">Categoria</a></p>
                                    <div class="text">
                                    	ipsum y dfas dfas dfsd fsd asipsum y dfas dfas dfsd fsd asipsum y dfas dfas dfsd fsd asipsum y dfas dfas dfsd fsd asipsum y dfas dfas dfsd fsd asipsum y dfas dfas dfsd fsd asipsum y dfas dfas dfsd fsd as
                                    </div>
                                    <div class="comments"><span class="misc misc-comments inline"></span>5</div>
                                    <div class="clear"></div>
                            </div>
                            <? endfor; ?>
                
                
            </div>    
        </div>
    
    </div>
    
    <div class="bar-right">
    	<div class="box no-tabs">
    		<div class="box-content show">
    			
    			<div class="box-title">
    				<p>FILTROS</p>
    			</div>
    			
    			<ul class="filter">
    				<li class="header">
    					Filtrar por categoría
    				</li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    			</ul>
    			
    			<ul class="filter">
    				<li class="header">
    					Filtrar por tipo
    				</li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    				<li><a href="#">Categoría</a></li>
    			</ul>
    			
    			<ul class="filter">
    				<li class="header">
    					Filtrar por barrio
    				</li>
    				<li>
    					<a href="#">Cáceres</a>
    					<ul>
    						<li><a href="#">Alagón</a></li>
    						<li><a href="#">Alagón</a></li>
    						<li><a href="#">Alagón</a></li>
    						<li><a href="#">Alagón</a></li>
    						<li><a href="#">Alagón</a></li>
							<li><a href="#">Alagón</a></li>
							<li><a href="#">Alagón</a></li>
							<li><a href="#">Alagón</a></li>
    					</ul>
    				</li>
    				<li><a href="#">Cáceres</a></li>
    				<li><a href="#">Cáceres</a></li>
    				<li><a href="#">Cáceres</a></li>
    				<li><a href="#">Cáceres</a></li>
    				<li><a href="#">Cáceres</a></li>
    				<li><a href="#">Cáceres</a></li>
    				<li><a href="#">Cáceres</a></li>
    			</ul>
    			
    		</div>
    	</div>
    </div>
    
    <? include_once('footer.php'); ?>
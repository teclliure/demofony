<?
	if(!$_GET['seccion'])
		@header('Location: perfil.php?seccion=opinions');
	$pageId = 'perfil';
	include_once('header.php');
?>
    <div class="bar-left">
        <div class="box has-title color1">
            <h1 class="hdr"><span class="inline icon-man_user"></span>Perfil</h1>
            <div class="box-content show">

                <div class="info">
                    <div class="img profile"></div>
                    <div class="user">
                    	<h1>John Doe</h1>
                    	<div>
                        	<p>Opiniones: <strong>5</strong></p>
                        	<p>Comentarios: <strong>5</strong></p>
                        	<p>Iniciativas: <strong>5</strong></p>
                        	<p>Trobadas: <strong>5</strong></p>
                    	</div>
                    </div>
                    <div class="clear"></div>
                    <div class="edit">
                        <a href="#"><span class="inline icon-edit"></span>Editar perfil</a>
                    </div>
                </div>

                <div class="map">
                    <p>Localizació: <strong>Ibiza</strong></p>
                    <div id="profile-map"></div>
                </div>

            </div>
        </div>

    </div>

    <div class="bar-right">

        <div class="box">
            <div class="box-content show">

                <div class="header">
                    <h1>Participació de <strong>John Doe</strong></h1>
                    <ul>
                        <li class="<?= $_GET['seccion'] == 'opinions' ? 'on' : '' ?>"><a href="perfil.php?seccion=opinions">Opinions</a></li>
                        <li class="<?= $_GET['seccion'] == 'iniciatives' ? 'on' : '' ?>"><a href="perfil.php?seccion=iniciatives">Iniciatives</a></li>
                        <li class="<?= $_GET['seccion'] == 'trobadas' ? 'on' : '' ?>"><a href="perfil.php?seccion=trobadas">Trobadas</a></li>
                    </ul>
                </div>
                
                <? if($_GET['seccion'] == 'opinions'): ?>

                <div class="opinions">
                
           
                
                    <?php for($i = 0; $i < 5; $i++): ?>
                    <div class="comment">
                        <h1>Lorem ipsum this is a test</h1>
                        <p class="info">
                            Propuesto por <a href="#">Concerjería de Igualdad y Empleo</a> el 17 de enero de 2011
                        </p>
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
                    <? if($i == 0): ?>
                    <div class="featured">
                		<form class="add-comment">
                			<a href="#" class="add"><span class="inline icon-add_comment"></span> Añadir un comentario</a>
                			<div>
                				<textarea></textarea>
                				<button type="submit" class="button1">Comentar</button>
                				<a href="#" class="cancel">Cancelar</a>
                			</div>
                		</form>
                		<?php for($i = 0; $i < 2; $i++): ?>
                		<div class="featured-comment">
                			<div class="img profile"></div>
                			<div class="content">
                				<h1>John Doe II <span>- 23 de marzo de 2011</span></h1>
                				<div class="text">
                					Lorem ipsum pisum lorem ipus ipsum pisum lorem ipus ipsum pisum lorem ipus lorem ipus ipsum pisum lorem ipus ipsum pisum lorem ipus.
                				</div>
                			</div>
                		</div>
                		 <? endfor; ?>
                	</div>
                    <? endif; ?>
                    <? endfor; ?>
                </div>
                
                <? endif; ?>
                
                <? if($_GET['seccion'] == 'iniciatives'): ?>
                
                <div class="iniciatives">
	                <? for($i = 0; $i < 5; $i++): ?>
	                <div class="iniciative <?= $i%2? '' : 'color' ?>">
                        <div class="letter icon-letter-c">c</div>
                        <div class="img"></div>
                        <h1><a href="#">Lorem ipsum y dfas dfas dfsd fsd as</a></h1>
                        <p class="author">por <a href="#">Manolo</a></p>
                        <p class="date">el 23 de marzo en <a href="#">Categoria</a></p>
                        <div class="comments"><span class="misc misc-comments inline"></span>5</div>
                        <div class="clear"></div>
	                </div>
	                <? endfor; ?>
                </div>
                
                <? endif; ?>
                
                <? if($_GET['seccion'] == 'trobadas'): ?>
                
                <? for($i = 0; $i < 5; $i++): ?>
                <div class="trobada <?= $i%2? '' : 'color' ?>">
                        <span class="icon icon-NeedleLeftYellow"></span>
                        <div class="col1">
                                <div class="img"></div>
                                <h1><a href="#">Lorem ipsum y dfas dfas dfsd fsd as</a></h1>
                                <p class="author">por <a href="#">Manolo</a></p>
                                <p class="date">el 23 de marzo en <a href="#">Categoria</a></p>
                        </div>
                        <div class="col2">
                                <p><strong>Lloc:</strong> c/dolor sit amet esq...</p>
                                <p><strong>Data:</strong> 12/05/2011</p>
                                <p class="estat"><strong>Estat:</strong> Trobada abierta <span class="misc misc-unlock inline"></span></p>
                        </div>
                        <div class="col3">
                                <p><strong>Participantes:</strong></p>
                                <p><strong>Max:</strong> 50</p>
                                <p><strong>Min:</strong> 5</p>
                        </div>
                        <div class="col4">
                                <a href="#" class="button1 enter">Entrar</a>
                        </div>
                        <div class="clear"></div>
                </div>
                <? endfor; ?>
                
                <? endif; ?>

            </div>
        </div>

    </div>

    <? include_once('footer.php'); ?>
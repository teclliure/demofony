
    <?
    $pageId = 'home';
    include_once('header.php');
    ?>

    <div class="bar-left">

        <div class="box has-tabs has-title iniciatives">
        	<h1 class="hdr"><span class="inline icon-altavoz_announcements"></span>Iniciatives</h1>
                <ul class="tabs">
                	<li><a href="#veure-tot"><span></span><b>Veure Tot</b></a></li>
                    <li><a href="#iniciatives-ciutadanes"><span class="icon-letter-c">c</span><b>Inciatives<br />Ciutadanes</b></a></li>
                    <li><a href="#iniciatives-govern"><span class="icon-letter-g">g</span><b>Iniciatives<br /> de Govern</b></a></li>
                    <li><a href="#consultes"><span class="icon-letter-q">?</span><b>Consultes</b></a></li>
                </ul>
                <div class="box-content" id="veure-tot">

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

                    <div class="pagination">
                        <a href="#"><<</a>
                        <a href="#"><</a>
                        <strong>1 de 3</strong>
                        <a href="#">></a>
                        <a href="#">>></a>
                    </div>

                </div>
                <div class="box-content" id="iniciatives-ciutadanes">
                	Muy pronto.
                </div>
                <div class="box-content" id="iniciatives-govern">
                	Muy pronto.
                </div>
                <div class="box-content" id="consultes">
                	Muy pronto.
                </div>
        </div>

        <div class="box has-tabs has-title mapa">
            <h1 class="hdr"><span class="inline icon-meeting_point"></span>Trobades</h1>
            <ul class="tabs">
                <li><a href="#mapa"><span class="icon-map inline"></span><b>Mapa</b></a></li>
                <li><a href="#accio-ciutadana"><span class="icon-pin_yellow inline"></span><b>Accio<br />Ciutadana</b></a></li>
                <li><a href="#sota-demanda"><span class="icon-pin_blue inline"></span><b>Tallers<br />Sota Demanda</b></a></li>
            </ul>
            <div class="box-content" id="mapa">
            	<div class="map" id="map_canvas"></div>
            </div>
            <div class="box-content accio-ciutadana" id="accio-ciutadana">

                <? for($i = 0; $i < 5; $i++): ?>
                <div class="trobada <?= $i%2? '' : 'color' ?>">
                    <span class="icon icon-pin_yellow"></span>
                    <div class="col1">
                        <div class="img"></div>
                        <h1><a href="#">Lorem ipsum y dfas</a></h1>
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

            </div>
            <div class="box-content" id="sota-demanda">
            	Muy pronto.
            </div>
        </div>

	</div>
	<div class="bar-right">

        <div class="box crear">
            <div class="box-content">
                <div class="misc misc-people"></div>
                <p>Vols participar a crear una <strong>Eivissa</strong> millor?</p>
                <a href="#" class="button1">Crear Compte</a>
            </div>
        </div>

        <div class="box has-title noticias">
            <h1 class="hdr"><span class="inline icon-news"></span>Noticias</h1>
            <div class="box-content">

                <? for($i = 0; $i < 4; $i++): ?>
                <div class="item">
                    <div class="img"></div>
                    <h1><a href="#">Lorem ipsum y dfas dfas dfsd fsd as</a></h1>
                    <p class="date">el 23 de marzo de 2011</p>
                    <div class="clear"></div>
                </div>
                <? endfor; ?>

                <div class="pagination">
                    <a href="#"><<</a>
                    <a href="#"><</a>
                    <strong>1 de 3</strong>
                    <a href="#">></a>
                    <a href="#">>></a>
                </div>

            </div>
        </div>

        <div class="box has-title entrevistas">
            <h1 class="hdr"><span class="inline icon-microphone"></span>E-ntrevistas</h1>
            <div class="box-content">

                <div class="img"></div>
                <h1>Haz tus preguntas a Don Jose</h1>
                <p>Consejal de Medio ambiente</p>
                <div class="bottom">
                        <a href="#" class="button1 inline">Entrar</a>
                        <strong><span class="misc misc-unlock inline"></span>Entrevista abierta</strong>
                        <div class="clear"></div>
                </div>

            </div>
        </div>

	</div>

    <? include_once('footer.php'); ?>				
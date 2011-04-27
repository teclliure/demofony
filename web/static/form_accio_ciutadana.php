<?
    $pageId = 'form-taller';
    include_once('header.php');
    ?>
    
    <form method="post" action="#" class="form">

    <div class="bar-left">
    
    	<div class="box no-tabs no-margin">
    		<div class="box-content show">
    
    			<div class="box-title color1">
    				<p>Acció Ciutadana</p>
    			</div>
    
    			
                
                	<label>	
                		<span>Títol</span>
                		<input type="text" name="title" class="wide" />
                	</label>
                	<label>	
                		<span>Descripció</span>
                		<textarea name="description" class="wide"></textarea>
                	</label>
                	<div class="features">
                		<p class="hdr">Características</p>
                		<label>
                			<span>Minim participants:</span>
                			<select name="min_participants">
                				<? for($i = 1; $i < 10; $i++): ?>
                				<option><?=$i?></option>
                				<? endfor; ?>
                			</select>
                		</label>
                		<label>
                			<span>Máxim participants:</span>
                			<select name="max_participants">
                				<? for($i = 1; $i < 10; $i++): ?>
                				<option><?=$i?></option>
                				<? endfor; ?>
                			</select>
                		</label>
                		<label>
                			<span>Data de celebració:</span>
                			<input type="text" name="date" class="date" />
                		</label>
                		<div class="clear"></div>
                	</div>
                    <div class="features no-border">
                    	<label>	
                			<span>Lloc de celebració:</span>
                			<input type="text" name="place" />
                		</label>
                		<label>	
                			<span>Barri:</span>
                			<select name="neighborhood">
                				<option>Selecciona...</option>
                			</select>
                		</label>
                		<div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                
            </div>    
        </div>
    
    </div>
    
    <div class="bar-right">
    	<div class="box no-tabs no-margin">
    		<div class="box-content show">
    			
    			<div class="box-title color1">
    				<p>Inclou una foto o video</p>
    			</div>
    			
    			<label>
    				<span>Imatge:</span>
    				<input type="file" name="file" />
    			</label>
    			
    			<label>	
                	<span>Video:</span>
                	<input type="text" name="title" class="wide" />
                	<small>Puedes incluir la URL de un video de YouTube o similar</small>
               	</label>

				<button class="button1">Enviar</button>
    			
    		</div>
    	</div>
    </div>
    
    <div class="clear"></div>
    
    <div class="note">
    	Esta propuesta será filtrada antes de su publicación. En caso de incluir insultos, vejaciones o contenido que consideremos inapropiado no será publicada. Para más información visita las <a href="#">Condiciones de uso</a>
    </div>
    
    </form> 
    
    <? include_once('footer.php'); ?>
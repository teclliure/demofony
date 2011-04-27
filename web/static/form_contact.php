<?
    $pageId = '';
    include_once('header.php');
?>

	<div class="box no-tabs no-margin">
		<div class="box-content show">
	
			<div class="box-title">
				<p>Contacto</p>
			</div>
			
			<div class="">
				
				<form mthod="post" class="form">
				
					<label>	
	                	<span>Nom</span>
	                	<input type="text" name="name" class="wide" />
	                </label>
	                <label>	
	                	<span>Email</span>
	                	<input type="text" name="email" class="wide" />
	                </label>
	                <label>	
	                	<span>Comentaris</span>
	                	<textarea name="comments" class="wide"></textarea>
	                </label>
	                
	                <button type="submit" class="button1">Enviar</button>
                
                </form>
				
			</div>
			
		</div>
	</div>
	
	<? include_once('footer.php'); ?>

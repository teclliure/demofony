	
	<?
	$reg = array('text-shadow', 'box-shadow', 'border-radius', 'opacity');
	if($_POST['css']){
		$css = @preg_replace("/\/\*.+\*\//", "", $_POST['css']);
		$s = explode('}', $css);
		foreach($s as $p){
			$x = explode('{', trim($p));
			if(@preg_match_all("/(".implode('|', $reg).")\:[^\;]+/i", $x[1], $m)){
				echo $x[0].'{';
				for($i = 0; $i < count($m) - 1; $i++){
					echo '-webkit-'.$m[$i][0].'; ';
					echo '-moz-'.$m[$i][0].'; ';
				}
				echo '}<br>';
			}
			//@preg_match_all("/((".implode('|', $reg).")\:[^\;]+)/i", $_POST['css'], $m);	
		}
	}
	?>
	
	<style>
		textarea{width:800px; height:120px; display:block; }
	</style>
	
	<form method="post">
		<textarea name="css"><?=$_POST['css']?></textarea>
		<button>Dale</button>
	</form>
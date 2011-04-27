<?

header("Content-type: text/css");

$folder = '../img/iconos/';

if ($handle = opendir($folder)) {

    while (false !== ($file = readdir($handle))) {
    	if(preg_match("/\.(png|gif)$/", $file)){
    		$data = getimagesize($folder.$file);
        	echo ".icon-".substr($file, 0, -4).'{width:'.$data[0].'px; height:'.$data[1].'px; background:url('.$folder.$file.') no-repeat; vertical-align:middle;}'."\n";
        }
	}
    closedir($handle);
}


?>
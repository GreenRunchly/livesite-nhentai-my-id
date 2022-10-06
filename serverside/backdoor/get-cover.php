<?php
    header('Cache-Control: max-age=0');
    header("Pragma: no-cache"); 
    header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time()+2));
    header("Connection: close");
    header("Content-type: image/jpeg");

    //mengambil konfigurasi
    require $_SERVER['DOCUMENT_ROOT']."/nhserver/config.php";
    
    if (!empty($_GET['media'])){
		$mediaUrl = $_GET['media'];
	}else{
		die('');
	}
    
    $tempfile = getUrl(URL_SITUS_MIDDLE_MAN.$mediaUrl);
    echo $tempfile;

?>
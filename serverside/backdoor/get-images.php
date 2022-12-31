<?php
    header('Cache-Control: max-age=0');
    header("Pragma: no-cache"); 
    header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time()+2));
    header("Connection: close");
    header("Content-type: image/jpeg");

    //mengambil konfigurasi
    require $_SERVER['DOCUMENT_ROOT']."/nh/serverside/config.php";
    
    if (!empty($_GET['mediaid'])){
		$mediaID = $_GET['mediaid'];
		$mediaType = $_GET['mediatype'];
		switch ($mediaType) {
            case 'j':
                $mediaTypeFormat = 'jpg';
                break;
            case 'p':
                $mediaTypeFormat = 'png';
                break;
            default:
                $mediaTypeFormat = 'jpg';
                break;
        }
	}else{
		die('');
	}
	if (!empty($_GET['pagesid'])){
		$pagesID = $_GET['pagesid'];
	}else{
		die('');
	}
    
    $tempfile = getUrl(URL_SITUS_CDN.'/galleries/'.$mediaID.'/'.$pagesID.'.'.$mediaTypeFormat);
    echo $tempfile;

?>

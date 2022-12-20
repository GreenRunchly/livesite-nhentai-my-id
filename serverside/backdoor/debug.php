<?php
	header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header("Access-Control-Allow-Headers: X-Requested-With");
    session_start();

    //mengambil konfigurasi
    require $_SERVER['DOCUMENT_ROOT']."/nh/serverside/config.php";
	
    require_once(DIR_SITUS.'/simple_html_dom.php');

        $html = getUrl(URL_SITUS_MIDDLE_MAN.URL_SITUS_CORS.'/g/364599');
        //https://cdn.dogehls.xyz/galleries/1947769/cover.jpg
	echo $html;
?>

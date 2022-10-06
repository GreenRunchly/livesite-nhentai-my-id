<?php

    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header("Access-Control-Allow-Headers: X-Requested-With");
    session_start();

    //mengambil konfigurasi
    require $_SERVER['DOCUMENT_ROOT']."/serverside/config.php";

    if (!empty($_GET['p'])){
        $QueryUserPage = stripslashes(trim(htmlspecialchars($_GET['p'])));
        $QueryUser = '?page='.$QueryUserPage;
    }else{
        $QueryUser = '';
    }
	
    require_once(DIR_SITUS.'/simple_html_dom.php');
    
    $html = str_get_html(getUrl(URL_SITUS_MIDDLE_MAN.URL_SITUS_CORS.'/' . $QueryUser));
    
    $serverData['title'] = 'Popular and New Uploads';
    
    foreach($html->find('div.container.index-container > div.gallery') as $element){
        $Listing[$id]['cover'] = $element;
    }
    
    foreach($html->find('section.pagination > a') as $element){
        $id = getStrBetween($element, 'page=', '" class="');
        $Pagination[$id]['caption'] = 'Page '.$id;
    }
    
    $headerMeta['url'] = URL_SITUS_MASTER;
    $headerMeta['title'] = 'Popular and New Uploads | NH Browser';
    $headerMeta['keywords'] = 'NH Browser, images downloader, nhentai downloader, nhentai reader, Popular, New Uploads';
    $headerMeta['ogimage'] = $headerMeta['og-image'];

    $Output['status'] = '200';
    $Output['title'] = $serverData;
    $Output['listing'] = $Listing;
    $Output['pagination'] = $Pagination;
    $Output['meta'] = $headerMeta;

    echo json_encode($Output);
?>

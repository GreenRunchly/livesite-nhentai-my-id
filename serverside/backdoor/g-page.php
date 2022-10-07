<?php
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header("Access-Control-Allow-Headers: X-Requested-With");
    session_start();

    //mengambil konfigurasi
    require $_SERVER['DOCUMENT_ROOT']."/serverside/config.php";

    if (!empty($_GET['q'])){
		$NHId = stripslashes(trim(htmlspecialchars($_GET['q'])));
	}else{
		$NHId = '183100'; //'364599'; //152988;
	}
    
    require_once(DIR_SITUS.'/simple_html_dom.php');
    $html = str_get_html(getUrl(URL_SITUS_MIDDLE_MAN.URL_SITUS_CORS.'/g/'.$NHId));
    $scripts = $html->find('script');
    foreach($scripts as $s) {
        if (strpos($s->innertext, 'N.gallery') !== false) {
            $scriptGallery  = $s;
        }
    }
    $json = getStrBetween($scriptGallery, 'var gallery = new N.gallery(', '});');
    $json = str_ireplace('\u0022','"',$json);
    /* patch start */
    $json = $json.'"ok":""}';
    /* patch end */
    $CodeData = json_decode($json, true);
    foreach ($CodeData['tags'] as $key => $value) {
        if ($CodeData['tags'][$key]['type'] == 'tag'){
            $CodeData['tags'][$key]['url'] = str_ireplace(array('/tag/','/'), '', $CodeData['tags'][$key]['url']);
        }
        if ($CodeData['tags'][$key]['type'] == 'tag'){
            $tags['raw'][$key] = $CodeData['tags'][$key]['name'];
            $tags['full'][$key] = $CodeData['tags'][$key];
        }
    }
    $tags['text'] = '';
    foreach ($tags['raw'] as $key => $value) {
        $tags['text'] = $tags['text'].''.$value.', ';
    }

    

    $headerMeta['url'] = URL_SITUS_MASTER;
    $headerMeta['title'] = $CodeData['title']['pretty'];
    $headerMeta['keywords'] = 'NH Browser, images downloader, nhentai downloader, nhentai reader,'.$tags['text'];
    $headerMeta['og-image'] = URL_SITUS.'/get-images.php?mediaid='.$CodeData['media_id'].'&pagesid=1';
    

    $Output['status'] = '200';
    $Output['title']['title'] = $CodeData['title']['pretty'];
    $Output['meta'] = $headerMeta;
    $Output['gallery'] = $CodeData;

    echo json_encode($Output);
?>
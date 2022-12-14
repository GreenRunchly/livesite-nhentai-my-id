<?php

    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header("Access-Control-Allow-Headers: X-Requested-With");
    session_start();

    //mengambil konfigurasi
    require $_SERVER['DOCUMENT_ROOT']."/nh/serverside/config.php";

    if (!empty($_GET['q'])){
		$QueryUser = stripslashes(trim(htmlspecialchars($_GET['q'])));
	}else{
		$QueryUser = '';
	}
	$QueryUserInput = $QueryUser;
	if (!empty($_GET['p'])){
		$QueryUser = $QueryUser.'&page='.stripslashes(trim(htmlspecialchars($_GET['p'])));
	}

    require_once(DIR_SITUS.'/simple_html_dom.php');
    
    if (!empty($QueryUser)){
    
        //$html = str_get_html(getUrl(URL_SITUS_MIDDLE_MAN.'&site_encode='.base64_encode(URL_SITUS_CORS.'/search?q='.$QueryUser)));
        $html = str_get_html(getUrl(URL_SITUS_MIDDLE_MAN.URL_SITUS_CORS.'/search?q='.$QueryUser));
        
        $serverData['title'] = $QueryUserInput;
        $serverData['count'] = getStrBetween($html->find('h2',0), '<h2>', ' Results</h2>');
        
        foreach($html->find('div.container.index-container > div.gallery') as $element){
            $id = getStrBetween($element, '<a href="/g/', '/" class="cover"');
            $coverother = getStrBetween($element, 'data-src="', '"');
            $coverother = str_ireplace(URL_SITUS_RM_CDN, '', $coverother);
            if (!strpos($coverother, URL_SITUS_CDN)){
                $coverother = URL_SITUS_CDN.$coverother;
                $coverother = $coverother;
            }
            $Listing[$id]['cover'] = $coverother;
            
            $Listing[$id]['caption'] = getStrBetween($element, '<div class="caption">', '</div>');
            $headerMeta['og-image'] = URL_SITUS.'/get-cover.php?media='.$Listing[$id]['cover'];
        }
        
        foreach($html->find('section.pagination > a') as $element){
            $id = getStrBetween($element, 'page=', '" class="');
            $Pagination[$id]['caption'] = 'Page '.$id;
        }
    
        $headerMeta['url'] = URL_SITUS_MASTER;
        $headerMeta['title'] = ($serverData['title']).' Search | NH Browser';
        $headerMeta['keywords'] = 'NH Browser, images downloader, nhentai downloader, nhentai reader, '.$QueryUser;
        $headerMeta['ogimage'] = $headerMeta['og-image'];

        $Output['status'] = '200';
        $Output['title'] = $serverData;
        $Output['listing'] = $Listing;
        $Output['pagination'] = $Pagination;
        $Output['meta'] = $headerMeta;

        echo json_encode($Output);

        
    }
    die();
    ///Down there is an old method
?>
<div class="header-layout">
    <div class="navbar">
        <div class="navbar-left-non">
            
        </div>
        <form class="navbar-center" method="GET">
            <input type="text" id="codeinput" placeholder="Keyword" name="q" value="<?php echo $QueryUserInput; ?>">
        </form>
        <div class="navbar-right">
            <a class="navbar-button" href="/popular"><i class="fal fa-fire"></i></a>
            <a class="navbar-button" href="/g?q=<?php echo rand(1,270000); ?>"><i class="fal fa-repeat"></i></a>
            <a class="navbar-button" href="https://trakteer.id/greenrunchly/tip" ><i class="fal fa-gift"></i></a>
        </div>
    </div>
    <div class="header-layout-top">
        <h1 id="titleManga"><?php echo ($serverData['title']); ?></h1>
    </div>
    <div class="header-layout-bottom">
        <h2><span id="totalPagesManga"><?php echo $serverData['count']; ?></span> Results</h2>
    </div>
</div>
<div id="mediaLayout" class="tiles-gallery">
<?php
    if (!empty($QueryUser)){
        foreach ($Listing as $id => $data) {
?>
    <a class="media-gallery" href="/g?q=<?php echo $id; ?>">
        <div class="media-gallery-thumb">
            <img src="<?php echo URL_SITUS; ?>/get-cover.php?media=<?php echo $data['cover']; ?>">
        </div>
        <div class="media-gallery-desc">
            <h2><?php echo substr($data['caption'], 0, 50); ?>...</h2>
        </div>
    </a>
<?php
        }
    }
?>
</div>
<div class="load-button-container">
<?php
    if (!empty($QueryUser)){
        foreach ($Pagination as $id => $data) {
?>
    <a class="load-button" href="?q=<?php echo $QueryUserInput; ?>&page=<?php echo $id; ?>"><p><?php echo $data['caption']; ?></p></a>
<?php
        }
    }
?>
</div>


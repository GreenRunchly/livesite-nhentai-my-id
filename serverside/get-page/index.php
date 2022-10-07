<?php
    //mengambil konfigurasi
    require $_SERVER['DOCUMENT_ROOT']."/serverside/config.php"; 
    if (!empty($_GET['site'])){
        if (!filter_var($_GET['site'], FILTER_VALIDATE_URL) === false) {
            $siteUsed = filter_var($_GET['site'], FILTER_SANITIZE_URL);
            if (strpos($siteUsed, "https://cdn.dogehls.xyz")){
                $siteUsed = str_ireplace("cdn.dogehls.xyz","google.com",$siteUsed);
            }
            echo getUrl($siteUsed);
        }
    }
    die();
?>
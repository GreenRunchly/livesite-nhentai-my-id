<?php
    //mengambil konfigurasi
    require $_SERVER['DOCUMENT_ROOT']."/nh/serverside/config.php"; 
    if (!empty($_GET['site'])){
        if (!filter_var($_GET['site'], FILTER_VALIDATE_URL) === false) {
            $siteUsed = filter_var($_GET['site'], FILTER_SANITIZE_URL);
            if (preg_match("/cdn.dogehls.xyz/i", $siteUsed)){
                $siteUsed = str_ireplace("cdn.dogehls.xyz","cdn.dogehls.xyz",$siteUsed);
            }
            echo getUrl($siteUsed);
        }
    }
    die();
?>

<?php
    //mengambil konfigurasi
    require $_SERVER['DOCUMENT_ROOT']."/serverside/config.php"; 
    if (!empty($_GET['site'])){
        if (!filter_var($_GET['site'], FILTER_VALIDATE_URL) === false) {
            echo getUrl(filter_var($_GET['site'], FILTER_SANITIZE_URL));
        }
    }
    die();
?>
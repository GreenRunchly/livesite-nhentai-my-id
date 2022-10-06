<?php
    if (!empty($_GET['site'])){
        if (!filter_var($_GET['site'], FILTER_VALIDATE_URL) === false) {
            echo file_get_contents(filter_var($_GET['site'], FILTER_SANITIZE_URL));
        }
    }
    die();
?>
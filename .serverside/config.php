<?php

	error_reporting(E_ERROR | E_PARSE);

   define('URL_SITUS_MASTER', 'https://nhentai.my.id');
   define('URL_SITUS', 'https://nhentai.my.id/.serverside/backdoor');
   define('DIR_SITUS', $_SERVER['DOCUMENT_ROOT'].'/.serverside/backdoor');
   define('URL_SITUS_CORS', 'https://nhentai.to');
   define('URL_SITUS_MIDDLE_MAN', 'https://rizkiirfananshori-games.000webhostapp.com?site=');
   define('URL_SITUS_CDN', 'https://t3.nhentai.net');
   define('URL_SITUS_RM_CDN', 'https://cdn.nload.xyz');

   // Function to get the client IP address
	function getIp() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	function getStrBetween($string, $start, $end){
	    $string = ' ' . $string;
	    $ini = strpos($string, $start);
	    if ($ini == 0) return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;
	    return substr($string, $ini, $len);
	}

	function getHttpResponse($url) {
		$headers = get_headers($url);
		return substr($headers[0], 9, 3);
	}
	
	function getUrl($url){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
           "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }   
   
?>
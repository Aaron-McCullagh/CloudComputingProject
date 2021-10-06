<?php

header("Access-Control-Allow-Origin: *");

$request = ($_GET['request']);

$paragraph = ($_GET['paragraph']);
$paragraph = urlencode($paragraph);

$word = ($_GET['word']);

$word = urlencode($word);

//acces configuration file
$json = "http://frontend.40036410.qpc.hal.davecutting.uk/url.json";
$str = file_get_contents($json);
$data = json_decode($str, true);
$finalURL = '';

if($request=="wordcheck"){
	
    foreach($data['backendServices']['wordcheck'] as $url){
	  
	// Use get_headers() function
	$headers = @get_headers($url);
	
	 
	// Use condition to check the existence of URL
	if($headers && strpos( $headers[0], '200')) {
		$finalURL = $url;
	//	echo $status = $url." : URL Exist<br>";
		break;
	}
	else {
	//	echo $status = $url." : URL Doesn't Exist<br>";
	}
    }
    $url = "$finalURL?paragraph=$paragraph&word=$word";

} else if ($request=="wordcount"){
    
    foreach($data['backendServices']['wordcount'] as $url){
	  
	// Use get_headers() function
	$headers = @get_headers($url);
	
	 
	// Use condition to check the existence of URL
	if($headers && strpos( $headers[0], '200')) {
		$finalURL = $url;
	//	echo $status = $url." : URL Exist<br>";
		break;
	}
	else {
	//	echo $status = $url." : URL Doesn't Exist<br>";
	}
    }

    $url = "$finalURL?paragraph=$paragraph";

} else if ($request=="keywordcount"){
   
    foreach($data['backendServices']['keywordcount'] as $url){
	  
	// Use get_headers() function
	$headers = @get_headers($url);
	
	 
	// Use condition to check the existence of URL
	if($headers && strpos( $headers[0], '200')) {
		$finalURL = $url;
	//	echo $status = $url." : URL Exist<br>";
		break;
	}
	else {
	//	echo $status = $url." : URL Doesn't Exist<br>";
	}
    }

    $url = "$finalURL?paragraph=$paragraph&word=$word";
}

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_exec($ch);
?>

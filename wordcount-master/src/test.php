<?php
echo "Test Script Starting\n";

//check url.json for wordcount url
$json = "http://frontend.40036410.qpc.hal.davecutting.uk/url.json";
$str = file_get_contents($json);
$data = json_decode($str, true);
$finalURL = '';
foreach($data['backendServices']['wordcount'] as $url){
  
// Use get_headers() function
$headers = @get_headers($url);
 
// Use condition to check the existence of URL
if($headers && strpos( $headers[0], '200')) {
    $finalURL = $url;
   echo "Test Result: HTTP 200 OK - request has succeeded for $finalURL \n";
    break;
}
else {
	echo "Test Result: request has failed for $url\n";    
}
}

$wordcountURL = "$finalURL";

//testing paragraph word count
$paragraph='This is a test paragraph';

$paragraph = urlencode($paragraph);

$expect=5;

$endpoint = "$wordcountURL?paragraph=$paragraph";

$data = file_get_contents($endpoint);

$response = json_decode($data, true);

$answer = $response['answer'];

echo "Test Result: ".$paragraph."=".$answer." (expected: ".$expect.")\n";

//testing error handling - no paragraph entered
$paragraph2='';

$paragraph = urlencode($paragraph);

$expect2="paragraph missing";

$endpoint2 = "$wordcountURL?paragraph=$paragraph2";

$data2 = file_get_contents($endpoint2);

$response2 = json_decode($data2, true);

$answer2 = $response2['answer'];

echo "Test Result: ".$paragraph2."=".$answer2." (expected: ".$expect2.")\n";

$paragraph3='This is a test paragraph This is a test paragraph This is a test paragraph';

$paragraph3 = urlencode($paragraph3);

$expect3=15;

$endpoint3 = "$wordcountURL?paragraph=$paragraph3";

$data3 = file_get_contents($endpoint3);

$response3 = json_decode($data3, true);

    $answer3 = $response3['answer'];

echo "Test Result: ".$paragraph3."=".$answer3." (expected: ".$expect3.")\n";

if (isset($finalURL) && $answer==$expect && $answer2==$expect2 && $answer3 == $expect3)
{
    echo "Test Passed\n";
    exit(0); // exit code 0 - success
}
else
{
    echo "Test Failed\n";
    exit(1); // exit code not zero - error
}

<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');

$output = array(

	"error" => false,
    "string" => "",
	"answer" => 0
);

$paragraph = $_REQUEST['paragraph'];

//error handling - if no paragraph entered
if($paragraph == ''){
	$output['error'] = true;
	$output['answer']= "paragraph missing";
	$output['string']= "null";

} else{
	//invoke word counting function
	$answer=NumberOfWords($paragraph);
	$output['string']=$paragraph;
	$output['answer']=$answer;
}

echo json_encode($output);

exit();
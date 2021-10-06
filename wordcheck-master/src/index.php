<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');

//json object
$output = array(
	"error" => false,
    "string" => "",
	"answer" => 0
);

//paragraph and word values are passed in URL
$paragraph = $_REQUEST['paragraph'];
$word = $_REQUEST['word'];

//error handling

//invalid characters
$invalid = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
$invalid2 = '~[0-9]~';

//check for invalid characters
if(preg_match($invalid, $word)==1){
	$output['error'] = true;
	$output['answer']= "invalid characters entered";
	$output['string']= "null";
}

//check if number entered instead of word
elseif(preg_match($invalid2, $word)==1){
	$output['error'] = true;
	$output['answer']= "numbers entered";
	$output['string']= "null";
} 

//paragraph & word missing
elseif($paragraph == '' && $word == ''){
	$output['error'] = true;
	$output['answer'] = 'paragraph & word missing';
}

//paragraph missing
elseif($paragraph == ''){
	$output['error'] = true;
	$output['answer']='paragraph missing';
}

//word missing
elseif($word == ''){
	$output['error'] = true;
	$output['answer'] = 'word missing';
}

//multiple words entered
elseif(str_word_count($word)>1){
	$output['error'] = true;
	$output['answer'] = 'multiple words entered';
}

//no errors..
else{
	$answer=check($paragraph,$word);
	$output['string']=$paragraph."+".$word."=".$answer;
	$output['answer']=$answer;
}

echo json_encode($output);

exit();

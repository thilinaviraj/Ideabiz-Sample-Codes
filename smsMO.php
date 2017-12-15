<?php


 $inputJSON = file_get_contents('php://input');
 file_put_contents("log.txt",$inputJSON.PHP_EOL.PHP_EOL,FILE_APPEND);
 
$data = json_decode(file_get_contents('php://input'), true);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => $inputJSON
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($data, false, $context);



?>
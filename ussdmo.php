<?php
/**
 * Created by PhpStorm.
 * User: Thilina Viraj
 * Date: 10/20/2017
 * Time: 11:10 PM
 */


header('Content-Type: application/json');
ini_set('display_errors', 0);

//sleep(5);
$body = file_get_contents('php://input');

//Make log
$headers = array();
foreach (getallheaders() as $name => $value) {
    $headers[$name] =  $value;
}
file_put_contents('echo3.txt', date("Y-m-d H:i:s")."-". PHP_EOL . $_SERVER['QUERY_STRING'] . PHP_EOL . $_SERVER['REQUEST_METHOD'] . PHP_EOL . json_encode($headers).PHP_EOL.PHP_EOL.$body . PHP_EOL . PHP_EOL . PHP_EOL, FILE_APPEND);

$body1=json_decode($body,true);
$address=$body1['inboundUSSDMessageRequest']["address"];
$sessionID=$body1['inboundUSSDMessageRequest']['sessionID'];
$shortCode=$body1['inboundUSSDMessageRequest']['shortCode'];
$keyword=$body1['inboundUSSDMessageRequest']['keyword'];
$inboundUSSDMessage=$body1['inboundUSSDMessageRequest']['inboundUSSDMessage'];
$clientCorrelator=$body1['inboundUSSDMessageRequest']['clientCorrelator'];
$notifyURL=$body1['inboundUSSDMessageRequest']['responseRequest']['notifyURL'];
$callbackData=$body1['inboundUSSDMessageRequest']['responseRequest']['callbackData'];
$ussdAction='mtfin';
$deliveryStatus='SENT';
$outboundUSSDMessage='Hello World!';

#Use whatever notify URL below
#$notifyURL_out='https://test.apps/notify.php';

$jsonObject=array('outboundUSSDMessageRequest'=>array('address'=>$address,'shortCode'=>$shortCode,'keyword'=>$keyword,'deliveryStatus'=>$deliveryStatus,'outboundUSSDMessage'=>$outboundUSSDMessage,'clientCorrelator'=>$clientCorrelator,'responseRequest'=>array('notifyURL'=>$notifyURL,'callbackData'=>$callbackData),'ussdAction'=>$ussdAction));
$sJson=json_encode($jsonObject,true);


echo $sJson;


?>

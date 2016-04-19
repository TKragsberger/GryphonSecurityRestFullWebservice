<?php
header("Content-Type:application/json");
include("../dataSource.php");
$dataSource = new dataSource();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $result = $dataSource->createNFC($data);
    echo $result;
   // var_dump($result);
    deliver_response(200, true);
} else {
    deliver_response(400, false);
}

function deliver_response($status, $status_message){
    header("HTTP/1.1 $status $status_message");

    $response = boolval($status_message);
    
    $json_response = json_encode($response);
    echo $json_response;
}

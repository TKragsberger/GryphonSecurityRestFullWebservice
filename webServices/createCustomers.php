<?php
header("Content-Type:application/json");
include("../dataSource.php");
$dataSource = new dataSource();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $result = $dataSource->createCustomers($data);
 
   // var_dump($result);
    deliver_response(200, true, $result);
} else {
    deliver_response(400, false,null);
}

function deliver_response($status, $status_message, $result){
    header("HTTP/1.1 $status $status_message");

    $response = boolval($result);
    
    $json_response = json_encode($response);
    echo $json_response;
}

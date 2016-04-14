<?php
header("Content-Type:application/json");
include("controller.php");
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $user = getUser($data);
    
    if(empty($user)){
        deliver_response(200, false, NULL);
    }else{
        deliver_response(200, true, $user);
    }
} else {
    deliver_response(400, false, NULL);
}

function deliver_response($status, $status_message, $user){
    header("HTTP/1.1 $status $status_message");
    
    $response['userId'] = $user->getId();
    $response['userFirstName'] = $user->getFirstName();
    $response['userLastName'] = $user->getLastName();
    
    $json_response = json_encode($response);
    echo $json_response;
}

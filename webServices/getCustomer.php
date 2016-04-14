<?php
header("Content-Type:application/json");
include("../dataSource.php");
$dataSource = new dataSource();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $cutomer = $dataSource->getCustomer($data);
    
    if(empty($customer->getCustomerName())){
        deliver_response(200, false, NULL);
    }else{
        deliver_response(200, true, $user);
    }
} else {
    deliver_response(400, false, NULL);
}

function deliver_response($status, $status_message, $user){
    header("HTTP/1.1 $status $status_message");

    $response['CustomerName'] = $user->getCustomerName();
    $response['CustomerNumber'] = $user->getCustomerNumber();
    $response['StreetHouseNumber'] = $user->getStreetHouseNumber();
    $response['ZipCode'] = $user->getZipCode();
    $response['City'] = $user->getCity();
    $response['Phonenumber'] = $user->getPhonenumber();
    
    $json_response = json_encode($response);
    echo $json_response;
}


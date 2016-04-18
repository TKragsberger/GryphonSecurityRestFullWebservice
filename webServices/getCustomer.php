<?php
header("Content-Type:application/json");
include("../dataSource.php");
$dataSource = new dataSource();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $customer = $dataSource->getCustomer($data);
    if(empty($customer->getCustomerName())){
        deliver_response(200, false, NULL);
    }else{
        deliver_response(200, true, $customer);
    }
} else {
    deliver_response(400, false, NULL);
}

function deliver_response($status, $status_message, $customer){
    header("HTTP/1.1 $status $status_message");

    $response['CustomerName'] = $customer->getCustomerName();
    $response['CustomerNumber'] = $customer->getCustomerNumber();
    $response['StreetHouseNumber'] = $customer->getStreetHouseNumber();
    $response['ZipCode'] = $customer->getZipCode();
    $response['City'] = $customer->getCity();
    $response['Phonenumber'] = $customer->getPhonenumber();
    
    $json_response = json_encode($response);
    echo $json_response;
}


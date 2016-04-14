<?php
class customer{
    
    
    private $customerName;
    private $customerNumber;
    private $streetHouseNumber;
    private $zipCode;
    private $city;
    private $phonenumber;
    
    function __construct($customerName, $customerNumber, $streetHouseNumber, $zipCode, $city, $phonenumber) {
        $this->customerName = $customerName;
        $this->customerNumber = $customerNumber;
        $this->streetHouseNumber = $streetHouseNumber;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->phonenumber = $phonenumber;
    }
    
    function getCustomerName() {
        return $this->customerName;
    }

    function getCustomerNumber() {
        return $this->customerNumber;
    }

    function getStreetHouseNumber() {
        return $this->streetHouseNumber;
    }

    function getZipCode() {
        return $this->zipCode;
    }

    function getCity() {
        return $this->city;
    }

    function getPhonenumber() {
        return $this->phonenumber;
    }

    function setCustomerName($customerName) {
        $this->customerName = $customerName;
    }

    function setCustomerNumber($customerNumber) {
        $this->customerNumber = $customerNumber;
    }

    function setStreetHouseNumber($streetHouseNumber) {
        $this->streetHouseNumber = $streetHouseNumber;
    }

    function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setPhonenumber($phonenumber) {
        $this->phonenumber = $phonenumber;
    }


}


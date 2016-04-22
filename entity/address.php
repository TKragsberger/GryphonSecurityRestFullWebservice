<?php

class address{
    
    private $addressId;
    private $adressName;
    private $latitude;
    private $longtitude;
  
    function __construct($addressId, $adressName, $latitude, $longtitude) {
        $this->addressId = $addressId;
        $this->adressName = $adressName;
        $this->latitude = $latitude;
        $this->longtitude = $longtitude;
    }

    function getAddressId() {
        return $this->addressId;
    }
    
    function setAddressId($addressId) {
        $this->addressId = $addressId;
    }
    
    function getAddressName() {
        return $this->adressName;
    }

    function setAddressName($adressName) {
        $this->adressName = $adressName;
    }
    function getLatitude() {
        return $this->latitude;
    }

    function getLongtitude() {
        return $this->longtitude;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongtitude($longtitude) {
        $this->longtitude = $longtitude;
    }



    
}


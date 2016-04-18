<?php

class address{
    
    private $adressName;
    private $latitude;
    private $longtitude;
  
    function __construct($adressName, $latitude, $longtitude) {
        $this->adressName = $adressName;
        $this->latitude = $latitude;
        $this->longtitude = $longtitude;
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


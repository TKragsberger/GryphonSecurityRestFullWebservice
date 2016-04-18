<?php

class address{
    
    private $adress;
    private $id;
  
    function __construct($adress, $id) {
        $this->adress = $adress;
        $this->id = $id;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

   

    function getTheAdress() {
        return $this->adress;
    }

    function setTheAdress($adress) {
        $this->adress = $adress;
    }


    
}


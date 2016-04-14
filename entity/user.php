<?php
class User {
    
    private $id;
    private $firstName;
    private $lastName;
    
    function __construct($id, $firstName, $lastName) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
    
    function getFirstName() {
        return $this->firstName;
    }
    function getLastName() {
        return $this->lastName;
    }
    
    function getId() {
        return $this->id;
    }
    
    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    
}


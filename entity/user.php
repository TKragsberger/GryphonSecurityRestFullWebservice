<?php
class User {
    
    private $id;
    private $firstname;
    private $lastname;
    
    function __construct($id, $firstname, $lastname) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }
    
    function getFirstname() {
        return $this->firstname;
    }
    function getLastname() {
        return $this->lastname;
    }
    
    function getId() {
        return $this->id;
    }
    
    function setFirstName($firstname) {
        $this->firstname = $firstname;
    }
    function setLastName($lastname) {
        $this->lastname = $lastname;
    }
    
}


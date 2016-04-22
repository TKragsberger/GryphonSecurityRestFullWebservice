<?php

class Employee{
    
    private $employeeId;
    private $firstname;
    private $lastname;
    function __construct($employeeId, $firstname, $lastname) {
        $this->employeeId = $employeeId;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }
    function getEmployeeId() {
        return $this->employeeId;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function setEmployeeId($employeeId) {
        $this->employeeId = $employeeId;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }


}

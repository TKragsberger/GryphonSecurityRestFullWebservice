<?php


class NFC {
    
    private $rangeCheck;
    private $tagAddress;
    private $time;
    private $user;
    function __construct($rangeCheck, $tagAddress, $time, $user) {
        $this->rangeCheck = $rangeCheck;
        $this->tagAddress = $tagAddress;
        $this->time = $time;
        $this->user = $user;
    }

    function getRangeCheck() {
        return $this->rangeCheck;
    }

    function getTagAddress() {
        return $this->tagAddress;
    }

    function getTime() {
        return $this->time;
    }

    function getUser() {
        return $this->user;
    }

    function setRangeCheck($rangeCheck) {
        $this->rangeCheck = $rangeCheck;
    }

    function setTagAddress($tagAddress) {
        $this->tagAddress = $tagAddress;
    }

    function setTime($time) {
        $this->time = $time;
    }

    function setUser($user) {
        $this->user = $user;
    }


    
    
    
}

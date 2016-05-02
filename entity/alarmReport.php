<?php

class alarmReport{
    
    private $customerName;
    private $customerNumber;
    private $streetAndHouseNumber;
    private $zipCode;
    private $city;
    private $phonenumber;
    private $date;
    private $time;
    private $zone;
    private $burglaryVandalism;
    private $windowDoorClosed;
    private $apprehendedPerson;
    private $staffError;
    private $nothingToReport;
    private $technicalError;
    private $unknownReason;
    private $other;
    private $cancelDuringEmergency;
    private $coverMade;
    private $remark;
    private $name;
    private $installer;
    private $controlCenter;
    private $guardRadioedDate;
    private $guardRadioedFrom;
    private $guardRadioedTo;
    private $arrivedAt;
    private $done;
    private $user;
    function __construct($customerName, $customerNumber, $streetAndHouseNumber, $zipCode, $city, $phonenumber, $date, $time, $zone, $burglaryVandalism, $windowDoorClosed, $apprehendedPerson, $staffError, $nothingToReport, $technicalError, $unknownReason, $other, $cancelDuringEmergency, $coverMade, $remark, $name, $installer, $controlCenter, $guardRadioedDate, $guardRadioedFrom, $guardRadioedTo, $arrivedAt, $done, $user) {
        $this->customerName = $customerName;
        $this->customerNumber = $customerNumber;
        $this->streetAndHouseNumber = $streetAndHouseNumber;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->phonenumber = $phonenumber;
        $this->date = $date;
        $this->time = $time;
        $this->zone = $zone;
        $this->burglaryVandalism = $burglaryVandalism;
        $this->windowDoorClosed = $windowDoorClosed;
        $this->apprehendedPerson = $apprehendedPerson;
        $this->staffError = $staffError;
        $this->nothingToReport = $nothingToReport;
        $this->technicalError = $technicalError;
        $this->unknownReason = $unknownReason;
        $this->other = $other;
        $this->cancelDuringEmergency = $cancelDuringEmergency;
        $this->coverMade = $coverMade;
        $this->remark = $remark;
        $this->name = $name;
        $this->installer = $installer;
        $this->controlCenter = $controlCenter;
        $this->guardRadioedDate = $guardRadioedDate;
        $this->guardRadioedFrom = $guardRadioedFrom;
        $this->guardRadioedTo = $guardRadioedTo;
        $this->arrivedAt = $arrivedAt;
        $this->done = $done;
        $this->user = $user;
    }

    function getCustomerName() {
        return $this->customerName;
    }

    function getCustomerNumber() {
        return $this->customerNumber;
    }

    function getStreetAndHouseNumber() {
        return $this->streetAndHouseNumber;
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

    function getDate() {
        return $this->date;
    }

    function getTime() {
        return $this->time;
    }

    function getZone() {
        return $this->zone;
    }

    function getBurglaryVandalism() {
        return $this->burglaryVandalism;
    }

    function getWindowDoorClosed() {
        return $this->windowDoorClosed;
    }

    function getApprehendedPerson() {
        return $this->apprehendedPerson;
    }

    function getStaffError() {
        return $this->staffError;
    }

    function getNothingToReport() {
        return $this->nothingToReport;
    }

    function getTechnicalError() {
        return $this->technicalError;
    }

    function getUnknownReason() {
        return $this->unknownReason;
    }

    function getOther() {
        return $this->other;
    }

    function getCancelDuringEmergency() {
        return $this->cancelDuringEmergency;
    }

    function getCoverMade() {
        return $this->coverMade;
    }

    function getRemark() {
        return $this->remark;
    }

    function getName() {
        return $this->name;
    }

    function getInstaller() {
        return $this->installer;
    }

    function getControlCenter() {
        return $this->controlCenter;
    }

    function getGuardRadioedDate() {
        return $this->guardRadioedDate;
    }

    function getGuardRadioedFrom() {
        return $this->guardRadioedFrom;
    }

    function getGuardRadioedTo() {
        return $this->guardRadioedTo;
    }

    function getArrivedAt() {
        return $this->arrivedAt;
    }

    function getDone() {
        return $this->done;
    }

    function getEmployee() {
        return $this->user;
    }

    function setCustomerName($customerName) {
        $this->customerName = $customerName;
    }

    function setCustomerNumber($customerNumber) {
        $this->customerNumber = $customerNumber;
    }

    function setStreetAndHouseNumber($streetAndHouseNumber) {
        $this->streetAndHouseNumber = $streetAndHouseNumber;
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

    function setDate($date) {
        $this->date = $date;
    }

    function setTime($time) {
        $this->time = $time;
    }

    function setZone($zone) {
        $this->zone = $zone;
    }

    function setBurglaryVandalism($burglaryVandalism) {
        $this->burglaryVandalism = $burglaryVandalism;
    }

    function setWindowDoorClosed($windowDoorClosed) {
        $this->windowDoorClosed = $windowDoorClosed;
    }

    function setApprehendedPerson($apprehendedPerson) {
        $this->apprehendedPerson = $apprehendedPerson;
    }

    function setStaffError($staffError) {
        $this->staffError = $staffError;
    }

    function setNothingToReport($nothingToReport) {
        $this->nothingToReport = $nothingToReport;
    }

    function setTechnicalError($technicalError) {
        $this->technicalError = $technicalError;
    }

    function setUnknownReason($unknownReason) {
        $this->unknownReason = $unknownReason;
    }

    function setOther($other) {
        $this->other = $other;
    }

    function setCancelDuringEmergency($cancelDuringEmergency) {
        $this->cancelDuringEmergency = $cancelDuringEmergency;
    }

    function setCoverMade($coverMade) {
        $this->coverMade = $coverMade;
    }

    function setRemark($remark) {
        $this->remark = $remark;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setInstaller($installer) {
        $this->installer = $installer;
    }

    function setControlCenter($controlCenter) {
        $this->controlCenter = $controlCenter;
    }

    function setGuardRadioedDate($guardRadioedDate) {
        $this->guardRadioedDate = $guardRadioedDate;
    }

    function setGuardRadioedFrom($guardRadioedFrom) {
        $this->guardRadioedFrom = $guardRadioedFrom;
    }

    function setGuardRadioedTo($guardRadioedTo) {
        $this->guardRadioedTo = $guardRadioedTo;
    }

    function setArrivedAt($arrivedAt) {
        $this->arrivedAt = $arrivedAt;
    }

    function setDone($done) {
        $this->done = $done;
    }

    function setUser($user) {
        $this->user = $user;
    }


    
    
    
    
    
}


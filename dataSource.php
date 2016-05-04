<?php

include("../entity/Employee.php");
include("../entity/customer.php");
include("../entity/alarmReport.php");
include("../entity/address.php");
include("../entity/NFC.php");
include("../connection.php");

class dataSource {

     private static $conn;
//   function __construct(){
//       static::$conn = $this->getConnection();  
//       echo static::$conn;
//}
    
   

    public function getConnection() {
        if (NULL === static::$conn) {
            static::$conn = new connection();
        }
        return static::$conn->getConnection();
    }


    public function getEmployee($id) {
       $conn = $this->getConnection();
       $conn->query('set NAMES utf8');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT EmployeeId, Firstname, Lastname FROM SECURITY_APP_EMPLOYEE WHERE EmployeeId =?");
        $stmt->bind_param("s", htmlspecialchars($id));
        $stmt->execute();
        $stmt->bind_result($employeeId, $employeeFirstname, $employeeLastname);


        $stmt->fetch();
        $stmt->close();
        $employee = new Employee($employeeId, $employeeFirstname, $employeeLastname);

        return $employee;
    }

    public function getCustomer($id) {
        $conn = $this->getConnection();
        $conn->query('set NAMES utf8');
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT * FROM SECURITY_APP_CUSTOMER WHERE CustomerNumber =?");
        $stmt->bind_param("s", htmlspecialchars($id));
        $stmt->execute();
        $stmt->bind_result($customerNumber, $customerName, $streetAndHouseNumber, $zipCode, $city, $phonenumber);


        $stmt->fetch();
        $stmt->close();
        $customer = new customer($customerName, $customerNumber, $streetAndHouseNumber, $zipCode, $city, $phonenumber);

        return $customer;
    }

    public function createAlarmReport($alarmreport) {
        $conn = $this->getConnection();
        $conn->query('set NAMES utf8');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT INTO SECURITY_APP_ALARMREPORT (AlarmReportDate ,AlarmReportTime ,AlarmReportZone ,BurglaryVandalism, "
                . "WindowDoorClosed, ApprehendedPerson, StaffError, NothingToReport, TechnicalError, UnknownReason, AlarmReportOther, "
                . "ReasonCodeId, CancelDuringEmergency, CancelDuringEmergencyTime, CoverMade, CoverMadeBy, AlarmReportRemark, AlarmReportName, "
                . "Installer, ControlCenter, GuardRadioedDate, GuardRadioedFrom, GuardRadioedTo, ArrivedAt, Done, EmployeeId, ReportCreated, "
                . "CustomerName, CustomerNumber, StreetAndHouseNumber, ZipCode, City, Phonenumber) "
                . "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("sssssssssssssssssssssssssssssssss", $alarmreport->Date, $alarmreport->Time, htmlspecialchars($alarmreport->Zone)
                , htmlspecialchars($this->convertBoolean($alarmreport->BurglaryVandalism)), htmlspecialchars($this->convertBoolean($alarmreport->WindowDoorClosed))
                , htmlspecialchars($this->convertBoolean($alarmreport->ApprehendedPerson)), htmlspecialchars($this->convertBoolean($alarmreport->StaffError))
                , htmlspecialchars($this->convertBoolean($alarmreport->NothingToReport)), htmlspecialchars($this->convertBoolean($alarmreport->TechnicalError))
                , htmlspecialchars($this->convertBoolean($alarmreport->UnknownReason)), htmlspecialchars($this->convertBoolean($alarmreport->Other))
                , htmlspecialchars($this->convertNull($alarmreport->ReasonCodeId)), htmlspecialchars($this->convertBoolean($alarmreport->CancelDuringEmergency))
                , $this->convertNull($alarmreport->CancelDuringEmergencyTime), htmlspecialchars($this->convertBoolean($alarmreport->CoverMade))
                , htmlspecialchars($this->convertNull($alarmreport->CoverMadeBy)), htmlspecialchars($alarmreport->Remark), htmlspecialchars($alarmreport->Name)
                , htmlspecialchars($alarmreport->Installer), htmlspecialchars($alarmreport->ControlCenter), htmlspecialchars($alarmreport->GuardRadioedDate)
                , htmlspecialchars($alarmreport->GuardRadioedFrom), htmlspecialchars($alarmreport->GuardRadioedTo), htmlspecialchars($alarmreport->ArrivedAt)
                , htmlspecialchars($alarmreport->Done), htmlspecialchars($alarmreport->EmployeeId), htmlspecialchars($alarmreport->ReportCreated)
                , htmlspecialchars($alarmreport->CustomerName), htmlspecialchars($alarmreport->CustomerNumber), htmlspecialchars($alarmreport->StreetAndHouseNumber)
                , htmlspecialchars($alarmreport->ZipCode), htmlspecialchars($alarmreport->City), htmlspecialchars($alarmreport->Phonenumber));

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function convertBoolean($boolean) {
        if ($boolean) {
            return 1;
        } else {
            return 0;
        }
    }

    public function convertNull($null) {
        if ($null != NULL) {
            return "'" . $null . "'";
        } else {
            return "NULL";
        }
    }

    public function createAlarmReports($alarmreports) {

        foreach ($alarmreports as $alarmreport) {
            if (!$this->createAlarmReport($alarmreport)) {
                return false;
            }
        }
        return true;
    }

    public function getAddress($data) {
        $conn = $this->getConnection();
        $conn->query('set NAMES utf8');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT TagAddress, Longtitude, Latitude FROM SECURITY_APP_ADDRESS WHERE SearchParameter =?");
        $stmt->bind_param("s", htmlspecialchars($data));

        $stmt->execute();
        $stmt->bind_result($tagAddress, $longtitude, $latitude);
        $stmt->fetch();
        $stmt->close();
        $address = new address($data, $tagAddress, $latitude, $longtitude);
        return $address;
    }

    public function createNFC($nfc) {
        $conn = $this->getConnection();
        $conn->query('set NAMES utf8');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT INTO SECURITY_APP_NFC (RangeCheck,NFCTime,EmployeeId,AddressId) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", htmlspecialchars($this->convertBoolean($nfc->RangeCheck)), htmlspecialchars($nfc->Time), htmlspecialchars($nfc->EmployeeId), htmlspecialchars($nfc->AddressId));
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function createNFCs($nfcs) {
        foreach ($nfcs as $nfc) {
            if (!$this->createNFC($nfc)) {
                return false;
            }
        }
        return true;
    }

    public function createCustomer($customer) {
        $conn = $this->getConnection();
        $conn->query('set NAMES utf8');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT INTO SECURITY_APP_CUSTOMER (CustomerNumber,CustomerName,StreetAndHouseNumber,ZipCode,City,Phonenumber) VALUES(?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", htmlspecialchars($customer->CustomerNumber), htmlspecialchars($customer->CustomerName), htmlspecialchars($customer->StreetAndHouseNumber), htmlspecialchars($customer->ZipCode), htmlspecialchars($customer->City), htmlspecialchars($customer->Phonenumber));

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function createCustomers($customers) {
        foreach ($customers as $customer) {
            if (!$this->createCustomer($customer)) {
                return false;
            }
        }
        return true;
    }



   







   

}

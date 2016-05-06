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

    public function createAlarmReportTemp($alarmreport) {
        $conn = $this->getConnection();
        $conn->query('set NAMES utf8');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $date = $alarmreport->Date;
        $time = $alarmreport->Time;
        $zone = $alarmreport->Zone;
        $burglaryVandalism = $this->convertBoolean($alarmreport->BurglaryVandalism);
        $windowDoorClosed = $this->convertBoolean($alarmreport->WindowDoorClosed);
        $apprehendedPerson = $this->convertBoolean($alarmreport->ApprehendedPerson);
        $staffError = $this->convertBoolean($alarmreport->StaffError);
        $unknownReason = $this->convertBoolean($alarmreport->UnknownReason);
        $technicalError = $this->convertBoolean($alarmreport->TechnicalError);
        $nothingToReport = $this->convertBoolean($alarmreport->NothingToReport);
        $other = $this->convertBoolean($alarmreport->Other);
        $reasonCodeId = $alarmreport->ReasonCodeId;
        $cancelDuringEmergency = $this->convertBoolean($alarmreport->CancelDuringEmergency);
        $cancelDuringEmergencyTime = $alarmreport->CancelDuringEmergencyTime;
        $coverMade = $this->convertBoolean($alarmreport->CoverMade);
        $coverMadeBy = $this->convertNull($alarmreport->CoverMadeBy);
        $remark = $alarmreport->Remark;
        $name = $alarmreport->Name; 
        $installer = $alarmreport->Installer;
        $controlCenter = $alarmreport->ControlCenter;
        $guardRadioedDate = $alarmreport->GuardRadioedDate;
        $guardRadioedFrom = $alarmreport->GuardRadioedFrom;
        $guardRadioedTo = $alarmreport->GuardRadioedTo;
        $arrivedAt = $alarmreport->ArrivedAt;
        $done = $alarmreport->Done;
        $employeeId = $alarmreport->EmployeeId;
        $reportCreated = $alarmreport->ReportCreated;
        $customerName = $alarmreport->CustomerName;
        $customerNumber = $alarmreport->CustomerNumber."";
        $streetAndHouseNumber = $alarmreport->StreetAndHouseNumber;
        $zipCode = $alarmreport->ZipCode;
        $city = $alarmreport->City;
        $phonenumber = $alarmreport->Phonenumber;
        $code = "000";
        
        $stmt = $conn->prepare("SELECT Code FROM SECURITY_APP_REASONCODE WHERE ReasonCodeId =?");
        $stmt->bind_param("s", $reasonCodeId);
        $result = $stmt->execute();
        $stmt->bind_result($code);
        $stmt->fetch();
        $stmt->close();
        $reasonCode = $reasonCodeId . " -  " . $code; 
        
        $stmt = $conn->prepare("SELECT Firstname, Lastname FROM SECURITY_APP_EMPLOYEE WHERE EmployeeId =?");
        $stmt->bind_param("s", $employeeId);
        $stmt->execute();
        $stmt->bind_result($firstname, $lastname);
        $stmt->fetch();
        $stmt->close();
        
        $name = $firstname . " " . $lastname; 
        $stmt = $conn->prepare("INSERT INTO alarm_rapport (Kundenavn, Kundenr, Addresse, Postnr, "
                . "`By`, Tlf, Dato, kl, Zone, Indbrud_haevaerk, Vindue_doer_lukket, "
                . "Antruffen_person, Personalefejl, Ukendt_aarsag, Intet_at_bemaerke, Teknisk_fejl, Andet, Aarsagkode, "
                . "Afmeldt_under_udrykning, Afmeldt_under_udrykning_kl, Afdaekning_foretaget, Afdaekning_foretaget_af, Bemaerkninger, "
                . "Vagt, Installatoer, Kontrolcentral, Vagt_rekviveret_den_dato, Vagt_rekviveret_den_kl_fra, "
                . "Vagt_rekviveret_den_kl_tl, Vagt_rekviveret_den_fremme, Vagt_rekviveret_den_faerdig) "
                . "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("sssssssssssssssssssssssssssssss", $customerName, $customerNumber, $streetAndHouseNumber
                , $zipCode, $city, $phonenumber
                , $date, $time
                , $zone, $burglaryVandalism
                , $windowDoorClosed, $apprehendedPerson
                , $staffError, $unknownReason
                , $nothingToReport, $technicalError
                , $other, $reasonCode, $cancelDuringEmergency
                , $cancelDuringEmergencyTime, $coverMade, $coverMadeBy
                , $remark, $name, $installer
                , $controlCenter, $guardRadioedDate, $guardRadioedFrom
                , $guardRadioedTo, $arrivedAt, $done);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function createAlarmReportsTemp($alarmreports) {
        foreach ($alarmreports as $alarmreport) {
            if (!$this->createAlarmReportTemp($alarmreport)) {
                return false;
            }
        }
        return true;
    }

    public function createNFCTemp($nfc) {

        $conn = $this->getConnection();
        $conn->query('set NAMES utf8');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $briknummer = $nfc->AddressId;
        
        $stmt = $conn->prepare("SELECT `id`, virksomhed, navn, MD5 FROM checkpoint_brik WHERE MD5 =?");
        $stmt->bind_param("s", $briknummer);

        $stmt->execute();
        $stmt->bind_result($id, $virksomhed, $navn, $c_hash);
        $stmt->fetch();
        $stmt->close();
        
        $stmt = $conn->prepare("INSERT INTO checkpoint_data (briknummer, virksomhed, navn, c_hash) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $id, $virksomhed, $navn, $c_hash);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function createNFCsTemp($nfcs) {

        foreach ($nfcs as $nfc) {
            if (!$this->createNFCTemp($nfc)) {
                return false;
            }
        }
        return true;
    }
    
    public function getAddressTemp($data) {
        $conn = $this->getConnection();
        $conn->query('set NAMES utf8');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $searchParameter = htmlspecialchars($data);
        
        $stmt = $conn->prepare("SELECT navn FROM checkpoint_brik WHERE MD5 =?");
        $stmt->bind_param("s", $searchParameter);

        $stmt->execute();
        $stmt->bind_result($navn);
        $stmt->fetch();
        $stmt->close();
        $latitude = 12;
        $longtitude = 55;
        $address = new address($data, $navn, $latitude, $longtitude);
        return $address;
    }
   
}

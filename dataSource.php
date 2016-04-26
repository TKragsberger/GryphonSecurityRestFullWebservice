<?php

include("../entity/Employee.php");
include("../entity/customer.php");
include("../entity/alarmReport.php");
include("../entity/address.php");
include("../entity/NFC.php");
include("../connection.php");

class dataSource {

    private static $conn;

    private function getConnection() {
        if (NULL === static::$conn) {
            static::$conn = new connection();
        }
        return static::$conn->getConnection();
    }

    public function getEmployee($id) {
        $employees = array(
            1 => new Employee(1, "Thomas", "Kragsberger"),
            2 => new Employee(2, "Mike", "Heerwagen"),
            3 => new Employee(3, "Jannik", "Vangsgaard")
        );

        foreach ($employees as $userId => $user) {
            if ($userId == $id) {
//                var_dump($user);
                return $user;
                break;
            }
        }
        return NULL;
    }

    public function getEmployeeDB($id) {
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

    public function getCustomerDB($id) {
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

    public function createAlarmReportDB($alarmreport) {
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

    public function createAlarmReportsDB($alarmreports) {

        foreach ($alarmreports as $alarmreport) {
            if (!$this->createAlarmReportDB($alarmreport)) {
                return false;
            }
        }
        return true;
    }

    public function getAddressDB($data) {
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

    public function createNFCDB($nfc) {
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

    public function createNFCsDB($nfcs) {
        foreach ($nfcs as $nfc) {
            if (!$this->createNFCDB($nfc)) {
                return false;
            }
        }
        return true;
    }

    public function createCustomerDB($customer) {
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

    public function createCustomersDB($customers) {
        foreach ($customers as $customer) {
            if (!$this->createCustomerDB($customer)) {
                return false;
            }
        }
        return true;
    }

    public function getCustomer($id) {
        $customers = array(
            1 => new Customer("Thomas Kragsberger", 1, "Bybækterrasserne 137 D", 3520, "Farum", 27708834),
            2 => new customer("Jannik Vangsgaard", 2, "Hovedgade 40", 2860, "Søborg", 22250898),
            3 => new customer("Mike Heerwagen", 3, "Kollegiebakken 9", 2800, "Lyngby", 41836990)
        );

        foreach ($customers as $customerId => $customer) {
            if ($customerId == $id) {
                return $customer;
                break;
            }
        }
        return NULL;
    }

    public function createAlarmReport($alarmreport) {
        /**       $returnAlarmReport = new alarmReport($alarmreport->CustomerName, $alarmreport->CustomerNumber, 
          $alarmreport->StreetAndHouseNumber, $alarmreport->ZipCode, $alarmreport->City,
          $alarmreport->Phonenumber, $alarmreport->Date, $alarmreport->Time, $alarmreport->Zone,
          $alarmreport->BurglaryVandalism, $alarmreport->WindowDoorClosed,
          $alarmreport->ApprehendedPerson, $alarmreport->StaffError,
          $alarmreport->NothingToReport, $alarmreport->TechnicalError,
          $alarmreport->UnknownReason, $alarmreport->Other, $alarmreport->CancelDuringEmergency,
          $alarmreport->CoverMade, $alarmreport->Remark, $alarmreport->Name,
          $alarmreport->Installer, $alarmreport->ControlCenter, $alarmreport->GuardRadioedDate,
          $alarmreport->GuardRadioedFrom, $alarmreport->GuardRadioedTo, $alarmreport->ArrivedAt,
          $alarmreport->Done, $alarmreport->User);
         */
        return $alarmreport;
    }

    public function createAlarmReports($alarmreports) {
        //var_dump($alarmreports);
        /**        $returnAlarmReport = new alarmReport($alarmreports[0]->CustomerName, $alarmreports[0]->CustomerNumber, 
          $alarmreports[0]->StreetAndHouseNumber, $alarmreports[0]->ZipCode, $alarmreports[0]->City,
          $alarmreports[0]->Phonenumber, $alarmreports[0]->Date, $alarmreports[0]->Time, $alarmreports[0]->Zone,
          $alarmreports[0]->BurglaryVandalism, $alarmreports[0]->WindowDoorClosed,
          $alarmreports[0]->ApprehendedPerson, $alarmreports[0]->StaffError,
          $alarmreports[0]->NothingToReport, $alarmreports[0]->TechnicalError,
          $alarmreports[0]->UnknownReason, $alarmreports[0]->Other, $alarmreports[0]->CancelDuringEmergency,
          $alarmreports[0]->CoverMade, $alarmreports[0]->Remark, $alarmreports[0]->Name,
          $alarmreports[0]->Installer, $alarmreports[0]->ControlCenter, $alarmreports[0]->GuardRadioedDate,
          $alarmreports[0]->GuardRadioedFrom, $alarmreports[0]->GuardRadioedTo, $alarmreports[0]->ArrivedAt,
          $alarmreports[0]->Done, $alarmreports[0]->User);
          //  echo 'Thomas..' . $returnAlarmReport->getCustomerName();
         */
        return $alarmreports;
    }

    public function getAddress($id) {
        $addresses = array(
            1 => new address("Københavns hovedbanegård", 55.6928897, 12.547805),
            2 => new address("Lyngby St.", 55.6928897, 12.502867899999956),
            3 => new address("Farum St.", 55.8117694, 12.373767000000043)
        );

        foreach ($addresses as $addressid => $address) {
            if ($addressid == $id) {
                return $address;
                break;
            }
        }
        // var_dump($address);
        return NULL;
    }

    public function createNFC($nfc) {

        $returnNFC = new NFC($nfc->RangeCheck, $nfc->TagAddress, $nfc->Time, $nfc->User);
        if ($returnNFC->getTagAddress() != "" && $returnNFC->getUser() != "") {
            return true;
        }
        return false;
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
        $returnCustomer = new customer($customer->CustomerName, $customer->CustomerNumber, $customer->StreetHouseNumber, $customer->ZipCode, $customer->City, $customer->Phonenumber);

        if ($returnCustomer->getCustomerName() != "" && $returnCustomer->getCustomerNumber() != "" && $returnCustomer->getStreetHouseNumber() != "" && $returnCustomer->getZipCode() != "" && $returnCustomer->getCity() != "" && $returnCustomer->getPhonenumber() != "") {
            return true;
        }return false;
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

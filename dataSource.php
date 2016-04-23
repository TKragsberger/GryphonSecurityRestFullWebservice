<?php
include("../entity/Employee.php");
include("../entity/customer.php");
include("../entity/alarmReport.php");
include("../entity/address.php");
include("../entity/NFC.php");
include("../connection.php");
class dataSource{
    private static $conn;
    
    private function getConnection(){
        if (NULL===static::$conn){
            static::$conn = new connection();
        }
        return static::$conn->getConnection();
    }

    public function getEmployee($id){
        $employees = array(
        1 => new Employee(1, "Thomas", "Kragsberger"),
        2 => new Employee(2, "Mike", "Heerwagen"),
        3 => new Employee(3, "Jannik", "Vangsgaard")
        );

        foreach($employees as $userId => $user){
            if($userId == $id){
//                var_dump($user);
                return $user;
                break;
            }
        }
        return NULL;
    }
    public function getEmployeeDB($id){
//        echo 'HEJ MIKE';
           $conn = $this->getConnection();
//         echo 'HEJ THOMAS';
         if ($conn->connect_error) {
//            echo 'HEJ MIG';
            die("Connection failed: " . $conn->connect_error);
            } 
            $sql = "SELECT * FROM EMPLOYEE WHERE EmployeeId =" . $id;
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $employee = new Employee((int)$row['EmployeeId'], $row['Firstname']."", $row['Lastname']."");
//            echo 'kig her mofos------------------------------------';


//            var_dump($employee);
        
        return $employee;
    }
    public function getCustomerDB($id){
         $conn = $this->getConnection();
         if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
         }
         $sql = "SELECT * FROM CUSTOMER WHERE CustomerNumber =" . $id;
         
         $result = $conn->query($sql);
         $row = $result->fetch_assoc();
            $customer = new customer($row['CustomerName'], $row['CustomerNumber'], $row['StreetAndHouseNumber'], $row['ZipCode'], $row['City'], $row['Phonenumber']);
            
        return $customer;
    }
    public function createAlarmReportDB($alarmreport){
         $conn = $this->getConnection();
         if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
         }
//         var_dump($alarmreport);
//         echo '------------------------------------------------------------------------------------------';
         $sql = "INSERT INTO ALARMREPORT (AlarmReportDate,AlarmReportTime,AlarmReportZone,BurglaryVandalism, WindowDoorClosed,ApprehendedPerson,StaffError,NothingToReport,TechnicalError,UnknownReason,AlarmReportOther,ReasonCodeId,CancelDuringEmergency,CancelDuringEmergencyTime,CoverMade,CoverMadeBy,AlarmReportRemark,AlarmReportName,Installer,ControlCenter,GuardRadioedDate,GuardRadioedFrom,GuardRadioedTo,ArrivedAt,Done,EmployeeId,ReportCreated,CustomerName,CustomerNumber,StreetAndHouseNumber,ZipCode,City,Phonenumber) "
                 . "VALUES ('$alarmreport->Date', '$alarmreport->Time', '$alarmreport->Zone',".$this->convertBoolean($alarmreport->BurglaryVandalism).",".$this->convertBoolean($alarmreport->WindowDoorClosed).",".$this->convertBoolean($alarmreport->ApprehendedPerson).",".$this->convertBoolean($alarmreport->StaffError).",".$this->convertBoolean($alarmreport->NothingToReport).",".$this->convertBoolean($alarmreport->TechnicalError).",".$this->convertBoolean($alarmreport->UnknownReason).",".$this->convertBoolean($alarmreport->Other).","
                 . $this->convertNull($alarmreport->ReasonCodeId).",".$this->convertBoolean($alarmreport->CancelDuringEmergency).",".$this->convertNull($alarmreport->CancelDuringEmergencyTime).",".$this->convertBoolean($alarmreport->CoverMade).",".$this->convertNull($alarmreport->CoverMadeBy).",'$alarmreport->Remark','$alarmreport->Name','$alarmreport->Installer','$alarmreport->ControlCenter','$alarmreport->GuardRadioedDate','$alarmreport->GuardRadioedFrom','$alarmreport->GuardRadioedTo','$alarmreport->ArrivedAt','$alarmreport->Done',$alarmreport->EmployeeId,'$alarmreport->ReportCreated','$alarmreport->CustomerName',$alarmreport->CustomerNumber,'$alarmreport->StreetAndHouseNumber',$alarmreport->ZipCode,'$alarmreport->City',$alarmreport->Phonenumber)";

//         var_dump($sql);
//         echo '------------------------------------------------------------------------------------------';
         $result = $conn->query($sql);
         
        return $result;
    }
    
    public function convertBoolean($boolean){
        if($boolean){
            return 1;
        } else {
            return 0;
        }
    }
    
    public function convertNull($null){
        if($null != NULL){
            return "'".$null."'";
        } else {
            return "NULL";
        }
    }
    
    public function createAlarmReportsDB($alarmreports){
         
        foreach ($alarmreports as $alarmreport){
             if (!$this->createAlarmReportDB($alarmreport)){
                 return false;
             }
          }
          return true;
    }
    public function getAddressDB($data){
         $conn = $this->getConnection();
//         var_dump($data);
         if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
         }
         $sql = "SELECT * FROM ADDRESS WHERE SearchParameter ='" . $data."'";
//         var_dump($sql);
         $result = $conn->query($sql);
//         var_dump($result);
         $row = $result->fetch_assoc();
            $address = new address($data, $row['TagAddress'], floatval($row['Latitude']), floatval($row['Longtitude']));
//            var_dump($address);
        return $address;
    }
    public function createNFCDB($nfc){
          $conn = $this->getConnection();
         if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
         }
//         var_dump($nfc);
         $sql = "INSERT INTO NFC (RangeCheck,NFCTime,EmployeeId,AddressId) "
                 . "VALUES(".$this->convertBoolean($nfc->RangeCheck).",'$nfc->Time',$nfc->EmployeeId,'$nfc->AddressId') ";
//         var_dump($sql);
         $result = $conn->query($sql);
        return $result;
    }
    public function createNFCsDB($nfcs){
            foreach ($nfcs as $nfc){
             if (!$this->createNFCDB($nfc)){
                 return false;
             }
          }
          return true;
    }
    public function createCustomerDB($customer){
         $conn = $this->getConnection();
         if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
         } 
         $sql = "INSERT INTO CUSTOMER (CustomerNumber,CustomerName,StreetAndHouseNumber,ZipCode,City,Phonenumber) "
                 . "VALUES($customer->CustomerNumber,'$customer->CustomerName','$customer->StreetAndHouseNumber',$customer->ZipCode,'$customer->City',$customer->Phonenumber) ";
         $result = $conn->query($sql);
           
        return $result;
    }
    public function createCustomersDB($customers){
            foreach ($customers as $customer){
             if (!$this->createCustomerDB($customer)){
                 return false;
             }
          }
          return true;
    }
    
    public function getCustomer($id){
        $customers = array(
            1 => new Customer("Thomas Kragsberger", 1, "Bybækterrasserne 137 D", 3520, "Farum", 27708834),
            2 => new customer("Jannik Vangsgaard", 2, "Hovedgade 40", 2860, "Søborg", 22250898),
            3 => new customer("Mike Heerwagen", 3, "Kollegiebakken 9", 2800, "Lyngby", 41836990)
        );
        
        foreach($customers as $customerId => $customer){
            if($customerId == $id){
                return $customer;
                break;
            }
        }
        return NULL;
    }
    public function createAlarmReport($alarmreport){
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
    public function createAlarmReports($alarmreports){
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
           1=> new address("Københavns hovedbanegård", 55.6928897, 12.547805),
           2=> new address("Lyngby St.", 55.6928897, 12.502867899999956),
           3=> new address("Farum St.", 55.8117694, 12.373767000000043)
           );
       
       foreach($addresses as $addressid => $address){
            if($addressid == $id){
                return $address;
                break;
            }
        }
       // var_dump($address);
        return NULL;
    }
    public function createNFC($nfc){
          
        $returnNFC = new NFC($nfc->RangeCheck, $nfc->TagAddress, $nfc->Time, $nfc->User);
        if ($returnNFC->getTagAddress()!= "" && $returnNFC->getUser() != ""){
            return true;
        }
        return false;
    
}
    public function createNFCs($nfcs){
        
          foreach ($nfcs as $nfc){
             if (!$this->createNFC($nfc)){
                 return false;
             }
          }
          return true;
          
      }
    public function createCustomer($customer){
          $returnCustomer = new customer($customer->CustomerName, $customer->CustomerNumber, $customer->StreetHouseNumber, $customer->ZipCode, $customer->City, $customer->Phonenumber);
      
          if($returnCustomer->getCustomerName()!="" && $returnCustomer->getCustomerNumber()!="" && $returnCustomer->getStreetHouseNumber()!= "" && $returnCustomer->getZipCode()!= "" && $returnCustomer->getCity()!= "" && $returnCustomer->getPhonenumber()!= "" ){
              return true;
              
          }return false;
      }
    public function createCustomers($customers){
        
          foreach ($customers as $customer){
             if (!$this->createCustomer($customer)){
                 return false;
             }
          }
          return true;
          
      }

}

<?php
include("../entity/user.php");
include("../entity/customer.php");
include("../entity/alarmReport.php");
include("../entity/address.php");
include("../entity/NFC.php");
class dataSource{
    
    public function getUser($id){
        $users = array(
        1 => new User(1, "Thomas", "Kragsberger"),
        2 => new User(2, "Mike", "Heerwagen"),
        3 => new User(3, "Jannik", "Vangsgaard")
        );

        foreach($users as $userId => $user){
            if($userId == $id){
                return $user;
                break;
            }
        }
        return NULL;
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

}

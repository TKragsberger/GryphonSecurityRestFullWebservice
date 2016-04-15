<?php
include("../entity/user.php");
include("../entity/customer.php");
include("../entity/alarmReport.php");
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
       $returnAlarmReport = new alarmReport($alarmreport->CustomerName, $alarmreport->CustomerNumber, 
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
//        var_dump($alarmreport);
       
       return $alarmreport;
    }
}



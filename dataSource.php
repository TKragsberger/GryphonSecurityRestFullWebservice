<?php
include("./entity/user.php");
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
}


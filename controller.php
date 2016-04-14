<?php
include("user.php");
class controller{
    public function getUser($id){
        $users = array(
        1 => new User(1, "Thomas", "Kragsberger"),
        2 => new User(2, "Mike Heerwagen"),
        3 => new User(3, "Jannik Vangsgaard")
        );

        foreach($users as $userId => $user){
            if($userId == $id){
                return $user;
                break;
            }
        }
        return NULL;
    }
}


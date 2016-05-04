<?php
class Connection {
        public function getConnection() {
//            $dbHost     = 'localhost';
//            $user       = 'root';
//            $password   = '';
//            $db         = 'kragsberger_dk';
            $dbHost     = 'kragsberger.dk.mysql';
            $user       = 'kragsberger_dk';
            $password   = 'Noibti8280';
            $db         = 'kragsberger_dk';
           try{
            $conn       = new mysqli($dbHost, $user, $password, $db);
               
           } catch (Exception $ex) {
              echo 'Connection failed: ' . $ex->getMessage();
           } 
            return $conn;
        }
        
        public function closeConnection($conn) {
            if($conn->close)
                echo "Connection closed";
            else
                echo "Connection not closed";
        }
}


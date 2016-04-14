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
            
            $conn       = new mysqli($dbHost, $user, $password, $db);
            return $conn;
        }
        
        public function closeConnection($conn) {
            if($conn->close)
                echo "Connection closed";
            else
                echo "Connection not closed";
        }
}


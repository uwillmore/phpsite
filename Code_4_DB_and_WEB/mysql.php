<?php
    class MySql {
        function __construct($host='',$db='',$user='',$pass='') {
            if($host == '') {$host = DB_HOST;}
            if($db == '') {$db = DB_DB;}
            if($user == '') {$user = DB_USER;}
            if($pass == '') {$pass = DB_PASSWORD;}

            $this->host = $host;
            $this->db = $db;
            $this->user = $user;
            $this->pass = $pass;

            $this->mysqlObj = new mysqli(
                $this->host,
                $this->user,
                $this->pass,
                $this->db
            );

        }

        public function query($query) {
            if(!$resultObj = $this->mysqlObj->query($query)){
                $error = 'Set';
                $this->sendError($error);
            }

            return $resultObj;
        }

        public function getArray($query, $type=MYSQLI_ASSOC){
            if(!$resultObj = $this->mysqlObj->query($query)) {
                $error = 'There was a problem.  You suck.';
                $this->sendError($error);
            }

            if($resultObj->num_rows){
                $data = array();
                while($row=$resultObj->fetch_array($type)){
                    $data[] = $row;
                }
                
                return $data;
            } else {
                return false;
            }
        }

        public function sendError($error) {
            echo $error;
            die;
        }







    }
?>

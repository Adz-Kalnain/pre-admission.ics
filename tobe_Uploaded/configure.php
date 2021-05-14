<?php

    class dbc {
        private $servername;
        private $username;
        private $password;
        private $dbname;
        private $charset;

        public function connect() {
            $this->servername  = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->dbname = "initialsystem";
            $this->charset = "utf8bm4";

            try {
                $dbconn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
                $pdo = new PDO ($dbconn, $this->username, $this->password);
                return $pdo;
            }catch (\Exception $e) {

            }
        }
    }

/*$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES =>false
);

$pdo = new PDO ("mysql:host=$servername; dbname=$dbname", $username, $password, $options);
*/
?>
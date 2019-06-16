<?php
class Database{
    // specify your own database credentials
    private $host = "192.168.0.19";
    private $port = 5432;
    private $db_name = "test";
    private $username = "postgres";
    private $password = "postgres";
    public $conn;
 
    // get the database connection
    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = pg_connect("host=" .$this->host. " port=" .$this->port. " dbname=" .$this->db_name. " user=".$this->username." password=" .$this->password. " ");
        }catch(Exception $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
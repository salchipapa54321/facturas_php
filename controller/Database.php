<?php
class Database{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;    

    private $port;
    public function __construct(){
        $this->host = HOST;
        $this->db_name = DATABASE;
        $this->username = USER;
        $this->password = PASSWORD;
        $this->port = PORT;
    }

    public function db_conection(){
        $this->conn = null;
        try{
           $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name,$this->port);

           if ($this->conn->connect_errno) {
            throw new Exception(strtoupper("failed to connect : " . $this->conn->connect_error));
           }
        }catch(Exception $e){
           die(strtoupper('error to conect with database <br>' . $e->getMessage()));
        }
        return $this->conn;
    }

    public function db_close($conn){
        $conn->close();
    }
}


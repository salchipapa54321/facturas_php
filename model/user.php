<?php
class User{
    private $conn;   

    public function __construct(){
        $this->conn = new Database();
    }

    public function get_user($user,$password){ //consultar usuarios para iniciar sesion
        $newCon = $this->conn->db_conection();
        $query = $newCon->prepare("SELECT * FROM usuarios WHERE usuario = ? AND pwd = MD5(?)");
        if($query === false){
            die("Error al intentar consultar: ". $newCon->error);
        }
        $query->bind_param('ss',$user, $password);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();

        $this->conn->db_close($newCon);
        unset($query,$user,$password);
        return $result;
    }

    public function get_client($id,$typeID){ //consultar clientes registrados
        $newCon = $this->conn->db_conection();
        $query = $newCon->prepare("SELECT * FROM clientes WHERE tipoDocumento = ? AND  numeroDocumento = ?");
        if($query === false){
            die("Error al intentar consultar: ". $newCon->error);
        }
        $query->bind_param('is',$typeID,$id);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();

        $this->conn->db_close($newCon);
        unset($query,$id,$typeID);
        return $result;
    }

    public function set_client($fullName,$mail,$phone,$id,$typeID){ //registrar datos del cliente
        $newCon = $this->conn->db_conection();
        $query = $newCon->prepare("INSERT INTO clientes (nombreCompleto,tipoDocumento,numeroDocumento,email,telefono) VALUES ( ?,?,?,?,?)");
        if($query === false){
            die("Error al intentar consultar: ". $newCon->error);
        }
        $query->bind_param('sisss', $fullName,$typeID,$id,$mail,$phone);
        $query->execute();

        $this->conn->db_close($newCon);
        unset($query,$fullName,$mail,$phone,$id,$typeID);
    }

    public function update_client($id,$typeID,$fullName,$mail,$phone){ //Actualizar datos del cliente
        $newCon = $this->conn->db_conection();
        $query = $newCon->prepare("UPDATE clientes SET nombreCompleto = ?, email = ?, telefono = ? WHERE tipoDocumento = ? AND numeroDocumento = ?");
        
        if($query === false){
            die("Error al intentar consultar: ". $newCon->error);
        }
        $query->bind_param('sssis',$fullName,$mail,$phone, $typeID,$id);
        $query->execute();
        $this->conn->db_close($newCon);
        unset($query,$fullName,$mail,$phone,$id,$typeID);
    }
}

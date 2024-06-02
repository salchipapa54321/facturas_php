<?php
class Product{
    private $conn;   

    public function __construct(){
        $this->conn = new Database();
    }

    public function get_products(){ //retorna los productos de la base de datos
        $newCon = $this->conn->db_conection();
        $query = $newCon->prepare("SELECT * FROM articulos");
        if($query === false){
            die("Error al intentar consultar: ". $newCon->error);
        }
        $query->execute();
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        $this->conn->db_close($newCon);
        unset($query,$keyword);
        return $result;
    }

    public function get_product($id){ //retorna un producto de la base de datos en base al identificador
        $newCon = $this->conn->db_conection();
        $query = $newCon->prepare("SELECT * FROM articulos WHERE id = ?");
        if($query === false){
            die("Error al intentar consultar: ". $newCon->error);
        }
        $query->bind_param('i',$id);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();

        $this->conn->db_close($newCon);
        unset($query,$keyword);
        return $result;
    }
}
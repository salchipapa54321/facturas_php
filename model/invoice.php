<?php
class Invoice{
    private $conn;   

    public function __construct(){
        $this->conn = new Database();
    }
    
    public function set_invoice($state,$discount,$idClient){ 
        $newCon = $this->conn->db_conection();
        $query = $newCon->prepare("INSERT INTO facturas (estado,descuento,idCliente) VALUES (?,?,?)");
        if($query === false){ die("Error al intentar consultar: ". $newCon->error); }
        $query->bind_param('isi',$state,$discount, $idClient);
        $query->execute();
        $idGenerado = $query->insert_id;

        unset($query,$state,$discount,$idClient);
        return $idGenerado;
    }

    public function set_detailsInvoice($amount,$price,$idproduct,$idInvoice){ 
        $newCon = $this->conn->db_conection();
        $query = $newCon->prepare("INSERT INTO detalleFacturas(cantidad,precioUnitario,idArticulo,referenciaFactura) VALUES (?,?,?,?)");
        if($query === false){ die("Error al intentar consultar: ". $newCon->error); }
        $query->bind_param('idii',$amount,$price, $idproduct,$idInvoice);
        $query->execute();

        $this->conn->db_close($newCon);
        unset($quer,$amount,$price,$idproduct,$idInvoice);
    }

    public function get_invoices(){ 
        $newCon = $this->conn->db_conection();
        $query = $newCon->prepare("
        SELECT c.nombreCompleto,c.tipoDocumento,c.numeroDocumento,c.email,c.telefono,f.referencia,f.fecha,f.estado,f.descuento,df.cantidad,df.precioUnitario FROM facturas f INNER JOIN  clientes c ON c.id = f.idCliente INNER JOIN detalleFacturas df ON df.referenciaFactura = f.referencia");
        if($query === false){
            die("Error al intentar consultar: ". $newCon->error);
        }
        $query->execute();
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        $this->conn->db_close($newCon);
        unset($query);

        return $result;
    }

    public function get_invoice($id){ 
        $newCon = $this->conn->db_conection();
        $query = $newCon->prepare("SELECT c.nombreCompleto,c.tipoDocumento,c.numeroDocumento,c.email,c.telefono,f.referencia,f.fecha,f.estado,f.descuento,df.cantidad,df.precioUnitario, a.nombre, a.precio FROM facturas f INNER JOIN  clientes c ON c.id = f.idCliente INNER JOIN detalleFacturas df ON df.referenciaFactura = f.referencia
        INNER JOIN articulos a ON a.id = df.idArticulo WHERE referencia = ?");
        if($query === false){ die("Error al intentar consultar: ". $newCon->error); }
        $query->bind_param('i',$id);
        $query->execute();
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        $this->conn->db_close($newCon);
        unset($query);

        return $result;
    }
}
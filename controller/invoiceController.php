<?php

class invoiceController{
    private $view;
    private $invoice;
    private $product;

    private $user;

    public function __construct(){
        $this->view = new Views("./view");
        $this->product = new Product();
        $this->user = new User();
        $this->invoice = new Invoice();
    }

    public function addProducts(){ //Agregar Productos al Carrito
        $product = [];

        if(isset($_POST['amount']) && isset($_GET['id'])){ 
            if(!isset($_SESSION['shoppingCar'])){
                $_SESSION['shoppingCar'] = []; 
            }else{
                $product = $_SESSION['shoppingCar'];
            }
            $productInf = $this->product->get_product($_GET['id']);
            array_push($product, ['product' => $productInf['id'], 'amount' => $_POST['amount'],'price' => $productInf['precio'], 'nombre' => $productInf['nombre']]);
        }else{
            echo "<script>alert('Error Peticion incorrecta intente nuevamente')</script>";
        }
        
        $_SESSION['shoppingCar'] = $product;
        unset($product);
        header('Location:'.ROUTE.'home');
    }

    public function listProducts(){ //Listar Productos del Carrito
        $productsList = [];

        if(isset($_SESSION['shoppingCar'])){
            foreach($_SESSION['shoppingCar'] as $row){
                $product = $this->product->get_product($row['product']);
                array_push($productsList, $product);
            }    
        }
        
        $this->view->render('/partial/header');
        $this->view->render('shoppingCar',['productsList' => $productsList]);
        $this->view->render('/partial/footer');
    }

    public function cancelPurchase(){ //Vaciar Productos del Carrito
        if(isset($_SESSION['shoppingCar'])){
            $_SESSION['shoppingCar'] = [];
        }
        header('Location:'.ROUTE.'home');
    }

    public function save_invoice(){//almacenar factura
        $discount = 0;
        $total = 0;
        $tempTotal = 0;

        if(isset($_GET['id'])){ $id = $_GET['id']; }

        if(isset($_SESSION['shoppingCar'])){
           foreach($_SESSION['shoppingCar'] as $row){
               $tempTotal = $row['price'] * $row['amount'];
               $total = $total + $tempTotal;
           }
        }else{ header('Location:'.ROUTE.'home'); }

        if ($total > 100000) { $discount = 8; } 
        elseif ($total > 200000) { $discount = 4;}
        elseif ($total > 65000) { $discount = 2;}
          
        $discountAmount = ($discount / 100) * $total;
        $endAmount = $tempTotal - $discountAmount; 

        $reference = $this->invoice->set_invoice(4,$discount,$id);
       
        foreach($_SESSION['shoppingCar']  as $row){}
        $this->invoice->set_detailsInvoice($row['amount'],$total,$row['product'],$reference);

        header('Location:'.ROUTE.'cancel');
    }

    public function return_invoices(){ //retornar datos de las facturas
        $invoices = $this->invoice->get_invoices();
        $reference = 0;

        $this->view->render('/partial/header');
        if($invoices != null){
            foreach($invoices as $row){
                
                $discountAmount = (intval($row['descuento']) / 100) * $row['precioUnitario'];
                $endAmount = $row['precioUnitario'] - $discountAmount; 
                if($row['referencia'] != $reference){ //para evitar generar dos facturas de la misma compra debido al inner join de la tabla detalle factura
                    echo " <div>
                    <p><strong>Referencia: </strong>".$row['referencia']."</p><br>
                    <p><strong>Nombre: </strong>".$row['nombreCompleto']."</p><br>
                    <p><strong>Tipo Documento: </strong>".$row['tipoDocumento']."</p><br>
                    <p><strong>Numero Documento: </strong>".$row['numeroDocumento']."</p><br>
                    <p><strong>Email: </strong>".$row['email']."</p><br>
                    <p><strong>Telefono: </strong>".$row['telefono']."</p><br>
                    <p><strong>Fecha: </strong>".$row['fecha']."</p><br>
                    <p><strong>Estado: </strong>".$row['estado']."</p><br>
                    <p><strong>Descuento: </strong>".$row['descuento']."</p><br>
                    <p><strong>Total: </strong>".$row['precioUnitario']."</p><br>
                    <p><strong>Total + Descuento: </strong>".$endAmount."$</p><hr>
                  </div><br>";
                }
                $reference = $row['referencia'];
            }
              echo "</div>
            </section>";
        }else{
            echo "<h3>No hay facturas para mostrar</h3>
            </div>
            </section>";
        }
        $this->view->render('/partial/footer');
    }

}

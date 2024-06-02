<div>
<?php
      if($productsList != null){
        foreach($productsList as $row){
            $i = 0;
            echo "<p>
                    ".$row['id']." ".$row['nombre']." ".$row['precio']." ".$_SESSION['shoppingCar'][$i]['amount']."
                  </p><hr>";
            $i++;
        }
      }else{
        echo "<h3>No hay productos en el Carrito para Mostrar</h3>";
      }
?>
</div>
        </div>
    </section>

            <?php
               $i = 0;
               
               if(isset($productos) && !is_null($productos)){
                  foreach($productos as $row){
                     echo '<article class="home__section__div__article">
                     <img class="home__section__div__article__img" src="'.ASSETS.'/img/productos.png" alt="product">
                     <h4 class="home__section__div__article__h4">'.$row['nombre'].'</h4>
                     <p class="home__section__div__article__p">'.$row['precio'].' $</p>
                     <br>
                     <form action="'.ROUTE.'product?id='.$row['id'].'" method="POST">
                         <input type="number" name="amount" class="home__section__div__article__input" min="1" required/>
                         <input type="submit" href="" class="home__section__div__article__a" value="Comprar">
                     </form>
                    </article>';
                  }
               }else{
                    echo "<h3>NO HAY PRODUCTOS PARA MOSTRAR</h3>";
               }

            ?>
            </div>
        </section>

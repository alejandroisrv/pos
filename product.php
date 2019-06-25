<?php
    include 'core/conexion.php';
    setlocale(LC_MONETARY,"es_PE");
    session_start();
    $modoventa=$_COOKIE['modoventa'];
        if($_SESSION['rol-user']==="admin"){
                $admin=true;
        }else{
                $admin=false;
        }
    if($_SESSION['rol-user']=="caja"){

          $sqlProduct="SELECT * FROM productos WHERE cantidad > 0 ORDER BY favoritos DESC, cantidad ASC LIMIT 0,15";
    }else{
          $sqlProduct="SELECT * FROM productos ORDER BY producto ASC , cantidad ASC LIMIT 0,35";
    }

  if(isset($_GET['search'])){
      $search=$_GET['search'];
      if($search=="all"){

            $sqlProduct="SELECT * FROM productos ORDER BY cantidad ASC";

      }else if($search!=""){

          $sqlProduct="SELECT * FROM productos WHERE producto LIKE '$search%' ORDER BY producto ASC";
      }
    }
  $queryProductos=$con_pdo->query($sqlProduct);
  if($queryProductos->rowCount()>0){
  ?>
  <table class="table my-2 col-12" id="product">
  <thead>
    <tr>
      <?php if($admin):  ?>
      <th style="cursor:pointer;">Producto</th>
      <th style="cursor:pointer;" class="ocultarMov">Precio Costo</th>
      <th style="cursor:pointer;">Precio</th>
      <th style="cursor:pointer;">Cantidad</th>
      <th style="cursor:pointer;"></th>
      <?php elseif($_SESSION['rol-user']=="inventario"): ?>
      <th style="cursor:pointer;">Producto</th>
      <th style="cursor:pointer;">Cantidad</th>
      <th style="cursor:pointer;">Precio</th>
      <th style="cursor:pointer;"></th>

      <?php else:  ?>
      <th style="cursor:pointer;">Producto</th>
      <th style="cursor:pointer;">Precio</th>
      <th style="cursor:pointer;"></th>

      <?php endif;?>
    </tr>
  </thead>

  <tbody id="table">
    <?php
      while ($products=$queryProductos->fetch(PDO::FETCH_ASSOC)) {


                if($modoventa=="delivery"):
                     $precioVenta=money_format('%(#10n',$products['precioDelivery']);

                elseif($modoventa=="noche"):
                     $precioVenta=money_format('%(#10n',$products['precioNoche']);
                elseif($modoventa=="domicilios.com"):
                     $precioVenta=money_format('%(#10n',$products['precioDomicilio']);
                else:
                     $precioVenta=money_format('%(#10n',$products['precioVenta']);

                endif;

      if($_SESSION['rol-user']=="caja"):?>
      <tr class="sellProduct"
      data-toggle="modal"
      data-target="#exampleModal"
      data-nombre="<?php echo ucwords(strtolower($products['producto'])); ?>"
      data-producto="<?php echo $products['idproducto']; ?>">
    <?php else:?>
        <tr>
      <?php endif;?>

    <?php if($admin): ?>

      <td><?php echo  ucwords(strtolower($products['producto']));  ?></td>
      <td  class="ocultarMov">
          <?php echo  money_format('%(#10n',$products['precioCosto']);  ?></td>
      <td><?php echo $precioVenta ?></td>

      <?php if ($products['cantidad']<=1): ?>
        <td style="color:red !important">
        <?php else: ?>
        <td>
        <?php endif; ?>


      <?php echo  $products['cantidad'];  ?>
     </td>

      <td>
        <button type="button" class="updateProduct btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-producto="<?php echo $products['idproducto']; ?>"><i  class=" far fa-edit"></i></button>
        <button type="button" class=" deleteProducto btn btn-danger" data-producto="<?php echo $products['idproducto']; ?>"> <i class="deleteProducto fas fa-times"></i></button>
      </td>

     <?php elseif($_SESSION['rol-user']=="inventario"): ?>

      <td><?php echo  ucwords(strtolower($products['producto']));  ?></td>
      <td><?php echo  $products['cantidad'];  ?></td>
      <td><?php echo  money_format('%(#10n',$products['precioVenta']);  ?></td>


     <?php else:  ?>

      <td><?php echo  ucwords(strtolower($products['producto']));  ?></td>
      <td> <?php echo $precioVenta ?></td>
      <td>
        <?php if($products['cantidad']>0):  ?>
        <button type="button"
            class="sellProduct px-4 btn btn-success"
            data-toggle="modal"
            data-target="#exampleModal"
            data-nombre="<?php echo ucwords(strtolower($products['producto'])); ?>"
            data-producto="<?php echo $products['idproducto']; ?>">
              <i class="far fa-money-bill-alt"></i>
        </button>
        <?php else:?>

            <p class="text-muted"> Sin stock</p>

        <?php endif;  ?>
      </td>
     <?php endif;?>
    </tr>
    <?php
      }

    }else {
      ?>

      <p class="alert alert-warning col-12" role="alert">No se ha encotrado productos</p>

      <?php
    }
  ?>

        </tbody>
    </table>

<script src="assets/js/products.js" charset="utf-8"></script>

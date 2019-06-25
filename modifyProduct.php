<?php
  include 'core/conexion.php';
  session_start();
  
  if(isset($_SESSION['usuario'])){
      
      $usuario=$_SESSION['usuario'];
      
  }
 ?>

<div class="form-row">
  <div class="col-md-12 mb-3">
    <label for="producto">Nombre del producto</label>
    <input type="text" class="form-control" placeholder="Producto" value="" name="producto" required id='producto'>
    <input type="hidden" class="form-control" placeholder="Producto" value="" name="idproducto" required id='idproducto'>
  </div>
</div>
<?php if($usuario=="admin"):?>

<div class="form-row mt-3">
<div class="col-md-4 ">
    <label for="precioDia">Precio dia</label>
    <input type="text" class="form-control" placeholder="Precio dia" value="" required name="precioDia" id="precioDia">
  </div>
    <div class="col-md-4">
    <label for="precioNoche">Precio noche</label>
    <input type="text" class="form-control" placeholder="Precio noche" value="" required name="precioNoche" id="precioNoche">
  </div>
  <div class="col-md-4">
    <label for="precioDelivery">Precio delivery</label>
    <input type="text" class="form-control"  placeholder="Precio delivery" value="" required name="precioDelivery" id='precioDelivery'>
  </div>
</div>
<div class="form-inline text-left ">
    <div class="form-row">
        <div class="form-group col-12 mt-4">
            <label for="precioCosto" class="mx-2">Precio costo</label>
            <input type="text" class="form-control form-control-sm col-6" placeholder="Precio costo" value="" required name="precioCosto" id="precioCosto">
        </div>
    </div>
</div>
<?php endif;?>
<?php

if (isset($_GET['id'])):
   $id=$_GET['id'];
   $queryUpdateProductos=$con_pdo->query("SELECT * FROM productos WHERE idproducto='$id'");
    if($queryUpdateProductos->rowCount()>0){

      while ($productos=$queryUpdateProductos->fetch(PDO::FETCH_ASSOC)): ?>

      <script type='text/javascript'>
          $('#idproducto').val("<?php echo $id ?>");
          $('#producto').val("<?php echo $productos['producto'] ?>");
          <?php if($usuario="admin"):?>
          $('#precioCosto').val("<?php echo $productos['precioCosto'] ?>");
          $('#precioDia').val("<?php echo $productos['precioVenta'] ?>");
          $('#precioNoche').val("<?php echo $productos['precioNoche'] ?>");
          $('#precioDelivery').val("<?php echo $productos['precioDelivery'] ?>");
          <?php endif;?>
      </script>

            <?php

      endwhile;

    }

 endif; ?>

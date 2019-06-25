<?php
  include 'core/conexion.php';
  session_start();

if (isset($_GET['id'])):
   $id=$_GET['id'];

   $queryUpdateProductos=$con_pdo->query("SELECT * FROM venta WHERE idventa='$id'");
    if($queryUpdateProductos->rowCount()>0){
    while($productos=$queryUpdateProductos->fetch(PDO::FETCH_ASSOC)):
        $idproducto=$productos['idproducto'];
        $cCantidad=$con_pdo->query("SELECT cantidad FROM productos WHERE idproducto='$idproducto' LIMIT 0,1");
      while ($comprobarCantidad=$cCantidad->fetch(PDO::FETCH_ASSOC)):
          $stock=$comprobarCantidad['cantidad'];
          endwhile;
      ?>

    <div class="form-inline align-items-self-start">
            <div class="form-row">
                  <div class="col-6 form-group">
                    <input type="text" readonly="" class="form-control-plaintext align-self-start" id="producto" name="producto" value="<?php echo $productos['producto'] ?> ">
                    </div>
                    <div class="form-gruop col-5">
                    <input type="text" min="1" max="100"
                        value="<?php echo $productos['cantidad']?>"
                        class="form-control text-center col-5"
                        id="cantidad" name="cantidad">
                       <small id="cantidadText" style="" class="form-text text-muted">Cantidad</small>
                    <input type="hidden"
                        value="<?php echo $productos['idventa']?> " name="idventa">
                    <input type="hidden"
                        value="<?php echo $productos['idproducto'] ?>" name="idproducto">
                  </div>
            </div>
            <script>

            var cantidadInicial=parseInt($('#cantidad').val());
            $('#cantidad').keyup(function(){

                var cantidad =  parseInt($('#cantidad').val());
                var stock = parseInt(<?php echo $stock; ?>)+cantidadInicial;
                if(cantidad <= stock && cantidad > 0){
                   $('#cantidadText').hide();
                   $('#cantidadText').attr('style','color:green !important');
                    $('#cantidadText').text('Cantidad disponible');
                   remDisable();
                }else{
                    $('#cantidadText').show();
                    $('#cantidadText').attr('style','color:red !important');
                    $('#cantidadText').text('Cantidad no disponible');
                    addDisable();
                }




            });
            </script>
     <?php
     endwhile;

    }


 endif; ?>

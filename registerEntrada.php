   <script>
        

         $( window ).on( "load", function() {
            $('.preloader').css('display', 'none');
          });

        
    </script>

<?php
include 'core/conexion.php';
if (isset($_GET['numero'])) {
  $numeroArticulo=$_GET['numero'];
  if($_GET['numero']!=0){
echo "<p>Ingrese los productos y la cantidad.</p>";
echo "<input type='text' class='form-control col-6 my-3' placeholder='Nro de Factura' name='factura'>";
    try {

      for ($i=1; $i <= $numeroArticulo ; $i++) {
        ?>

          <div class="form-row">
            <div class="form-group col-md-6">
              <select class="form-control" name="producto[]">
                <option value="" selected>Selecciona el producto <?php echo $i ?></option>
              <?php
              $productoQuery=$con_pdo->query("SELECT producto FROM productos ORDER BY producto ASC");
              while ($producto=$productoQuery->fetch(PDO::FETCH_ASSOC)) {

                echo "<option value='".$producto['producto']."'>
                        ".$producto['producto']."
                     </option>";
              }
              ?>
              </select>
            </div>
            <div class="form-group col-md-4">
              <input placeholder=" Cantidad " type='text' class="form-control" name="cantidadProductoVentas[]">
            </div>
          </div>

        <?php
      }

    } catch (\Exception $e) {

      echo $e->getMessage();

    }



  }else{

    ?>


    <div class="form-row my-2 px-2">
      <input type="text" class="form-control col-6 cantidad" id="cantidadProductoVentas" placeholder="Numero de articulos">
      <button type="button" data-tipo="Entrada" class="continuar btn btn-primary mx-3">Continuar</button>
    </div>

    <?php
  }


  ?>


<?php

}else {

  echo "se ha producido un error";
}

?>

<script>
    $(".continuar").on('click',function() {

  if($(this).attr('data-tipo')=="Entrada"){

  registerEntradaLoops();

  }else{

  registerVentaLoops();
  
  }


});

</script>

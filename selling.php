<?php
  include 'core/conexion.php';
        setlocale(LC_MONETARY,"es_PE");
  session_start();

  if(isset($_SESSION['usuario'])){

      $usuario=$_SESSION['usuario'];

    }

if (isset($_GET['id'])):
    $id=$_GET['id'];
   $queryUpdateProductos=$con_pdo->query("SELECT idproducto,precioVenta,precioNoche,precioDelivery,precioDomicilio,cantidad FROM productos WHERE idproducto='$id' LIMIT 0,1");
    if($queryUpdateProductos->rowCount()>0){

      while ($productos=$queryUpdateProductos->fetch(PDO::FETCH_ASSOC)):

        switch ($_COOKIE['modoventa']){
            case 'dia' :
                $precio=$productos['precioVenta'];
                break;
            case 'noche' :
                $precio=$productos['precioNoche'];
                break;
            case 'delivery' :
                $precio=$productos['precioDelivery'];
                break;
            case 'domicilios.com' :
                  $precio=$productos['precioDomicilio'];
                    break;
            default:
                break;
        }
      ?>

      <style>
          #cantidadText{

              color:green;
              font-size:0.75rem;
          }
      </style>
        <div class="form-inline ">
            <div class="form-row">
              <div class="form-group col-6">
                <label for="producto" class="mx-2">Cantidad</label>
                <input type="text" min="1" requerid class="form-control col-5" value="1"
                pattern="[0-9]{1,40}" title="Solo numeros" name="cantidad" id='cantidad'>
                <small id="cantidadText"
                        class="form-text mx-2">
                    <?php ($productos['cantidad']>1) ? $cantidadText=$productos['cantidad']." disponibles" : $cantidadText=$productos['cantidad']." disponible" ;
                        echo $cantidadText;?>
                </small>
              </div>
              <div class="form-group col-6">

                <input type="text" readonly class="form-control-plaintext " id="subtotal" name="subtotal"
                    value="S/. <?php echo $precio ?>">
                <small id="emailHelp" class="form-text mx-2">Total a cobrar</small>
                 </div>
            </div>
        </div>

        <input type="hidden" class="form-control" value="<?php echo $productos['idproducto'] ?>" name="idproducto" required id='idproducto'>
          <input type="hidden" class="form-control" value="<?php echo $precio ?>" name="precio" required id='precio' >
      </div>
    </div>
      <script type='text/javascript'>
          remDisable();
          var cantidad = parseInt($('#cantidad').val());
          var stock = parseInt(<?php echo $productos['cantidad']; ?>);

            function comprobarCantidad(cantidad){

                if(cantidad>stock){

                    $('#cantidadText').show();
                    $('#cantidadText').css('color','red');
                    $('#cantidadText').text("Solo quedan " + stock + " de este producto");
                    addDisable();

                }else{

                    $('#cantidadText').show();
                    $('#cantidadText').css('color','green');
                    if(stock>1){

                        $('#cantidadText').text(stock + " disponibles");

                    }else{

                        $('#cantidadText').text(stock + " disponible");
                    }

                    remDisable();

                }



            }

          comprobarCantidad(cantidad);
          $('#registerBtn').text('Vender').button("refresh");
          $('#cantidad').keyup(function(res){
              cantidad = parseInt($('#cantidad').val());
                  if(cantidad>=1){

                      var subtotal = <?php echo $precio ?> * cantidad;
                      $('#subtotal').val("S/. "+ subtotal);
                      comprobarCantidad(cantidad);

                  }else{

                        $('#cantidadText').show();
                        $('#cantidadText').css('color','red');
                        $('#cantidadText').text("La cantidad minima para vender es 1");
                        addDisable();

                  }


              });




      </script>

            <?php

      endwhile;

    }

 endif; ?>

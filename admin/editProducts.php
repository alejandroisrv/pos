  <style media="screen">
    .formulario-mlabel label{
      font-weight:500 !important;
      font-size: 12px !important;
      margin-bottom: 3px !important;
    }
  </style>

  <div class="formulario-mlabel">
      <div class="form-element-list">
        <div class="basic-tb-hd">
          <h2 id="tituloModal"></h2>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label>Nombre</label>
                    <div class="nk-int-st">
                        <input type="hidden" name="idproducto" value="" id="idproducto">
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Introduce el nombre del producto aquí">
                    </div>
                </div>
            </div>
        </div>
        <h2 class="my-3">Precios:</h2>
        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label>Día</label>
                    <div class="nk-int-st">
                        <input type="text" id="precioVenta" name="precioVenta" class="form-control"placeholder="Precio de dia">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label>Noche</label>
                    <div class="nk-int-st">
                        <input type="text" id="precioNoche" name="precioNoche" class="form-control" placeholder="Precio de noche">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label>Delivery</label>
                    <div class="nk-int-st">
                        <input type="text" id="precioDelivery" name="precioDelivery" class="form-control" placeholder="Precio de delivery">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label>Domicilios.com</label>
                    <div class="nk-int-st">
                        <input type="text" id="precioDomicilio" name="precioDomicilio" class="form-control" placeholder="Precio de domicilios">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label>Precio de costo</label>
                    <div class="nk-int-st">
                        <input type="text" id="precioCosto" name="precioCosto" class="form-control" placeholder="Introduce el precio de costo del producto aquí">
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

<script  type="text/javascript">
  function llenarCuadros(cuadro,valor) {
      $('#'+cuadro).val(valor);
  }
  $("#tituloModal").text("Agrega un nuevo producto");
  <?php
  if(isset($_GET['idproducto'])){
    include '../class/database.php';
    include '../class/productos.php';
    $conexion=new database();
    $products=new productos($conexion);
    $producto=$products->getProduct($_GET['idproducto']);
  ?>
  $("#tituloModal").text("Modificar <?php echo $producto['producto'] ?>");
  llenarCuadros('idproducto',"<?php echo $_GET['idproducto'] ?>")
  llenarCuadros('nombre',"<?php echo $producto['producto'] ?>")
  llenarCuadros('precioVenta',"<?php echo $producto['precioVenta'] ?>")
  llenarCuadros('precioNoche',"<?php echo $producto['precioNoche'] ?>")
  llenarCuadros('precioDelivery',"<?php echo $producto['precioDelivery'] ?>")
  llenarCuadros('precioCosto',"<?php echo $producto['precioCosto'] ?>")
  llenarCuadros('precioDomicilio',"<?php echo $producto['precioDomicilio'] ?>")
  <?php } ?>

</script>

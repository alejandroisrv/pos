<?php
include '../class/database.php';
include '../class/productos.php';
$conexion=new database();
$products=new productos($conexion);
$productos=$products->getProducts();

?>

  <div class="formulario-mlabel">
    <div class="form-element-list">
      <div class="basic-tb-hd">
        <p style="font-size:11px !important;cursor: pointer;float:right;display:block;margin-left:10px;" onclick="addRow()"><i class="notika-icon notika-plus"></i>Añadir otro producto</p>
        <h2 id="tituloModal"></h2>
        <p>Seleccione el producto y la cantidad</p>

      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <div class="">
                  <select class="form-control productos"  name="producto[]">
                              <?php foreach ($productos as $producto):  ?>
                  <option value="<?php echo $producto['idproducto']?>">
                      <?php echo $producto['producto']?>
                    </option>
                            <?php endforeach; ?>
                    </select>
              </div>
            </div>
        </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="nk-int-st">
                <input type="text" id="precioVenta" name="cantidad[]" class="form-control"placeholder="Cantidad">
          </div>
    </div>
  </div>


      </div>
      <input type="hidden" id="tipo" name="tipo" value="<?php echo $_GET['idproducto']?>">
    </div>
    <script type="text/javascript">

            var tipo = $('#tipo').val();
            if(tipo>0){
                $('#tituloModal').text("Entrada de productos al inventario");
            }else {
                $('#tituloModal').text("Salida de productos del inventario");
            }

                      var row ='<div class="row">'
                                  + '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">'
                                      + '<div class="form-group">'
                                          + '<div class="">'
                                            + '<select class="form-control productos"  name="producto[]">'
                                              <?php foreach ($productos as $producto):  ?>
                                            + '<option value="<?php echo $producto['idproducto']?>">'
                                                + '<?php echo $producto['producto']?>'
                                              + '</option>'
                                            <?php endforeach; ?>
                                            + ' </select>'
                                        + '</div>'
                                      + '</div>'
                                  + '</div>'
                                + '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">'
                                      + '<div class="nk-int-st">'
                                            + '<input type="text" id="precioVenta" name="cantidad[]" class="form-control"placeholder="Cantidad">'
                                        +'</div>'
                                + '</div>'
                              + '</div>';
                              function addRow() {
                                $('.form-element-list').append(row);
                              }
    </script>

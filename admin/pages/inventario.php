<?php
include '../../class/database.php';
include '../../class/productos.php';
$conexion=new database();
$products=new productos($conexion);
$productos=$products->getProducts();
setlocale(LC_MONETARY,"es_PE");
?>


<link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">
<script src="../assets/js/data-table/jquery.dataTables.min.js"></script>
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcomb-list">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="breadcomb-wp">
                <div class="breadcomb-icon">
                  <i class="notika-icon notika-form"></i>
                </div>
                <div class="breadcomb-ctn">
                  <h2>Inventario</h2>
                  <p>Estos son los productos que tienes en tu inventario</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
              <div class="breadcomb-report">
                <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcomb area End-->
  <!-- Data Table area Start-->
  <div class="data-table-area">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="data-table-list">
                      <div class="basic-tb-hd">
                          <h2>Productos</h2>
                          <p></p>
                      </div>
                      <div class="table-responsive">
                          <table id="data-table-basic" class="table table-striped">
                              <thead>
                                  <tr>

                                      <th>Producto</th>
                                      <th>Cantidad</th>
                                      <th>Precio costo</th>
                                      <th>Precio Venta</th>
                                      <td></td>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($productos as $producto):  ?>
                                <tr>

                                  <td><?php echo $producto['producto']?></td>
                                  <td><?php echo $producto['cantidad']?></td>
                                  <td><?php echo money_format('%(#10n',$producto['precioCosto']) ?></td>
                                  <td><?php echo money_format('%(#10n',$producto['precioVenta']) ?></td>
                                  <td>
                                    <button type="button" class="btn btn-primary notika-btn-primary waves-effect modalLoad" onclick="modalLoad(this)" redirect="inventario" url="editProducts" data-producto="<?php echo $producto['idproducto'] ?>">
                                      <i class="notika-icon notika-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger notika-btn-danger waves-effect" onclick="deleteProduct(this)" redirect="inventario" data-producto="<?php echo $producto['idproducto'] ?>">
                                      <i class="notika-icon notika-trash"></i>
                                    </button>
                                  </td>
                                </tr>
                                <?php endforeach; ?>
                                  </tbody>
                                    <tfoot>
                                    <tr>
                                      <th>Producto</th>
                                      <th>Cantidad</th>
                                      <th>Precio costo</th>
                                      <th>Precio Venta</th>
                                      <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#data-table-basic').DataTable({
                columnDefs: [{
                    targets: [0],
                    orderData: [0, 1]
                }, {
                    targets: [1],
                    orderData: [1, 0]
                }, {
                    targets: [4],
                    orderData: [4, 0]
                }]
            });
        });
    </script>

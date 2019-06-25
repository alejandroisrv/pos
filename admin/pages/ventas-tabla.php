<?php
include '../../class/database.php';
include '../../class/ventas.php';
$conexion    =  new database();
$ventas =  new ventas($conexion);
setlocale(LC_MONETARY,"es_PE");
if((isset($_GET['desde'])) && (isset($_GET['hasta']))){
  $sales = $ventas->getVentas($_GET['desde'],$_GET['hasta']);
}else{
  $sales = $ventas->getVentas();
}


?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="data-table-list">
        <div class="table-responsive">
            <table id="data-table-basic" class="table table-striped">
                <thead>
                    <tr>

                        <th>Código</th>
                        <th>Modo de venta</th>
                        <th>Método de pago</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($sales as $sale): ?>
                  <tr>
                    <th><?php echo $sale['codigo']?></th>
                    <td><?php echo ucfirst($sale['metodoVenta'])?></td>
                    <td><?php echo ucfirst($sale['metodoPago'])?></td>
                    <td><?php echo money_format('%#10n',$sale['total']) ?></td>
                    <td><?php echo $sale['fecha']." ".$sale['hora']?></td>
                    <td>
                      <a href="pages/venta?codigo=<?php echo $sale['codigo'] ?>" class="btn btn-warning warning-icon-notika waves-effect" target="_blank">
                        <i class="notika-icon notika-edit"></i>
                      </a>
                      <a href="pages/venta?codigo=<?php echo $sale['codigo'] ?>&d=true" class="btn btn-primary primary-icon-notika waves-effect" target="_blank">
                        <i class="notika-icon notika-sent"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                    </tbody>
                      <tfoot>
                      <tr>
                        <th>Código</th>
                        <th>Modo de venta</th>
                        <th>Método de pago</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <td></td>
                      </tr>
                  </tfoot>
              </table>
          </div>
      </div>
  </div>
  <script src="../assets/js/data-table/jquery.dataTables.min.js"></script>
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

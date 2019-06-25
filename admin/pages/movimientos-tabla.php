<?php
include '../../class/database.php';
include '../../class/movimientos.php';
$conexion    =  new database();
$mov =  new movimientos($conexion);
setlocale(LC_MONETARY,"es_PE");
if((isset($_GET['desde'])) && (isset($_GET['hasta']))){
  $movimientos = $mov->getMovimientos($_GET['desde'],$_GET['hasta']);
}else{
  $movimientos = $mov->getMovimientos();
}


?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="data-table-list">
        <div class="table-responsive">
            <table id="data-table-basic" class="table table-striped">
                <thead>
                    <tr>

                        <th>Nª de orden</th>
                        <th>Tipo</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($movimientos as $movimiento):
                    if($movimiento['tipo']>0){
                      $tipoText="Compra de mercancia";
                    }else{
                      $tipoText="Salida de mercancia del inventario";
                    }
                  ?>

                  <tr>

                    <th><?php echo $movimiento['orden']?></th>
                    <th><?php echo $tipoText ?></th>
                    <td><?php echo money_format('%#10n',$movimiento['total']) ?></td>
                    <td><?php echo $movimiento['fecha']?></td>
                    <td>
                      <a href="pages/movimiento?orden=<?php echo $movimiento['orden'] ?>" class="btn btn-warning warning-icon-notika waves-effect" target="_blank">
                        <i class="notika-icon notika-edit"></i>
                      </a>
                      <a href="pages/movimiento?orden=<?php echo $movimiento['orden'] ?>&d=true" class="btn btn-primary primary-icon-notika waves-effect" target="_blank">
                        <i class="notika-icon notika-sent"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                    </tbody>
                      <tfoot>
                      <tr>
                        <th>Nª de orden</th>
                        <th>Operación</th>
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

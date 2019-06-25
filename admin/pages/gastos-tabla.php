<?php
include '../../class/database.php';
include '../../class/cajachica.php';
$conexion    =  new database();
$spend =  new cajachica(date('Y-m-d'),2,$conexion);
setlocale(LC_MONETARY,"es_PE");
$estadoFecha=false;
if((isset($_GET['desde'])) && (isset($_GET['hasta']))){
  $gastos = $spend->getGastosAdmin($_GET['desde'],$_GET['hasta']);
  $estadoFecha=true;
}else{
  $gastos = $spend->getGastosAdmin();
}


?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="data-table-list">
        <div class="table-responsive">
            <table id="data-table-basic" class="table table-striped">
                <thead>
                    <tr>
                        <th>Referencia</th>
                        <th>Descripcion</th>
                        <th>Monto</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($gastos as $gasto):
                    $enlace="<a href='pages/movimiento?orden=".$gasto['dato']."' target='_blank' style='color:black !important;'>#".$gasto['dato']."</a>";
                  ?>

                  <tr>
                    <th><?php echo ($gasto['dato']!="") ? $enlace : "Sin referencia"; ?></th>
                    <td><?php echo ucfirst($gasto['descripcion'])?></td>
                    <td><?php echo money_format('%#10n',$gasto['monto']) ?></td>
                    <td><?php echo $gasto['usuario']?></td>
                    <td><?php echo $gasto['date']?></th>

                    <td>
                      <button type="button" class="btn btn-primary notika-btn-primary waves-effect modalLoad" onclick="modalLoad(this)" redirect="gastos" url="addGastos" data-producto="<?php echo $gasto['idgasto'] ?>">
                        <i class="notika-icon notika-edit"></i>
                      </button>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                    </tbody>
                      <tfoot>
                      <tr>
                        <th>Descripcion</th>
                        <th>Monto</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Referencia</th>
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

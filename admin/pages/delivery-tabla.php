<?php
include '../../class/database.php';
include '../../class/pedidos.php';
$conexion    =  new database();
$delivery =  new pedidos($conexion);
setlocale(LC_MONETARY,"es_PE");
if((isset($_GET['desde'])) && (isset($_GET['hasta']))){
  $pedidos = $delivery->getPedidosAdmin($_GET['desde'],$_GET['hasta']);

}else{
  $pedidos = $delivery->getPedidosAdmin();
}


?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="data-table-list">
        <div class="table-responsive">
            <table id="data-table-basic" class="table table-striped">
                <thead>
                    <tr>

                        <th>Código de pedido</th>
                        <th>Método de pago</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($pedidos as $pedido):
                      if($pedido['estado']==0){
                        $estadoPedido="No entregado";
                      }else if($pedido['estado']==1){
                        $estadoPedido="Entregado con exito";
                      }else {
                        $estadoPedido="Rechazado";
                      }
                   ?>
                  <tr>
                    <th><?php echo $pedido['codigo']?></th>
                    <td><?php echo ucfirst($pedido['metodoPago'])?></td>
                    <td><?php echo $estadoPedido ?></td>
                    <td><?php echo money_format('%#10n',$pedido['total']) ?></td>
                    <td><?php echo $pedido['fecha']." ".$pedido['hora']?></td>
                    <td>                      <a href="pages/delive?codigo=<?php echo $pedido['codigo'] ?>" class="btn btn-warning warning-icon-notika waves-effect" target="_blank">
                                            <i class="notika-icon notika-edit"></i>
                                          </a>
                                          <a href="pages/delive?codigo=<?php echo $pedido['codigo'] ?>&d=true" class="btn btn-primary primary-icon-notika waves-effect" target="_blank">
                                            <i class="notika-icon notika-sent"></i>
                                          </a></td>
                  </tr>
                  <?php endforeach; ?>
                    </tbody>
                      <tfoot>
                      <tr>
                        <th>Código de pedido</th>
                        <th>Método de pago</th>
                        <th>Estado</th>
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

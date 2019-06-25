<?php
session_start();
include 'class/database.php';
include 'class/cajachica.php';
include 'class/ventas.php';
include 'class/pedidos.php';
setlocale(LC_MONETARY,"es_PE");
$conexion=new database();
$usuario=$_SESSION['usuario'];
$fecha=date('y')."-".date('m')."-".date('d');
$cajachica=new cajachica($fecha,$usuario,$conexion);
$ventas=new ventas($conexion);
$allPedidos=new pedidos($conexion);
$pedidos= $allPedidos->getPedidosUser();
$fondo=$cajachica->getCaja();
$gastar=$cajachica->getGastos();
$allVentas=$ventas->getVentas($fecha,$fecha);
$gastos=$totalvisa=$totalefectivo=$totalventas=0;
$totaldelivery=$totaldeliveryefectivo=$totaldeliveryvisa=$rechazados=$entregados=$totalenrechazados=0;
foreach ($pedidos as $pedido) {

    if($pedido['estado']==1){
      if($pedido['metodoPago'] == "efectivo")
        $totaldeliveryefectivo+=$pedido['total'];
      else
        $totaldeliveryvisa+=$pedido['total'];
    $entregados++;
    $totaldelivery+=$pedido['total'];
    }else {
        $totalenrechazados+=$pedido['total'];
        $rechazados++;
    }
}
foreach ($gastar as $gasto) {
  if ($gasto['caja']==0) {
      $gastos += $gasto['monto'];
  }

}
foreach ($allVentas as $venta) {
  if($venta['cerrado']==0){
    if($venta['metodoPago']=="efectivo"){
      $totalefectivo+=$venta['total'];
    }else {
      $totalvisa+=$venta['total'];
    }
    $totalventas+=$venta['total'];
  }
}
 ?>

 <style media="screen">
   .modal-dialog{
     max-width: 700px !important;
   }
   td,th{
     font-size: 0.85rem !important;
   }
 </style>

<div class="col-12 text-center">
  <p class="my-4">Debes cuadrar la caja antes de salir</p>
  <div class="row mt-4">
    <div class="col-12 ">
        <div class="form-group">
          <form action="core/cerrarCaja.php" method="post">
          <table class="table table-bordered">
            <tr>
              <td>Fondo</td>
              <td><?php echo money_format('%(#10n',$fondo); ?></td>
              <td>Gastos de hoy:  </td>
              <td><?php echo money_format('%(#10n',$gastos); ?></td>
            </tr>
            <tr>
              <th>Ventas</th>
            </tr>
            <tr>
              <td>En efectivo:</td>
              <td><?php echo money_format('%(#10n',$totalefectivo); ?></td>
              <td>Ventas en visa:</td>
              <td><?php echo money_format('%(#10n',$totalvisa); ?></td>
            </tr>
            <tr>
              <th>Delivery</th>
            </tr>
            <tr>
              <td>En efectivo:</td>
              <td><?php echo money_format('%(#10n',$totaldeliveryefectivo); ?></td>
              <td>En visa:</td>
              <td><?php echo money_format('%(#10n',$totaldeliveryvisa); ?></td>
              <td>Entregados: <?php echo $entregados." Rechazados:".$rechazados ?></td>
            </tr>
            <tr>
              <th>Total en ventas:</th>
              <th><?php echo money_format('%(#10n',$totalventas); ?></th>
              <th>Total en delivery:</th>
              <th><?php echo money_format('%(#10n',$totaldelivery); ?></th>
            </tr>
          </table>
          <button type="button" name="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="submit" name="button" class="btn btn-primary">Cerrar caja</button>
        </form>
        </div>
    </div>
  </div>
</div>

<script>
$(".salir").on('click',function () {
$("·exampleModal").modal('hide');
})
</script>

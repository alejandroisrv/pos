<?php
require_once "../../vendor/autoload.php";
include '../../class/database.php';
include '../../class/ventas.php';
include '../../class/pedidos.php';
setlocale(LC_MONETARY,"es_PE");
$conexion    =  new database();
$sale =  new ventas($conexion);
$pedidosClass=new pedidos($conexion);
$ventas=$sale->getVentaAdmin($_GET['codigo']);
$pedidoGeneral=$pedidosClass->getPedidoAdmin($_GET['codigo']);
if($pedidoGeneral['estado']==0){
  $estadoPedido="<small style='color:yellow;'>Pedido no entregado aun</small>";
}elseif ($pedidoGeneral['estado']==1) {
    $estadoPedido="<small style='color:green;'>Pedido entregado con exito</small>";
}else {
    $estadoPedido="<small style='color:red;'>Pedido rechazado</small>";
}
$html="

    <table>
      <tr>
        <td><img src='../../assets/img/logo-inv.png'/></td>
      </tr>
    <tr>
      <td class='table'><h2>LocalSucre</td>
    </tr>
    <tr>
      <td class='table'>Av. Sucre 1051, Pueblo Libre.</td>
    </tr>
      <tr>
        <td class='table'>Pedido delivery
        </td>
      </tr>
      <tr>
        <td class='table'>Pag&oacute; con ".$pedidoGeneral['metodoPago'].".
        </td>
      </tr>
      <tr>
        <td class='table'>Fecha: ".$pedidoGeneral['fecha']." "." Hora: ".$pedidoGeneral['hora'].".
      </td>
      <tr>
        <td class='table'>Hecha por: ".$pedidoGeneral['usuario'].".
      </td>

      </tr>
      </tr>
    </table>
    <table>
    <tr>
    <th>Datos de entrega</th>
    </tr>
    <tr>
      <td> ".$pedidoGeneral['nombre']." ".$pedidoGeneral['telefono']." ".
      $pedidoGeneral['direccion']." <small>".$pedidoGeneral['observaciones'] ."</small>.
      ".$estadoPedido."<small> (".$pedidoGeneral['rechazo'] .")</small>
    </td>
    </tr>
    </table>
    <table>
      <thead>
        <tr>
        <th class='align'>Cantidad</th>
        <th>Producto</th>
        <th>Precio de venta</th>
        <th>Sub-Total</th>
        </tr>
      </thead>
      <tbody>";

      foreach ($ventas as $venta) {
        $subtotal = $venta['cantidad']*$venta['precio'];
        $total+=$subtotal;
        $html.="<tr>
                  <td class='align'>".$venta['cantidad']."</td>
                  <td>".$venta['producto']."</td>
                  <td>".money_format('%(#10n',$venta['precio'])."</td>
                  <td>".money_format('%(#10n',$subtotal)."</td>
              </tr>";
      }
      $html.="<tr><th class='total align'>Total</th><th class='total'>".money_format('%(#10n',$total)."</th></tr>
          </tbody>
      </table>

      ";

$stylesheet = file_get_contents('bootstrap4.3.min.css');
$name="LocalSucre ".$_GET['codigo'].".pdf";
$htmlSalidas=utf8_encode($html);
$mpdf = new mPDF('R','A4', 11,'Arial');
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($htmlSalidas,2);
if($_GET['d']){
  $mpdf->Output($name,'D');
}else{
  $mpdf->Output();
}

?>

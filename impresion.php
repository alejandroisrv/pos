<?php
require_once "vendor/autoload.php";
include 'class/database.php';
include 'class/ventas.php';
setlocale(LC_MONETARY,"es_PE");
$conexion    =  new database();
$sale =  new ventas($conexion);
$ventas=$sale->getVentaAdmin($_GET['codigo']);
$ventasGeneral=$sale->getVenta($_GET['codigo']);
$stylesheet = file_get_contents('bootstrap4.3.min.css');
$name="LocalSucre ".$_GET['codigo'].".pdf";
$tipoText="Venta en el local";
$pagocon=$_GET['pagocon'];
$vuelto=$_GET['vuelto'];
if($_GET['pedido']){
  $ventaGeneral=$pedidosClass->getPedidoAdmin($codigo);
  $cliente=true;
}else{
  $ventaGeneral=$ventasClass->getVenta($codigo);
}
$html="
    <table>
    <tr></tr>
    <tr><td class='table'><h2>LICORERIA SUCRE</td></tr>
    <tr><td class='table'>TELEFONO:(01) 480-0167  943 727 483.</td></tr>
    <tr><td class='table'>DIRECCION: SUCRE S/N P. LIBRE ".$ventasGeneral['metodoVenta'].".</td></tr>
    <tr><td class='table'>".date('d/m/y')." ".date('H:i:s').".</td>";
    if($cliente){
      $html.="<tr><td class='table'>DIRECCION: ".strtoupper($ventaGeneral['direccion']).".</td></tr>
              <tr><td class='table'>NOMBRE: ".strtoupper($ventaGeneral['nombre'])." ".$ventaGeneral['telefono']."</td></tr>
              <tr><td class='table'>OBSERVACION: ".strtoupper($ventaGeneral['observaciones'])."</td></tr>";
    }
    $html.="
    </table>
    <table>
      <thead>
        <tr>
        <th class='align'>CANT</th>
        <th>ARTICULO</th>
        <th>PRECIO</th>
        </tr>
      </thead>
      <tbody>";

      foreach ($ventas as $venta) {
        $total+=$subtotal;
        $html.="<tr>
                  <td class='align'>".$venta['cantidad']."</td>
                  <td>".strtoupper($venta['producto'])."</td>
                  <td>".money_format('%(#10n',$venta['precio'])."</td>
              </tr>";
      }
      $html.="<tr><th class='total align'>Total</th><th class='total'>".money_format('%(#10n',$total)."</th></tr>
          </tbody>
      </table>  ";

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

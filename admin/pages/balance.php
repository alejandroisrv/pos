<?php
session_start();
$usuario=$_SESSION['usuario'];
include '../../class/database.php';
include '../../class/ventas.php';
include '../../class/pedidos.php';
include '../../class/cajachica.php';
require_once "../../vendor/autoload.php";
setlocale(LC_MONETARY,"es_PE");
function formatFecha($fecha)
{
  $desd= explode('/', $fecha);
  return "{$desd[2]}-{$desd[1]}-{$desd[0]}";
}
$desde=formatFecha($_POST['desde']);
$hasta=formatFecha($_POST['hasta']);
$conexion = new database();
$sale = new ventas($conexion);
$pedidos = new pedidos($conexion);
$cajachica= new cajachica($desde,$usuario,$conexion);
$gastos=$cajachica->getGastosAdmin($desde,$hasta);
$totalEnVentas=0;
$totalDomicilios=0;
$totalDelivery=0;
//Traer los gastos de esta semana;
$gastos=$cajachica->getGastosAdmin($desde,$hasta);
//Venta detalle (Productos, cantidad, etc) para sacar los productos más vendidos
$sales=$sale->getVentaPedidos($desde,$hasta);
//ventas/pedidos en general para sacar los metodos de pago y totales
$ventasGeneral =array_merge($sale->getVentas($desde,$hasta),$pedidos->getPedidosAdmin($desde,$hasta));


//Con las ventas detalle calculamos la lista de los productos vendidos con sus cantidades y el total a invertir por precio Costo
//inicializando variables
// $cantidad=$pasadas=$diferente=0;
// $productosVendidos = array();
// for ($i=0; $i <count($sales)+1 ; $i++) {
//     similar_text($sales[$i]['producto'],$diferente,$porcentaje);
//     if($porcentaje==100){
//       $pasadas++;
//       $cantidad+=$sales[$i]['cantidad'];
//     }else{
//       $pasadas++;
//       if($pasadas>1){
//         $productosVendidos[]=array('nombre' => $diferente ,'cantidad'=> $cantidad , 'precioCosto'=> $precioCosto,'precioVenta' => $precioVenta );
//         $cantidad=$sales[$i]['cantidad'];
//         $pasadas=1;
//       }else{
//         $cantidad+=$sales[$i]['cantidad'];
//       }
//       $diferente=$sales[$i]['producto'];
//       $precioCosto=$sales[$i]['precioCosto'];
//       $precioVenta=$sales[$i]['precio'];
//     }
// }

//Calculo de totales entre las ventas y los pedidos
for ($i=0; $i< count($ventasGeneral); $i++) {

  if($ventasGeneral[$i]['usuario']!=4){
    if($ventasGeneral[$i]['metodoVenta']==""){
        if($ventasGeneral[$i]['estado']==1){
          $ventasGeneral[$i]['metodoVenta']="Delivery";
          //Calculo de visa y efectivo;
          if($ventasGeneral[$i]['metodoPago']=="efectivo"){
            $totalDeliveryEfectivo+=$ventasGeneral[$i]['total'];
          }else if($ventasGeneral[$i]['metodoPago']=="visa"){
            $totalDeliveryVisa+=$ventasGeneral[$i]['total'];
            $porcentajeDelivery+=$ventasGeneral[$i]['total']*3.8/100;
          }

        }else {
          if($ventasGeneral[$i]['metodoPago']=="domicilios.com"){
            $totalDomicilios+=$ventasGeneral[$i]['total'];
            $porcentajeDomicilios+=$ventasGeneral[$i]['total']*18/100;
          }
        }
    }else {
      if($ventasGeneral[$i]['estado']==""){
        if($ventasGeneral[$i]['metodoPago']=="efectivo"){
          $totalVentasEfectivo+=$ventasGeneral[$i]['total'];
        }else{
          $totalVentasVisa+=$ventasGeneral[$i]['total'];
          $procentajeVentas+=$ventasGeneral[$i]['total']*3.8/100;
        }

      }
    }

  }

}
$totalEnDomicilios=$totalDomicilios-$porcentajeDomicilios;
$totalDelivery=$totalDeliveryEfectivo+($totalDeliveryVisa-$porcentajeDelivery);
$totalEnVentas=$totalVentasEfectivo+($totalVentasVisa-$procentajeVentas);
//calculo de los gastos;
for ($i=0; $i <count($gastos) ; $i++) {

  if($gastos[$i]['usuarioGastos']==$usuario){
    if($gastos[$i]['dato']!=""){
      $gastosMercancia+=$gastos[$i]['monto'];
    }else {
      $gastosAdmin+=$gastos[$i]['monto'];
    }
  }else{
    $gastosLocal+=$gastos[$i]['monto'];
  }
  $totalGastos+=$gastos[$i]['monto'];
}

$Total=$totalEnVentas+$totalDelivery+($totalDomicilios-$porcentajeDomicilios);
$ganancias=$Total-$totalGastos;
$html="
  <table>
    <tr><td class='table'><img src='../../assets/img/logo-inv.png'/></td></tr>
    <tr><td class='table'><h2>LocalSucre</td></tr>
    <tr><td class='table'>Av. Sucre 1051, Pueblo Libre.</td></tr>
    <tr><td class='table'>Balance general</td></tr>
    <tr><td class='table'>Del {$_POST['desde']} al {$_POST['hasta']}</td></tr>
  </table>";

//   $html.="<table>
//           <tr><th>Productos Vendidos</th></tr>
//           <tr><th>Cantidad</th><th>Producto</th></tr>";
//    for ($i=0; $i <count($productosVendidos) ; $i++) {
//      $html.= "<tr><td>".$productosVendidos[$i]['cantidad']."</td><td>".$productosVendidos[$i]['nombre']."</td>/tr>";
//    }
//    $html.="</table>";
$html.= "

      <table>
      <tr><th>Ventas de la tienda</th></tr>
      <tr><td class='tabla-balance tabla-balance-left';>Total en efectivo</td><td class='tabla-balance tabla-balance-left';>".money_format('%(#10n',$totalVentasEfectivo)."</td></tr>
      <tr><td class='tabla-balance tabla-balance-left';>Total en visa</td><td class='tabla-balance tabla-balance-left';>".money_format('%(#10n',$totalVentasVisa)."</td></tr>
            <tr><td class='tabla-balance tabla-balance-left';>Porcentaje 3.8% </td><td class='tabla-balance tabla-balance-left';>".money_format('%(#10n',$procentajeVentas)."</td></tr>
      <tr><th>Total</th><th>".money_format('%(#10n',$totalEnVentas)."</th></tr>


      <tr><th>Ventas delivery</th></tr>
      <tr><td class='tabla-balance tabla-balance-left';>Total en efectivo</td><td class='tabla-balance tabla-balance-left';>".money_format('%(#10n',$totalDeliveryEfectivo)."</td></tr>
      <tr><td class='tabla-balance tabla-balance-left';>Total en visa</td><td class='tabla-balance tabla-balance-left';>".money_format('%(#10n',$totalDeliveryVisa)."</td></tr>
            <tr><td class='tabla-balance tabla-balance-left';>Porcentaje 18% </td><td class='tabla-balance tabla-balance-left';>".money_format('%(#10n',$porcentajeDelivery)."</td></tr>
      <tr><th>Total</th><th>".money_format('%(#10n',$totalDelivery)."</th></tr>
      <tr><th>Pedidos domicilios.com</th></tr>
      <tr><td class='tabla-balance tabla-balance-left';>Total</td><td class='tabla-balance tabla-balance-left';>".money_format('%(#10n',$totalDomicilios)."</td></tr>
            <tr><td class='tabla-balance tabla-balance-left';>Porcentaje 18% </td><td class='tabla-balance tabla-balance-left';>".money_format('%(#10n',$porcentajeDomicilios)."</td></tr>
      <tr><th>Total</th><th>".money_format('%(#10n',$totalEnDomicilios)."</th></tr>
      <tr><th class='total-balance'>Total:</th><th>".$totalEnVentas." + ". $totalDelivery." + ".$totalEnDomicilios." = ".money_format('%(#10n',$Total). " </th></tr>
      <tr><th>Gastos</th></tr>
      <tr><td class='tabla-balance tabla-balance-left';>Gastos administrativos</td><td class='tabla-balance tabla-balance-left';>".money_format('%(#10n',$gastosAdmin)."</td></tr>
      <tr><td class='tabla-balance tabla-balance-left';>Gastos en el local</td><td class='tabla-balance tabla-balance-left';>".money_format('%(#10n',$gastosLocal)."</td></tr>
      <tr><td class='tabla-balance tabla-balance-left';>Gastos en mercancia</td><td class='tabla-balance tabla-balance-left';>".money_format('%(#10n',$gastosMercancia)."</td></tr>
      <tr><td class='tabla-balance tabla-balance-left total-balance';>Total en gastos</td><td class='tabla-balance tabla-balance-left total-balance';>".money_format('%(#10n',$totalGastos)."</td></tr>
      <tr><td class='tabla-balance tabla-balance-left total-balance';>Ganancias</td><td class='tabla-balance tabla-balance-left total-balance';>".money_format('%-#10n',$ganancias)."</td></tr>
      </table>";


  $stylesheet = file_get_contents('bootstrap4.3.min.css');
  $name="LocalSucre Reporte de ventas desde ".$_POST['desde']." hasta ".$_POST['hasta'].".pdf";
  $htmlSalidas=utf8_encode($html);
  $mpdf = new mPDF('R','A4', 11,'Arial');
  $mpdf->SetTitle($name);
  $mpdf->SetDisplayMode('fullpage');
  $mpdf->WriteHTML($stylesheet,1);
  $mpdf->WriteHTML($htmlSalidas,2);
  if($_POST['d']){
    $mpdf->Output($name,'D');
  }else{
    $mpdf->Output();
  }








 ?>

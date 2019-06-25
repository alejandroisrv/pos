<?php
require_once "../../vendor/autoload.php";
include '../../class/database.php';
include '../../class/ventas.php';
include '../../class/pedidos.php';
setlocale(LC_MONETARY,"es_PE");
$conexion    =  new database();
$ventasClass= new ventas($conexion);
$pedidosClass=new pedidos($conexion);
function formatFecha($fecha)
{
  $desd= explode('/', $fecha);
  return "{$desd[2]}-{$desd[1]}-{$desd[0]}";
}
$desde=formatFecha($_POST['desde']);
$hasta=formatFecha($_POST['hasta']);
$showProducto=$_POST['showProductos'];
$metodoPago=strtolower($_POST['metodoPago']);
$metodoVenta=strtolower($_POST['metodoVenta']);

//Ver en que db vamos a consultar
if($metodoVenta=="dia" || $metodoVenta=="noche"){
  $ventasGeneral =$ventasClass->getVentas($desde,$hasta);
}elseif($metodoVenta=="delivery") {
  $ventasGeneral =$pedidosClass->getPedidosAdmin($desde,$hasta);
}else if($metodoVenta=="domicilios.com"){
  $ventasGeneral =$pedidosClass->getDomiciliosAdmin($desde,$hasta);
}else{
  $ventasGeneral =array_merge($ventasClass->getVentas($desde,$hasta),$pedidosClass->getPedidosAdmin($desde,$hasta));
}

$html="
  <table>
    <tr><td class='table'><img src='../../assets/img/logo-inv.png'/></td></tr>
    <tr><td class='table'><h2>LocalSucre</td></tr>
    <tr><td class='table'>Av. Sucre 1051, Pueblo Libre.</td></tr>
    <tr><td class='table'>Reporte de ventas (".$_POST['desde']." hasta ".$_POST['hasta'].")</td></tr>
    <tr><td class='table'>Metodo de pago: ".ucfirst($metodoPago)." </td></tr>
    <tr><td class='table'>Modo de venta: ".ucfirst($metodoVenta).".</td></tr>
    <tr><td class='table'>Total de resultados: ".count($ventasGeneral).".</td></tr>
  </table>";
foreach ($ventasGeneral as $ventaGeneral) {
    $metodoVentaFinal=($ventaGeneral['metodoVenta']=="") ? ucfirst("delivery") : ucfirst($ventaGeneral['metodoVenta']);
    if($metodoVenta="delivery") $estadoPedido= ($ventaGeneral['estado']==1) ? 'Entregado' : 'No entregado/rechazado' ;
    if(($metodoPago!="todos")){
      if(($ventaGeneral['metodoPago']==$metodoPago) || ($metodoVenta==$ventaGeneral['metodoPago'])){
        if(($metodoVenta==$ventaGeneral['metodoVenta']) || ($metodoVenta=="todos") || ($metodoVenta=="delivery" || ($metodoVenta==$ventaGeneral['metodoPago']))){
            $tablaInterna.="
                  <br>
                  <table style='margin-bottom:5px !important'>
                    <tr><th class='table'>".$metodoVentaFinal."</th></tr>
                    <tr><td class='table'>Pag&oacute; con ".$ventaGeneral['metodoPago'].".</td></tr>
                    <tr><td class='table'> ".$ventaGeneral['fecha']." ".$ventaGeneral['hora'].".</td></tr>
                    <tr><td class='table'>Relizada por: ".$ventaGeneral['usuario'].".</td></tr>
                    <tr><td class='table'>".$estadoPedido.".</td></tr>
                  </table>";
                  if($showProducto){
                    $tablaInterna.="
                    <table style='margin-bottom:1px !important'>
                      <thead>
                        <tr>
                        <th class='align'>Cantidad</th>
                        <th>Producto</th>
                        <th>Precio de venta</th>
                        <th>Sub-Total</th>
                        </tr>
                      </thead>
                      <tbody>";
                      $ventas=$ventasClass->getVentaAdmin($ventaGeneral['codigo']);
                      foreach ($ventas as $venta) {
                        $subtotal = $venta['cantidad']*$venta['precio'];
                        $total+=$subtotal;
                        $tablaInterna.="<tr>
                                  <td class='align'>".$venta['cantidad']."</td>
                                  <td>".$venta['producto']."</td>
                                  <td>".money_format('%(#10n',$venta['precio'])."</td>
                                  <td>".money_format('%(#10n',$subtotal)."</td>
                              </tr>";
                      }
                      $tablaInterna.="
                        </tbody>
                      </table>";
                  }

                  $tablaInterna.="
                  <table>
                      <tbody><tr><th>Sub-total ".money_format('%(#10n',$ventaGeneral['total'])."</th></tr>";
                  if($ventaGeneral['metodoPago']=="visa"){
                      $totalVentaGeneral=$ventaGeneral['total']-($ventaGeneral['total']*3.8/100);
                      $tablaInterna.="<tr><th>Sub-total neto (-3.8%) ".money_format('%(#10n',$totalVentaGeneral)."</th></tr>";
                  }else{
                      $totalVentaGeneral=$ventaGeneral['total'];
                  }

                  $tablaInterna.="</tbody></table>";

                  $totalEnVentas+=$totalVentaGeneral;
          }
      }
    }else{

      //$metodoVenta="domicilios.com";
      if(($metodoVenta==$ventaGeneral['metodoVenta']) || ($metodoVenta=="todos") || ($metodoVenta=="delivery") || ($metodoVenta==$ventaGeneral['metodoPago'])){
        $tablaInterna.="
              <br>
              <table style='margin-bottom:5px !important'>
                <tr><th class='table'>".$metodoVentaFinal."</th></tr>
                <tr><td class='table'>Pag&oacute; con ".$ventaGeneral['metodoPago'].".</td></tr>
                <tr><td class='table'> ".$ventaGeneral['fecha']." ".$ventaGeneral['hora'].".</td></tr>
                <tr><td class='table'>Relizada por: ".$ventaGeneral['usuario'].".</td></tr>
                <tr><td class='table'>".$estadoPedido.".</td></tr>
              </table>";
              if($showProducto){
                $tablaInterna.="
                <table style='margin-bottom:1px !important'>
                  <thead>
                    <tr>
                    <th class='align'>Cantidad</th>
                    <th>Producto</th>
                    <th>Precio de venta</th>
                    <th>Sub-Total</th>
                    </tr>
                  </thead>
                  <tbody>";
                  $ventas=$ventasClass->getVentaAdmin($ventaGeneral['codigo']);
                  foreach ($ventas as $venta) {
                    $subtotal = $venta['cantidad']*$venta['precio'];
                    $total+=$subtotal;
                    $tablaInterna.="<tr>
                              <td class='align'>".$venta['cantidad']."</td>
                              <td>".$venta['producto']."</td>
                              <td>".money_format('%(#10n',$venta['precio'])."</td>
                              <td>".money_format('%(#10n',$subtotal)."</td>
                          </tr>";
                  }
                  $tablaInterna.="
                    </tbody>
                  </table>";
              }

              $tablaInterna.="
              <table>
                  <tbody><tr><th>Sub-total ".money_format('%(#10n',$ventaGeneral['total'])."</th></tr>";
              if($ventaGeneral['metodoPago']=="visa"){
                  $totalVentaGeneral=$ventaGeneral['total']-($ventaGeneral['total']*3.8/100);
                  $tablaInterna.="<tr><th>Sub-total neto (-3.8%) ".money_format('%(#10n',$totalVentaGeneral)."</th></tr>";
              }else{
                  $totalVentaGeneral=$ventaGeneral['total'];
              }

              $tablaInterna.="</tbody></table>";

              $totalEnVentas+=$totalVentaGeneral;
        }
      }
    }
    $tablaInterna.="
    <table>
        <tr><th class='total'>Total</th><th class='total'>".money_format('%-#10n',$totalEnVentas)."</th></tr>

    </table>";

    $stylesheet = file_get_contents('bootstrap4.3.min.css');
    $name="LocalSucre Reporte de ventas desde ".$_POST['desde']." hasta ".$_POST['hasta'].".pdf";
    $htmlSalidas=utf8_encode($html);
    $mpdf = new mPDF('R','A4', 11,'Arial');
    $mpdf->SetTitle($name);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->WriteHTML($htmlSalidas,2);
    $mpdf->WriteHTML($tablaInterna,2);
    if($_POST['d']){
      //$mpdf->Output($name,'D');
    }else{
      $mpdf->Output();
    }


 ?>

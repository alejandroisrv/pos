<?php
include '../../class/database.php';
include '../../class/ventas.php';
require_once "../../vendor/autoload.php";
setlocale(LC_MONETARY,"es_PE");
$conexion=new database();
$sale=new ventas($conexion);
$sales=$sale->getVentaPedidos();
$diferente;
$cantidad=0;
$pasadas=0;
$productosVendidos = array();
$html="
  <table>
    <tr><td class='table'><img src='../../assets/img/logo-inv.png'/></td></tr>
    <tr><td class='table'><h2>LocalSucre</td></tr>
    <tr><td class='table'>Av. Sucre 1051, Pueblo Libre.</td></tr>
    <tr><td class='table'>Listado de productos faltantes/vendidos</td></tr>
    <tr><td class='table'>Ultimos 7 dias</td></tr>
  </table>";

for ($i=0; $i <count($sales)+1 ; $i++) {
    similar_text($sales[$i]['producto'],$diferente,$porcentaje);
    if($porcentaje==100){
      $pasadas++;
      $cantidad+=$sales[$i]['cantidad'];
    }else{
      $pasadas++;
      if($pasadas>1){
        $productosVendidos[]=array('nombre' => $diferente ,'cantidad'=> $cantidad , 'precioCosto'=> $precioCosto,'precioVenta' => $precioVenta );
        $cantidad=$sales[$i]['cantidad'];
        $pasadas=1;
      }else{
        $cantidad+=$sales[$i]['cantidad'];
      }
      $diferente=$sales[$i]['producto'];
      $precioCosto=$sales[$i]['precioCosto'];
      $precioVenta=$sales[$i]['precio'];
    }
}

$html.="<table style='text-align:left;'>
          <tr>
            <th>Cantidad</th>
            <th>Producto</th>
            <th>Precio costo</th>
            <th>Sub-total</th>
          </tr>";

for ($i=0; $i <count($productosVendidos) ; $i++) {
    $subtotal=$productosVendidos[$i]['cantidad']*$productosVendidos[$i]['precioCosto'];
    $total+=$subtotal;
    $vendido+=$productosVendidos[$i]['cantidad']*$productosVendidos[$i]['precioVenta'];

    $html.="<tr>
            <th>{$productosVendidos[$i]['cantidad']}</th>
            <td>{$productosVendidos[$i]['nombre']}</td>
            <td>".money_format('%(#10n',$productosVendidos[$i]['precioCosto'])."</td>
            <td>".money_format('%(#10n',$subtotal)."</td>
          </tr>";
}
$ganacias=$vendido-$total;
$html.= "</table>
          <table>
          <tr>
          <th class='total'>Total a invertir:".money_format('%(#10n',$total)."</th>
      </tr>
      </table>";

      $stylesheet = file_get_contents('bootstrap4.3.min.css');
      $name="LocalSucre reporte de gastos desde ".$_POST['desde']." hasta ".$_POST['hasta'].".pdf";
      $htmlSalidas=$html;
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

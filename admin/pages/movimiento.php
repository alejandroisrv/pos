<?php
require_once "../../vendor/autoload.php";
include '../../class/database.php';
include '../../class/movimientos.php';
setlocale(LC_MONETARY,"es_PE");
$conexion    =  new database();
$mov =  new movimientos($conexion);
$movimientos=$mov->getMovimiento($_GET['orden']);
$stylesheet = file_get_contents('bootstrap4.3.min.css');
if($movimientos[0]['tipo']>0){
  $tipoText="Compra de mercancia";
}else{
  $tipoText="Salida de mercancia del inventario";
}
$fec = explode('-', $movimientos[0]['fecha']);
$fecha = "{$fec[2]}/{$fec[1]}/{$fec[0]}";
$name="LocalSucre ".$_GET['orden'].".pdf";
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
        <td class='table'>".$tipoText.".
        </td>
      </tr>
      <tr>
        <td class='table'>Fecha: ".$fecha.".
        </td>
      </tr>
    </table>
    <table>
      <thead>
        <tr>
        <th>Producto</th>
        <th>Precio de costo</th>
        <th>Cantidad</th>
        <th>Total</th>
        </tr>
      </thead>
      <tbody>";

      foreach ($movimientos as $movimiento) {
        $cantidad=$movimiento['cantidad']*$movimiento['tipo'];
        $subtotal = $cantidad *$movimiento['precioCosto'];
        $total+=$subtotal;
        $html.="<tr>
                  <td>".$movimiento['producto']."</td>
                  <td class='center'>".money_format('%(#10n',$movimiento['precioCosto'])."</td>
                  <td>".$cantidad."</td>
                  <td class='center'>".money_format('%(#10n',$subtotal)."</td>
              </tr>";
      }
      $html.="<tr><th class='total'>Total:</th><th class='total'>".money_format('%(#10n',$total)."</th></tr>
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

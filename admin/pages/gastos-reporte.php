<?php
require_once "../../vendor/autoload.php";
include '../../class/database.php';
include '../../class/cajachica.php';
setlocale(LC_MONETARY,"es_PE");
function formatFecha($fecha)
{
  $desd= explode('/', $fecha);
  return "{$desd[2]}-{$desd[1]}-{$desd[0]}";
}
$conexion=new database();
$gastosClass=new cajachica($desde,2,$conexion);
$desde=formatFecha($_POST['desde']);
$hasta=formatFecha($_POST['hasta']);
$tipoGasto=$_POST['tipo'];
$gastos=$gastosClass->getGastosAdmin($desde,$hasta);
$html="
  <table>
    <tr><td class='table'><img src='../../assets/img/logo-inv.png'/></td></tr>
    <tr><td class='table'><h2>LocalSucre</td></tr>
    <tr><td class='table'>Av. Sucre 1051, Pueblo Libre.</td></tr>
    <tr><td class='table'>Reporte de gastos (".$_POST['desde']." hasta ".$_POST['hasta'].")</td></tr>
    <tr><td class='table'>".$tipoGasto." </td></tr>
  </table>";
  $html.="
  <table style='margin-bottom:1px !important';>
    <thead>
      <tr><th>Descripcion</th><th>Monto</th><th>Usuario</th><th>Fecha</th></tr>
    </thead>
    <tbody>";
function showGastos($gastoShow,&$html) {
    global $total;
    $total+=$gastoShow['monto'];
    $html.="<tr>
              <td>".$gastoShow['descripcion']."</td>
              <td>".money_format('%(#10n',$gastoShow['monto'])."</td>
              <td>".$gastoShow['usuario']."</td>
              <td>".$gastoShow['date']."</td>
          </tr>";
}
if ($tipoGasto!=="Todos") {
  for ($i=0; $i < count($gastos) ; $i++) {
      if (($tipoGasto==="Compra de mercancia" ) && ($gastos[$i]['dato']!==null)) {
        showGastos($gastos[$i],$html);
      }elseif (($tipoGasto==="Gastos en el local" ) && ($gastos[$i]['caja']==1)) {
        showGastos($gastos[$i],$html);
      }elseif (($tipoGasto==="Gastos administrativos" ) && ($gastos[$i]['usuarioGastos']==2 && $gastos[$i]['dato']===null)) {
        showGastos($gastos[$i],$html);
      }
    }
  }else {
      for ($i=0; $i < count($gastos) ; $i++) {
        showGastos($gastos[$i],$html);
      }

  }
  $html.="
    </tbody>
  </table>";
  $html.="
  <table>
      <tr><th class='total'>Total ".money_format('%(#10n',$total)."</th></tr>
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

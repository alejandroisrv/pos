<?php
include 'class/cajachica.php';
setlocale(LC_MONETARY,"es_PE");
$fecha=date('y')."-".date('m')."-".date('d');
$cajachica = new cajachica();
$gastos=$cajachica->getGastos($fecha);
foreach ($gastos as $gasto) {
      $monto += $gasto['monto'];
}



















 ?>

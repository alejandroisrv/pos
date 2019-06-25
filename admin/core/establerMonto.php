<?php
include '../../class/cajachica.php';
include '../../class/database.php';

$conexion=new database();
$cajachica=new cajachica(null,null,$conexion);
$monto=$_POST['monto'];
echo $cajachica->setLimite($monto);











 ?>

<?php
include '../../class/database.php';
include '../../class/cajachica.php';
$conexion=new database();
$spend=new cajachica(date('Y-d-m'),2,$conexion);
$descripcion=$_POST['descripcion'];
$monto=$_POST['monto'];
$frecuencia=$_POST['frecuencia'];;
if($_POST['idgasto']!=""){
    $gasto=$spend->updateGasto($descripcion,$monto,$frecuencia,$_POST['idgasto']);
}else{
    $gasto=$spend->gastar($monto,$descripcion,null,$frecuencia=null);

}

if($gasto>0){
  echo "OK";
}else{
  echo "ERROR";
}








 ?>

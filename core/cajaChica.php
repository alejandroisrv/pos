<?php
include '../class/cajachica.php';
include '../class/database.php';
session_start();
$usuario=$_SESSION['usuario'];
$conexion= new database();
$fecha=date('y')."-".date('m')."-".date('d');
$caja=new cajachica($fecha,$usuario,$conexion);
$montos=$_POST['monto'];
$descripcion=$_POST['descripcion'];
  foreach( $montos as $key => $monto ) {
    if($monto>0){
      $result+=$caja->gastar($monto,$descripcion[$key]);
    }
  }


if($result>0){
  echo "OK";
}






 ?>

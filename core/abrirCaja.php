<?php
session_start();
include '../class/database.php';
include '../class/cajachica.php';
$usuario = $_SESSION['usuario'];
$conexion= new database();
$fondo=$_POST['fondo'];
$caja= new cajachica($fecha,$usuario,$conexion);
  $row=$caja->abrirCaja($fondo);
  if($row>0){
    $conexion->query("UPDATE usuarios SET caja = 1 WHERE id = $usuario");
    $_SESSION['caja']=1;
    echo "OK";
  }else{
    echo "ERROR";
  }








 ?>

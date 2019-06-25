<?php
session_start();
include '../class/database.php';
include '../class/cajachica.php';
$conexion= new database();
$fecha=date('y')."-".date('m')."-".date('d');
$usuario=$_SESSION['usuario'];
$cajachica= new cajachica($fecha,$usuario,$conexion);
$cerrarCaja=$cajachica->cerrarCaja();
if($cerrarCaja>0){
  session_start();
  session_destroy();
  unset($_SESSION['usuario']);
  header('Location:../login');
}




















 ?>

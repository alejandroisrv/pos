<?php
setlocale(LC_MONETARY,"es_PE");
require('core/fpdf/fpdf.php');
include 'class/ventas.php';
include 'class/database.php';
include 'class/pedidos.php';
$conexion=new database();
$codigo=$_GET['codigo'];
$ventasClass=new ventas($conexion);
$pedidosClass=new pedidos($conexion);

$pagocon=$_GET['pagocon'];
$vuelto=$_GET['vuelto'];

if($_GET['pedido']){
    $ventaGeneral=$pedidosClass->getPedidoAdmin($codigo);
    $cliente=true;
}else{
    $ventaGeneral=$ventasClass->getVenta($codigo);
}
$ventas=$ventasClass->getVentaAdmin($codigo);
$productos = array();
foreach($ventas as $venta){
  $producto=array(
   	"q"=>$venta['cantidad'],
   	"name"=>$venta['producto'],
    "price"=>$venta['precio']);
    array_push($productos,$producto) ;
}

var_dump($ventaGeneral);
?>


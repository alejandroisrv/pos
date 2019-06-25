<?php
include '../../class/database.php';
include '../../class/productos.php';
$conexion=new database();
$products=new productos($conexion);
$productoNombre=$_POST['nombre'];
$precioCosto=$_POST['precioCosto'];
$precioVenta=$_POST['precioVenta'];
$precioNoche=$_POST['precioNoche'];;
$precioDelivery=$_POST['precioDelivery'];
$precioDomicilio=$_POST['precioDomicilio'];
$proveedor=$_POST['proveedor'];
if($_POST['idproducto']!=""){
    $producto=$products->updateProducts($productoNombre, $precioCosto,$precioVenta,$precioNoche,$precioDelivery,$precioDomicilio,$proveedor,$_POST['idproducto']);
}else{
    $producto=$products->addProduct($productoNombre, $precioCosto,$precioVenta,$precioNoche,$precioDelivery,$precioDomicilio,$proveedor);
}

if($producto>0){
  echo "OK";
}else{
  echo "ERROR";
}








 ?>

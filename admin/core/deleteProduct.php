<?php

include '../../class/database.php';
include '../../class/productos.php';
$conexion= new database();
$products=new productos($conexion);
$id=$_GET['idproducto'];
$row=$products->deleteProduct($id);

if($row>0){
echo "OK";
}else{
  echo $id;
}










 ?>

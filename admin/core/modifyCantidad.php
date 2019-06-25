<?php

include '../../class/database.php';
include '../../class/productos.php';
include '../../class/cajachica.php';
include '../../class/movimientos.php';
$conexion  =  new database();
$products  =  new productos($conexion);
$cajachica =  new cajachica(null,2,$conexion);
$movimientos =  new movimientos($conexion);
$productos=$_POST['producto'];
$cantidad=$_POST['cantidad'];
$tipo=$_POST['tipo'];
$resultado=0;
foreach ($productos as $key => $producto) {
      $calcularGasto=$products->getProduct($producto);
      $cantidadFinal=$cantidad[$key]*$tipo;
      $gasto+=$calcularGasto['precioCosto']*$cantidadFinal;
        $resultadoP=$products->modifyCantidad($producto,$cantidadFinal);
        $resultadoM=$movimientos->saveMovimientos($producto,$cantidadFinal);
      if(($resultadoP>0 ) && ($resultadoM>0)){
          $resultado++;
      }
}

if($resultado>0){
  if($tipo>0){
    $gastar=$cajachica->gastar($gasto,"Compra de mercancia",$movimientos->orden);
  }
    $saveMovimiento=$movimientos->saveMovimiento($tipo,$gasto);
    echo "OK";
}else {
  echo "ERROR";
}

 ?>

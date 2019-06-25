<?php

include 'conexion.php';


function generarCodigo() {
   $key = '';
   $pattern = '1234567890';
   $max = strlen($pattern)-1;
   for($i=0;$i < 6;$i++) $key .= $pattern{mt_rand(0,$max)};
   return $key;
}

$code=false;
while ($code==false) {

  $orden=generarCodigo();
  $comprueba=$con_pdo->query("SELECT * FROM `movimientos` WHERE orden='$orden'");
  if ($comprueba->rowCount()==0) {

    $code=true;

  }else {

    $code=false;

  }
}

try {


  $factura=$_POST['factura'];
  foreach (array_keys($_POST['producto']) as $key => $value) {

      $cantidad=$_POST['cantidadProductoVentas'][$key];
      $producto=$_POST['producto'][$key];
      $sql_update="UPDATE `productos` SET cantidad=cantidad-$cantidad WHERE producto='$producto'";
      $sql_ventas="INSERT INTO `movimientos` (`producto`, `cantidad`, `factura`,`orden`,`tipo`,`fecha`) VALUES ('$producto','$cantidad','$factura','$orden',1,now())";
      $con_pdo->query($sql_update);
      $con_pdo->query($sql_ventas);

  }
  echo "OK";
} catch (\Exception $e) {

  echo $e->getMessage;


}



 ?>

  <?php

  include 'conexion.php';
$producto=ucwords(strtolower($_POST['producto']));
$precioCosto=$_POST['precioCosto'];
$precioVenta=$_POST['precioDia'];
$precioNoche=$_POST['precioNoche'];
$precioDelivery=$_POST['precioDelivery'];

$ganancia=$precioVenta-$precioCosto;
try {
    $queryComprueba=$con_pdo->query("SELECT * FROM productos WHERE producto ='$producto' ");
    if($queryComprueba->rowCount()==0){
      $sql="INSERT INTO `productos`( `producto`, `precioCosto`, `precioVenta`,`precioNoche`,`precioDelivery`,`ganancias`)
      VALUES ('$producto','$precioCosto','$precioVenta',
                '$precioNoche','$precioDelivery','$ganancia') ";
      $con_pdo->query($sql);
      echo "OK";
    }else {
      echo "ERROR";
    }


} catch (\Exception $e) {

   echo $e->getMessage();

}

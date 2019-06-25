<?php

include 'conexion.php';

$idproducto=$_POST['idproducto'];
$producto=$_POST['producto'];
$precioCosto=$_POST['precioCosto'];
$precioVenta=$_POST['precioDia'];
$precioNoche=$_POST['precioNoche'];
$precioDelivery=$_POST['precioDelivery'];
$ganancia=$precioVenta-$precioCosto;

try {



    $sql="UPDATE productos SET producto='$producto', precioCosto='$precioCosto', precioVenta='$precioVenta', precioNoche ='$precioNoche',
        precioDelivery = '$precioDelivery', ganancias='$ganancia' WHERE idproducto ='$idproducto'";
    $con_pdo->query($sql);
    echo "OK";


} catch (\Exception $e) {

 echo $e->getMessage();

}

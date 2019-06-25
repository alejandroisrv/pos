<?php
include '../class/database.php';
include '../class/pedidos.php';
$conexion= new database();
$pedidos=new pedidos($conexion);
$observaciones=$_POST['observaciones'];
$idpedidos=$_POST['idpedido'];
$sqlS="SELECT codigo FROM pedidos WHERE idpedido='$idpedidos' LIMIT 0,1";
$codigoPedidos=$conexion->query($sqlS);
while($codigos=$codigoPedidos->fetch(PDO::FETCH_ASSOC)){
    $codigoPedido=$codigos['codigo'];
}
$sql="SELECT idproducto,cantidad FROM venta WHERE codigo='$codigoPedido'";
$venta=$conexion->query($sql);
while ($ventas=$venta->fetch(PDO::FETCH_ASSOC)) {
    $producto=$ventas['idproducto'];
    $cantidad=$ventas['cantidad'];
    $sql="UPDATE productos SET cantidad=cantidad+$cantidad WHERE idproducto=$producto";
    $updateProducto=$conexion->query($sql);
}



$updatePedido=$pedidos->updatePedido(2,0,$idpedidos,$observaciones);
if($updatePedido)
  echo "OK";
else
 echo "ERROR";


 ?>

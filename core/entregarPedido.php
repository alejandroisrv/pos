<?php
include '../class/database.php';
include '../class/pedidos.php';
$conexion= new database();
$pedidos=new pedidos($conexion);
$observaciones=$_POST['observaciones'];
$idpedidos=$_POST['idpedido'];
$updatePedido=$pedidos->updatePedido(1,0,$idpedidos,$observaciones);
if($updatePedido)
  echo "OK";
else
    echo "ERROR";



 ?>

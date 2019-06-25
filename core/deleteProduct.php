<?php

include 'conexion.php';
try {
  $id=$_GET['id'];
  $sql="DELETE FROM productos WHERE idproducto='$id' ";
  $queryDelete=$con_pdo->query($sql);
  echo "OK";
} catch (\Exception $e) {

  echo $e->getMessage();

}

;



















 ?>

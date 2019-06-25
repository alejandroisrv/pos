<?php
include 'conexion.php';
$codigo=$_COOKIE['codigo'];
$vaciar=$con_pdo->query("DELETE FROM venta WHERE codigo = '$codigo' ");

if($vaciar->rowCount()>0){
  echo "OK";
}else {
  echo "ERROR";
  
}






?>

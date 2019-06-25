<?php
include 'class/database.php';
$conexion=new database();
$pedidos=$conexion->query("SELECT * FROM pedidos WHERE usuario =3 AND cerrado =0");
echo $pedidos->rowCount();

 ?>

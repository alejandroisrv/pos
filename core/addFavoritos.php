<?php
include 'conexion.php';


$ids=explode(',',$_POST['fav']);
$removeFavoritos = $con_pdo->query("UPDATE productos SET favoritos = 0");
foreach ($ids as $id) {
  $addFavoritos = $con_pdo->query("UPDATE productos SET favoritos = 1 WHERE producto = '$id' ");
}

echo "OK";
























?>

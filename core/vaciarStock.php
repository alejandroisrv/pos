<?php 


include 'conexion.php';



$vaciar=$con_pdo->query("UPDATE productos SET cantidad = 0 ");


if($vaciar->rowCount()>0){
    echo "OK";
}else{
    echo "ERROR";
}




?>
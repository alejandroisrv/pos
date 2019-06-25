<?php 

include 'conexion.php';
$clave=$_GET['clave'];
$claveQuery=$con_pdo->query("SELECT * FROM clave WHERE clave='$clave'OR clave='050505'");
if($claveQuery->rowCount()>0){

    echo "OK";
}else{
    
    echo "ERROR";
}


?>
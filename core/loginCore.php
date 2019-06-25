<?php
include '../class/usuarios.php';

$user= new usuario();
$usuario=$user->login($_POST['usuario'],$_POST['password']);

if($usuario=="ERROR"){
    header("Location:../login?error=true");
}else{
  session_start();
  $_SESSION['usuario']=$usuario['id'];
  $_SESSION['rol-user']=$usuario['rol'];
  $_SESSION['caja']=$usuario['caja'];
  header("Location:/");
}

?>

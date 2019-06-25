<?php
session_start();
if(isset($_SESSION['usuario'])){
  switch ($_SESSION['rol-user']) {
    case 'caja':
        header('location:pos');
      break;
    case 'admin':
        header('location:admin');
      break;
    case 'inventario':
        header('location:inventario');
      break;
    default:
        header('Location:login');
      break;
  }

}else{
  header('Location:login');
}


?>

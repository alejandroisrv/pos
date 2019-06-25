<?php


try {

  $con_pdo=new PDO("mysql:host=localhost;dbname=pando199_appinve;charset=utf8", "pando199_inv", "appinve");
  $con_pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (\Exception $e) {

  echo $e->getMessage();
}


 ?>

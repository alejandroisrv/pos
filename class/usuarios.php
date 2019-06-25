<?php
include 'database.php';

/**
 *
 */
class usuario
{
  public $conexion;
  function __construct()
  {
    $this->conexion=new database();
  }

  public function getUser($id)
  {
    $sql="SELECT * FROM `usuarios` WHERE id=? LIMIT 0,1";
    $setUser=$this->conexion->prepare($sql);
    $setUser->bindParam(1,$id);
    $setUser->execute();
    if($setUser->rowCount()>0){
        return $setUser->fetch();
    }else{
        return "Usuario no encontrado";
    }

  }
  public function setUser($name,$user,$pass,$rol)
  {
    // code...
  }
  public function login($user,$password){
    $sql="SELECT * FROM `usuarios` WHERE usuario=? AND password = ? LIMIT 0,1";
    $setUser=$this->conexion->prepare($sql);
    $setUser->bindParam(1,$user);
    $setUser->bindParam(2,$password);
    $setUser->execute();
    if($setUser->rowCount()>0){
        return $setUser->fetch();
    }else{
        return "ERROR";
    }
  }
}





















 ?>

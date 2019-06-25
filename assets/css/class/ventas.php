<?php
class ventas
{
  public $conexion;
  public $codigo;
  function __construct($conexion)
  {
    $this->conexion=$conexion;
    $this->codigo=$_COOKIE['codigo'];
    $this->modoVenta=$_COOKIE['modoventa'];
  }

  function getVentas($desde,$hasta)
  {
    $sql="SELECT * FROM ventas WHERE fecha between ? AND ? ";
    $getVenta=$this->conexion->prepare($sql);
    $getVenta->execute(array($desde,$hasta));
    return $getVenta->fetchAll(PDO::FETCH_ASSOC);
  }
  public function vender($usuario,$total,$metodoPago){
    $sql="INSERT INTO `ventas`( `codigo`, `fecha`, `hora`,`total`,`metodoPago`,`metodoVenta`,`usuario`)
             VALUES (?,now(),now(),?,?,?,?)";
    $vender=$this->conexion->prepare($sql);
    $vender->execute(array($this->codigo,$total,$metodoPago,$this->modoVenta,$usuario));
    return $vender;
}



}



 ?>

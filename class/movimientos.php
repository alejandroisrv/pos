<?php


/**
 *
 */
class movimientos{
  public $conexion;
  public $orden;

  function __construct($conexion)
  {
    $this->conexion=$conexion;
    $this->orden = $this->generateOrden();
  }

  public function generateOrden(){
       $key = '';
       $pattern = '1234567890L';
       $max = strlen($pattern)-1;
       for($i=0;$i < 6;$i++) $key .= $pattern{mt_rand(0,$max)};
       return $key;
  }

  public function saveMovimiento($tipo,$total){
    $sql="INSERT INTO `movimiento`(`orden`, `tipo`, `total`, `fecha`, `hora`) VALUES (?,?,?,now(),now())";
    $saveMovimiento=$this->conexion->prepare($sql);
    $saveMovimiento->bindParam(1,$this->orden);
    $saveMovimiento->bindParam(2,$tipo);
    $saveMovimiento->bindParam(3,$total);
    $saveMovimiento->execute();
    return $saveMovimiento->rowCount();

  }

  public function saveMovimientos($producto,$cantidad){
    $sql="INSERT INTO `movimientos`(`producto`, `cantidad`, `orden`) VALUES (?,?,?)";
    $saveMovimientos=$this->conexion->prepare($sql);
    $saveMovimientos->bindParam(1,$producto);
    $saveMovimientos->bindParam(2,$cantidad);
    $saveMovimientos->bindParam(3,$this->orden);
    $saveMovimientos->execute();
    return $saveMovimientos->rowCount();
  }

  public function getMovimientos($desde=null,$hasta=null){
    if(($desde===null ) && ($hasta===null)){
      $sql="SELECT * FROM `movimiento` WHERE `fecha` BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() ORDER BY fecha DESC";
    }else{
      $sql="SELECT * FROM `movimiento` WHERE fecha BETWEEN '$desde' AND '$hasta' ORDER BY fecha ASC";
    }
    $getMovimientos=$this->conexion->prepare($sql);
    $getMovimientos->execute();
    return $getMovimientos->fetchAll();

  }

  public function getMovimiento($orden){
    $sql="SELECT mov.orden,p.producto,p.precioCosto,mov.cantidad, m.total,m.tipo,m.fecha,m.hora FROM movimientos mov
          INNER JOIN movimiento m ON mov.orden = m.orden
          INNER JOIN productos p ON mov.producto = p.idproducto WHERE mov.orden = ? ";
    $getMovimiento=$this->conexion->prepare($sql);
    $getMovimiento->bindParam(1,$orden);
    $getMovimiento->execute();
    return $getMovimiento->fetchAll();
  }

}










 ?>

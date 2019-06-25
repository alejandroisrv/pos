<?php


class cajachica
{
  public $conexion;
  public $usuario;
  public $fecha;
  public $fondo;

  function __construct($fecha,$usuario,$conexion)
  {
    $this->fecha= $fecha;
    $this->usuario=$usuario;
    $this->conexion=$conexion;
  }

  public function gastar($monto,$descripcion) {
    $sql="INSERT INTO gastos (`monto`,`fecha`,`descripcion`,`hora`,`usuario`) VALUES (?, now(), ?,now(),?)";
    $gastar=$this->conexion->prepare($sql);
    $gastar->execute(array($monto,$descripcion,$this->usuario));
    return $gastar->rowCount();
  }


  public function getGastos()
  {
    $sql="SELECT * FROM gastos WHERE usuario = ? AND caja = 0";
    $getGastos=$this->conexion->prepare($sql);
    $getGastos->bindParam(1,$this->usuario);
    $getGastos->execute();
    return $getGastos->fetchAll();
  }

  public function abrirCaja($fondo)
  {
    $abrirCaja=$this->conexion->prepare("INSERT INTO `cajachica`(`usuario`,`monto`, `fecha`, `hora`) VALUES (?,?,now(),now()) ");
    $abrirCaja->bindParam(1,$this->usuario);
    $abrirCaja->bindParam(2,$fondo);
    $abrirCaja->execute();
    return $abrirCaja->rowCount();

  }
  public function cerrarCaja()
  {

    $quitarGastos=$this->conexion->query("UPDATE gastos SET caja = 1 WHERE usuario = $this->usuario ");
    $cerrarPedido=$this->conexion->query("UPDATE pedidos SET cerrado = 1 WHERE usuario =  $this->usuario  ");
    $cerrarVentas=$this->conexion->prepare("UPDATE ventas SET cerrado = 1 WHERE usuario = ? AND cerrado = 0 ");
    $cerrarCaja=$this->conexion->prepare("UPDATE usuarios SET caja = 0 WHERE id = ? ");
    $cerrarCaja->bindParam(1,$this->usuario);
    $cerrarVentas->bindParam(1,$this->usuario);
    $cerrarCaja->execute();
    $cerrarVentas->execute();
    return $cerrarCaja->rowCount();

  }
  public function getCaja(){

    $caja=$this->conexion->prepare("SELECT * FROM `cajachica` WHERE  usuario = ? AND caja = 0 ORDER BY idcajachica DESC LIMIT 0,1 ");
    $caja->bindParam(1,$this->usuario);
    $caja->execute();
    $fondos=$caja->fetch();
    $this->fondo=$fondos['monto'];
    return $this->fondo;

  }





}













?>

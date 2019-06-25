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

  public function gastar($monto,$descripcion,$dato=null,$frecuencia=null) {
    $sql="INSERT INTO gastos (`monto`,`fecha`,`descripcion`,`dato`,`hora`,`usuario`,`frecuencia`) VALUES (?, now(),?,?,now(),?,?)";
    $gastar=$this->conexion->prepare($sql);
    $gastar->execute(array($monto,$descripcion,$dato,$this->usuario,$frecuencia));
    return $gastar->rowCount();
  }

  public function getGastosAdmin($desde=null,$hasta=null)
  {
    ;
    if(($desde===null ) && ($hasta===null)){
      $sql="SELECT idgasto,descripcion,gastos.caja as caja,gastos.usuario as usuarioGastos,monto,DATE_FORMAT(fecha,'%d/%m/%Y') as date,usuarios.usuario,dato FROM gastos INNER JOIN usuarios ON gastos.usuario=usuarios.id WHERE `fecha` BETWEEN  CURDATE() - INTERVAL 7 DAY AND CURDATE() ORDER BY fecha ASC";
    }else{
      $sql="SELECT idgasto,descripcion,gastos.caja as caja,gastos.usuario as usuarioGastos,monto,DATE_FORMAT(fecha,'%d/%m/%Y') as date,usuarios.usuario,dato FROM gastos INNER JOIN usuarios ON gastos.usuario=usuarios.id WHERE `fecha` BETWEEN '$desde' AND '$hasta' ORDER BY `fecha` ASC";
    }
    $getGastosAdmin=$this->conexion->prepare($sql);
    $getGastosAdmin->execute();
    return $getGastosAdmin->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getGastos()
  {
    $sql="SELECT * FROM gastos WHERE usuario = ? AND caja = 0";
    $getGastos=$this->conexion->prepare($sql);
    $getGastos->bindParam(1,$this->usuario);
    $getGastos->execute();
    return $getGastos->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getGasto($id)
  {
    $sql="SELECT * FROM gastos WHERE idgasto = ?";
    $getGasto=$this->conexion->prepare($sql);
    $getGasto->bindParam(1,$id);
    $getGasto->execute();
    return $getGasto->fetch();
  }
  public function updateGasto($descripcion,$monto,$frecuencia,$id)
  {
    $sql="UPDATE `gastos` SET `descripcion` = ?, `monto`=?, `frecuencia` = ?  WHERE `idgasto` = ?";
    $updateGasto=$this->conexion->prepare($sql);
    $updateGasto->execute(array($descripcion,$monto,$frecuencia,$id));
    return $updateGasto->rowCount();
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
    $cerrarPedido=$this->conexion->query("UPDATE pedidos SET cerrado = 1");
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
  public function getLimite(){
    $getLimite=$this->conexion->prepare("SELECT monto FROM `caja` ORDER BY fecha DESC,hora DESC LIMIT 0,1 ");
    $getLimite->execute();
    return $getLimite->fetch();
  }
  public function setLimite($monto){
    $sql="INSERT INTO `caja`(`monto`, `fecha`, `hora`) VALUES (?,now(),now())";
    $setLimite=$this->conexion->prepare($sql);
    $setLimite->bindParam(1,$monto);

    if($setLimite->execute()){
      return "OK";

    }else {
      return "ERROR";

    }

  }





}













?>

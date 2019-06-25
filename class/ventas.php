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
  //Vender, se utilizar para finalizar el proceso de venta en el pos;
  function vender($usuario,$total,$metodoPago){
    $sql="INSERT INTO `ventas`( `codigo`, `fecha`, `hora`,`total`,`metodoPago`,`metodoVenta`,`usuario`)
             VALUES (?,now(),now(),?,?,?,?)";
    $vender=$this->conexion->prepare($sql);
    $vender->execute(array($this->codigo,$total,$metodoPago,$this->modoVenta,$usuario));
    return $vender;
  }

  //CALCULO CON LAS VENTAS YA PROCESADAS;

  //Trae una sola venta general por un codigo (Metodo de pago, fecha, total, etc), se usa en venta, para el reporte de una venta especifica;
  function getVenta($codigo)
  {
    $sql="SELECT codigo,metodoPago,metodoVenta,total,usuarios.usuario,DATE_FORMAT(fecha,'%d/%m/%Y') as fecha,hora FROM ventas INNER JOIN usuarios ON ventas.usuario=usuarios.id WHERE codigo = ?";
    $getVenta=$this->conexion->prepare($sql);
    $getVenta->bindParam(1,$codigo);
    $getVenta->execute();
    return $getVenta->fetch();
  }

  //Trae las ventas en general (Metodo de pago,fecha) por fecha o la ultima semana, se usa en balance,ventas,ventas-reporte.
  function getVentas($desde=null,$hasta=null)
  {
    if(($desde===null ) && ($hasta===null)){
      $sql="SELECT codigo,metodoPago,metodoVenta,total,usuarios.usuario,DATE_FORMAT(fecha,'%d/%m/%Y') as fecha,hora FROM ventas INNER JOIN usuarios ON ventas.usuario=usuarios.id WHERE `fecha` BETWEEN  CURDATE() - INTERVAL 7 DAY AND CURDATE() AND ventas.usuario != 4 ORDER BY fecha DESC";
    }else{
      $sql="SELECT codigo,metodoPago,metodoVenta,total,usuarios.usuario,DATE_FORMAT(fecha,'%d/%m/%Y') as fecha,hora FROM ventas INNER JOIN usuarios ON ventas.usuario=usuarios.id WHERE fecha BETWEEN '$desde' AND '$hasta' AND ventas.usuario != 4 ORDER BY fecha ASC";
    }
    $getVentaA=$this->conexion->prepare($sql);
    $getVentaA->execute();
    return $getVentaA->fetchAll(PDO::FETCH_ASSOC);
  }

  //Trea los detalles de las ventas en generales (Productos,cantidad,precio), se usa para dar detalle a las ventas,en venta-reporte;
  public function getVentaAdmin($codigo)
  {
    $sqlAdmin="SELECT producto, cantidad,precio,DATE_FORMAT(fecha,'%H:%i:%s') AS hora FROM venta WHERE codigo = ?";
    $getVentaAdmin=$this->conexion->prepare($sqlAdmin);
    $getVentaAdmin->bindParam(1,$codigo);
    $getVentaAdmin->execute();
    return $getVentaAdmin->fetchAll(PDO::FETCH_ASSOC);
  }

  //Igual que el de arriba pero por fecha Para hacer pedidos de los rpoductos, calculo faltante, se usa en el balance, inventario-reporte;
  public function getVentaPedidos($desde=null,$hasta=null)
  {
    if(($desde===null ) && ($hasta===null)){
      $sqlAdmin="SELECT venta.producto as producto,venta.cantidad,productos.precioCosto,venta.precio as precio FROM venta INNER JOIN productos on venta.idproducto= productos.idproducto WHERE fecha BETWEEN now() - interval 7 day AND now() AND venta.usuario != 4  ORDER BY venta.producto ASC";
    }else {
      $sqlAdmin="SELECT venta.producto as producto,venta.cantidad,productos.precioCosto,venta.precio as precio FROM venta INNER JOIN productos on venta.idproducto= productos.idproducto WHERE fecha BETWEEN '$desde' AND '$hasta'  AND venta.usuario != 4 ORDER BY venta.producto ASC";
    }
    $getVentaPedidos=$this->conexion->prepare($sqlAdmin);
    $getVentaPedidos->execute();
    return $getVentaPedidos->fetchAll(PDO::FETCH_ASSOC);
  }




}



 ?>

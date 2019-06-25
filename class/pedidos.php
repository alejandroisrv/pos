<?php



class pedidos
{
  public $conexion;
  public $codigo;
  public $metodoventa;
  public $usuario;
  function __construct($conexion)
  {

    $this->conexion=$conexion;
    $this->codigo = $_COOKIE['codigo'];
    $this->metodoventa= $_COOKIE['metodoventa'];

  }
  public function getCliente($telefono){
    $sql="SELECT * FROM clientes WHERE telefono = ?";
    $getCliente=$this->conexion->prepare($sql);
    $getCliente->bindParam(1,$telefono);
    $getCliente->execute();
    return $getCliente->fetch();

  }
  public function getClientes(){
    $sql="SELECT * FROM clientes";
    $getCliente=$this->conexion->prepare($sql);
    $getCliente->execute();
    return $getCliente->fetchAll(PDO::FETCH_ASSOC);

  }
  public function updateCliente($nombre,$telefono,$direccion){
    $sql="UPDATE clientes SET nombre = ?, direccion= ? WHERE telefono = ?";
    $updateCliente=$this->conexion->prepare($sql);
    $updateCliente->bindParam(1,$nombre);
    $updateCliente->bindParam(2,$direccion);
    $updateCliente->bindParam(3,$telefono);
    $updateCliente->execute();
    return $updateCliente->rowCount();

  }
  public function addCliente($nombre,$telefono,$direccion){
      if($this->getCliente($telefono)==""){
        $sql="INSERT INTO `clientes`(`nombre`, `telefono`, `direccion`) VALUES (?,?,?)";
        $addCliente=$this->conexion->prepare($sql);
        $addCliente->execute(array($nombre,$telefono,$direccion));
        return $addCliente->rowCount();
      }else{
        return $this->updateCliente($nombre,$telefono,$direccion);
      }
  }

  public function hacerPedido($observaciones,$metodoPago,$total,$usuario,$telefono){
    $sql= "INSERT INTO `pedidos`(`observaciones`, `metodoPago`,`total`, `codigo`, `estado`, `fecha`, `hora`, `usuario`,`cliente`)
          VALUES (?,?,?,?,0,now(),now(),?,?)";
    $hacerPedido=$this->conexion->prepare($sql);
    $hacerPedido->execute(array($observaciones,$metodoPago,$total,$this->codigo,$usuario,$telefono));
    return $hacerPedido;
  }
  public function getPedidosUser($usuario=null){
    if($usuario==null){
      $sql="SELECT idpedido,codigo,direccion,nombre,telefono,metodoPago,total,estado,date_format(fecha,'%d/%m/%Y') AS fecha, hora FROM pedidos INNER JOIN clientes ON pedidos.cliente = clientes.telefono WHERE `cerrado` = 0 ORDER BY `hora` DESC";
    }else {
      $sql="SELECT idpedido,codigo,direccion,nombre,telefono,metodoPago,total,estado,date_format(fecha,'%d/%m/%Y') AS fecha, hora FROM pedidos INNER JOIN clientes ON pedidos.cliente = clientes.telefono WHERE `usuario` = $usuario AND `cerrado` = 0 ORDER BY `hora` DESC";
    }
    $getPedidoUser=$this->conexion->prepare($sql);
    $getPedidoUser->execute();
    return $getPedidoUser->fetchAll(PDO::FETCH_ASSOC);

  }


  public function getPedidoAdmin($codigo){
    $sql="SELECT codigo,direccion,clientes.nombre as nombre,telefono,pedidos.observaciones as observaciones,rechazo,metodoPago,total,estado,date_format(fecha,'%d/%m/%Y') as fecha, hora,usuarios.usuario as usuario FROM pedidos INNER JOIN clientes ON pedidos.cliente = clientes.telefono INNER JOIN usuarios ON pedidos.usuario = usuarios.id WHERE `codigo`= ? ";
    $getPedidoAdmin=$this->conexion->prepare($sql);
    $getPedidoAdmin->bindParam(1,$codigo);
    $getPedidoAdmin->execute();
    return $getPedidoAdmin->fetch();
  }
  public function getPedidosAdmin($desde=null,$hasta=null){
    if(($desde!=null ) && ($hasta!=null)){
      $sql="SELECT codigo,direccion,clientes.nombre as nombre,telefono,pedidos.observaciones as observaciones,rechazo,metodoPago,total,estado,date_format(fecha,'%d/%m/%Y') as fecha, hora,usuarios.usuario as usuario FROM pedidos INNER JOIN clientes ON pedidos.cliente = clientes.telefono INNER JOIN usuarios ON pedidos.usuario = usuarios.id WHERE `fecha` BETWEEN '$desde' AND '$hasta' AND pedidos.usuario != 4 ORDER BY fecha ASC";
    }else{
      $sql="SELECT codigo,direccion,clientes.nombre as nombre,telefono,pedidos.observaciones as observaciones,rechazo,metodoPago,total,estado,date_format(fecha,'%d/%m/%Y') as fecha, hora,usuarios.usuario as usuario FROM pedidos INNER JOIN clientes ON pedidos.cliente = clientes.telefono INNER JOIN usuarios ON pedidos.usuario = usuarios.id WHERE `fecha` BETWEEN  CURDATE() - INTERVAL 7 DAY AND CURDATE() AND pedidos.usuario != 4 ORDER BY fecha DESC";
    }
    $getPedidos=$this->conexion->prepare($sql);
    $getPedidos->execute();
    return $getPedidos->fetchAll(PDO::FETCH_ASSOC);

  }
  public function getDomiciliosAdmin(){
    if(($desde!=null ) && ($hasta!=null)){
      $sql="SELECT codigo,direccion,clientes.nombre as nombre,telefono,pedidos.observaciones as observaciones,rechazo,metodoPago,total,estado,date_format(fecha,'%d/%m/%Y') as fecha, hora,usuarios.usuario as usuario FROM pedidos INNER JOIN clientes ON pedidos.cliente = clientes.telefono INNER JOIN usuarios ON pedidos.usuario = usuarios.id WHERE `fecha` BETWEEN '$desde' AND '$hasta' AND pedidos.usuario != 4 AND metodoPago='domicilios.com' ORDER BY fecha ASC";
    }else{
      $sql="SELECT codigo,direccion,clientes.nombre as nombre,telefono,pedidos.observaciones as observaciones,rechazo,metodoPago,total,estado,date_format(fecha,'%d/%m/%Y') as fecha, hora,usuarios.usuario as usuario FROM pedidos INNER JOIN clientes ON pedidos.cliente = clientes.telefono INNER JOIN usuarios ON pedidos.usuario = usuarios.id WHERE `fecha` BETWEEN  CURDATE() - INTERVAL 7 DAY AND CURDATE() AND pedidos.usuario != 4 AND metodoPago='domicilios.com' ORDER BY fecha DESC";
    }
    $getPedidos=$this->conexion->prepare($sql);
    $getPedidos->execute();
    return $getPedidos->fetchAll(PDO::FETCH_ASSOC);

  }
  public function updatePedido($estado,$cerrar,$id,$rechazo)
  {
    $sql="UPDATE pedidos SET estado = ?, rechazo= ?, cerrado = ? WHERE idpedido = ? ";
    $updatePedido=$this->conexion->prepare($sql);
    $updatePedido->execute(array($estado,$rechazo,$cerrar,$id));
    return $updatePedido->rowCount();

  }


}














 ?>

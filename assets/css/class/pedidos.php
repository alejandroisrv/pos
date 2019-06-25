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

  public function hacerPedido($nombre,$telefono,$direccion,$observaciones,$metodoPago,$total,$usuario){

    $sql= "INSERT INTO `pedidos`(`nombre`, `telefono`, `direccion`, `observaciones`, `metodoPago`,`total`, `codigo`, `estado`, `fecha`, `hora`, `usuario`)
          VALUES (?,?,?,?,?,?,?,0,now(),now(),?)";
    $hacerPedido=$this->conexion->prepare($sql);
    $hacerPedido->execute(array($nombre,$telefono,$direccion,$observaciones,$metodoPago,$total,$this->codigo,$usuario));
    return $hacerPedido;
  }
  public function getPedidosUser($usuario){
    $sql="SELECT * FROM pedidos WHERE usuario = ? AND cerrado = 0 ORDER BY hora DESC";
    $getPedido=$this->conexion->prepare($sql);
    $getPedido->bindParam(1,$usuario);
    $getPedido->execute();
    return $getPedido->fetchAll();

  }
  public function getPedidosFecha($desde,$hasta){
    $sql="SELECT * FROM pedidos WHERE fecha BETWEEN ? AND ?";
    $getPedido=$this->conexion->prepare($sql);
    $getPedido->bindParam(1,$desde);
    $getPedido->bindParam(2,$hasta);
    $getPedido->execute();
    return $getPedido->fetch(PDO::FETCH_ASSOC);

  }
  public function updatePedido($estado,$cerrar,$id,$rechazo)
  {
    $sql="UPDATE pedidos SET estado = ?, rechazo= ?, cerrado = ? WHERE idpedido = ? ";
    $updatePedido=$this->conexion->prepare($sql);
    $updatePedido->execute(array($estado,$rechazo,$cerrar,$id));
    return $updatePedido;

  }


}














 ?>

<?php


class productos
{
  public $conexion;

  function __construct($conexion)
  {
    $this->conexion=$conexion;
  }

  public function getProducts(){

    $sql="SELECT * FROM productos";
    $products=$this->conexion->prepare($sql);
    $products->execute();
    return $products->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getProduct($id)
  {
    $sql="SELECT * FROM productos WHERE idproducto = ?";
    $products=$this->conexion->prepare($sql);
    $products->bindParam(1,$id);
    $products->execute();
    return $products->fetch();
  }

  public function addProduct($producto,$precioCosto,$precioVenta,$precioNoche,$precioDelivery,$precioDomicilio,$proveedor){
      $sql="INSERT INTO `productos`(`producto`, `precioCosto`, `precioVenta`, `precioNoche`, `precioDelivery`,`precioDomicilio`,`proveedor`) VALUES (?,?,?,?,?,?,?) ";
      $productsAdd=$this->conexion->prepare($sql);
      $productsAdd->execute(array($producto, $precioCosto,$precioVenta,$precioNoche,$precioDelivery,$precioDomicilio,$proveedor));
      return $productsAdd->rowCount();
  }

  public function updateProducts($producto,$precioCosto,$precioVenta,$precioNoche,$precioDelivery,$precioDomicilio,$proveedor,$id)
  {

    $sql="UPDATE `productos` SET `producto`= ?,`precioCosto`=?,`precioVenta`=?,`precioNoche`=?,`precioDelivery`=?,`precioDomicilio`=?,`proveedor`=? WHERE idproducto = ?";
    $productsUppdate=$this->conexion->prepare($sql);
    $productsUppdate->execute(array($producto, $precioCosto,$precioVenta,$precioNoche,$precioDelivery,$precioDomicilio,$proveedor,$id));
    return $productsUppdate;


  }
  public function deleteProduct($id)
  {
    $sql="DELETE FROM `productos` WHERE `idproducto` = ?";
    $productsDelete=$this->conexion->prepare($sql);
    $productsDelete->bindParam(1,$id);
    $productsDelete->execute();
    return $productsDelete->rowCount();
  }

  public function modifyCantidad($id,$cantidad){
    $sql="UPDATE `productos` SET cantidad = cantidad + ? WHERE `idproducto` = ?";
    $productsM=$this->conexion->prepare($sql);
    $productsM->bindParam(1,$cantidad);
    $productsM->bindParam(2,$id);
    $productsM->execute();
    return $productsM->rowCount();

  }

}








 ?>

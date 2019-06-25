<?php
session_start();
 if(!isset($_COOKIE['codigo']) || $_COOKIE['codigo']==""){
    function generarCodigo() {
   $key = '';
   $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $max = strlen($pattern)-1;
   for($i=0;$i < 8;$i++) $key .= $pattern{mt_rand(0,$max)};
   return $key;
  }
  $codigo=generarCodigo();
     setcookie('codigo',$codigo,time()+ 365 * 24 * 60 * 60,'/','inv.donjuerguero.com');
 }else{

  $codigo= $_COOKIE['codigo'];
}
include 'conexion.php' ;
$idproducto=$_POST['idproducto'];
$cantidad=$_POST['cantidad'];
$queryComprobar=$con_pdo->query("SELECT * FROM venta WHERE idproducto='$idproducto' AND codigo='$codigo' ");
$queryProducto=$con_pdo->query("SELECT * FROM productos WHERE idproducto='$idproducto'");
while($comprobacion=$queryProducto->fetch(PDO::FETCH_ASSOC)){
  $nombre=$comprobacion['producto'];
          switch ($_COOKIE['modoventa']){
            case 'dia' :
                $precio=$comprobacion['precioVenta'];
                break;
            case 'noche' :
                $precio=$comprobacion['precioNoche'];
                break;
            case 'delivery' :
                $precio=$comprobacion['precioDelivery'];
                break;
            case 'domicilios.com' :
                    $precio=$comprobacion['precioDomicilio'];
                break;
            default:
                break;
        }
  $preciocosto=$comprobacion['precioCosto'];
}


//Comprobar las ventas y actualizar cantidad
if($queryComprobar->rowCount()>=1){
    if($cantidad>=1){
        $con_pdo->query("UPDATE venta SET cantidad=cantidad+$cantidad WHERE idproducto='$idproducto'");
        $guardada=true;

    }else{
        $guardada=false;
        echo "ERROR";
    }


}else{

//Insertar la venta


  $sqlSell="INSERT INTO `venta` (`idproducto` ,`producto`,`cantidad`, `precio`,`precioCosto`, `codigo`, `fecha`, `cerrado`) VALUES ('$idproducto','$nombre', '$cantidad', '$precio','$preciocosto', '$codigo', now(),0)";
  $querySell=$con_pdo->query($sqlSell);
  $guardada=true;

}

if($guardada){
  if($_SESSION['usuario']==4){

  }else {
    $con_pdo->query("UPDATE productos SET cantidad=cantidad-$cantidad WHERE idproducto='$idproducto' AND cantidad >= $cantidad ");
  }
   echo "OK";

 }else{


     echo "ERROR";

 }




?>

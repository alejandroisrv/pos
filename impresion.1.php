<?php
setlocale(LC_MONETARY,"es_PE");
require('core/fpdf/fpdf.php');
include 'class/ventas.php';
include 'class/database.php';
include 'class/pedidos.php';
$conexion=new database();
$codigo=$_GET['codigo'];
$ventasClass=new ventas($conexion);
$pedidosClass=new pedidos($conexion);

$pagocon=$_GET['pagocon'];
$vuelto=$_GET['vuelto'];

if($_GET['pedido']){
    $ventaGeneral=$pedidosClass->getPedidoAdmin($codigo);
    $cliente=true;
}else{
    $ventaGeneral=$ventasClass->getVenta($codigo);
}
$ventas=$ventasClass->getVentaAdmin($codigo);
$productos = array();
foreach($ventas as $venta){
  $producto=array(
   	"q"=>$venta['cantidad'],
   	"name"=>$venta['producto'],
    "price"=>$venta['precio']);
    array_push($productos,$producto) ;
}

$pdf = new FPDF($orientation='P',$unit='mm', array(45,350));
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);    //Letra Arial, negrita (Bold), tam. 20
$textypos = 5;
$pdf->setY(2);
$pdf->setX(2);
$pdf->Cell(5,$textypos,"LICORERIA SUCRE");
$pdf->SetFont('Arial','',5);    //Letra Arial, negrita (Bold), tam. 20
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,"");
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,"TELEFONO:(01) 480-0167  943 727 483");
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,"DIRECCION: SUCRE S/N P. LIBRE");
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,"LIMA S/N  BARRANCO");
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,date('d/m/y'));
$pdf->setX(29);
$pdf->Cell(5,$textypos,date('H:i:s'));
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,'========================================');
if ($cliente) {
  $textypos+=6;
  $pdf->setX(2);
  $pdf->Cell(5,$textypos,"DIRECCION: ".strtoupper($ventaGeneral['direccion']));
  $textypos+=6;
  $pdf->setX(2);
  $pdf->Cell(5,$textypos,"NOMBRE: ".strtoupper($ventaGeneral['nombre'])." ".$ventaGeneral['telefono']);
  $textypos+=6;
  $pdf->setX(2);
  $pdf->Cell(5,$textypos,"OBSERVACION: ".strtoupper($ventaGeneral['observaciones']));
  $textypos+=6;
  $pdf->setX(2);
  $pdf->Cell(5,$textypos,'========================================');
}
$textypos+=6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,'CANT.  ARTICULO       PRECIO               TOTAL');
$total =0;
$off = $textypos+6;


foreach($productos as $pro){
$pdf->setX(2);
$pdf->Cell(5,$off,$pro["q"]);
$pdf->setX(6);
$pdf->Cell(35,$off,  strtoupper(substr($pro["name"], 0,12)) );
$pdf->setX(20);
$pdf->Cell(11,$off,  "S/.".number_format($pro["price"],2,".",",") ,0,0,"R");
$pdf->setX(32);
$pdf->Cell(11,$off,  "S/. ".number_format($pro["q"]*$pro["price"],2,".",",") ,0,0,"R");
$total += $pro["q"]*$pro["price"];
$off+=6;
}
$textypos=$off+6;
$pdf->setX(2);
$pdf->Cell(5,$textypos,"TOTAL: " );
$pdf->setX(38);
$pdf->Cell(5,$textypos,"S/. ".number_format($total,2,".",","),0,0,"R");
$pdf->setX(2);
if($ventaGeneral['metodoPago']=="efectivo"){
  if($pagocon>0){
    $pdf->Cell(5,$textypos+6,"PAGO CON: " );
    $pdf->setX(38);
    $pdf->Cell(5,$textypos+6,"S/. ".number_format($pagocon,2,".",","),0,0,"R");
    $pdf->setX(2);
    $pdf->Cell(5,$textypos+12,"SU VUELTO: " );
    $pdf->setX(38);
    $pdf->Cell(5,$textypos+12,"S/. ".number_format($vuelto,2,".",","),0,0,"R");
  }else{
      $textypos-=12;
  }


}else{
  $pdf->Cell(5,$textypos+6,"PAGO CON: " );
  $pdf->setX(33);
  $pdf->Cell(5,$textypos+6,strtoupper($ventaGeneral['metodoPago']));
  $textypos-=6;
}
$pdf->setX(2);
$pdf->Cell(5,$textypos+24,"DELIVERY TODOS LOS DIAS");
$pdf->setX(2);
$pdf->Cell(5,$textypos+30,utf8_decode("BREÑA - SAN MIGUEL - MAGDALENA"));
$pdf->setX(2);
$pdf->Cell(5,$textypos+36,"P. LIBRE- MIRAFLORES - S. ISIDRO - SURCO");
$pdf->setX(2);
$pdf->Cell(5,$textypos+42,"GRACIAS POR TU COMPRA!");
$pdf->setX(2);
$pdf->Cell(5,$textypos+48,"WWW.LAJUERGA24HORAS.COM");
$pdf->output();

?>

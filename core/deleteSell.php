<?php

include 'conexion.php';

$idventa=$_POST['idventa'];
$idproducto=$_POST['idproducto'];

    //Buscamos cantidad del producto que esta en la venta
    $prodQuery=$con_pdo->query("SELECT cantidad FROM venta WHERE idventa='$idventa' ");
    while($venta=$prodQuery->fetch(PDO::FETCH_ASSOC)):
        $cantidad=$venta['cantidad'];
    endwhile;

        try {
            //Regresamos lo 'vendido' de nuevo al producto
            $backSql="UPDATE productos SET cantidad = cantidad + $cantidad WHERE idproducto='$idproducto' ";
             $backToStock=$con_pdo->query($backSql);
            $sell=$con_pdo->query("DELETE FROM venta WHERE idventa ='$idventa'");
              function generarCodigo() {
               $key = '';
               $pattern = '1234567890';
               $max = strlen($pattern)-1;
               for($i=0;$i < 5;$i++) $key .= $pattern{mt_rand(0,$max)};
               return $key;
              }
            echo "OK";



        } catch (\Exception $e) {

           echo $e->getMessage();

        }

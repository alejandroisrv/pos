<?php

include 'conexion.php';

$idventa=$_POST['idventa'];
$idproducto=$_POST['idproducto'];
$cantidad=$_POST['cantidad'];

    try {

        //Buscamos cantidad del producto que esta en la venta
        $prodQuery=$con_pdo->query("SELECT cantidad FROM venta WHERE idventa='$idventa' ");
        while($venta=$prodQuery->fetch(PDO::FETCH_ASSOC)):
            $cantidadV=$venta['cantidad'];
        endwhile;
        $cantidadF=$cantidad-$cantidadV;
        if($cantidadV>=$cantidad):

            $backSql="UPDATE productos
                    SET cantidad = cantidad - $cantidadF
                    WHERE idproducto='$idproducto' ";
            else:
                $backSql="UPDATE productos
                          SET cantidad = cantidad + $cantidadF
                          WHERE idproducto='$idproducto' ";
            endif;


        $backToStock=$con_pdo->query($backSql);
        $updSale=$con_pdo->query("UPDATE venta SET cantidad=$cantidad WHERE idventa ='$idventa'");
        //Regresamos lo 'vendido' de nuevo al producto

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

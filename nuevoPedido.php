<?php
include 'class/database.php';
include 'class/pedidos.php';
$conexion=new database();
$pedidosClass= new pedidos($conexion);
$pedidos=$pedidosClass->getPedidosUser(3);
$codigo=$pedidos[0]['codigo'];
echo "<p class='mx-2'>{$pedidos[0]['direccion']}</p>";
echo "<p class='mx-2'>{$pedidos[0]['nombre']} {$pedidos[0]['telefono']}</p>";
echo "<small class='text-muted mx-2'> {$pedidos[0]['observaciones']}</small>";
?>
<table class="table table-borderless col-12 mx-2">
<?php $productoPedidos=$conexion->query("SELECT * FROM venta WHERE codigo = '$codigo'");
while ($row=$productoPedidos->fetch(PDO::FETCH_ASSOC)) {
  $subtotal=$row['precio']*$row['cantidad'];
    echo "<tr>
            <td class='my-3 p-1' style='font-size:0.80rem !important;'>".$row['producto']." x".$row['cantidad']." ".money_format('%(#10n',$subtotal)."</td>
          </tr>";
}?>

<tr>
    <th class="p-1 pt-2">Total: <?php echo money_format('%(#10n',$pedidos[0]['total'])." " ?> <?php echo ucfirst($pedidos[0]['metodoPago']) ?></th>
</tr>
</table>
<?php
 ?>

<?php
include 'class/database.php';
include 'class/pedidos.php';
setlocale(LC_MONETARY,"es_PE");
session_start();
$fecha=date('y')."-".date('m')."-".date('d');
$usuario=$_SESSION['usuario'];
$conexion=new database();
$pedidosClass = new pedidos($conexion);
$pedidos = $pedidosClass->getPedidosUser();
if(count($pedidos)>0){
  echo '<h5 class="m-3 h5">Pedidos delivery</h5>
    <div id="accordion">';
foreach ($pedidos as $pedido):?>

<?php if ($pedido['metodoPago']!="domicilios.com"): ?>


  <hr>
  <style media="screen">
    p{
      font-size: 0.85rem !important;
    }
  </style>
  <div id="m">
    <div class="my-2 m-1 p-1  row">
      <div style="cursor:pointer" class="col-9" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <p class="col-5 p-0 d-inline"><?php echo $pedido['direccion'] ?><small class="text-muted d-block"><?php echo $pedido['observaciones'] ?></small></p>
        <p class="col-4 p-0 d-inline"><?php echo $pedido['telefono'] ?></p>
        <p class="col-3 p-0 d-inline"><?php echo $pedido['nombre'] ?></p>
        <small class="text-muted"> <?php echo $pedido['hora'] ?></small>
      </div>

      <div class="col-3">
        <a href="impresion?codigo=<?php  echo $pedido['codigo'] ?>&pedido=true" target="_blank"><i class="fas fa-print mx-1"></i></a>
      <?php if($pedido['estado']==0): ?>
              <i class="fas fa-check mr-2 d-inline text-success entregarPedido" data-pedido="<?php echo $pedido['idpedido'] ?>"></i>
              <i class="fas fa-ban d-inline text-danger rechazarPedido" data-pedido="<?php echo $pedido['idpedido'] ?>"></i>
      <?php else:
                echo ($pedido['estado']==1) ? "<p class='text-success'>Entregado</p>" : "<p class='text-danger'>Rechazado</p>" ;
            endif;  ?>
      </div>
    </div>
    <hr>
<div id="collapseOne" class="collapse" aria-labelledby="<?php echo $pedido['idpedido'] ?>m" data-parent="#accordion">
  <div class="card card-body">
    <table class="table table-borderless col-12">
    <?php
    $codigo = $pedido['codigo'];
    $productoPedidos=$conexion->query("SELECT * FROM venta WHERE codigo = '$codigo'");
    while ($row=$productoPedidos->fetch(PDO::FETCH_ASSOC)) {
      $subtotal=$row['precio']*$row['cantidad'];
        echo "<tr>
                <td class='my-3 p-1' style='font-size:0.80rem !important;'>".$row['producto']." x".$row['cantidad']." ".money_format('%(#10n',$subtotal)."</td>
              </tr>";
    }
    ?>
    <tr>
        <th class="p-1 pt-2">Total: <?php echo money_format('%(#10n',$pedido['total'])." " ?> <?php echo ucfirst($pedido['metodoPago']) ?></th>
    </tr>
  </table>
  </div>
</div>
</div>
<?php endif; ?>
<?php endforeach;
} ?>
</div>
<script src="assets/js/delivered.js" charset="utf-8"></script>

<?php


include 'core/conexion.php';

if(isset($_GET['tipo'])){
  $tipo=$_GET['tipo'];
  if($tipo!=0){

    $sql="SELECT * FROM movimientos WHERE tipo = $tipo";

  }else {
    $sql="SELECT * FROM movimientos ORDER BY fecha DESC";
  }


  $queryMovimientos=$con_pdo->query($sql);
  if($queryMovimientos->rowCount()>0){
    ?>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.widgets.js"></script>
    <script type="text/javascript">
        $("#product").tablesorter();
    </script>
    <table class="table my-2" id="product">
    <thead>
      <tr>
        <th style="cursor:pointer;">Orden</th>
        <th style="cursor:pointer;">Producto</th>
        <th style="cursor:pointer;">Cantidad</th>
        <th style="cursor:pointer;">Factura</th>
        <th style="cursor:pointer;">Tipo</th>
        <th style="cursor:pointer;">Fecha </th>
      </tr>
    </thead>
    <tbody id="table">
      <?php
    while ($movimientos=$queryMovimientos->fetch(PDO::FETCH_ASSOC)):
?>
      <?php if ($movimientos['tipo']==1): $tipo="-"; ?>
        <tr class="table-danger">

      <?php else: $tipo="+"; ?>
        <tr class="table-success">
      <?php endif; ?>

        <th scope="row"><?php echo $movimientos['orden']  ?></th>
        <td><?php echo  ucfirst($movimientos['producto']);  ?></td>
        <td><?php echo  $movimientos['cantidad'];  ?></td>
        <td><?php echo  $movimientos['factura'];  ?></td>
        <td><?php echo  $tipo ?> </td>
        <td><?php echo  $movimientos['fecha'];  ?></td>

      <tr>



<?php endwhile;
}else {
  echo "<p class='alert alert-warning'> No hay movimientos </p>";
}

}















 ?>

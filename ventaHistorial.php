<?php


include 'core/conexion.php';
 setlocale(LC_MONETARY,"es_PE");
if(isset($_GET['desde']) && isset($_GET['hasta']) ){
  $desde=$_GET['desde'];
  $hasta=$_GET['hasta'];
  $sql="SELECT * FROM ventas WHERE fecha BETWEEN '$desde' AND '$hasta'";

  }else{
      
      $sql="SELECT * FROM ventas LIMIT 0,15";
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
    <thead class="thead-dark">
      <tr>
        <th style="cursor:pointer;font-weight:500;">Factura</th>
        <th style="cursor:pointer;font-weight:500;">Total </th>
        <th style="cursor:pointer;font-weight:500;">Fecha de cierre</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="table">
      <?php
    while ($movimientos=$queryMovimientos->fetch(PDO::FETCH_ASSOC)):
?>
        <tr>
            
        <th scope="row"><?php echo $movimientos['codigo']  ?></th>
        <td><?php echo  money_format('%(#10n',$movimientos['total']);  ?></td>
        <td><?php echo  $movimientos['fecha'];  ?></td>
        <td><button type="button" data-toggle="modal" 
         data-target="#detalleVenta" data-fecha="<?php echo $movimientos['fecha']  ?>" class="deVenta btn btn-warning " 
         data-codigo="<?php echo $movimientos['codigo']  ?>">
            <i class="fas fa-eye"></i> </button></td>

      <tr>

    </tbody>

<?php endwhile;
}else {
  echo "<p class='alert alert-warning'> No hay ventas para mostrar </p>";
}

















 ?>
<script src="js/ventas.js" charset="utf-8"></script>
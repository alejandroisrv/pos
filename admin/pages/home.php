<?php

include '../../class/database.php';
include '../../class/pedidos.php';
include '../../class/ventas.php';
include '../../class/productos.php';
include '../../class/cajachica.php';
$conexion= new database();
$cajachica=new cajachica(date('d/m/Y'),2,$conexion);
$pedidosClass=new pedidos($conexion);
$ventasClass=new ventas($conexion);
$productoClass=new productos($conexion);
$productosAlerta=$productoClass->getProducts();
$alertaProductos=[];
foreach ($productosAlerta as $productoAlerta) {
  if($productoAlerta['cantidad']<2){
      $alertaProductos[]=array('nombre' => $productoAlerta['producto']);
  }
}
$totalEnVentas=$totalEnGastos=$totalEnDelivery=0;
$ventas=$ventasClass->getVentas(date('Y-m-d'),date('Y-m-d'));
$gastos=$cajachica->getGastosAdmin(date('Y-m-d'),date('Y-m-d'));
$pedidos=$pedidosClass->getPedidosAdmin(date('Y-m-d'),date('Y-m-d'));
$sales=$ventasClass->getVentaPedidos(date('Y-m-d'),date('Y-m-d'));
for ($i=0; $i <count($ventas) ; $i++) {
    $totalEnVentas+=$ventas[$i]['total'];
}
for ($i=0; $i <count($gastos) ; $i++) {
    $totalEnGastos+=$gastos[$i]['monto'];
}
for ($i=0; $i <count($pedidos) ; $i++) {
    $totalEnDelivery+=$pedidos[$i]['total'];
}
//Con las ventas detalle calculamos la lista de los productos vendidos con sus cantidades y el total a invertir por precio Costo
//inicializando variables
$cantidad=$pasadas=$diferente=0;
$productosVendidos = array();
for ($i=0; $i <count($sales)+1 ; $i++) {
    similar_text($sales[$i]['producto'],$diferente,$porcentaje);
    if($porcentaje==100){
      $pasadas++;
      $cantidad+=$sales[$i]['cantidad'];
    }else{
      $pasadas++;
      if($pasadas>1){
        $productosVendidos[]=array('nombre' => $diferente ,'cantidad'=> $cantidad , 'precioCosto'=> $precioCosto,'precioVenta' => $precioVenta );
        $cantidad=$sales[$i]['cantidad'];
        $pasadas=1;
      }else{
        $cantidad+=$sales[$i]['cantidad'];
      }
      $diferente=$sales[$i]['producto'];
      $precioCosto=$sales[$i]['precioCosto'];
      $precioVenta=$sales[$i]['precio'];
    }
}
for ($i=0; $i < count($productosVendidos); $i++) {
      $totalProductos+=$productosVendidos[$i]['cantidad'];
}

$ventasDiasSemanas=$conexion->query("SELECT (ELT(WEEKDAY(fecha) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS dia,total
FROM ventas WHERE fecha between curdate() - interval 7 day and curdate() ORDER BY fecha ASC")->fetchAll(PDO::FETCH_ASSOC);
$cantidad=$pasadas=$diferente=0;
$ventasGrafico = array();
for ($i=0; $i <count($ventasDiasSemanas)+1; $i++) {
    similar_text($ventasDiasSemanas[$i]['dia'],$diferente,$porcentaje);
    if($porcentaje==100){
      $pasadas++;
      $cantidad+=$ventasDiasSemanas[$i]['total'];
    }else{
      $pasadas++;
      if($pasadas>1){
        $ventasGrafico[]=array('dia' => $diferente ,'total'=> $cantidad);
        $cantidad=$ventasDiasSemanas[$i]['total'];
        $pasadas=1;
      }else{
        $cantidad+=$ventasDiasSemanas[$i]['total'];
      }
      $diferente=$ventasDiasSemanas[$i]['dia'];
    }
}

?>
<link rel="stylesheet" href="../assets/css/normalize.css">
<script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
<!-- Start Status area -->
<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2>S/. <span class="counter"><?php echo $totalEnVentas ?></span></h2>
                        <p>Total en ventas</p>
                    </div>
                    <div class="sparkline-bar-stats1">9,4,8,6,5,6,4,8,3,5,9,5</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2>S/. <span class="counter"><?php echo $totalEnGastos ?></span></h2>
                        <p>Total de gastos</p>
                    </div>
                    <div class="sparkline-bar-stats2">1,4,8,3,5,6,4,8,3,3,9,5</div>
                </div>

            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2>S/. <span class="counter"><?php echo $totalEnDelivery ?></span></h2>
                        <p>Total en delivery</p>
                    </div>
                    <div class="sparkline-bar-stats3">4,2,8,2,5,6,3,8,3,5,9,5</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                    <div class="website-traffic-ctn">
                        <h2><span class="counter"><?php echo $totalProductos; ?> </span></h2>
                        <p>Productos vendidos</p>
                    </div>
                    <div class="sparkline-bar-stats4">2,4,8,4,5,7,4,7,3,5,7,5</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Status area-->
<!-- Start Sale Statistic area-->
<div class="sale-statistic-area">
    <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
                <div class="sale-statistic-inner notika-shadow mg-tb-30">
                    <div class="curved-inner-pro">
                        <div class="curved-ctn">
                            <h2>Estadisticas de venta</h2>
                            <p>Ventas de la semana</p>
                        </div>
                    </div>
                    <div class="line-chart-wp mg-t-30 chart-mg-nt">
                        <canvas height="140vh" width="180vw" id="grafico"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
                <div class="statistic-right-area notika-shadow mg-tb-30 sm-res-mg-t-0" style="padding:20px 40px;">
                    <div class="row">
                      <div class="past-day-statis">
                          <h4>Lo que se esta vendiendo</h4>
                          <p>Ultimos productos vendidos</p>
                      </div>
                        <div class="recent-items-inn">
                         <table class="table table-inner table-vmiddle">
                          <tbody>
                           <?php

                           for ($i=0; $i < count($productosVendidos) ; $i++) {
                             if($i==10){
                               break;
                             }
                             echo "<tr>
                                     <td>
                                     {$productosVendidos[$i]['cantidad']}
                                     </td>
                                      <td>
                                      {$productosVendidos[$i]['nombre']}
                                      </td>
                                  </tr>";
                           }
                            ?>
                             </tbody>


                         </table>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <div class="footer-copyright-area">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="footer-copy-right">
                      <p>Copyright © 2019. Sistema de inventario</p>
                  </div>
              </div>
          </div>
      </div>
  </div>


  <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
  <!-- bootstrap JS
  ============================================ -->
  <script src="../assets/js/bootstrap.min.js"></script>
  <!-- wow JS
  ============================================ -->
  <script src="../assets/js/wow.min.js"></script>
  <!-- price-slider JS
  ============================================ -->
  <script src="../assets/js/jquery-price-slider.js"></script>
  <!-- owl.carousel JS
  ============================================ -->
  <script src="../assets/js/owl.carousel.min.js"></script>
  <!-- scrollUp JS
  ============================================ -->
  <script src="../assets/js/jquery.scrollUp.min.js"></script>
  <!-- meanmenu JS
  ============================================ -->
  <script src="../assets/js/meanmenu/jquery.meanmenu.js"></script>
  <!-- counterup JS
  ============================================ -->
  <script src="../assets/js/counterup/jquery.counterup.min.js"></script>
  <script src="../assets/js/counterup/waypoints.min.js"></script>
  <script src="../assets/js/counterup/counterup-active.js"></script>
  <!-- mCustomScrollbar JS
  ============================================ -->
  <script src="../assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
  <!-- sparkline JS
  ============================================ -->
  <script src="../assets/js/sparkline/jquery.sparkline.min.js"></script>
  <script src="../assets/js/sparkline/sparkline-active.js"></script>
  <!-- flot JS
  ============================================ -->
  <script src="../assets/js/flot/jquery.flot.js"></script>
  <script src="../assets/js/flot/jquery.flot.resize.js"></script>
  <script src="../assets/js/flot/flot-active.js"></script>
  <!-- knob JS
  ============================================ -->
  <script src="../assets/js/knob/jquery.knob.js"></script>
  <script src="../assets/js/knob/jquery.appear.js"></script>
  <script src="../assets/js/knob/knob-active.js"></script>
  <!--  Chat JS
  ============================================ -->
  <script src="../assets/js/chat/jquery.chat.js"></script>
  <!-- Charts JS
  ============================================ -->
  <script src="../assets/js/charts/Chart.js"></script>
  <!--  todo JS
  ============================================ -->
  <script src="../assets/js/todo/jquery.todo.js"></script>
<!--  wave JS
  ============================================ -->
  <script src="../assets/js/wave/waves.min.js"></script>
  <script src="../assets/js/wave/wave-active.js"></script>
  <!-- plugins JS
  ============================================ -->
  <script src="../assets/js/plugins.js"></script>
  <!-- main JS
  ============================================ -->
  <script src="../assets/js/main.js"></script>
<!-- tawk chat JS
  ============================================ -->
  <script type="text/javascript">
    var grafico = document.getElementById("grafico");
    var graficoMostrar = new Chart(grafico, {
      type: 'line',
      data: {
        labels: [<?php

          for ($i=0; $i <count($ventasGrafico) ; $i++) {
              echo "'{$ventasGrafico[$i]['dia']}',";
          }




         ?>],
        datasets: [{
          label: "Ventas",
          backgroundColor: '#00c292',
          borderColor: '#00c294',
          data: [<?php

            for ($i=0; $i <count($ventasGrafico) ; $i++) {
                echo "'{$ventasGrafico[$i]['total']}',";
            }




           ?>],
          fill: false,
          pointRadius: 5,
          pointHoverRadius: 5,
          showLine: true
        }]
      },
      options: {
        responsive: true,
        title:{
          display:true,
          text:'Ventas de la semana'
        },
        legend: {
          display: false
        },
        elements: {
          point: {
            pointStyle: 'circle',
          }
        }
      }
    });

  <?php if(count($alertaProductos)>0):?>
          swal("Queda muy poco de estos productos:", "<?php for($i=0;$i<count($alertaProductos);$i++):  echo "{$alertaProductos[$i]['nombre']}, "; endfor;?> ");
  <?php endif; ?>

  </script>

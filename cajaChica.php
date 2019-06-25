<?php
include 'class/cajachica.php';
include 'class/database.php';
session_start();
setlocale(LC_MONETARY,"es_PE");
$usuario=$_SESSION['usuario'];
$conexion= new database();
$fecha=date('y')."-".date('m')."-".date('d');
$cajachica = new cajachica($fecha,$usuario,$conexion);
$gastos=$cajachica->getGastos($fecha);
foreach ($gastos as $gasto) {
    $monto += $gasto['monto'];
}
$totalGastado=0;
$gastados=$cajachica->getGastosAdmin();
foreach ($gastados as $gastado) {
  if($gastado['usuarioGastos']=$usuario && $gastado['dato']==null){
    $totalGastado+=$gastado['monto'];
  }
}
$disponibilidad=$cajachica->getLimite();
$disponible=$disponibilidad['monto'];
$restanteGastado=$disponible-$totalGastado;


?>
<p class="d-inline text-right col-4" style="font-size:0.75rem;margin-top:-10px"> <i class="fas fa-dollar-sign fl-right"></i> Gastos de hoy:<?php echo money_format('%(#10n',$monto ) ?> </p>
<p class="d-inline text-right col-6" style="font-size:0.75rem;margin-top:-10px"> <i class="fas fa-dollar-sign fl-right"></i> Disponible: <?php echo money_format('%(#10n',$restanteGastado) ?> de <small><?php echo money_format('%(#10n',$disponible) ?></small> </p>
<p class="px-2 mx-3 mt-4">Coloca el monto y una pequeña descripcion para registrar el gasto </p>
<div class="addGastos col-12">
  <div class='form-row form-inline mt-2'>
    <input type='text' requerid name='monto[] ' class='form-control col-4 mx-2' placeholder='Monto' id="monto">
    <input type='text' requerid name='descripcion[] ' class='form-control col-6' placeholder='Descripcion'>
    <small class="text-danger mx-2 p-0 col-12 mt-2 " id="alerta"></small>
  </div>
</div>

<script>
remDisable();
$('#alerta').hide();
$('#monto').keyup(function(){
  var disponible =<?php echo $restanteGastado  ?>;
  if($(this).val()>disponible){
    $('#alerta').show();
    $('#alerta').text("No hay cantidad disponible para gastar");
    addDisable();

  }else{
    $('#alerta').hide();
    remDisable();
  }

})

</script>

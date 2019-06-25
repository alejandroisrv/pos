<style media="screen">
  .formulario-mlabel label{
    font-weight:500 !important;
    font-size: 12px !important;
    margin-bottom: 3px !important;
  }
</style>

<div class="formulario-mlabel">
    <div class="form-element-list">
      <div class="basic-tb-hd">
        <h2 id="tituloModal"></h2>
      </div>
      <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label>Descripcion</label>
                  <div class="nk-int-st">
                      <input type="hidden" name="idgasto" value="" id="idgasto">
                      <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Introduce una pequeña descripcion del gasto aquí">
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-56 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label>Monto</label>
                  <div class="nk-int-st">
                    <input type="text" id="monto" name="monto" class="form-control"placeholder="Coloca el monto">
                  </div>
              </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label title="¿Cada cuanto se realizará este gasto?">Frecuencia</label>
                <div class="">
                    <select class="form-control" id="frecuencia"  name="frecuencia" >
                      <option>Unico</option>
                      <option>Diario</option>
                      <option>Semanal</option>
                      <option>Mensual</option>
                    </select>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
<script  type="text/javascript">
function llenarCuadros(cuadro,valor) {
    $('#'+cuadro).val(valor);
}
$("#tituloModal").text("Añade un nuevo gasto");
<?php
if(isset($_GET['idproducto'])){
  include '../class/database.php';
  include '../class/cajachica.php';
  $conexion=new database();
  $spend=new cajachica(date("Y-d-m"),2,$conexion);
  $gasto=$spend->getGasto($_GET['idproducto']);
?>
$("#tituloModal").text("Modificar gasto");
$("#descripcion").prop('readonly',true);
llenarCuadros('idgasto',"<?php echo $_GET['idproducto'] ?>")
llenarCuadros('descripcion',"<?php echo $gasto['descripcion'] ?>")
llenarCuadros('monto',"<?php echo $gasto['monto'] ?>")
$('#frecuencia').selectpicker('val', '<?php echo $gasto['frecuencia'] ?>');
<?php } ?>

</script>

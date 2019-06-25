
<link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcomb-list">
          <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
              <div class="breadcomb-wp">
                <div class="breadcomb-icon">
                  <i class="notika-icon notika-bar-chart"></i> 
                </div>
                <div class="breadcomb-ctn">
                  <h2>Delivery</h2>
                  <p>Todos los pedidos, aparecerán aquí. Puedes acceder a los detalles, incluso descargarlos.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
              <div class="breadcomb-report">
                <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcomb area End-->
  <!-- Data Table area Start-->
  <div class="data-table-area">
      <div class="container">
                <div class="datepicker-int mg-t-30">
                  <div class="cmp-tb-hd">
                    <h2>Historial de delivery</h2>
                    <p>Puedes relizar busquedas por fecha, número de orden, tipo y total.</p>
                  </div>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <div class="form-group nk-datapk-ctm form-elet-mg" data-date-format="mm/dd/yyyy" id="data_2">
                              <label>Desde</label>
                              <div class="input-group date nk-int-st">
                                  <span class="input-group-addon"></span>
                                  <input type="text" class="form-control" id="desde" value="24/03/2019" autocomplete="off">
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <div class="form-group nk-datapk-ctm form-elet-mg" data-date-format="mm/dd/yyyy" id="data_2">
                              <label>Hasta</label>
                              <div class="input-group date nk-int-st">
                                  <span class="input-group-addon"></span>
                                  <input type="text" class="form-control" id="hasta" value="24/03/2019" autocomplete="off">
                              </div>
                          </div>
                      </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group nk-datapk-ctm form-elet-mg mg-t-30">
                                <button class="btn btn-success success-icon-notika waves-effect" id="searchFecha"><i class="notika-icon notika-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
            </div>
          <div class="row" id="tabla-delivery">

            </div>
        </div>
    </div>
    <script type="text/javascript">
    request("pages/delivery-tabla.php",null,$('#tabla-delivery'));
    function convertForPHP(fecha) {
      var info = fecha.split('/');
      return info[2] + '-' + info[1] + '-' + info[0];
      //2019-03-24
    }
    $(document).ready(function () {
        $('#searchFecha').on('click',function(){
        var data = {
            'desde':convertForPHP($("#desde").val()),
            'hasta':convertForPHP($("#hasta").val())
          }
          request("pages/delivery-tabla.php",data,$('#tabla-delivery'));
        })
    });

    </script>
    <script src="../assets/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="../assets/js/datapicker/datepicker-active.js"></script>

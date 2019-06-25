<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
                  <i class="notika-icon notika-windows"></i>
                </div>
                <div class="breadcomb-ctn">
                  <h2>Reporte</h2>
                  <p>Filtra los datos para obtener la información exacta.</p>
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
  <div class="data-table-area" style>
      <div class="container">
        <form action="pages/gastos-reporte" method="post" target="_blank">
                <div class="datepicker-int mg-t-30" style="margin-bottom:130px !important;">
                  <div class="cmp-tb-hd">
                    <h2>Reporte detallado de todos tus gastos</h2>
                    <p></p>
                  </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3col-xs-12">
                            <div class="form-group nk-datapk-ctm form-elet-mg" data-date-format="mm/dd/yyyy" id="data_2">
                                <label>Desde</label>
                                <div class="input-group date nk-int-st">
                                    <span class="input-group-addon"></span>
                                    <input type="text" class="form-control" name="desde" value="24/03/2019" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3col-xs-12">
                            <div class="form-group nk-datapk-ctm form-elet-mg" data-date-format="mm/dd/yyyy" id="data_2">
                                <label>Hasta</label>
                                <div class="input-group date nk-int-st">
                                    <span class="input-group-addon"></span>
                                    <input type="text" class="form-control" name="hasta" value="24/03/2019" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3col-xs-12">
                          <div class="form-group">
                            <label title="">Tipo de gasto</label>
                            <div class="">
                                <select class="form-control" name="tipo" id="tipogasto" >
                                  <option>Todos</option>
                                  <option>Compra de mercancia</option>
                                  <option>Gastos en el local</option>
                                  <option>Gastos administrativos</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3col-xs-12">
                            <div class="form-group nk-datapk-ctm form-elet-mg mg-t-30">
                                <button type="submit" class="btn btn-success success-icon-notika waves-effect" id="searchFecha"><i class="notika-icon notika-search"></i> Buscar</button>
                            </div>
                        </div>
                      </div>
                  </div>
          </form>
        </div>
    </div>
    <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="../assets/js/datapicker/datepicker-active.js"></script>

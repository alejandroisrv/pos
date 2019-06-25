
<link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcomb-list">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="breadcomb-wp">
                <div class="breadcomb-icon">
                  <i class="notika-icon notika-house"></i>
                </div>
                <div class="breadcomb-ctn">
                  <h2>Balance</h2>
                  <p>Aquí podrás obtener un balance general sobre los ingresos y egresos</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
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
                    <h2>Balance general</h2>
                    <p>Relizar busquedas por fecha.</p>
                  </div>
                  <form  action="pages/balance" method="post" target="_blank">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group nk-datapk-ctm form-elet-mg" id="data_2">
                                <label>Desde</label>
                                <div class="input-group date nk-int-st">
                                    <span class="input-group-addon"></span>
                                    <input type="text" class="form-control" name="desde" value="24/03/2018">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group nk-datapk-ctm form-elet-mg" id="data_2">
                                <label>Hasta</label>
                                <div class="input-group date nk-int-st">
                                    <span class="input-group-addon"></span>
                                    <input type="text" class="form-control" name="hasta" value="24/03/2018">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group nk-datapk-ctm form-elet-mg mg-t-30">
                                <button type="submit" class="btn btn-success success-icon-notika waves-effect" id="searchFecha"><i class="notika-icon notika-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../assets/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="../assets/js/datapicker/datepicker-active.js"></script>

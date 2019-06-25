<?php
session_start();
if(!isset($_SESSION['usuario'])){
 header('Location:login');
}
if((!isset($_COOKIE['modoventa']))){
    header('Location:modoventa');
}

header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Inventario Sencillo</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <?php if($_COOKIE['nocturno']):?>
    <link rel="stylesheet" type="text/css" href="assets/css/nocturno.css">
    <?php endif; ?>
</head>
<body>
    <?php include 'nav.php' ?>
    <div class="preloader">
        <img src="assets/img/gif-load.gif" alt="cargando">
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modalclose"><button type="button" class="close mr-4 mt-4 text-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrar Venta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form id='formSendData' method='post' action=''>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger cancelar" id="cancelar" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="registerBtn" disabled="true">Guardar</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    <section class="pl-4 py-2 mt-2">
      <p class="result alert my-4"></p>
      <div class="md-form mt-0">
        <form class="form-inline pb-3" id='searchForm'>
          <input class="form-control col-5" type="search" placeholder="Prueba buscar aquí" aria-label="Search" id='searchText' />
        </form>
      </div>
        <div class="row justify-content-between">
          <div class="content-product ml-4 col-4 px-0">
          </div>
          <div class="col-6">
            <div class="row">
                <div class="col-12 content-selling mb-3">
                </div>
            </div>
            <div class="row">

              <div class="col-12 content-delivery pr-2 mr-2">
              </div>

            </div>
          </div>
      </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="assets/js/functionsController.js" charset="utf-8"></script>
    <script src="assets/js/controller.js" charset="utf-8"></script>
    <script src="assets/js/formSendData.js" charset="utf-8"></script>
    <script src="assets/js/caja.js" charset="utf-8"></script>
    <script type="text/javascript" src="assets/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="assets/js/jquery.tablesorter.widgets.js"></script>
    <?php if($_SESSION['caja']==0): ?>
    <script>
        abrirCaja();
    </script>
    <?php  endif; ?>

    <?php if($_SESSION['usuario']==1 && $_COOKIE['modoventa']=="delivery"): ?>
    <script type="text/javascript">

    var actual;

    var audioElement = document.createElement('audio');
		audioElement.setAttribute('src', 'alerta2.mp3');
    xhr_get('consultaPedidos.php',null,null).done(function(data){
       actual = data;
    });
    setInterval(function(){
      $.get('consultaPedidos.php',function(res){
        if(actual<res){
            btnModal.hide();
            prepareModal("Nuevo pedido en barranco","Continuar","");
            $('#cancelar').text('Aceptar').button("refresh");
            audioElement.play().catch(function(){});
            setTimeout(audioElement.play().catch(function(){}),3000);;
            loadDelivery();
            $('#exampleModal').modal('show');
            xhr_get('nuevoPedido.php',modal,null);
            console.log("nuevo pedido");
            actual = res;
        }else {
          console.log("Todo igual");
        }
      });
    },5000);

    </script>
    <?php  endif; ?>
</body>
</html>

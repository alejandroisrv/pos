<?php
session_start();
if(!isset($_SESSION['usuario'])){
  if($_SESSION['rol-user']!="admin"){
     header('Location:/');
  }
}
if((!isset($_COOKIE['modoventa'])) && ($_SESSION['usuario']=="caja")){
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
<body >

    <?php include 'nav.php' ?>
    <div class="preloader">
        <img src="assets/gif-load.gif" alt="cargando">
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
            <button type="button" class="btn btn-danger cancelar" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="registerBtn" disabled="true">Guardar</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    <section class="pl-4 py-2 mt-2">
         <?php if($_SESSION['usuario']!="caja"): ?>
           <h1 class="lead mt-4" style="font-size:2rem !important;" id="titulo">Inventario<span id='numeroArticulos'></span>
              <small class="showAll " style="font-size:0.78rem; margin-left:8px;cursor:pointer">Mostrar todos los productos</small>
              <small class="hideAll " style="font-size:0.78rem; margin-left:8px;cursor:pointer">Mostrar menos</small>
            </h1>

         <?php else: ?>
            <h1 class="display-4 mt-4" style="font-size:2rem !important;" id="titulo">Sistema de Venta<span id='numeroArticulos'></span></h1>
          <?php endif; ?>

          <p class="result alert my-4"></p>
        <div class="md-form mt-0">
            <form class="form-inline pb-3" id='searchForm'>
              <input class="form-control col-5" type="search" placeholder="Prueba buscar aquí" aria-label="Search" id='searchText' />
            </form>
        </div>
        <div class="row justify-content-start">
          <div class="content-product col-10 px-0">
          </div>
      </div>
    </section>
    <script>
         $( window ).on( "load", function() {
            $('.preloader').css('display', 'none');
          });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="assets/js/functionsController.js" charset="utf-8"></script>
    <script src="assets/js/controller.js" charset="utf-8"></script>
    <script src="assets/js/formSendData.js" charset="utf-8"></script>
</body>
</html>

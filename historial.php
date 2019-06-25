<?php 
session_start();
if(!isset($_SESSION['usuario'])){
 header('Location:login');
}
if($_SESSION['usuario']!="admin"){
    header('Location:login');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inventario Sencillo</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <?php if($_COOKIE['nocturno']):?>
      <style type="text/css">
        
                
            body{
                color: white !important;
                background: #131313 !important;
            
            }
            .table td, .table th{
                border-top: 1px solid #2a2a2a !important;
            }
            .form-control{
                  background-color: #232323 !important;
                  color: white !important;
            }
            

            .modal-content {
                  background-color: #232323 !important;
                  color: white !important;
                
            }
      </style>
    <?php endif; ?>

</head>
<body>
    <script>
        

         $( window ).on( "load", function() {
            $('.preloader').css('display', 'none');
          });
  </script>
    <?php include 'nav.php' ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
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
        <button type="button" class="btn btn-secondary cancelar" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="registerBtn">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>
<section class="container mt-2">
  <h1 class="lead my-4" style="font-size:2rem !important;">Historial de movimientos<span id='numeroArticulos'></span></h1>
  <ul class="nav nav-tabs my-4">
    <li class="nav-item">
      <a href="#todos" class="nav-link tipoMovimientos" data-movimiento="0">Todos</a>
    </li>
    <li class="nav-item">
      <a href="#entradas" class="nav-link tipoMovimientos" data-movimiento="2">Entradas</a>
    </li>
    <li class="nav-item">
      <a href="#salidas" class="nav-link tipoMovimientos" data-movimiento="1">Salidas</a>
    </li>
        
    <li class="nav-item" style="float:right !important; margin-left:90% !important; margin-bottom:10px;">
        <button class="vaciarStock btn btn-danger"  type="button"> Vaciar stock </button>
    </li>
  </ul>

  <p class="result alert my-4"></p>

  <div class="content-history">



  </div>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="js/historial.js" charset="utf-8"></script>
</body>
</html>

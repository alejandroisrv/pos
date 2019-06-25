<?php
session_start();

  $hora=date("G");
  if(($hora>=21 && $hora<=23) || ($hora>=0 && $hora<=4) ):
      $noche=true;
  else:
      $noche=false;
  endif;
  if(!isset($_COOKIE['nocturno'])){
    setcookie('nocturno',$noche,time()+ 14400,'/','inv.donjuerguero.com');
    $nocturno=$noche;
  }else{
    $nocturno=$_COOKIE['nocturno'];
  }
  if(isset($_SESSION['usuario'])){
    header('Location:/');
  }
?>
<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | Inventario Secillo</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body  style="background:url('assets/img/<?php if($nocturno){ echo '8048';}else{ echo 'sky'; }?>.jpg'); background-size:cover;color:white !important">
<section class="container p-5 align-self-center mt-5">

    <div class="row justify-content-left align-self-center mt-5">
    <small class="display-4 col-lg-7 col-sm-12" style="text-shadow: 1px #000;"> Iniciar sesion </small>
    <form class="col-lg-4 col-sm-12 p-5" action="core/loginCore" method='post' style="background:rgba(253,253,253,0.3);border-radius:20px;">
      <div class="form-group">
        <label for="exampleInputEmail1">Usuario</label>
        <input type="text" class="form-control" name="usuario" aria-describedby="emailHelp" placeholder="Usuario">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Contraseña</label>
        <input type="password" class="form-control" name="password" placeholder="Contraseña">
      </div>
      <button type="submit" class="btn btn-primary col-12">Entrar</button>
    </form>

    </div>
.
</section>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="assets/js/functionsController.js" charset="utf-8"></script>
    <script src="assets/js/controller.js" charset="utf-8"></script>
    <script src="assets/js/formSendData.js" charset="utf-8"></script>
</body>
</html>

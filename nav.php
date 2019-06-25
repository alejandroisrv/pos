<?php
  $usuario=$_SESSION['rol-user'];
    $admin=false;
    if($usuario=="admin"){
      $admin=true;
    }
      $hora=date("G");
      if(($hora>=21 && $hora<=23) || ($hora>=0 && $hora<=4) ):
          $noche=true;
      else:
          $noche=false;
      endif;
    if(!isset($_COOKIE['codigo']) || $_COOKIE['codigo']==""){
       function generarCodigo() {
       $key = '';
       $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $max = strlen($pattern)-1;
       for($i=0;$i < 8;$i++) $key .= $pattern{mt_rand(0,$max)};
       return $key;
       }
      $codigo=generarCodigo();
      setcookie('codigo',$codigo,time()+ 365 * 24 * 60 * 60,'/','inv.donjuerguero.com');
    }else{
      $codigo= $_COOKIE['codigo'];
    }
      if(!isset($_COOKIE['modoventa'])){
        header('Location:modoventa');
      }else{
        $modoventa=$_COOKIE['modoventa'];
      }
      $modosventa = array('dia','noche','delivery','domicilios.com');
      $nocturno=$_COOKIE['nocturno'];

  ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container py-1">
    <a class="navbar-brand align-self-center" href="index.php">
        <img src="assets/img/logo-inv.png" width="45" height="40" class="d-inline-block align-bottom" alt=""/> Local Sucre

        </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" style="color:white;"></span>
    </button>
    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
          <?php if($_SESSION['rol-user']!="caja"):?>
        <li class="nav-item align-self-center">
          <a class="nav-link loadModal" style="font-size:0.85rem;" href="#" data-toggle="modal" data-target="#exampleModal" data-tipo="addProduct">Nuevo producto</a>
        </li>
        <li class="nav-item active align-self-center">
          <a class="nav-link loadModal" style="font-size:0.85rem;" href="#" data-toggle="modal" data-target="#exampleModal" data-tipo="registerVenta"><i class="fas fa-minus-circle"></i></i>Salida de productos</a>
        </li>
        <li class="nav-item active align-self-center">
          <a class="nav-link loadModal" style="font-size:0.85rem;" href="#" data-toggle="modal" data-target="#exampleModal" data-tipo="registerEntrada"><i class="fas fa-plus-circle"></i> Entrada de productos</a>
        </li>
      <?php else:?>
        <li class="nav-item active align-self-center">
          <a class="nav-link loadModal" style="font-size:0.85rem;" href="#" data-toggle="modal" data-target="#exampleModal" title="Gastos/Caja chica" data-tipo="cajachica"><i class="fas fa-cash-register"></i></a>
        </li>

        <li class="nav-item active align-self-center">
          <a class="nav-link loadModal" style="font-size:0.85rem;" href="#" data-toggle="modal" data-target="#exampleModal" title="Lista de favoritos" data-tipo="favoritos"><i class="fas fa-star"></i></a>
        </li>

        <?php endif; ?>
        <li class="nav-item active align-self-center">

          <div class="dropdown show">
                <a class="nav-link dropdown-toggle" style="font-size:0.85rem;" href="#" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ucfirst($modoventa)  ?></i></a>

               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                 <?php

                      for($i=0;$i < count($modosventa); $i++){
                        if($modosventa[$i]!="$modoventa"){
                         if(!$admin){
                            if(($noche) && ($modosventa[$i]!="dia")){
                                echo '<a class="dropdown-item changeModo" data-modo="'.$modosventa[$i].'" >
                                        '.ucfirst($modosventa[$i]).'
                                    </a>';
                                 }else if((!$noche) && ($modosventa[$i]!="noche")){
                                echo '<a class="dropdown-item changeModo" data-modo="'.$modosventa[$i].'" >
                                        '.ucfirst($modosventa[$i]).'
                                    </a>';
                             }
                         }else{
                                echo '<a class="dropdown-item changeModo" data-modo="'.$modosventa[$i].'" >
                                        '.ucfirst($modosventa[$i]).'
                                    </a>';
                         }

                        }


                      }
                  ?>

              </div>
            </div>
        </li>
        <?php if($admin):?>

        <li class="nav-item active">
          <a class="nav-link" style="font-size:0.85rem;" href="ventas.php">
               <i class="fas fa-hand-holding-usd"></i>
          </a>
        </li>
        <li class="nav-item active ml-3">
          <a class="nav-link" style="font-size:0.85rem;" href="historial.php"><i class="fas fa-history"></i></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" style="font-size:0.85rem;" href="clave.php">
              <i class="fas fa-key"></i></a>
        </li>
        <?php endif; ?>
        <li class="nav-item active">
          <a class="nav-link nocturnoMode" title="Modo Nocturno" style="font-size:0.85rem;">
          <?php
           if($nocturno)
                echo '<i class="fas fa-moon"></i>';
           else
                echo '<i class="far fa-moon"></i>';
            ?>

          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link cerrarSesion" title="Cierre de sesión" style="font-size:0.85rem;" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </div>

  </div>
</nav>

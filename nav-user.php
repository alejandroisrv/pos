
<style media="screen">

  .btn-primary{

    background-color:#4FC3F7 !important;
    border-color:#4FC3F7 !important;

  }

  .btn-primary:hover{

    background-color:#49b6e7 !important;
    border-color:#49b6e7;

  }
   i{
    cursor: pointer;
  }
  .c{

    cursor:pointer;

  }
  .ocultarMov{


  }

  @media only screen and (max-width: 850px) {
    .ocultarMov{

      display: none;
    }

    #product{
      font-size:0.85rem;
      width: 100%;
    }
    #product td{
      padding: 4px;
      width: 100%;
    }
    #product tr{
      padding: 4px;
      width: 100%;

    }

		}


  /*.sidebar{
    background-color:#4FC3F7 !important;
    position: fixed;
    left:0px;
    width: 26%;
    height: 100%;
    box-shadow: 0 2px 5px rgba(0,0,0,.15);background-color:#4FC3F7 !important;color:white;
  }
  section{
    width: 72% !important;
    margin-left: 27% !important;
    display: block;
    background-color: white;

  }*/

</style>
<nav class="navbar navbar-expand-lg navbar-light" style="box-shadow: 0 2px 5px rgba(0,0,0,.15);background-color:#4FC3F7 !important;color:white;">
  <div class="container py-2">
    <a class="navbar-brand" style="color:white;" href="index.php">Inventario</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" style="color:white;"></span>
    </button>
    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link loadModal" style="color:white;font-size:0.85rem;" href="#" data-toggle="modal" data-target="#exampleModal" data-tipo="addProduct"><i class="fas fa-folder-plus"></i> A単adir Producto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link loadModal" style="color:white;font-size:0.85rem;" href="#" data-toggle="modal" data-target="#exampleModal" data-tipo="registerVenta"><i class="fas fa-external-link-alt"></i> Registrar salida</a>
        </li>
        <li class="nav-item">
          <a class="nav-link loadModal" style="color:white;font-size:0.85rem;" href="#" data-toggle="modal" data-target="#exampleModal" data-tipo="registerEntrada"><i class="fas fa-plus-circle"></i> Registrar entrada</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " style="color:white;font-size:0.85rem;" href="out.php"> <i class="fas fa-sign-out-alt"></i> Salir</a>
        </li>
      </ul>
    </div>

  </div>
</nav>

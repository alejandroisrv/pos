<?php

session_start();

if(!isset($_SESSION['usuario'])){

 header('Location:login');
 
}

$hora=date("G");
$noche=false;
if(($hora>=17 && $hora<=23) || ($hora>=0 && $hora<=4) )
    $noche=true;
    
if(isset($_GET['modoventa'])){

    
    if($noche){
        
        if($_GET['modoventa']=="noche" || $_GET['modoventa']=="delivery"){
            
            setcookie('modoventa',$_GET['modoventa'],time()+ 14400000,'/');
            header('location:/');
        }else{
            
            echo "<script>alert('Ha ocurrido un error')</script>";
            
        }
    }else{
        
        
        setcookie('modoventa',$_GET['modoventa'],time()+ 14400000,'/');
        header('location:/');
        
        
    }

    
}







?>
<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inventario Secillo</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        
        .boton{
            background:white;color:#49b6e7  !important; border-radius:20px;
            cursor:pointer;
            border:none;
            outline:none;
        }

        button:disabled,
        button[disabled]{
           background-color:#5cc0ec !important;
            
        }
                button:disabled,
        button[disabled]{
           background-color:#5cc0ec !important;
            
        }
    </style>
    </head>
    <body style="background-color:#49b6e7 !important;">
        
        
        <section class="container p-5 align-self-center mt-5">
            <br><br>
            <div class="row justify-content-center align-items-center">
            <small class="display-4" style="color:white;"> Modo de venta </small>
            </div>
            <form>

            <div class="row justify-content-center align-items-center mt-5">
                     <button <?php if($noche) echo 'disabled';   ?> 
                     name="modoventa" value="dia" type="submit" class="col-3 mx-2 p-4 text-center boton">
                        
                        <i class="fas fa-cloud-sun" style="font-size:11.5rem;"></i>
                        <small class="display-4 m-1" style="font-size:1.5rem !important;">Día</small>
                              
                    </button>
                <button <?php if(!$noche) echo 'disabled="true"';   ?> 
                type="submit" name="modoventa"  class="col-3 mx-2 p-4 text-center boton" value="noche">
                        
                        <i class="fas fa-cloud-moon" style="font-size:11.5rem;"></i>
                        <small class="display-4 m-1" style="font-size:1.5rem !important;">Noche</small>
                </button>
                <button  type="submit" name="modoventa" value="delivery" class="col-3 mx-2 p-4 text-center boton">
                        
                        <i class="fas fa-motorcycle" style="font-size:11.5rem;"></i>
                        
                        <small class="display-4 m-1" style="font-size:1.5rem 
                        !important;">Delivery</small>
                        
                    </button>
                
            </div>
            </form>
        </section>
    </body>
</html>
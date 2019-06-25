<?php
session_start();
        function generarCodigo() {
        $key = '';
        $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($pattern)-1;
        for($i=0;$i < 8;$i++) $key .= $pattern{mt_rand(0,$max)};
        return $key;
        }
        $codigo=generarCodigo();

        $hora=date("G");
      if(($hora>=21 && $hora<=23) || ($hora>=0 && $hora<=4) ):
          $noche=true;
      else:
          $noche=false;
      endif;

      if(($noche) && ($_GET['modoventa']=="delivery" || $_GET['modoventa']=="noche" || $_GET['modoventa']=="domicilios.com")){
          setcookie('modoventa',$_GET['modoventa'],time()+ 14400 ,'/');
          setcookie('codigo',$codigo,time()+ 365 * 24 * 60 * 60,'/','inv.donjuerguero.com');
        echo "OK";

      }else if((!$noche) && ($_GET['modoventa']=="delivery" || $_GET['modoventa']=="dia" || $_GET['modoventa']=="domicilios.com")){
          setcookie('modoventa',$_GET['modoventa'],time()+ 14400 ,'/');
          setcookie('codigo',$codigo,time()+ 365 * 24 * 60 * 60,'/','inv.donjuerguero.com');
        echo "OK";
      }else{

          echo "ERROR";
      }
















?>

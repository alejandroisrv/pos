<?php 




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



?>
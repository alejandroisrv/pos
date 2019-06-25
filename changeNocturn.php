<?php 
if ($_COOKIE["nocturno"]) {

      setcookie("nocturno",false,time()+ 144 *10 * 10 ,"/","inv.donjuerguero.com");
}else{

      setcookie("nocturno",true,time()+ 144 *10 * 10 ,"/","inv.donjuerguero.com");
}




?>
<?php 

session_start();

if(!isset($_SESSION['usuario'])){

	header('Location:../login');

}else{



	$usuario=$_SESSION['usuario'];
	switch ($usuario) {
		case 'caja':
		$admin=false;
		$hora=date("G");
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
			header('Location:../modoventa');
		}else{

			$modoventa=$_COOKIE['modoventa'];
		} 

		
		if(($hora>=18 && $hora<=23) || ($hora>=0 && $hora<=4) ):
			$noche=true;
			$modosventa = array('noche','delivery' );

		else:
			$modosventa = array('dia','noche','delivery');
		endif;
		
		if(!isset($_COOKIE['nocturno'])){

			if($noche){
				setcookie('nocturno',true,time()+ 14400000,'/');
	    		$nocturno=true;
			}else{
				setcookie('nocturno',false,time()+ 14400000,'/');
	    		$nocturno=false;
			}

		}else{

			$nocturno=$_COOKIE['nocturno'];
		}


			break;
	
		case 'inventario':
		
		$admin=false;


			break;


		case 'admin':

			$admin=true;

			break;
		
		default:
			header('Location:../login?e=user_error');
			break;
	}


}












?>
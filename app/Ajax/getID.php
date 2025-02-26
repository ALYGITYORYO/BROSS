<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\getIDController;

	if(isset($_GET['variable'])){

		$folios = new getIDController();

		if($_GET['variable']=="get_ID"){
			echo $folios->getIDControlador();
		}

		if($_GET['variable']=="colaboradorGet_ID"){
			echo $folios->colaboradorGetIDControlador();
		}

		if($_GET['variable']=="cotizadorGet_ID"){
			echo $folios->cotizadorGetIDControlador();
		}
		if($_GET['variable']=="remisionGet_ID"){
			echo $folios->remisionGetIDControlador();
		}		
		
	}
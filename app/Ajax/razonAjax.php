<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\razonController;

	if(isset($_POST['catalogo_razon'])){

		$intrazon =new razonController();

		if($_POST['catalogo_razon']=="registrar"){
			echo $intrazon->registrarRazonControlador();
		}

		if($_POST['catalogo_razon']=="eliminar"){
			echo $intrazon->eliminarRazonControlador();
		}

		if($_POST['catalogo_razon']=="actualizar"){
			echo $intrazon->actualizarRazonControlador();
		}		
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}
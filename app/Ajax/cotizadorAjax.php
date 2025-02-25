<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\cotizadorController;

	if(isset($_POST['moduloCotizador'])){

		$cotizadorinit = new cotizadorController();

		if($_POST['moduloCotizador']=="registrar"){
			echo $cotizadorinit->registrarCotizacionControlador();
		}

		if($_POST['moduloCotizador']=="leer"){
			echo $cotizadorinit->leerCotizacionControlador();
		}
	
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}
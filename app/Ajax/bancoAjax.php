<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\bancoController;

	if(isset($_POST['catalogo_banco'])){

		$intbanco = new bancoController();

		if($_POST['catalogo_banco']=="registrar"){
			echo $intbanco->registrarBancoControlador();
		}

		if($_POST['catalogo_banco']=="eliminar"){
			echo $intbanco->eliminarBancoControlador();
		}

		if($_POST['catalogo_banco']=="actualizar"){
			echo $intbanco->actualizarBancoControlador();
		}		
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}
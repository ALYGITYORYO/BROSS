<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\colaboradoresController;

	if(isset($_POST['catalogo_colaboradores'])){

		$intcolaboradores = new colaboradoresController();

		if($_POST['catalogo_colaboradores']=="registrar"){
			echo $intcolaboradores->registrarColaboradoresControlador();
		}

		if($_POST['catalogo_colaboradores']=="eliminar"){
			echo $intcolaboradores->eliminarUsuarioControlador();
		}

		if($_POST['catalogo_colaboradores']=="actualizar"){
			echo $intcolaboradores->actualizarUsuarioControlador();
		}		
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}
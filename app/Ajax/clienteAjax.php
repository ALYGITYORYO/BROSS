<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\clienteController;

	if(isset($_POST['catalogo_cliente'])){

		$intcliente = new clienteController();

		if($_POST['catalogo_cliente']=="registrar"){
			echo $intcliente->registrarClienteControlador();
		}

		if($_POST['catalogo_cliente']=="eliminar"){
			echo $intcliente->eliminarUsuarioControlador();
		}

		if($_POST['catalogo_cliente']=="leercliente"){
			echo $intcliente->leerclienteControlador();
		}

		if($_POST['catalogo_cliente']=="actualizar"){
			echo $intcliente->actualizarClientesControllers();
		}		
		if($_POST['catalogo_cliente']=="lista_clientes"){
			echo $intcliente->listaClientesControlador();
		}	
		if($_POST['catalogo_cliente']=="drillRelacionOperativo"){
			echo $intcliente->DrillClientesOpeControlador();
		}	
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}
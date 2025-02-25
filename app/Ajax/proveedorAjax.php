<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\proveedorController;

	if(isset($_POST['catalogo_proveedor'])){

		$intProveedor = new proveedorController();

		if($_POST['catalogo_proveedor']=="registrar"){
			echo $intProveedor->registrarProveedorControlador();
		}

		if($_POST['catalogo_proveedor']=="eliminar"){
			echo $intProveedor->eliminarProveedorControlador();
		}

		if($_POST['catalogo_proveedor']=="actualizar"){
			echo $intProveedor->actualizarProveedorControlador();
		}		
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}
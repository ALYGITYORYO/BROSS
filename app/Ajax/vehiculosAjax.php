<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\vehiculosController;

	if(isset($_POST['vehiculosCatalogo'])){

		$vehiculosOBJ = new vehiculosController();

		if($_POST['vehiculosCatalogo']=="registrar"){
			echo $vehiculosOBJ->vehiculosAltaControlador();
		}

		if($_POST['vehiculosCatalogo']=="leer"){
			echo $vehiculosOBJ->listarDroplistControlador();
		}

		if($_POST['vehiculosCatalogo']=="ultimo_id"){
			echo $vehiculosOBJ->ultimoIDroplistControlador();
		}	

		if($_POST['vehiculosCatalogo']=="lista_vehiculos_remision"){
			echo $vehiculosOBJ->remisionListaControlador();
		}		
		
		if($_POST['vehiculosCatalogo']=="drillRelacionRemolque"){
			echo $vehiculosOBJ->remisionRmolqueDrill();
		}	
		
	}
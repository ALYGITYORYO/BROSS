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
		if($_POST['vehiculosCatalogo']=="lista_vehiculos_logistica"){
			echo $vehiculosOBJ->listLogisticaControlador();
		}		
		
		if($_POST['vehiculosCatalogo']=="drillRelacionRemolque"){
			echo $vehiculosOBJ->remisionRmolqueDrill();
		}	
		if($_POST['vehiculosCatalogo']=="drillRelacionRemolqueLog"){
			echo $vehiculosOBJ->logisticaRemolqueDrill();
		}	
		if($_POST['vehiculosCatalogo']=="listar"){
			echo $vehiculosOBJ->listavehiculosControlador();
		}
		if($_POST['vehiculosCatalogo']=="leerVehiculo"){
			echo $vehiculosOBJ->leerVehiculoControlador();
		}
		if($_POST['vehiculosCatalogo']=="actualizar"){
			echo $vehiculosOBJ->actualizarVehiculoControlador();
		}

		if($_POST['vehiculosCatalogo']=="eliminarLogV"){
			echo $vehiculosOBJ->borrarLogVControlador();
		}
		
	}
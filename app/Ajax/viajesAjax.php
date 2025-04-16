<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\viajesController;
	if(isset($_POST['viajesControllers'])){
		$viajes = new viajesController();
		if($_POST['viajesControllers']=="viajes"){
			echo $viajes->viajesGetController();
		}

		if($_POST['viajesControllers']=="leer"){
			echo $viajes->viajesModuloController();
		}
		if($_POST['viajesControllers']=="drillVehiculos"){
			echo $viajes->vehiculos_drill();
		}

		if($_POST['viajesControllers']=="drillimg"){
			echo $viajes->imagen_drill();
		}

		if($_POST['viajesControllers']=="incidenciadrill"){
			echo $viajes->incidencia_drill();
		}
	}
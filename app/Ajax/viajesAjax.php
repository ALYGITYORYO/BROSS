<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\viajesController;
	if(isset($_POST['viajesControllers'])){
		$remision = new viajesController();
		if($_POST['viajesControllers']=="viajes"){
			echo $remision->viajesGetController();
		}
	}
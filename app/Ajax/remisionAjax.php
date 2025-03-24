<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\remisionController;
	if(isset($_POST['remision'])){
		$remision = new remisionController();
		if($_POST['remision']=="leer"){
			echo $remision->remisionLeer();
		}
		if($_POST['remision']=="registrar"){
			echo $remision->remisionRegistrarController();
		}
		if($_POST['remision']=="viajes"){
			echo $remision->viajesTranscursoController();
		}
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}
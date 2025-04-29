<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\logVController;

	if(isset($_POST['moduloLogistica'])){

		$obj_log = new logVController();

		if($_POST['moduloLogistica']=="registrar"){
			echo $obj_log->registralogVControlador();
		}

		if($_POST['moduloLogistica']=="listar"){
			echo $obj_log->colaboradorGetIDControlador();
		}
        if($_POST['moduloLogistica']=="modificar"){
			echo $obj_log->colaboradorGetIDControlador();
		}
		
		
	}
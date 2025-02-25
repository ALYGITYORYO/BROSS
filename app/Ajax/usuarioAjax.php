<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\userController;
	if(isset($_POST['catalogo_usuario'])){
		$insUsuario = new userController();
		if($_POST['catalogo_usuario']=="registrar"){
			echo $insUsuario->registrarUsuarioControlador();
		}
		if($_POST['catalogo_usuario']=="eliminar"){
			echo $insUsuario->eliminarUsuarioControlador();
		}
		if($_POST['catalogo_usuario']=="actualizar"){
			echo $insUsuario->actualizarUsuarioControlador();
		}
		if($_POST['catalogo_usuario']=="eliminarFoto"){
			echo $insUsuario->eliminarFotoUsuarioControlador();
		}
		if($_POST['catalogo_usuario']=="actualizarFoto"){
			echo $insUsuario->actualizarFotoUsuarioControlador();
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}
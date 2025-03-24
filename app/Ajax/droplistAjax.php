<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\droplistController;

	if(isset($_GET['catalogo_droplist'])){

		$intdroplist = new droplistController();

		if($_GET['catalogo_droplist']=="registrar"){
			echo $intdroplist->registrardroplistControlador();
		}

		if($_GET['catalogo_droplist']=="leer"){
			echo $intdroplist->listarDroplistControlador();
		}

		if($_GET['catalogo_droplist']=="leer_operador"){
			echo $intdroplist->listaOperadorControlador();
		}
		if($_GET['catalogo_droplist']=="leer_razon"){
			echo $intdroplist->listaRazonControlador();
		}		
		if($_GET['catalogo_droplist']=="leer_remolque"){
			echo $intdroplist->listaRemolqueControlador();
		}

		if($_GET['catalogo_droplist']=="leer_dolly"){
			echo $intdroplist->listaDollyControlador();
		}
		
		
		if($_GET['catalogo_droplist']=="leer_cliente"){
			echo $intdroplist->listaClienteControlador();
		}

		if($_GET['catalogo_droplist']=="leer_cp"){
			echo $intdroplist->listaCPControlador();
		}
		
	}
<?php

	namespace app\controllers;
	use app\models\mainModel;

	class droplistController extends mainModel{

		/*----------  Controlador registrar usuario  ----------*/
		public function registrardroplistControlador(){

			# Almacenando datos#
			$tabla = $_POST['TABLA'];
			$value = $_POST['VALUE'];			
			$registrar_usuario=$this->ejecutarConsulta("INSERT INTO `$tabla` (`ID`, `NOMBRE`) VALUES (NULL, '$value')");
			//$last_id = $registrar_usuario->lastInsertId();
			//$response = array("value" => $last_id, "text" => $nuevoRegimen); // Devuelve el ID y el texto
        	return "listo";
			
		}



		/*----------  Controlador listar usuario  ----------*/
		public function listarDroplistControlador(){
			# Lectura datos#
			$tabla = $_GET['TABLA'];
			$lista = array();
			$drop_list=$this->ejecutarConsulta("SELECT * FROM `$tabla`");						
			 while($fila = $drop_list->fetchall()) {
            $lista[] = $fila;
        }

        return json_encode($lista);
		}


		public function listaOperadorControlador(){
				# Lectura datos#
				
				$lista = array();
				$drop_list=$this->ejecutarConsulta("SELECT `ID`,`NOEMPLEADO`,`NOMBRE` FROM `colaborador` WHERE `AREA`='Operativa' AND `CARGO`='Operador' AND `ASIGNADO`!=1");			
				$fila = $drop_list->fetchall();
				foreach ($fila as $row) {
					$lista[]= array(
						"ID" => $row["ID"],
						"NOMBRE" => $row["NOMBRE"],
						"NOEMPLEADO" => $row["NOEMPLEADO"]
						);
				}
	
				echo json_encode($lista);
			
	}

		public function listaRazonControlador(){

			$lista = array();
				$drop_list=$this->ejecutarConsulta("SELECT `ID`,`NOMBRE`,`RFC` FROM `razon` WHERE 1");			
				$fila = $drop_list->fetchall();
				foreach ($fila as $row) {
					$lista[]= array(
						"ID" => $row["ID"],
						"NOMBRE" => $row["NOMBRE"],
						"RFC" => $row["RFC"]
						

						);
				}
	
				echo json_encode($lista);

		}
	
		public function listaRemolqueControlador(){

			$lista = array();
				$drop_list=$this->ejecutarConsulta("SELECT `ID`,`NOVEHICULO`,`TIPO_REMOLQUE`,`FOTO_UNIDAD`,`PLACAS`,`SERIE` FROM `vehiculos` WHERE `TIPO_VEHICULO`='REMOLQUE' AND `ESTATUS`!=1");			
				$fila = $drop_list->fetchall();
				foreach ($fila as $row) {
					$lista[]= array(
						"ID" => $row["ID"],
						"NOMBRE" => $row["NOVEHICULO"],
						"TIPO_REMOLQUE" => $row["TIPO_REMOLQUE"],
						"PLACAS" => $row["PLACAS"],
						"SERIE" => $row["SERIE"],
						"FOTO" => $row["FOTO_UNIDAD"]
						

						);
				}
	
				echo json_encode($lista);

		}
	
		public function listaDollyControlador(){

			$lista = array();
				$drop_list=$this->ejecutarConsulta("SELECT `ID`,`NOVEHICULO`,`PLACAS`,`SERIE`,`FOTO_UNIDAD` FROM `vehiculos` WHERE `TIPO_VEHICULO`='DOLLY' AND `ESTATUS`!=1");			
				$fila = $drop_list->fetchall();
				foreach ($fila as $row) {
					$lista[]= array(
						"ID" => $row["ID"],
						"PLACAS" => $row["PLACAS"],
						"SERIE" => $row["SERIE"],
						"IMG" => $row["FOTO_UNIDAD"],
						"NOMBRE" => $row["NOVEHICULO"]			
						);
				}
	
				echo json_encode($lista);

		}
		
		public function listaTractoControlador(){

			$lista = array();
				$drop_list=$this->ejecutarConsulta("SELECT `ID`,`NOVEHICULO`,`PLACAS`,`SERIE`,`FOTO_UNIDAD` FROM `vehiculos` WHERE `TIPO_VEHICULO`='Tracto' AND `ESTATUS`!=1");			
				$fila = $drop_list->fetchall();
				foreach ($fila as $row) {
					$lista[]= array(
						"ID" => $row["ID"],
						"PLACAS" => $row["PLACAS"],
						"SERIE" => $row["SERIE"],
						"IMG" => $row["FOTO_UNIDAD"],
						"NOMBRE" => $row["NOVEHICULO"]			
						);
				}
	
				echo json_encode($lista);

		}		

		public function listaClienteControlador(){

			$lista = array();
				$drop_list=$this->ejecutarConsulta("SELECT `ID`,`NOMBRE`,`RFC`,`CREDITO`,`CONDICIONES` FROM `clientes` WHERE 1");			
				$fila = $drop_list->fetchall();
				foreach ($fila as $row) {
					$lista[]= array(
						"ID" => $row["ID"],
						"NOMBRE" => $row["NOMBRE"],
						"RFC" => $row["RFC"],
						"DIAS" => $row["CREDITO"],
						"CONDICIONES" => $row["CONDICIONES"]

						);
				}
	
				echo json_encode($lista);

		}
		
		public function listaCPControlador(){
			$cp=$_GET["cp"];
			$lista = array();
				$drop_list=$this->ejecutarConsulta("SELECT `ID`,`CODIGO`,`ASENTAMIENTO`,`CLAVE`,`C_MUNICIPIO`,`ESTADO`,`MUNICIPIO`,`CIUDAD` FROM `cp_bd` WHERE `CODIGO`='$cp'");			
				$fila = $drop_list->fetchall();
				foreach ($fila as $row) {
					$lista[]= array(
						"ID" => $row["ID"],
						"CODIGO" => $row["CODIGO"],
						"CLAVE" => $row["CLAVE"],
						"ESTADO" => $row["ESTADO"],
						"C_MUNICIPIO" => $row["C_MUNICIPIO"],
						"MUNICIPIO" => $row["MUNICIPIO"],
						"CIUDAD" => $row["CIUDAD"],
						"ASENTAMIENTO" => $row["ASENTAMIENTO"]

						);
				}
	
				echo json_encode($lista);

		}
		
		

		
}
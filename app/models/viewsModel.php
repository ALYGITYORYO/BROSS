<?php
	
	namespace app\models;

	class viewsModel{

		/*---------- Modelo obtener vista ----------*/
		protected function obtenerVistasModelo($vista){

			$listaBlanca=["dashboard","logOut","userNew","userList","userSerach","userUpdate","clienteAlta","bancoAlta","razonAlta","proveedorAlta","colaboradoresAlta","VehiculosAlta","remision","cotizacion","pdf","operacion","listClientes","listColaboradores","listVehiculos","modificaCliente","modificaColaborador"];

			if(in_array($vista, $listaBlanca)){
				if(is_file("./app/views/content/".$vista."-view.php")){
					$contenido="./app/views/content/".$vista."-view.php";
				}else{
					$contenido="404";
				}
			}elseif($vista=="login" || $vista=="index"){
				$contenido="login";
			}else{
				$contenido="404";
			}
			return $contenido;
		}

	}
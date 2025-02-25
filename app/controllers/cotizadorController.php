<?php
	namespace app\controllers;
	use app\models\mainModel;
	class cotizadorController extends mainModel{
		/*----------  Controlador registrar cotizacion  ----------*/
		public function registrarCotizacionControlador(){

			# Almacenando datos#
			$folio =$_POST['folio'];
			$cliente =$_POST['cliente'];
			$estadoinicio =$_POST['estadoinicio'];
			$ciudadinicio =$_POST['ciudadinicio'];
			$estadofinal =$_POST['estadofinal'];
			$ciudadfinal =$_POST['ciudadfinal'];
			$dirinicio =$_POST['dirinicio'];
			$dirfinal =$_POST['dirfinal'];
			$material =$_POST['material'];
			$peso =$_POST['peso'];
			$fechaInicio =$_POST['fechaInicio'];
			$fechaFin =$_POST['fechaFin'];
			$precio =$_POST['precio'];
            $fecha_hora_actual = date('Y-m-d H:i:s');
            $cotizacion_reg=[
				[
					"campo_nombre"=>"FOLIO",
					"campo_marcador"=>":FOLIO",
					"campo_valor"=>$folio
				],
				[
					"campo_nombre"=>"CLIENTE",
					"campo_marcador"=>":CLIENTE",
					"campo_valor"=>$cliente
				],[
					"campo_nombre"=>"PUNTO_INICIO_EDO",
					"campo_marcador"=>":PUNTO_INICIO_EDO",
					"campo_valor"=>$estadoinicio
				],[
					"campo_nombre"=>"PUNTO_INICIO_CIUDAD",
					"campo_marcador"=>":PUNTO_INICIO_CIUDAD",
					"campo_valor"=>$ciudadinicio
				],[
					"campo_nombre"=>"PUNTO_FINAL_EDO",
					"campo_marcador"=>":PUNTO_FINAL_EDO",
					"campo_valor"=>$estadofinal
				],[
					"campo_nombre"=>"PUNTO_FINAL_CIUDAD",
					"campo_marcador"=>":PUNTO_FINAL_CIUDAD",
					"campo_valor"=>$ciudadfinal
				],[
					"campo_nombre"=>"DIR_INICIO",
					"campo_marcador"=>":DIR_INICIO",
					"campo_valor"=>$dirinicio
				],[
					"campo_nombre"=>"DIR_FINAL",
					"campo_marcador"=>":DIR_FINAL",
					"campo_valor"=>$dirfinal
				],[
					"campo_nombre"=>"MATERIAL",
					"campo_marcador"=>":MATERIAL",
					"campo_valor"=>$material
				],[
					"campo_nombre"=>"PESO",
					"campo_marcador"=>":PESO",
					"campo_valor"=>$peso
				],[
					"campo_nombre"=>"FECHA_CARGA",
					"campo_marcador"=>":FECHA_CARGA",
					"campo_valor"=>$fechaInicio
				],[
					"campo_nombre"=>"FECHA_DESCARGA",
					"campo_marcador"=>":FECHA_DESCARGA",
					"campo_valor"=>$fechaFin
				],[
					"campo_nombre"=>"PRECIO",
					"campo_marcador"=>":PRECIO",
					"campo_valor"=>$precio
                ],[
					"campo_nombre"=>"USUARIO",
					"campo_marcador"=>":USUARIO",
					"campo_valor"=> $_SESSION['nombre']." ".$_SESSION['apellido']
				],[
					"campo_nombre"=>"FECHA",
					"campo_marcador"=>":FECHA",
					"campo_valor"=>$fecha_hora_actual
				]		
			];
			$registrar_banco=$this->guardarDatos("cotizador",$cotizacion_reg);
			$alerta=[
				"tipo"=>"limpiar",
				"titulo"=>"Cotización registrada",
				"texto"=>"La cotizació ".$folio." se registro con exito",
				"icono"=>"success"
			];
			return json_encode($alerta);
		}

        public function leerCotizacionControlador(){
                $lista = array();
                $autoincrement=1;
				$drop_list=$this->ejecutarConsulta("SELECT r.FOLIO,r.FECHA,r.USUARIO, c.NOMBRE AS CLIENTE, m.NOMBRE AS MATERIAL, CONCAT(r.PUNTO_INICIO_EDO, ' - ', r.PUNTO_FINAL_EDO) AS VIAJE, r.PRECIO FROM cotizador r INNER JOIN clientes c ON r.CLIENTE = c.ID INNER JOIN d_material m ON r.MATERIAL = m.ID;");			
				$fila = $drop_list->fetchall();

				foreach ($fila as $row) {
					$lista[]= array(
						"ID" => $autoincrement++,
						"FOLIO" => $row["FOLIO"],
						"CLIENTE" => $row["CLIENTE"],
						"VIAJE" => $row["VIAJE"],
						"MATERIAL" => $row["MATERIAL"],
						"FECHA" => $row["FECHA"],
						"PRECIO" => $row["PRECIO"],
						"USUARIO" => $row["USUARIO"]
						);
				}
	
				echo json_encode($lista);

        }
    }
<?php

	namespace app\controllers;
	use app\models\mainModel;

	class logVController extends mainModel{

		/*----------  Controlador registrar usuario  ----------*/
		public function registralogVControlador(){

			# Almacenando datos#
            
			$operador_nombre =$_POST['operador_asignado_input'];
			$operador_id =$_POST['operador_asignado'];
			$serie_tracto =$_POST['tracto_asignado_input'];
			$tracto_id =$_POST['tracto_asignado'];
			$dobleArticulado =$_POST['dobleArticulado'];
			$remolque1 =$_POST['remolque1_asignado_input'];
			$remolque1_id =$_POST['remolque1_asignado'];
			// el operador 18 es sin operador 
		if($operador_id!=18)
		{
			if($this->datoDuplicado("Unico","logistica","OPERADOR_ID",$operador_id)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error en el Operador".$operador_nombre ,
					"texto"=>"El Operador se encuentra usado por otro TRACTO",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}
		}
			if($this->datoDuplicado("Unico","logistica","TRACTO_ID",$tracto_id)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error en el Tracto ".$serie_tracto,
					"texto"=>"El Tracto se encuentra usado por otro Operador",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}
			if($this->datoDuplicado("Unico","logistica","REMOLQUE1_ID",$remolque1_id)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error en el Remolque ".$remolque1,
					"texto"=>"El Remolque se encuentra usado por otro Operador",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

            if($dobleArticulado=="si"){
                $serie_dolly =$_POST['dolly_asignado_input'];
                $id_dolly =$_POST['dolly_asignado'];

                $remolque2 =$_POST['remolque2_asignado_input'];
    			$remolque2_id =$_POST['remolque2_asignado'];

				if($remolque2_id==$remolque1_id){
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error en los Remolques" ,
						"texto"=>"Los remolque son iguales",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}

				if($this->datoDuplicado("Unico","logistica","DOLLY_ID",$id_dolly)){
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error en el DOLLY " .$serie_dolly,
						"texto"=>"El DOLLY se encuentra usado por otro TRACTO",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}
				if($this->datoDuplicado("Unico","logistica","REMOLQUE2_ID",$remolque2_id)){
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error en el REMOLQUE " .$remolque2 ,
						"texto"=>"El REMOLQUE se encuentra usado por otro TRACTO",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}
            }
			else{
				$serie_dolly ="";
                $id_dolly ="";
                $remolque2 ="";
    			$remolque2_id ="";
			}
		
            $fecha_hora_actual = date('Y-m-d H:i:s');


            $vehiculos_datos_log=[
				[
					"campo_nombre"=>"OPERADOR",
					"campo_marcador"=>":OPERADOR",
					"campo_valor"=>$operador_nombre
				],
				[
					"campo_nombre"=>"OPERADOR_ID",
					"campo_marcador"=>":OPERADOR_ID",
					"campo_valor"=>$operador_id
				]
				,
				[
					"campo_nombre"=>"TRACTO",
					"campo_marcador"=>":TRACTO",
					"campo_valor"=>$serie_tracto
				],
				[
					"campo_nombre"=>"TRACTO_ID",
					"campo_marcador"=>":TRACTO_ID",
					"campo_valor"=>$tracto_id
				]
                ,
				[
					"campo_nombre"=>"DOBLE",
					"campo_marcador"=>":DOBLE",
					"campo_valor"=>$dobleArticulado
				]
                ,
				[
					"campo_nombre"=>"REMOLQUE1_ID",
					"campo_marcador"=>":REMOLQUE1_ID",
					"campo_valor"=>$remolque1_id
				]
                ,
				[
					"campo_nombre"=>"REMOLQUE1",
					"campo_marcador"=>":REMOLQUE1",
					"campo_valor"=>$remolque1
				]
                ,
				[
					"campo_nombre"=>"REMOLQUE2_ID",
					"campo_marcador"=>":REMOLQUE2_ID",
					"campo_valor"=>$remolque2_id
				]
                ,
				[
					"campo_nombre"=>"REMOLQUE2",
					"campo_marcador"=>":REMOLQUE2",
					"campo_valor"=>$remolque2
				],
				[
					"campo_nombre"=>"DOLLY",
					"campo_marcador"=>":DOLLY",
					"campo_valor"=>$serie_dolly
				]
                ,
				[
					"campo_nombre"=>"DOLLY_ID",
					"campo_marcador"=>":DOLLY_ID",
					"campo_valor"=>$id_dolly
				],
				[
					"campo_nombre"=>"FECHA",
					"campo_marcador"=>":FECHA",
					"campo_valor"=>$fecha_hora_actual
				]
                ,
				[
					"campo_nombre"=>"ESTATUS",
					"campo_marcador"=>":ESTATUS",
					"campo_valor"=>"Alta"
				]
			];



			$log_vehiculos=$this->guardarDatos("logistica",$vehiculos_datos_log);
			$alerta=[
				"tipo"=>"limpiar",
				"titulo"=>"Operador vinculado a tracto",
				"texto"=>"El operador ".$operador_nombre." se vínculo con exito",
				"icono"=>"success"
			];
			return json_encode($alerta);
		}
    }
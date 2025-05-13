<?php

	namespace app\controllers;
	use app\models\mainModel;

	class clienteController extends mainModel{

		/*----------  Controlador registrar usuario  ----------*/
		public function registrarClienteControlador(){

			# Almacenando datos#
			$nombre =$_POST['nombre'];
			$apepat =$_POST['apepat'];
			$apemat =$_POST['apemat'];
			$razon =$_POST['razon'];
			$rfc =$_POST['rfc'];
			$calle =$_POST['calle'];
			$numero_interior =$_POST['numero_interior'];
			$numero_exterior =$_POST['numero_exterior'];
			$colonia =$_POST['colonia'];
			$municipio =$_POST['municipio'];
			$ciudad =$_POST['ciudad'];
			$estado =$_POST['estado'];
			$localidad =$_POST['localidad'];
			$cp =$_POST['cp'];
			$regimen =$_POST['regimen_input'];
			$usocfdi =$_POST['usocfdi_input'];
			$correo =$_POST['correo'];
			$telefono =$_POST['telefono'];
			$domicilios =$_POST['domicilios'];
			$credito =$_POST['diasCredito'];
			$condiciones =$_POST['condiciones'];
			

			//API PARA INGRESAR A FACTURACION 
			$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://sandbox.factura.com/api/v1/clients/create',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',			
			CURLOPT_POSTFIELDS => json_encode(array(
				"rfc" => $rfc,
				"razons" => $razon,
				"codpos" => $cp, 
				"email" => $correo,
				"usocfdi" => $usocfdi,
				"regimen" => $regimen,
				"calle" => $calle,
				"numero_exterior" => $numero_exterior,
				"numero_interior" => $numero_interior,
				"colonia" => $colonia,
				"ciudad" => $ciudad,
				"delegacion" => $municipio, 
				"localidad" => $localidad, 
				"estado" => $estado,
				"pais" => "MEX", 
				"numregidtrib" => "", // Este valor parece ser estático
				"nombre" => $nombre,
				"apellidos" => $apepat." ".$apemat, 
				"telefono" => $telefono,
				"email2" => "", // Este valor parece ser estático
				"email3" => "" // Este valor parece ser estático
			)),

			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'F-PLUGIN: 9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
				'F-Api-Key:JDJ5JDEwJGJoanluQ25KRjJOMERFb1N1MURYN3VYYk1mQTlOZkxoREhlSkZwcDM4b2xmU2dLbGdQSFR5',
    			'F-Secret-Key:JDJ5JDEwJG9uSE5xZEJUQnVEbWtDZzRCcGVja2VnVmtNS0VqWC83U0NSc2RCV0g1L2NjcGRIREJSVEtl'
			),
			));

			$response = curl_exec($curl);

			curl_close($curl);

			$response = curl_exec($curl);
			curl_close($curl);

			// Decodificar la respuesta JSON a un array asociativo de PHP
			$data = json_decode($response, true);

			// Verificar si la decodificación fue exitosa y si el UID existe en la respuesta
			if ($data['status']=='success' && isset($data)) {
				// Imprimir el UID
				$uid= $data['Data']['UID'];
			} else {
				$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"No pudimos conectarnos a la API de facturas",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
			}



            $cliente_datos_reg=[
				[
					"campo_nombre"=>"NOMBRE",
					"campo_marcador"=>":NOMBRE",
					"campo_valor"=>$nombre
				],[
					"campo_nombre"=>"RAZON",
					"campo_marcador"=>":RAZON",
					"campo_valor"=>$razon
				],[
					"campo_nombre"=>"APEPAT",
					"campo_marcador"=>":APEPAT",
					"campo_valor"=>$apepat
				],[
					"campo_nombre"=>"APEMAT",
					"campo_marcador"=>":APEMAT",
					"campo_valor"=>$apemat
				],
				[
					"campo_nombre"=>"UID",
					"campo_marcador"=>":UID",
					"campo_valor"=>$uid
				],
				[
					"campo_nombre"=>"RFC",
					"campo_marcador"=>":RFC",
					"campo_valor"=>$rfc
				]
				,
				[
					"campo_nombre"=>"CALLE",
					"campo_marcador"=>":CALLE",
					"campo_valor"=>$calle
				],
				
				[
					"campo_nombre"=>"NUM_INT",
					"campo_marcador"=>":NUM_INT",
					"campo_valor"=>$numero_interior
				],
				[
					"campo_nombre"=>"NUM_EXT",
					"campo_marcador"=>":NUM_EXT",
					"campo_valor"=>$numero_exterior
				],[
					"campo_nombre"=>"COLONIA",
					"campo_marcador"=>":COLONIA",
					"campo_valor"=>$colonia
				],[
					"campo_nombre"=>"MUNICIPIO",
					"campo_marcador"=>":MUNICIPIO",
					"campo_valor"=>$municipio
				],[
					"campo_nombre"=>"CIUDAD",
					"campo_marcador"=>":CIUDAD",
					"campo_valor"=>$ciudad
				],
				[
					"campo_nombre"=>"ESTADO",
					"campo_marcador"=>":ESTADO",
					"campo_valor"=>$estado
				],[
					"campo_nombre"=>"LOCALIDAD",
					"campo_marcador"=>":LOCALIDAD",
					"campo_valor"=>$localidad
				],
				[
					"campo_nombre"=>"CP",
					"campo_marcador"=>":CP",
					"campo_valor"=>$cp
				],
				[
					"campo_nombre"=>"REGIMEN",
					"campo_marcador"=>":REGIMEN",
					"campo_valor"=>$regimen
				],
				[
					"campo_nombre"=>"USO_CFDI",
					"campo_marcador"=>":USO_CFDI",
					"campo_valor"=>$usocfdi
				],

				[
					"campo_nombre"=>"CORREO",
					"campo_marcador"=>":CORREO",
					"campo_valor"=>$correo
				],[
					"campo_nombre"=>"TELEFONO",
					"campo_marcador"=>":TELEFONO",
					"campo_valor"=>$telefono
				],
				[
					"campo_nombre"=>"CONDICIONES",
					"campo_marcador"=>":CONDICIONES",
					"campo_valor"=>$condiciones
				],
				[
					"campo_nombre"=>"CREDITO",
					"campo_marcador"=>":CREDITO",
					"campo_valor"=>$credito
				],
				[
					"campo_nombre"=>"DOMICILIOS",
					"campo_marcador"=>":DOMICILIOS",
					"campo_valor"=>$domicilios
				]
			];
			$registrar_usuario=$this->guardarDatos("clientes",$cliente_datos_reg);
			
			

			
			//echo $response;
			$alerta=[
				"tipo"=>"limpiar",
				"titulo"=>"Usuario registrado",
				"texto"=>"El cliente ".$razon." se registro con exito con el UID: ".$uid,
				"icono"=>"success"
			];

			return json_encode($alerta);

		}

		/*----------  Controlador listar usuario  ----------*/
		public function listarUsuarioControlador($pagina,$registros,$url,$busqueda){

			$pagina=$this->limpiarCadena($pagina);
			$registros=$this->limpiarCadena($registros);

			$url=$this->limpiarCadena($url);
			$url=APP_URL.$url."/";

			$busqueda=$this->limpiarCadena($busqueda);
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){

				$consulta_datos="SELECT * FROM usuario WHERE ((usuario_id!='".$_SESSION['id']."' AND usuario_id!='1') AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%')) ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE ((usuario_id!='".$_SESSION['id']."' AND usuario_id!='1') AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%'))";

			}else{

				$consulta_datos="SELECT * FROM usuario WHERE usuario_id!='".$_SESSION['id']."' AND usuario_id!='1' ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE usuario_id!='".$_SESSION['id']."' AND usuario_id!='1'";

			}

			$datos = $this->ejecutarConsulta($consulta_datos);
			$datos = $datos->fetchAll();

			$total = $this->ejecutarConsulta($consulta_total);
			$total = (int) $total->fetchColumn();

			$numeroPaginas =ceil($total/$registros);

			$tabla.='
		        <div class="table-container">
		        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
		            <thead>
		                <tr>
		                    <th class="has-text-centered">#</th>
		                    <th class="has-text-centered">Nombre</th>
		                    <th class="has-text-centered">Usuario</th>
		                    <th class="has-text-centered">Email</th>
		                    <th class="has-text-centered">Creado</th>
		                    <th class="has-text-centered">Actualizado</th>
		                    <th class="has-text-centered" colspan="3">Opciones</th>
		                </tr>
		            </thead>
		            <tbody>
		    ';

		    if($total>=1 && $pagina<=$numeroPaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr class="has-text-centered" >
							<td>'.$contador.'</td>
							<td>'.$rows['usuario_nombre'].' '.$rows['usuario_apellido'].'</td>
							<td>'.$rows['usuario_usuario'].'</td>
							<td>'.$rows['usuario_email'].'</td>
							<td>'.date("d-m-Y  h:i:s A",strtotime($rows['usuario_creado'])).'</td>
							<td>'.date("d-m-Y  h:i:s A",strtotime($rows['usuario_actualizado'])).'</td>
							<td>
			                    <a href="'.APP_URL.'userPhoto/'.$rows['usuario_id'].'/" class="button is-info is-rounded is-small">Foto</a>
			                </td>
			                <td>
			                    <a href="'.APP_URL.'userUpdate/'.$rows['usuario_id'].'/" class="button is-success is-rounded is-small">Actualizar</a>
			                </td>
			                <td>
			                	<form class="FormularioAjax" action="'.APP_URL.'app/ajax/usuarioAjax.php" method="POST" autocomplete="off" >

			                		<input type="hidden" name="modulo_usuario" value="eliminar">
			                		<input type="hidden" name="usuario_id" value="'.$rows['usuario_id'].'">

			                    	<button type="submit" class="button is-danger is-rounded is-small">Eliminar</button>
			                    </form>
			                </td>
						</tr>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="has-text-centered" >
			                <td colspan="7">
			                    <a href="'.$url.'1/" class="button is-link is-rounded is-small mt-4 mb-4">
			                        Haga clic acá para recargar el listado
			                    </a>
			                </td>
			            </tr>
					';
				}else{
					$tabla.='
						<tr class="has-text-centered" >
			                <td colspan="7">
			                    No hay registros en el sistema
			                </td>
			            </tr>
					';
				}
			}

			$tabla.='</tbody></table></div>';

			### Paginacion ###
			if($total>0 && $pagina<=$numeroPaginas){
				$tabla.='<p class="has-text-right">Mostrando usuarios <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';

				$tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,7);
			}

			return $tabla;
		}

		public function listaClientesControlador(){

			$drop_list=$this->ejecutarConsulta("SELECT * FROM `clientes`");			
			while($fila = $drop_list->fetchall()) {
				$lista[] = $fila;
			}
	
			return json_encode($lista);
		}

		public function DrillClientesOpeControlador(){
			$lista = array();                
			$drop_list=$this->ejecutarConsulta("SELECT `ID`,`DOMICILIOS` FROM `clientes` WHERE 1;");			
			$fila = $drop_list->fetchall();
			foreach ($fila as $row) {
				$lista[]= array(
					"ID" => $row["ID"],
					"DOMICILIOS" => $row["DOMICILIOS"]				                                           
					);
			}
			return json_encode($lista);
		}

		public function leerclienteControlador(){
			$ID=$_POST["ID"];
			$lista = array();
			$drop_list=$this->ejecutarConsulta("SELECT * FROM `clientes` WHERE ID=".$ID);			
			while($fila = $drop_list->fetchall()) {
				$lista[] = $fila;
			}
			return json_encode($lista);
		}

		public function actualizarClientesControllers(){
			
			# Almacenando datos#
			$curl = curl_init();
			$id =$_POST['id_cliente'];
			$nombre =$_POST['nombre'];
			$apemat =$_POST['apemat'];
			$apepat =$_POST['apepat'];
			$razon =$_POST['razon'];
			$rfc =$_POST['rfc'];
			$calle =$_POST['calle'];
			$numero_interior =$_POST['numero_interior'];
			$numero_exterior =$_POST['numero_exterior'];
			$colonia =$_POST['colonia'];
			$municipio =$_POST['municipio'];
			$ciudad =$_POST['ciudad'];
			$estado =$_POST['estado'];
			$localidad =$_POST['localidad'];
			$cp =$_POST['cp'];
			$regimen =$_POST['regimen_input'];
			$usocfdi =$_POST['usocfdi_input'];
			$correo =$_POST['correo'];
			$telefono =$_POST['telefono'];
			$domicilios =$_POST['domicilios'];
			$credito =$_POST['diasCredito'];
			$condiciones =$_POST['condiciones'];
			$uid=$_POST['uid'];
			if($uid!=""){
				
				curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://sandbox.factura.com/api/v1/clients/'.$uid.'/update',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => json_encode(array(
				
				"rfc" => $rfc,
				"razons" => $razon,
				"codpos" => $cp, 
				"email" => $correo,
				"usocfdi" => $usocfdi,
				"regimen" => $regimen,
				"calle" => $calle,
				"numero_exterior" => $numero_exterior,
				"numero_interior" => $numero_interior,
				"colonia" => $colonia,
				"ciudad" => $ciudad,
				"delegacion" => $municipio, 
				"localidad" => $localidad, 
				"estado" => $estado,
				"pais" => "MEX", 
				"numregidtrib" => "", // Este valor parece ser estático
				"nombre" => $nombre,
				"apellidos" => $apepat." ".$apemat, 
				"telefono" => $telefono,
				"email2" => "", // Este valor parece ser estático
				"email3" => "" // Este valor parece ser estático
			    )),
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json',
					'F-PLUGIN: 9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
					'F-Api-Key:JDJ5JDEwJGJoanluQ25KRjJOMERFb1N1MURYN3VYYk1mQTlOZkxoREhlSkZwcDM4b2xmU2dLbGdQSFR5',
    				'F-Secret-Key:JDJ5JDEwJG9uSE5xZEJUQnVEbWtDZzRCcGVja2VnVmtNS0VqWC83U0NSc2RCV0g1L2NjcGRIREJSVEtl'
				),
				));

				$response = curl_exec($curl);

			curl_close($curl);

			$response = curl_exec($curl);
			curl_close($curl);

			// Decodificar la respuesta JSON a un array asociativo de PHP
			$data = json_decode($response, true);

			// Verificar si la decodificación fue exitosa y si el UID existe en la respuesta
			if ($data['status']=='error') {
			
				$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>$data['Data'],
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
			}
				
			}
			else{

			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://sandbox.factura.com/api/v1/clients/create',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',			
			CURLOPT_POSTFIELDS => json_encode(array(
				"rfc" => $rfc,
				"razons" => $razon,
				"codpos" => $cp, 
				"email" => $correo,
				"usocfdi" => $usocfdi,
				"regimen" => $regimen,
				"calle" => $calle,
				"numero_exterior" => $numero_exterior,
				"numero_interior" => $numero_interior,
				"colonia" => $colonia,
				"ciudad" => $ciudad,
				"delegacion" => $municipio, 
				"localidad" => $localidad, 
				"estado" => $estado,
				"pais" => "MEX", 
				"numregidtrib" => "", // Este valor parece ser estático
				"nombre" => $nombre,
				"apellidos" => $apepat." ".$apemat, 
				"telefono" => $telefono,
				"email2" => "", // Este valor parece ser estático
				"email3" => "" // Este valor parece ser estático
			)),

			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'F-PLUGIN: 9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
				'F-Api-Key:JDJ5JDEwJGJoanluQ25KRjJOMERFb1N1MURYN3VYYk1mQTlOZkxoREhlSkZwcDM4b2xmU2dLbGdQSFR5',
    			'F-Secret-Key:JDJ5JDEwJG9uSE5xZEJUQnVEbWtDZzRCcGVja2VnVmtNS0VqWC83U0NSc2RCV0g1L2NjcGRIREJSVEtl'
			),
			));

			$response = curl_exec($curl);

			curl_close($curl);

			

			// Decodificar la respuesta JSON a un array asociativo de PHP
			$data = json_decode($response, true);

			// Verificar si la decodificación fue exitosa y si el UID existe en la respuesta
			if ($data['status']=='success' && isset($data)) {
				// Imprimir el UID
				$uid= $data['Data']['UID'];
			} else {
				$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"No pudimos conectarnos a la API de facturas". $data['Data'],
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
			}



			}
            $cliente_datos_update=[
				[
					"campo_nombre"=>"NOMBRE",
					"campo_marcador"=>":NOMBRE",
					"campo_valor"=>$nombre
				],[
					"campo_nombre"=>"RAZON",
					"campo_marcador"=>":RAZON",
					"campo_valor"=>$razon
				],[
					"campo_nombre"=>"APEPAT",
					"campo_marcador"=>":APEPAT",
					"campo_valor"=>$apepat
				],[
					"campo_nombre"=>"APEMAT",
					"campo_marcador"=>":APEMAT",
					"campo_valor"=>$apemat
				],
				[
					"campo_nombre"=>"UID",
					"campo_marcador"=>":UID",
					"campo_valor"=>$uid
				],
				[
					"campo_nombre"=>"RFC",
					"campo_marcador"=>":RFC",
					"campo_valor"=>$rfc
				]
				,
				[
					"campo_nombre"=>"CALLE",
					"campo_marcador"=>":CALLE",
					"campo_valor"=>$calle
				],
				
				[
					"campo_nombre"=>"NUM_INT",
					"campo_marcador"=>":NUM_INT",
					"campo_valor"=>$numero_interior
				],
				[
					"campo_nombre"=>"NUM_EXT",
					"campo_marcador"=>":NUM_EXT",
					"campo_valor"=>$numero_exterior
				],[
					"campo_nombre"=>"COLONIA",
					"campo_marcador"=>":COLONIA",
					"campo_valor"=>$colonia
				],[
					"campo_nombre"=>"MUNICIPIO",
					"campo_marcador"=>":MUNICIPIO",
					"campo_valor"=>$municipio
				],[
					"campo_nombre"=>"CIUDAD",
					"campo_marcador"=>":CIUDAD",
					"campo_valor"=>$ciudad
				],
				[
					"campo_nombre"=>"ESTADO",
					"campo_marcador"=>":ESTADO",
					"campo_valor"=>$estado
				],[
					"campo_nombre"=>"LOCALIDAD",
					"campo_marcador"=>":LOCALIDAD",
					"campo_valor"=>$localidad
				],
				[
					"campo_nombre"=>"CP",
					"campo_marcador"=>":CP",
					"campo_valor"=>$cp
				],
				[
					"campo_nombre"=>"REGIMEN",
					"campo_marcador"=>":REGIMEN",
					"campo_valor"=>$regimen
				],
				[
					"campo_nombre"=>"USO_CFDI",
					"campo_marcador"=>":USO_CFDI",
					"campo_valor"=>$usocfdi
				],

				[
					"campo_nombre"=>"CORREO",
					"campo_marcador"=>":CORREO",
					"campo_valor"=>$correo
				],[
					"campo_nombre"=>"TELEFONO",
					"campo_marcador"=>":TELEFONO",
					"campo_valor"=>$telefono
				],
				[
					"campo_nombre"=>"CONDICIONES",
					"campo_marcador"=>":CONDICIONES",
					"campo_valor"=>$condiciones
				],
				[
					"campo_nombre"=>"CREDITO",
					"campo_marcador"=>":CREDITO",
					"campo_valor"=>$credito
				],
				[
					"campo_nombre"=>"DOMICILIOS",
					"campo_marcador"=>":DOMICILIOS",
					"campo_valor"=>$domicilios
				]
			];
			$condicion=[
				"condicion_campo"=>"ID",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if($this->actualizarDatos("clientes",$cliente_datos_update,$condicion)){
				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Cliente actualizado",
					"texto"=>"Los datos del cliente ".$razon." se actualizaron correctamente con el UID: ".$uid,
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido actualizar los datos del Cliente ".$nombre." , por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);
		}

	}
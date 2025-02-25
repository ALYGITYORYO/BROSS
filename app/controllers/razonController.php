<?php
namespace app\controllers;
use app\models\mainModel;
class razonController extends mainModel{
	/*----------  Controlador registrar banco  ----------*/
	public function registrarRazonControlador(){

		# Almacenando datos#
		$nombre =$_POST['nombre'];
		$rfc =$_POST['rfc'];
		$calle =$_POST['calle'];
		$numero_interior =$_POST['numero_interior'];
		$numero_exterior =$_POST['numero_exterior'];
		$colonia =$_POST['colonia'];
		$municipio =$_POST['municipio'];
		$ciudad =$_POST['ciudad'];
		$estado =$_POST['estado'];
		$cp =$_POST['cp'];
		$actividad =$_POST['actividad'];
		$vigenciaCaat =$_POST['vigenciaCaat'];
		$caat =$_POST['caat'];


		$file_dir="../views/fotos/".$rfc; // Directorio donde se guardarán los archivos

		$nombre_archivo=str_ireplace(" ","_caat_",$rfc);
		$nombre_archivo=$nombre_archivo."_".rand(0,100);
		$nombre_archivo = $nombre_archivo.".pdf";
		// Ruta completa del archivo
		$ruta_archivo = $file_dir . "/" . $nombre_archivo;

		$archivo_pdf = $_FILES["file_caat"];
		if($archivo_pdf['name']!="" && $archivo_pdf["size"]>0){
		// Validar tamaño del archivo
		if ($archivo_pdf["size"] > 5 * 1024 * 1024) {
			$alerta=[
				"tipo"=>"simple",
				"titulo"=>"Ocurrió un error inesperado",
				"texto"=>"Error maximo permitido ",
				"icono"=>"error"
			];return json_encode($alerta);
			exit();
		}
	  
		// Validar tipo de archivo
		if ($archivo_pdf["type"] != "application/pdf") {
			$alerta=[
				"tipo"=>"simple",
				"titulo"=>"Ocurrió un error inesperado",
				"texto"=>"Error solo permite PDF ",
				"icono"=>"error"
			];return json_encode($alerta);
			exit();
		}
	  
		// Crear carpeta si no existe
		if (!file_exists($file_dir)) {
		  mkdir($file_dir);
		}
	  
	  
	  
		// Mover archivo subido a la carpeta
		if (move_uploaded_file($archivo_pdf["tmp_name"], $ruta_archivo)) {
		  
		} else {
			$alerta=[
				"tipo"=>"simple",
				"titulo"=>"Ocurrió un error inesperado",
				"texto"=>"Error al crear el directorio ",
				"icono"=>"error"
			];
			return json_encode($alerta);
			exit();
		}
	}
	else{

		$nombre_archivo="";
	}


		$razon_datos_reg=[
			[
				"campo_nombre"=>"NOMBRE",
				"campo_marcador"=>":NOMBRE",
				"campo_valor"=>$nombre
			],
			[
				"campo_nombre"=>"RFC",
				"campo_marcador"=>":RFC",
				"campo_valor"=>$rfc
			],
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
			],[
				"campo_nombre"=>"ESTADO",
				"campo_marcador"=>":ESTADO",
				"campo_valor"=>$estado
			],[
				"campo_nombre"=>"CP",
				"campo_marcador"=>":CP",
				"campo_valor"=>$cp
			],
			[
				"campo_nombre"=>"ACTIVIDAD",
				"campo_marcador"=>":ACTIVIDAD",
				"campo_valor"=>$actividad
			],
			[
				"campo_nombre"=>"CAAT",
				"campo_marcador"=>":CAAT",
				"campo_valor"=>$caat
			],
			[
				"campo_nombre"=>"VIGENCIA_CAAT",
				"campo_marcador"=>":VIGENCIA_CAAT",
				"campo_valor"=>$vigenciaCaat
			],
			[
				"campo_nombre"=>"FILE_CAAT",
				"campo_marcador"=>":FILE_CAAT",
				"campo_valor"=>$nombre_archivo
			]			
		];
		$registrar_razon=$this->guardarDatos("razon",$razon_datos_reg);
		$alerta=[
			"tipo"=>"limpiar",
			"titulo"=>"Razon registrado",
			"texto"=>"La razon ".$nombre." se registro con exito",
			"icono"=>"success"
		];
		return json_encode($alerta);
	}



	/*----------  Controlador listar usuario  ----------*/
	public function listarBancoControlador($pagina,$registros,$url,$busqueda){

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


}
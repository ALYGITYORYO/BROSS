<?php

namespace app\controllers;
use app\models\mainModel;

class colaboradoresController extends mainModel{

/*----------  Controlador registrar usuario  ----------*/
public function registrarColaboradoresControlador(){

# Almacenando datos#

$no_empleado =$_POST['no_empleado'];
$area =$_POST['area_input'];
$cargo =$_POST['cargo_input'];
$nombre =$_POST['nombre'];

$curp =$_POST['curp'];
$telefono =$_POST['telefono'];
$ine_id =$_POST['ine_id'];
# datos operadores#

$folio_licencia_federal =$_POST['folio_licencia_federal'];
$vigencia_licencia_federal =$_POST['vigencia_licencia_federal'];
$folio_examen_medico =$_POST['folio_examen_medico'];
$fecha_examen_medico =$_POST['fecha_examen_medico'];
$folio_antidoping =$_POST['folio_antidoping'];
$fecha_examen_antidoping =$_POST['fecha_examen_antidoping'];
$folio_carta_no_antecedentes =$_POST['folio_carta_no_antecedentes'];
$referencias =$_POST['referencias'];

//UBICACIONE

$calle = $_POST['calle'];
$numero_exterior = $_POST['numero_exterior'];
$numero_interior = $_POST['numero_interior'];
$colonia = $_POST['colonia'];
$localidad = $_POST['localidad'];
$referencia = $_POST['referencia'];
$municipio = $_POST['municipio'];
$estado = $_POST['estado'];
$pais = $_POST['pais'];
$cp = $_POST['cp'];






	$file_dir="../views/fotos/".$no_empleado."/";

	$archivos = array("file_ine", "file_licencia", "file_examen_medico", "file_examen_antidoping", "file_carta_antecedentes");
	$rutas_archivos = array(); // Array para guardar las rutas
	// Crear carpeta si no existe
	# Creando directorio #
	if(!file_exists($file_dir)){
		if(!mkdir($file_dir,0777)){
			$alerta=[
				"tipo"=>"simple",
				"titulo"=>"Ocurrió un error inesperado",
				"texto"=>"Error al crear el directorio",
				"icono"=>"error"
			];
			return json_encode($alerta);
			exit();
		} 
	}
	
	foreach ($archivos as $archivo) {
		$pdf = $_FILES[$archivo];
		if($pdf['name']!="" && $pdf["size"]>0){
		
	
		// Validar tamaño del archivo
		if ($pdf["size"] > 5 * 1024 * 1024) {
			$alerta=[
				"tipo"=>"simple",
				"titulo"=>"Ocurrió un error inesperado",
				"texto"=>"El archivo que ha seleccionado supera el peso permitido $archivo ",
				"icono"=>"error"
			];
			return json_encode($alerta);
		continue; // Saltar al siguiente archivo
		}
	
		// Validar tipo de archivo
		if ($pdf["type"] != "application/pdf") {
			$alerta=[
				"tipo"=>"simple",
				"titulo"=>"Ocurrió un error inesperado",
				"texto"=>"La imagen que ha seleccionado es de un formato no permitido $archivo ",
				"icono"=>"error"
			];
			return json_encode($alerta);
		continue; // Saltar al siguiente archivo
		}
	
		// Generar nombre de archivo único
		
		$nombre_archivo=str_ireplace(" ","_",$archivo);
		$nombre_archivo=$nombre_archivo."_".rand(0,100);
		$nombre_archivo = $nombre_archivo.".pdf";
	
		// Ruta completa del archivo
		$ruta_archivo = $file_dir . "/" . $nombre_archivo;
		$rutas_archivos[$archivo] = $ruta_archivo;
		// Mover archivo subido a la carpeta
		if (move_uploaded_file($pdf["tmp_name"], $ruta_archivo)) {
		//echo "Archivo " . $archivo . " subido correctamente.<br>";
		} else {
			$alerta=[
				"tipo"=>"simple",
				"titulo"=>"Ocurrió un error inesperado",
				"texto"=>"Error al crear el directorio $archivo",
				"icono"=>"error"
			];
			return json_encode($alerta);
		}
	}
	else {
		$rutas_archivos[$archivo] = "";
	}
}

	
	


# Comprobar si se selecciono una imagen #
if($_FILES['foto']['name']!="" && $_FILES['foto']['size']>0){

	

	# Verificando formato de imagenes #
	if(mime_content_type($_FILES['foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['foto']['tmp_name'])!="image/png"){
		$alerta=[
			"tipo"=>"simple",
			"titulo"=>"Ocurrió un error inesperado",
			"texto"=>"La imagen que ha seleccionado es de un formato no permitido",
			"icono"=>"error"
		];
		return json_encode($alerta);
		exit();
	}

	# Verificando peso de imagen #
	if(($_FILES['foto']['size']/1024)>5120){
		$alerta=[
			"tipo"=>"simple",
			"titulo"=>"Ocurrió un error inesperado",
			"texto"=>"La imagen que ha seleccionado supera el peso permitido",
			"icono"=>"error"
		];
		return json_encode($alerta);
		exit();
	}

	# Nombre de la foto #
	$foto=str_ireplace(" ","_",$nombre);
	$foto=$foto."_".rand(0,100);

	# Extension de la imagen #
	switch(mime_content_type($_FILES['foto']['tmp_name'])){
		case 'image/jpeg':
			$foto=$foto.".jpg";
		break;
		case 'image/png':
			$foto=$foto.".png";
		break;
	}

	chmod($file_dir,0777);

	# Moviendo imagen al directorio #
	if(!move_uploaded_file($_FILES['foto']['tmp_name'],$file_dir.$foto)){
		$alerta=[
			"tipo"=>"simple",
			"titulo"=>"Ocurrió un error inesperado",
			"texto"=>"No podemos subir la imagen al sistema en este momento",
			"icono"=>"error"
		];
		return json_encode($alerta);
		exit();
	}

}else{
	$foto="";
}

$colaboradores_datos_reg=[
	[
		"campo_nombre"=>"NOEMPLADO",
		"campo_marcador"=>":NOEMPLADO",
		"campo_valor"=>$no_empleado
	],
	[
		"campo_nombre"=>"FOTO",
		"campo_marcador"=>":FOTO",
		"campo_valor"=>$foto
	],
	[
		"campo_nombre"=>"INE",
		"campo_marcador"=>":INE",
		"campo_valor"=>$rutas_archivos['file_ine']
	],
	[
		"campo_nombre"=>"LICENCIA_FILE",
		"campo_marcador"=>":LICENCIA_FILE",
		"campo_valor"=>$rutas_archivos['file_licencia']
	],
	[
		"campo_nombre"=>"EXAMEN_FILE",
		"campo_marcador"=>":EXAMEN_FILE",
		"campo_valor"=>$rutas_archivos['file_examen_medico']
	],
	[
		"campo_nombre"=>"ANTIDOPING_FILE",
		"campo_marcador"=>":ANTIDOPING_FILE",
		"campo_valor"=>$rutas_archivos['file_examen_antidoping']
	],
	[
		"campo_nombre"=>"ANTECEDENTES_FILE",
		"campo_marcador"=>":ANTECEDENTES_FILE",
		"campo_valor"=>$rutas_archivos['file_carta_antecedentes']
	],
	[
		"campo_nombre"=>"AREA",
		"campo_marcador"=>":AREA",
		"campo_valor"=>$area
	],
	[
		"campo_nombre"=>"CARGO",
		"campo_marcador"=>":CARGO",
		"campo_valor"=>$cargo
	],
	[
		"campo_nombre"=>"NOMBRE",
		"campo_marcador"=>":NOMBRE",
		"campo_valor"=>$nombre
	],
				[
					"campo_nombre" => "CALLE",
					"campo_marcador" => ":CALLE",
					"campo_valor" => $calle
				],
				[
					"campo_nombre" => "NUM_EXT",
					"campo_marcador" => ":NUM_EXT",
					"campo_valor" => $numero_exterior
				],
				[
					"campo_nombre" => "NUM_INT",
					"campo_marcador" => ":NUM_INT",
					"campo_valor" => $numero_interior
				],
					[
					"campo_nombre" => "COLONIA",
					"campo_marcador" => ":COLONIA",
					"campo_valor" => $colonia
				],
					[
					"campo_nombre" => "LOCALIDAD",
					"campo_marcador" => ":LOCALIDAD",
					"campo_valor" => $localidad
				],
					[
					"campo_nombre" => "REFERENCIA",
					"campo_marcador" => ":REFERENCIA",
					"campo_valor" => $referencia
				],
					[
					"campo_nombre" => "MUNICIPIO",
					"campo_marcador" => ":MUNICIPIO",
					"campo_valor" => $municipio
				],
					[
					"campo_nombre" => "ESTADO",
					"campo_marcador" => ":ESTADO",
					"campo_valor" => $estado
				],
					[
					"campo_nombre" => "PAIS",
					"campo_marcador" => ":PAIS",
					"campo_valor" => $pais
				],
					[
					"campo_nombre" => "CP",
					"campo_marcador" => ":CP",
					"campo_valor" => $cp
					],
	[
		"campo_nombre"=>"CURP",
		"campo_marcador"=>":CURP",
		"campo_valor"=>$curp
	],
	[
		"campo_nombre"=>"TELEFONO",
		"campo_marcador"=>":TELEFONO",
		"campo_valor"=>$telefono
	],
	[
		"campo_nombre"=>"FOLIO_LICENCIA",
		"campo_marcador"=>":FOLIO_LICENCIA",
		"campo_valor"=>$folio_licencia_federal
	],
	[
		"campo_nombre"=>"FECHA_LICENCIA",
		"campo_marcador"=>":FECHA_LICENCIA",
		"campo_valor"=>$vigencia_licencia_federal
	],
	[
		"campo_nombre"=>"FOLIO_EXAMENMEDICO",
		"campo_marcador"=>":FOLIO_EXAMENMEDICO",
		"campo_valor"=>$folio_examen_medico
	],
	[
		"campo_nombre"=>"FECHA_EXAMEN",
		"campo_marcador"=>":FECHA_EXAMEN",
		"campo_valor"=>$fecha_examen_medico
	],
	[
		"campo_nombre"=>"FOLIO_ANTIDOPPING",
		"campo_marcador"=>":FOLIO_ANTIDOPPING",
		"campo_valor"=>$folio_antidoping
	],
	[
		"campo_nombre"=>"FECHA_ANTIDOPPING",
		"campo_marcador"=>":FECHA_ANTIDOPPING",
		"campo_valor"=>$fecha_examen_antidoping
	],
	[
		"campo_nombre"=>"FOLIO_ANTECEDENTES",
		"campo_marcador"=>":FOLIO_ANTECEDENTES",
		"campo_valor"=>$folio_carta_no_antecedentes
	],
	[
		"campo_nombre"=>"REFERENCIAS",
		"campo_marcador"=>":REFERENCIAS",
		"campo_valor"=>$referencias
	]
];
$registrar_colaborador=$this->guardarDatos("colaborador",$colaboradores_datos_reg);
$alerta=[
	"tipo"=>"limpiar",
	"titulo"=>"Colaborador registrado",
	"texto"=>"El Colaborador ".$nombre." se registro con exito",
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


}
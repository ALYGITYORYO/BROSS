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
$rfc =$_POST['rfc'];
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
		"campo_nombre"=>"INE_ID",
		"campo_marcador"=>":INE_ID",
		"campo_valor"=>$ine_id
	],
	[
		"campo_nombre"=>"RFC",
		"campo_marcador"=>":RFC",
		"campo_valor"=>$rfc
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



/*----------  Controlador listar todos los colaboradores  ----------*/
public function listarColaboradorControlador(){
	$drop_list=$this->ejecutarConsulta("SELECT * FROM `colaborador`");			
			while($fila = $drop_list->fetchall()) {
				$lista[] = $fila;
			}
	
			return json_encode($lista);
}

/*----------  Controlador listar por colaborador  ----------*/
public function leerColaboradorControlador(){
			$ID=$this->limpiarCadena($_POST["ID"]);
			$lista = array();		
			$drop_list=$this->ejecutarConsulta("SELECT * FROM `colaborador` WHERE ID=".$ID);			
			while($fila = $drop_list->fetchall()) {
				$lista[] = $fila;
			}
			return json_encode($lista);
}


public function acualizarColaboradorControlador(){

			$id =$this->limpiarCadena($_POST['id_empleado']);
			# Almacenando datos#
			$no_empleado =$_POST['no_empleado'];
			$area =$_POST['area_input'];
			$cargo =$_POST['cargo_input'];
			$nombre =$_POST['nombre'];
			$curp =$_POST['curp'];
			$telefono =$_POST['telefono'];
			$ine_id =$_POST['ine_id'];
			$rfc =$_POST['rfc'];
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


			//FOTO
			$file_dir="../views/fotos/".$no_empleado."/";

			if(isset($_FILES['foto']) && $_FILES['foto']['name']!="" && $_FILES['foto']['size']>0){

	

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
				$check_foto=$this->ejecutarConsulta("SELECT FOTO FROM colaborador WHERE id=$id");
				if($check_foto->rowCount()==1){
			
					$check_foto=$check_foto->fetch();
			
					if($check_foto['FOTO']!=""){
						$foto=$check_foto['FOTO'];
					}
					else{
						$foto="";
					}
				}
			
				
			}
			// ARCHIVOS INE  licencia examenes y carta 
			$archivos = array("file_ine", "file_licencia", "file_examen_medico", "file_examen_antidoping", "file_carta_antecedentes");
			$rutas_archivos = array(); // Array para guardar las rutas
			$nombre_tablas= array("INE","LICENCIA_FILE","EXAMEN_FILE","ANTIDOPING_FILE","ANTECEDENTES_FILE");
			foreach ($archivos as $indice => $archivo) {
				if(isset($_FILES[$archivo])){
				$pdf = $_FILES[$archivo];
				$nombre_tabla = $nombre_tablas[$indice];
				if($pdf['name']!="" && $pdf["size"]>0)
				{
				
			
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

					$check_archivo=$this->ejecutarConsulta("SELECT $nombre_tabla FROM colaborador WHERE id=$id");
					if($check_archivo->rowCount()==1){
						$check_archivo=$check_archivo->fetch();
						if($check_archivo["$nombre_tabla"]!=""){
							$rutas_archivos[$archivo] =$check_archivo["$nombre_tabla"];
						}
						else{
							$rutas_archivos[$archivo] = "";
						}
					}
					
				}
				}
				else{
					$check_ine=$this->ejecutarConsulta("SELECT $nombre_tablas[$indice] FROM colaborador WHERE id=$id");
					if($check_ine->rowCount()==1){
						$check_ine=$check_ine->fetch();
						if($check_ine[$nombre_tablas[$indice]]!=""){
							$rutas_archivos[$archivo] =$check_ine[$nombre_tablas[$indice]];
						}
						else{
							$rutas_archivos[$archivo] = "";
						}
					}					
				}
			}

			$colaboradores_datos_update=[
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
					"campo_nombre"=>"INE_ID",
					"campo_marcador"=>":INE_ID",
					"campo_valor"=>$ine_id
				],
				[
					"campo_nombre"=>"RFC",
					"campo_marcador"=>":RFC",
					"campo_valor"=>$rfc
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
				]
			];
			
            
			$condicion=[
				"condicion_campo"=>"ID",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if($this->actualizarDatos("colaborador",$colaboradores_datos_update,$condicion)){
				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Cliente actualizado",
					"texto"=>"Los datos del cliente ".$nombre." se actualizaron correctamente",
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
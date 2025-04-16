<?php

namespace app\controllers;
use app\models\mainModel;

class remisionController extends mainModel{



    function remisionRegistrarController(){
            //VARIABLES REMISION
            $folio = $_POST['folio_cotizacion'];
            $folio_remision = $_POST['folio_remision'];
            $cliente = $_POST['cliente'];
            $condiciones = $_POST['condiciones'];
            $diasCredito = $_POST['diasCredito'];
            $vehiculo = $_POST['vehiculo'];
            $num_viaje = $_POST['num_viaje'];
            
            $iniciolink =addslashes($_POST['diriniciogoogle']);
            $finallink =addslashes($_POST['dirfinalgoogle']);

            $material =$_POST['materiales'];
            
            $fechaInicio = $_POST['fechaInicio'];
            $fechaFin = $_POST['fechaFin'];
            $precio = $_POST['precio'];
            $notas = $_POST['notas'];
            $fiscal = $_POST['fiscal'];
            $razon_social = $_POST['razon_social'];


            //UBICACIONES ORIGEN
			$id_ubicacion_origen = $_POST['id_ubicacion_origen'];
			$calle_origen = $_POST['calle_origen'];
			$numero_exterior_origen = $_POST['numero_exterior_origen'];
			$numero_interior_origen = $_POST['numero_interior_origen'];
			$colonia_origen = $_POST['colonia_origen'];
			$localidad_origen = $_POST['localidad_origen'];
			$referencia_origen = $_POST['referencia_origen'];
			$municipio_origen = $_POST['municipio_origen'];
			$estado_origen = $_POST['estado_origen'];
			$pais_origen = $_POST['pais_origen'];
			$cp_origen = $_POST['cp_origen'];
			$distancia_recorrida_origen = $_POST['distancia_recorrida_origen'];
			
			//UBICACIONES DESTINO
			$id_ubicacion_destino = $_POST['id_ubicacion_destino'];
			$calle_destino = $_POST['calle_destino'];
			$numero_exterior_destino = $_POST['numero_exterior_destino'];
			$numero_interior_destino = $_POST['numero_interior_destino'];
			$colonia_destino = $_POST['colonia_destino'];
			$localidad_destino = $_POST['localidad_destino'];
			$referencia_destino = $_POST['referencia_destino'];
			$municipio_destino = $_POST['municipio_destino'];
			$estado_destino = $_POST['estado_destino'];
			$pais_destino = $_POST['pais_destino'];
			$cp_destino = $_POST['cp_destino'];
			$distancia_recorrida_destino = $_POST['distancia_recorrida_destino'];



    $datos_remision = [
        [
            "campo_nombre" => "FOLIO",
            "campo_marcador" => ":FOLIO",
            "campo_valor" => $folio
        ],
        [
            "campo_nombre" => "FOLIO_REMISION",
            "campo_marcador" => ":FOLIO_REMISION",
            "campo_valor" => $folio_remision
        ],
        [
            "campo_nombre" => "CLIENTE",
            "campo_marcador" => ":CLIENTE",
            "campo_valor" => $cliente
        ],
        [
            "campo_nombre" => "CONDICIONES",
            "campo_marcador" => ":CONDICIONES",
            "campo_valor" => $condiciones
        ],
        [
            "campo_nombre" => "DIAS_CREDITO",
            "campo_marcador" => ":DIAS_CREDITO",
            "campo_valor" => $diasCredito
        ],
        [
            "campo_nombre" => "VEHICULO",
            "campo_marcador" => ":VEHICULO",
            "campo_valor" => $vehiculo
        ],
        [
            "campo_nombre" => "LINK_INICIO",
            "campo_marcador" => ":LINK_INICIO",
            "campo_valor" => $iniciolink
        ],
        [
            "campo_nombre" => "LINK_FINAL",
            "campo_marcador" => ":LINK_FINAL",
            "campo_valor" => $finallink
        ],
        [
            "campo_nombre" => "MATERIAL",
            "campo_marcador" => ":MATERIAL",
            "campo_valor" => $material
        ],

        [
            "campo_nombre" => "FECHA_INICIO",
            "campo_marcador" => ":FECHA_INICIO",
            "campo_valor" => $fechaInicio
        ],
        [
            "campo_nombre" => "FECHA_FINAL",
            "campo_marcador" => ":FECHA_FINAL",
            "campo_valor" => $fechaFin
        ],
        [
            "campo_nombre" => "PRECIO",
            "campo_marcador" => ":PRECIO",
            "campo_valor" => $precio
        ],
        [
            "campo_nombre" => "NOTAS",
            "campo_marcador" => ":NOTAS",
            "campo_valor" => $notas
        ],
        [
            "campo_nombre" => "FISCAL",
            "campo_marcador" => ":FISCAL",
            "campo_valor" => $fiscal
        ],
        [
            "campo_nombre" => "RAZON_SOCIAL",
            "campo_marcador" => ":RAZON_SOCIAL",
            "campo_valor" => $razon_social
        ],
		[
            "campo_nombre" => "NUM_VIAJE",
            "campo_marcador" => ":NUM_VIAJE",
            "campo_valor" => $num_viaje
        ],
				[
					"campo_nombre" => "ID_ORIGEN",
					"campo_marcador" => ":ID_ORIGEN",
					"campo_valor" => $id_ubicacion_origen
				],
				[
					"campo_nombre" => "CALLE_ORIGEN",
					"campo_marcador" => ":CALLE_ORIGEN",
					"campo_valor" => $calle_origen
				],
				[
					"campo_nombre" => "NUM_EXT_ORIGEN",
					"campo_marcador" => ":NUM_EXT_ORIGEN",
					"campo_valor" => $numero_exterior_origen
				],
				[
					"campo_nombre" => "NUM_INT_ORIGEN",
					"campo_marcador" => ":NUM_INT_ORIGEN",
					"campo_valor" => $numero_interior_origen
				],
					[
					"campo_nombre" => "COLONIA_ORIGEN",
					"campo_marcador" => ":COLONIA_ORIGEN",
					"campo_valor" => $colonia_origen
				],
					[
					"campo_nombre" => "LOCALIDAD_ORIGEN",
					"campo_marcador" => ":LOCALIDAD_ORIGEN",
					"campo_valor" => $localidad_origen
				],
					[
					"campo_nombre" => "REFERENCIA_ORIGEN",
					"campo_marcador" => ":REFERENCIA_ORIGEN",
					"campo_valor" => $referencia_origen
				],
					[
					"campo_nombre" => "MUNICIPIO_ORIGEN",
					"campo_marcador" => ":MUNICIPIO_ORIGEN",
					"campo_valor" => $municipio_origen
				],
					[
					"campo_nombre" => "ESTADO_ORIGEN",
					"campo_marcador" => ":ESTADO_ORIGEN",
					"campo_valor" => $estado_origen
				],
					[
					"campo_nombre" => "PAIS_ORIGEN",
					"campo_marcador" => ":PAIS_ORIGEN",
					"campo_valor" => $pais_origen
				],
					[
					"campo_nombre" => "CP_ORIGEN",
					"campo_marcador" => ":CP_ORIGEN",
					"campo_valor" => $cp_origen
				],
					[
					"campo_nombre" => "DISTANCIA_ORIGEN",
					"campo_marcador" => ":DISTANCIA_ORIGEN",
					"campo_valor" => $distancia_recorrida_origen
				],
					
				[
					"campo_nombre" => "ID_DESTINO_DESTINO",
					"campo_marcador" => ":ID_DESTINO_DESTINO",
					"campo_valor" => $id_ubicacion_destino
				],
				[
					"campo_nombre" => "CALLE_DESTINO",
					"campo_marcador" => ":CALLE_DESTINO",
					"campo_valor" => $calle_destino
				],
				[
					"campo_nombre" => "NUM_EXT_DESTINO",
					"campo_marcador" => ":NUM_EXT_DESTINO",
					"campo_valor" => $numero_exterior_destino
				],
				[
					"campo_nombre" => "NUM_INT_DESTINO",
					"campo_marcador" => ":NUM_INT_DESTINO",
					"campo_valor" => $numero_interior_destino
				],
					[
					"campo_nombre" => "COLONIA_DESTINO",
					"campo_marcador" => ":COLONIA_DESTINO",
					"campo_valor" => $colonia_destino
				],
					[
					"campo_nombre" => "LOCALIDAD_DESTINO",
					"campo_marcador" => ":LOCALIDAD_DESTINO",
					"campo_valor" => $localidad_destino
				],
					[
					"campo_nombre" => "REFERENCIA_DESTINO",
					"campo_marcador" => ":REFERENCIA_DESTINO",
					"campo_valor" => $referencia_destino
				],
					[
					"campo_nombre" => "MUNICIPIO_DESTINO",
					"campo_marcador" => ":MUNICIPIO_DESTINO",
					"campo_valor" => $municipio_destino
				],
					[
					"campo_nombre" => "ESTADO_DESTINO",
					"campo_marcador" => ":ESTADO_DESTINO",
					"campo_valor" => $estado_destino
				],
					[
					"campo_nombre" => "PAIS_DESTINO",
					"campo_marcador" => ":PAIS_DESTINO",
					"campo_valor" => $pais_destino
				],
					[
					"campo_nombre" => "CP_DESTINO",
					"campo_marcador" => ":CP_DESTINO",
					"campo_valor" => $cp_destino
				],
					[
					"campo_nombre" => "DISTANCIA_DESTINO",
					"campo_marcador" => ":DISTANCIA_DESTINO",
					"campo_valor" => $distancia_recorrida_destino
				]
    ];

    $registrar_vehiculo=$this->guardarDatos("remision",$datos_remision);
//DESHABILITAR TRACTO Y REMISION

$last_id=$this->ejecutarConsulta("SELECT ID FROM `remision` WHERE FOLIO='$folio'");
$last_id_remi = $last_id->fetch();
//obtener relacion de vehiculos
$relacion_id=$this->ejecutarConsulta("SELECT `ID_RELACION` FROM `bross_tracto` WHERE `ID_VEHICULO`=$vehiculo");
$id_relacion_vehiculos = $relacion_id->fetch();



$update_cotizacion=$this->ejecutarConsulta("UPDATE `cotizador` SET `ESTATUS` = '".$last_id_remi['ID']."' WHERE `cotizador`.`FOLIO` ='".$folio."'");
$update_vehiculo=$this->ejecutarConsulta("UPDATE `vehiculos` SET `ESTATUS` = '1' WHERE `vehiculos`.`ID` =".$vehiculo);
$inser_viaje=$this->ejecutarConsulta("INSERT INTO `viajes` (`ID`, `ID_VEHICULO`,`ID_RELACION_VEHICULO`, `ID_REMISION`, `ESTATUS`, `COLOR`) VALUES (NULL, '".$vehiculo."',".$id_relacion_vehiculos['ID_RELACION'].", ".$last_id_remi['ID'].", 'VIAJE', 'BLANCO')");

    $alerta=[
        "tipo"=>"limpiar",
        "titulo"=>"El Vehículo fue registrado",
        "texto"=>"El Vehículo ".$folio_remision." se registro con exito",
        "icono"=>"success"
    ];
    return json_encode($alerta);

    }



    function remisionLeer(){
        $ID=$_POST["ID"];
        $lista = array();
        $autoincrement=1;
        $drop_list=$this->ejecutarConsulta("SELECT * FROM `cotizador` WHERE ID=".$ID);			
        

// PARA OBTENER TODOS LOS DATOS 
        while($fila = $drop_list->fetchall()) {
            $lista[] = $fila;
        }

        return json_encode($lista);
    }

	function viajesTranscursoController(){

		$lista = array();
        $autoincrement=1;
        $drop_list=$this->ejecutarConsulta("SELECT * FROM `remision`");			
		// PARA OBTENER TODOS LOS DATOS 
        while($fila = $drop_list->fetchall()) {
            $lista[] = $fila;
        }

        return json_encode($lista);
	}
    
}

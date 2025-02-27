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
    $estadoinicio = $_POST['estadoinicio'];
    $ciudadinicio = $_POST['ciudadinicio'];
    $estadofinal = $_POST['estadofinal'];
    $ciudadfinal = $_POST['ciudadfinal'];
    $dirinicio = $_POST['dirinicio'];
    $dirfinal = $_POST['dirfinal'];
    $diriniciogoogle = $_POST['diriniciogoogle'];
    $dirfinalgoogle = $_POST['dirfinalgoogle'];
    $material = $_POST['material'];
    $peso = $_POST['peso'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $precio = $_POST['precio'];
    $notas = $_POST['notas'];
    $fiscal = $_POST['fiscal'];
    $razon_social = $_POST['razon_social'];


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
            "campo_nombre" => "ESTADO_INICIO",
            "campo_marcador" => ":ESTADO_INICIO",
            "campo_valor" => $estadoinicio
        ],
        [
            "campo_nombre" => "CIUDAD_INICIO",
            "campo_marcador" => ":CIUDAD_INICIO",
            "campo_valor" => $ciudadinicio
        ],
        [
            "campo_nombre" => "ESTADO_FINAL",
            "campo_marcador" => ":ESTADO_FINAL",
            "campo_valor" => $estadofinal
        ],
        [
            "campo_nombre" => "CIUDAD_FINAL",
            "campo_marcador" => ":CIUDAD_FINAL",
            "campo_valor" => $ciudadfinal
        ],
        [
            "campo_nombre" => "DIR_INICIO",
            "campo_marcador" => ":DIR_INICIO",
            "campo_valor" => $dirinicio
        ],
        [
            "campo_nombre" => "DIR_FINAL",
            "campo_marcador" => ":DIR_FINAL",
            "campo_valor" => $dirfinal
        ],
        [
            "campo_nombre" => "LINK_INICIO",
            "campo_marcador" => ":LINK_INICIO",
            "campo_valor" => $diriniciogoogle
        ],
        [
            "campo_nombre" => "LINK_FINAL",
            "campo_marcador" => ":LINK_FINAL",
            "campo_valor" => $dirfinalgoogle
        ],
        [
            "campo_nombre" => "MATERIAL",
            "campo_marcador" => ":MATERIAL",
            "campo_valor" => $material
        ],
        [
            "campo_nombre" => "PESO",
            "campo_marcador" => ":PESO",
            "campo_valor" => $peso
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
        ]
    ];

    $registrar_vehiculo=$this->guardarDatos("remision",$datos_remision);
//DESHABILITAR TRACTO Y REMISION
    
    $alerta=[
        "tipo"=>"limpiar",
        "titulo"=>"El Vehículo fue registrado",
        "texto"=>"El Vehículo ".$folio." se registro con exito",
        "icono"=>"success"
    ];
    return json_encode($alerta);

    }



    function remisionLeer(){
        $ID=$_POST["ID"];
        $lista = array();
        $autoincrement=1;
        $drop_list=$this->ejecutarConsulta("SELECT * FROM `cotizador` WHERE ID=".$ID);			
        $fila = $drop_list->fetchall();

        foreach ($fila as $row) {
            $lista[]= array(
                "ID" => $row["ID"],
                "FOLIO" => $row["FOLIO"],
                "CLIENTE" => $row["CLIENTE"],
                "PUNTO_INICIO_EDO" => $row["PUNTO_INICIO_EDO"],
                "PUNTO_INICIO_CIUDAD" => $row["PUNTO_INICIO_CIUDAD"],
                "DIR_INICIO" => $row["DIR_INICIO"],
                "PUNTO_FINAL_EDO" => $row["PUNTO_FINAL_EDO"],
                "PUNTO_FINAL_CIUDAD" => $row["PUNTO_FINAL_CIUDAD"],
                "DIR_FINAL" => $row["DIR_FINAL"],
                "MATERIAL" => $row["MATERIAL"],
                "PESO" => $row["PESO"],
                "PRECIO" => $row["PRECIO"],
                "FECHA_CARGA" => $row["FECHA_CARGA"],
                "FECHA_DESCARGA" => $row["FECHA_DESCARGA"],
                "LINK_INICIO" => $row["LINK_INICIO"],
                "LINK_FINAL" => $row["LINK_FINAL"],
                "NOTAS" => $row["NOTAS"],
                "TIPO_FISCAL" => $row["TIPO_FISCAL"],
                "DIAS_CREDITO" => $row["DIAS_CREDITO"],
                "CONDICION" => $row["CONDICION"]

                );
        }

        return json_encode($lista);
    }
    
}

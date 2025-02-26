<?php

namespace app\controllers;
use app\models\mainModel;

class remisionController extends mainModel{

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

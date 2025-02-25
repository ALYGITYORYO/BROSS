<?php

namespace app\controllers;
use app\models\mainModel;

class remisionController extends mainModel{

    function remisionLeer($ID){
        $lista = array();
        $autoincrement=1;
        $drop_list=$this->ejecutarConsulta("SELECT co.`ID`,co.`FOLIO`,co.`PUNTO_INICIO_EDO`,co.`PUNTO_INICIO_CIUDAD`,co.`DIR_INICIO`,co.`PUNTO_FINAL_EDO`,co.`PUNTO_FINAL_CIUDAD`,co.`DIR_FINAL`,co.`PESO`,co.`FECHA_CARGA`,co.`FECHA_DESCARGA`,co.`DIAS`,co.`PRECIO`,c.NOMBRE AS CLIENTE, m.NOMBRE AS MATERIAL FROM `cotizador`co INNER JOIN clientes c ON CLIENTE = c.ID INNER JOIN d_material m ON MATERIAL = m.ID WHERE co.ID=".$ID);			
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
                "FECHA_CARGA" => $row["FECHA_CARGA"],
                "FECHA_DESCARGA" => $row["FECHA_DESCARGA"],
                "PRECIO" => $row["PRECIO"]
                );
        }

        return json_encode($lista);
    }
    
}

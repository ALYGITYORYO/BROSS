<?php

namespace app\controllers;
use app\models\mainModel;

class dashboardController extends mainModel{

    function dashboardContent(){
        $lista = array();
				$drop_list=$this->ejecutarConsulta("SELECT (SELECT COUNT(*) FROM clientes) AS CLIENTES, (SELECT COUNT(*) FROM cotizador WHERE ESTATUS=0 ) AS COTIZACIONES, (SELECT COUNT(DISTINCT ID_TRACTO) FROM relacion_operador_vehiculo ) AS VEHICULOS, (SELECT COUNT(*) FROM colaborador  ) AS COLABORADORES");			
				$fila = $drop_list->fetchall();
				foreach ($fila as $row) {
					$lista[]= array(
						"CLIENTES" => $row["CLIENTES"],
						"COTIZACIONES" => $row["COTIZACIONES"],
						"VEHICULOS" => $row["VEHICULOS"],
						"COLABORADORES" => $row["COLABORADORES"]
						);
				}
	
				return  json_encode($lista);
    }
    
}

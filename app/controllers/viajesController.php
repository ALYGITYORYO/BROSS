<?php

	namespace app\controllers;
	use app\models\mainModel;

	class viajesController extends mainModel{

		/*----------  OBTIENE ID  ----------*/
		public function viajesGetController(){
            $id_cliente=$_POST["cliente"];
            $ciudad_inicio=$_POST["ciudad_inicio"];
            $ciudad_final=$_POST["ciudad_final"];

$consulta="SELECT r.FOLIO,r.FECHA_HORA, c.NOMBRE AS CLIENTE, m.NOMBRE AS MATERIAL, CONCAT(r.CIUDAD_INICIO, ' - ', r.CIUDAD_FINAL) AS VIAJE, r.PRECIO FROM remision r INNER JOIN clientes c ON r.CLIENTE = c.ID INNER JOIN d_material m ON r.MATERIAL = m.ID WHERE r.CLIENTE=$id_cliente AND r.CIUDAD_INICIO='$ciudad_inicio' and r.CIUDAD_FINAL='$ciudad_final'";
            $contador=0;
            $lista = array();
            $drop_list=$this->ejecutarConsulta($consulta);			
            $fila = $drop_list->fetchall();
            foreach ($fila as $row) {
                $lista[]= array(
                    "ID" => $contador++,
                    "FOLIO" => $row["FOLIO"],
                    "CLIENTE" => $row["CLIENTE"],
                    "VIAJE" => $row["VIAJE"],
                    "MATERIAL" => $row["MATERIAL"],
                    "FECHA" => $row["FECHA_HORA"],
                    "PRECIO" => $row["PRECIO"]
                    );
            }

            $drop_list=$this->ejecutarConsulta("SELECT r.FOLIO,r.FECHA_HORA, c.NOMBRE AS CLIENTE, m.NOMBRE AS MATERIAL, CONCAT(r.CIUDAD_FINAL, ' - ', r.CIUDAD_INICIO) AS VIAJE, r.PRECIO FROM remision r INNER JOIN clientes c ON r.CLIENTE = c.ID INNER JOIN d_material m ON r.MATERIAL = m.ID WHERE r.CLIENTE=$id_cliente AND r.CIUDAD_INICIO='$ciudad_inicio' and r.CIUDAD_FINAL='$ciudad_final'");			
            $fila = $drop_list->fetchall();
            foreach ($fila as $row) {
                $lista[]= array(
                    "ID" => $contador++,
                    "FOLIO" => $row["FOLIO"],
                    "CLIENTE" => $row["CLIENTE"],
                    "VIAJE" => $row["VIAJE"],
                    "MATERIAL" => $row["MATERIAL"],
                    "FECHA" => $row["FECHA_HORA"],
                    "PRECIO" => $row["PRECIO"],
                    );
            }
            
            return  json_encode($lista);
			
		}

    }
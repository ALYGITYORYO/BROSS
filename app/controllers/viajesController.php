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


        function viajesModuloController(){

            $lista = array();
        $autoincrement=1;
        $drop_list=$this->ejecutarConsulta("SELECT V.ID,R.FOLIO_REMISION AS FOLIO, C.NOMBRE AS CLIENTE, R.ESTADO_ORIGEN AS ORIGEN , R.ESTADO_DESTINO AS DESTINO, VE.OPERADOR AS OPERADOR, l.NOMBRE AS RZ, V.ESTATUS, V.ID_RELACION_VEHICULO AS ID_VEHI FROM viajes V INNER JOIN remision R ON V.ID_REMISION=R.ID INNER JOIN clientes C ON R.CLIENTE=C.ID INNER JOIN razon l ON R.RAZON_SOCIAL=L.ID INNER JOIN vehiculos VE ON V.ID_VEHICULO=VE.ID");			
		// PARA OBTENER TODOS LOS DATOS 
        while($fila = $drop_list->fetchall()) {
            $lista[] = $fila;
        }

        return json_encode($lista);

        }

        function vehiculos_drill(){
            $contador=0;
            $drop_list=$this->ejecutarConsulta("SELECT V.ID_RELACION_VEHICULO AS ID_RELACION, VE.NOVEHICULO AS FOLIO, VE.TIPO_VEHICULO, VE.FOTO_UNIDAD FROM viajes V INNER JOIN bross_tracto B ON V.ID_RELACION_VEHICULO=B.ID_RELACION INNER JOIN vehiculos VE ON B.ID_VEHICULO=VE.ID");			
            $fila = $drop_list->fetchall();
            foreach ($fila as $row) {
                $lista[]= array(
                    "ID" => $contador++,
                    "FOLIO" => $row["FOLIO"],
                    "ID_RELACION" => $row["ID_RELACION"],
                    "TIPO_VEHICULO" => $row["TIPO_VEHICULO"],
                    "IMG" => $row["FOTO_UNIDAD"]                    
                    );
            }            
            return  json_encode($lista);
        }

        function imagen_drill(){
            $contador=0;
            $drop_list=$this->ejecutarConsulta("SELECT * FROM `bross_imagenes`");			
            $fila = $drop_list->fetchall();
            foreach ($fila as $row) {
                $lista[]= array(
                    "ID" => $row["ID"],
                    "ID_VIAJE" => $row["ID_VIAJE"],
                    "FECHA" => $row["FECHA"],
                    "ESTATUS" => $row["ESTATUS"],
                    "USUARIO" => $row["USUARIO"],
                    "IMG" => $row["IMG"]                    
                    );
            }            
            return  json_encode($lista);
        }

        function incidencia_drill(){
            $contador=0;
            $drop_list=$this->ejecutarConsulta("SELECT * FROM `incidencias`");			
            $fila = $drop_list->fetchall();
            foreach ($fila as $row) {
                $lista[]= array(
                    "ID" => $row["ID"],
                    "ID_VIAJE" => $row["ID_VIAJE"],
                    "FECHA" => $row["FECHA"],
                    "TIPO_INCIDENCIA" => $row["TIPO_INCIDENCIA"],
                    "NOTA" => $row["NOTA"],
                    "IMG" => $row["IMG"]                    
                    );
            }            
            return  json_encode($lista);
        }

    }
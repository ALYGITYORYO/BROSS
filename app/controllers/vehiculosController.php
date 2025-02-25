<?php
namespace app\controllers;
        use app\models\mainModel;

        class vehiculosController extends mainModel{


        /*----------  Controlador registrar usuario  ----------*/
        public function vehiculosAltaControlador(){
        
    


            # Almacenando datos#
            $no_vehiculo =$_POST['no_vehiculo'];
            $tipo_vehiculo =$_POST['tipos_vehiculos_input'];
            $tipo_remolque =$_POST['tipos_remolques_input'];
            $proveedor_gps =$_POST['proveedor_gps'];
            $imei =$_POST['imei'];
            $link_gps =$_POST['link_gps'];
            $fecha_instalacion_gps =$_POST['fecha_instalacion_gps'];
            $gps =$_POST['gps'];
            $razon_social =$_POST['razon_social_input'];
            $marca =$_POST['marca'];
            $modelo =$_POST['modelo'];
            $color =$_POST['color'];
            $anio =$_POST['anio'];
            $placas =$_POST['placas'];
            $tarjeta_circulacion =$_POST['tarjeta_circulacion'];
            $serie =$_POST['serie'];
            $no_motor =$_POST['no_motor'];
            $valor_unidad =$_POST['valor_unidad'];
            $no_factura =$_POST['no_factura'];
            $tipo_combustible =$_POST['tipo_combustible'];
            $capacidad_combustible =$_POST['capacidad_combustible'];
            $aseguradora =$_POST['aseguradora'];
            $no_poliza =$_POST['no_poliza'];
            $vigencia_poliza =$_POST['vigencia_poliza'];
            $verificacion_mecanica =$_POST['verificacion_mecanica'];
            $vigencia_verificacion_mecanica =$_POST['vigencia_verificacion_mecanica'];
            $verificacion_ambiental =$_POST['verificacion_ambiental'];
            $vigencia_verificacion_ambiental =$_POST['vigencia_verificacion_ambiental'];
            $operador_asignado =$_POST['operador_asignado_input'];
            $operador_asignado_ID=$_POST['operador_asignado'];
            $doble_articulado =$_POST['dobleArticulado'];

            $dolly_asignado =$_POST['dolly_asignado_input'];
            $dolly_asignado_ID =$_POST['dolly_asignado'];

            $dolly_bandera=0;
            $remolques_asignados_concat="";
            if (isset($_POST['reolques_asignados']))
            {
                
                $reolques_asignados = $_POST['reolques_asignados'];
                //$dolly_bandera=1;
                if (is_array($reolques_asignados)) {
                    foreach ($reolques_asignados as $valor) {
                        $remolques_asignados_concat=$valor.",".$remolques_asignados_concat;
                        // Se actualiza el estado del vehiculo a 1=usado de remolques
                        $update_unidad=$this->ejecutarConsulta("UPDATE `vehiculos` SET `ESTATUS` = '1' WHERE `vehiculos`.`ID` =".$valor);                    
                    }
                    }
                    else{
                        $alerta=[
                            "tipo"=>"simple",
                            "titulo"=>"Ocurrió un error inesperado",
                            "texto"=>"No podemos leer $reolques_asignados",
                            "icono"=>"error"
                        ];
                        return json_encode($alerta);
                        exit();
                    }
            }
          
            

                    # Directorio de imagenes #
                    $file_dir="../views/fotos/".$no_vehiculo."/";
                    # Comprobar si se selecciono una imagen #
                    if($_FILES['unidad_foto']['name']!="" && $_FILES['unidad_foto']['size']>0){

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

                        # Verificando formato de imagenes #
                        if(mime_content_type($_FILES['unidad_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['unidad_foto']['tmp_name'])!="image/png"){
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
                        if(($_FILES['unidad_foto']['size']/1024)>5120){
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
                        $foto_unidad=str_ireplace(" ","_",$serie);
                        $foto_unidad=$foto_unidad."_".rand(0,100);

                        # Extension de la imagen #
                        switch(mime_content_type($_FILES['unidad_foto']['tmp_name'])){
                            case 'image/jpeg':
                                $foto_unidad=$foto_unidad.".jpg";
                            break;
                            case 'image/png':
                                $foto_unidad=$foto_unidad.".png";
                            break;
                        }

                        chmod($file_dir,0777);

                        # Moviendo imagen al directorio #
                        if(!move_uploaded_file($_FILES['unidad_foto']['tmp_name'],$file_dir.$foto_unidad)){
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
                        $foto_unidad="";
                    }
                    
                    
                    
                $archivos = array("file_tarjeta_circulacion", "file_factura", "file_poliza_seguro", "file_verificacion_mecanica", "file_verificacion_ambiental");
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

                foreach ($archivos as $archivo) 
                {
                    $pdf = $_FILES[$archivo];
                    if(isset($pdf) && $pdf['name']!="" && $pdf["size"]>0){
                    

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
                    $ruta_archivo = $file_dir . $nombre_archivo;
                    $rutas_archivos[$archivo] ="app/views/fotos/".$no_vehiculo."/".$nombre_archivo;
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


                $vehiculo_datos_reg=[
                    [
                        "campo_nombre"=>"NOVEHICULO",
                        "campo_marcador"=>":NOVEHICULO",
                        "campo_valor"=>$no_vehiculo
                    ],
                    [
                        "campo_nombre"=>"REMOLQUE_ASIGNADO",
                        "campo_marcador"=>":REMOLQUE_ASIGNADO",
                        "campo_valor"=>$remolques_asignados_concat
                    ],
                    [
                        "campo_nombre"=>"PROVEDOR_GPS",
                        "campo_marcador"=>":PROVEDOR_GPS",
                        "campo_valor"=>$proveedor_gps
                    ],
                    [
                        "campo_nombre"=>"TIPO_REMOLQUE",
                        "campo_marcador"=>":TIPO_REMOLQUE",
                        "campo_valor"=>$tipo_remolque
                    ],
                    [
                        "campo_nombre"=>"IMEI",
                        "campo_marcador"=>":IMEI",
                        "campo_valor"=>$imei
                    ],[
                        "campo_nombre"=>"FECHA_GPS",
                        "campo_marcador"=>":FECHA_GPS",
                        "campo_valor"=>$fecha_instalacion_gps
                    ],[
                        "campo_nombre"=>"GPS",
                        "campo_marcador"=>":GPS",
                        "campo_valor"=>$gps
                    ],[
                        "campo_nombre"=>"LINK_GPS",
                        "campo_marcador"=>":LINK_GPS",
                        "campo_valor"=>$link_gps
                    ],[
                        "campo_nombre"=>"DOBLE_ARTICULADO",
                        "campo_marcador"=>":DOBLE_ARTICULADO",
                        "campo_valor"=>$doble_articulado
                    ],
                    [
                        "campo_nombre"=>"FOTO_UNIDAD",
                        "campo_marcador"=>":FOTO_UNIDAD",
                        "campo_valor"=>"app/views/fotos/".$no_vehiculo."/".$foto_unidad
                    ],
                    [
                        "campo_nombre"=>"TIPO_VEHICULO",
                        "campo_marcador"=>":TIPO_VEHICULO",
                        "campo_valor"=>$tipo_vehiculo
                    ],
                    [
                        "campo_nombre"=>"MARCA",
                        "campo_marcador"=>":MARCA",
                        "campo_valor"=>$marca
                    ],
                    [
                        "campo_nombre"=>"MODELO",
                        "campo_marcador"=>":MODELO",
                        "campo_valor"=>$modelo
                    ],
                    [
                        "campo_nombre"=>"COLOR",
                        "campo_marcador"=>":COLOR",
                        "campo_valor"=>$color
                    ],
                    [
                        "campo_nombre"=>"ANHOS",
                        "campo_marcador"=>":ANHOS",
                        "campo_valor"=>$anio
                    ],
                    [
                        "campo_nombre"=>"PLACAS",
                        "campo_marcador"=>":PLACAS",
                        "campo_valor"=>$placas
                    ],
                    [
                        "campo_nombre"=>"TARJETA_CIRCULACION",
                        "campo_marcador"=>":TARJETA_CIRCULACION",
                        "campo_valor"=>$tarjeta_circulacion
                    ],
                    [
                        "campo_nombre"=>"SERIE",
                        "campo_marcador"=>":SERIE",
                        "campo_valor"=>$serie
                    ],
                    [
                        "campo_nombre"=>"MOTOR",
                        "campo_marcador"=>":MOTOR",
                        "campo_valor"=>$no_motor
                    ],
                    [
                        "campo_nombre"=>"VALOR_UNIDAD",
                        "campo_marcador"=>":VALOR_UNIDAD",
                        "campo_valor"=>$valor_unidad
                    ],
                    [
                        "campo_nombre"=>"RAZON",
                        "campo_marcador"=>":RAZON",
                        "campo_valor"=>$razon_social
                    ],
                    [
                        "campo_nombre"=>"NOFACTURA",
                        "campo_marcador"=>":NOFACTURA",
                        "campo_valor"=>$no_factura
                    ],
                    [
                        "campo_nombre"=>"TIPO_COMBUSTIBLE",
                        "campo_marcador"=>":TIPO_COMBUSTIBLE",
                        "campo_valor"=>$tipo_combustible
                    ],
                    [
                        "campo_nombre"=>"CAPACIDAD_COMBUSTIBLE",
                        "campo_marcador"=>":CAPACIDAD_COMBUSTIBLE",
                        "campo_valor"=>$capacidad_combustible
                    ],
                    [
                        "campo_nombre"=>"ASEGURADORA",
                        "campo_marcador"=>":ASEGURADORA",
                        "campo_valor"=>$aseguradora
                    ],
                    [
                        "campo_nombre"=>"NOPOLIZA",
                        "campo_marcador"=>":NOPOLIZA",
                        "campo_valor"=>$no_poliza
                    ],
                    [
                        "campo_nombre"=>"VIGENCIA_POLIZA",
                        "campo_marcador"=>":VIGENCIA_POLIZA",
                        "campo_valor"=>$vigencia_poliza
                    ],
                    [
                        "campo_nombre"=>"VERIFICACION_MECANICA",
                        "campo_marcador"=>":VERIFICACION_MECANICA",
                        "campo_valor"=>$verificacion_mecanica
                    ],
                    [
                        "campo_nombre"=>"VIGENCIA_MECANICA",
                        "campo_marcador"=>":VIGENCIA_MECANICA",
                        "campo_valor"=>$vigencia_verificacion_mecanica
                    ],
                    [
                        "campo_nombre"=>"VERIFICACION_AMBIENTAL",
                        "campo_marcador"=>":VERIFICACION_AMBIENTAL",
                        "campo_valor"=>$verificacion_ambiental
                    ],
                    [
                        "campo_nombre"=>"VIGENCIA_AMBIENTAL",
                        "campo_marcador"=>":VIGENCIA_AMBIENTAL",
                        "campo_valor"=>$vigencia_verificacion_ambiental
                    ],
                    [
                        "campo_nombre"=>"OPERADOR",
                        "campo_marcador"=>":OPERADOR",
                        "campo_valor"=>$operador_asignado
                    ],
                    [
                        "campo_nombre"=>"DOLLY_ASIGNADO",
                        "campo_marcador"=>":DOLLY_ASIGNADO",
                        "campo_valor"=>$dolly_asignado
                    ]
                    ,
                    [
                        "campo_nombre"=>"FILE_CIRCULACION",
                        "campo_marcador"=>":FILE_CIRCULACION",
                        "campo_valor"=>$rutas_archivos['file_tarjeta_circulacion']
                    ]	
                    ,
                    [
                        "campo_nombre"=>"FILE_FACTURA",
                        "campo_marcador"=>":FILE_FACTURA",
                        "campo_valor"=>$rutas_archivos['file_factura']
                    ]	
                    ,
                    [
                        "campo_nombre"=>"FILE_POLIZA",
                        "campo_marcador"=>":FILE_POLIZA",
                        "campo_valor"=>$rutas_archivos['file_poliza_seguro']
                    ]	
                    ,
                    [
                        "campo_nombre"=>"FILE_VERIFICACION_MECANICA",
                        "campo_marcador"=>":FILE_VERIFICACION_MECANICA",
                        "campo_valor"=>$rutas_archivos['file_verificacion_mecanica']
                    ]	
                    ,
                    [
                        "campo_nombre"=>"FILE_VERIFICACION_AMBIENTAL",
                        "campo_marcador"=>":FILE_VERIFICACION_AMBIENTAL",
                        "campo_valor"=>$rutas_archivos['file_verificacion_ambiental']
                    ]		
                ];
                




                $registrar_vehiculo=$this->guardarDatos("vehiculos",$vehiculo_datos_reg);
                

                //se ingresa el ID a las relacion de tractos con remolques y dolly
                if($tipo_vehiculo=="Tracto"){
                $last_id=$this->ejecutarConsulta("SELECT ID FROM `vehiculos` WHERE NOVEHICULO='$no_vehiculo'");
                $last_idaux = $last_id->fetch();
                //$id_relacion=$this->ejecutarConsulta("INSERT INTO `relacion_operador_vehiculo` (`ID`, `ID_TRACTO`, `ID_REMOLQUES`) VALUES (NULL, '".$last_idaux["ID"]."', '".$last_idaux["ID"]."')");
                }

                if (isset($_POST['reolques_asignados']))
                {
                    $reolques_asignados = $_POST['reolques_asignados'];
                    // ASIGNACION DE REMOLQUES Y TRACTO A RELACION
                    if (is_array($reolques_asignados)) {
                        foreach ($reolques_asignados as $valor) {
                            $id_relacion=$this->ejecutarConsulta("INSERT INTO `relacion_operador_vehiculo` (`ID`, `ID_TRACTO`, `ID_REMOLQUES`) VALUES (NULL, '".$last_idaux["ID"]."', '".$valor."')");    
                        }
                        }
                        else{
                            $alerta=[
                                "tipo"=>"simple",
                                "titulo"=>"Ocurrió un error inesperado",
                                "texto"=>"No podemos leer $reolques_asignados",
                                "icono"=>"error"
                            ];
                            return json_encode($alerta);
                            exit();
                        }
                }
                //SE ACTUALIZA DOLLY SI ESTE EXISTE
                if($dolly_asignado!=""){
                    $update_unidad=$this->ejecutarConsulta("UPDATE `vehiculos` SET `ESTATUS` = '1' WHERE ID='$dolly_asignado_ID'");                             
                    $id_relacion=$this->ejecutarConsulta("INSERT INTO `relacion_operador_vehiculo` (`ID`, `ID_TRACTO`, `ID_REMOLQUES`) VALUES (NULL, '".$last_idaux["ID"]."', '".$dolly_asignado_ID."')");
                }
    
            
                

                $alerta=[
                    "tipo"=>"limpiar",
                    "titulo"=>"El Vehículo fue registrado",
                    "texto"=>"El Vehículo ".$marca." se registro con exito",
                    "icono"=>"success"
                ];
                return json_encode($alerta);
            }

            function remisionListaControlador(){
                $lista = array();
                
                $drop_list=$this->ejecutarConsulta("SELECT `ID`,`FOTO_UNIDAD`,`NOVEHICULO`,`TIPO_VEHICULO`,`DOBLE_ARTICULADO`,`OPERADOR`,`LINK_GPS` FROM vehiculos WHERE `TIPO_VEHICULO` LIKE '%TRACTO%' AND `ESTATUS`=!1");			
                $fila = $drop_list->fetchall();
        
                foreach ($fila as $row) {
                    $lista[]= array(
                        "ID" => $row["ID"],
                        "IMG" => $row["FOTO_UNIDAD"],
                        "NOVEHICULO" => $row["NOVEHICULO"],
                        "TIPO" => $row["TIPO_VEHICULO"],
                        "OPERADOR" => $row["OPERADOR"],
                        "DOBLE_ARTICULADO" => $row["DOBLE_ARTICULADO"],
                        "GPS" => $row["LINK_GPS"]                        
                        );
                }
                return json_encode($lista);
                #SELECT CO.NOMBRE AS OPERADOR, V.NOVEHICULO AS VEHICULO ,V.TIPO_VEHICULO FROM relacion_operador_vehiculo R INNER JOIN vehiculos V ON R.ID_VEHICULO=V.ID INNER JOIN colaborador CO ON R.ID_OPERADOR=CO.ID GROUP BY R.ID_OPERADOR 
            }

            function remisionRmolqueDrill(){
                $lista = array();
                
                $drop_list=$this->ejecutarConsulta("SELECT re.`ID_TRACTO` AS ID, ve.NOVEHICULO, ve.TIPO_REMOLQUE, ve.TIPO_VEHICULO, ve.FOTO_UNIDAD FROM `relacion_operador_vehiculo` re JOIN vehiculos ve ON re.ID_REMOLQUES=ve.ID ");			
                $fila = $drop_list->fetchall();
        
                foreach ($fila as $row) {
                    $lista[]= array(
                        "ID" => $row["ID"],
                        "IMG" => $row["FOTO_UNIDAD"],
                        "NOVEHICULO" => $row["NOVEHICULO"],
                        "TIPO" => $row["TIPO_REMOLQUE"],
                        "TIPO_VEHICULO" => $row["TIPO_VEHICULO"]                                              
                        );
                }
                return json_encode($lista);
                #SELECT CO.NOMBRE AS OPERADOR, V.NOVEHICULO AS VEHICULO ,V.TIPO_VEHICULO FROM relacion_operador_vehiculo R INNER JOIN vehiculos V ON R.ID_VEHICULO=V.ID INNER JOIN colaborador CO ON R.ID_OPERADOR=CO.ID GROUP BY R.ID_OPERADOR 
            }
        }
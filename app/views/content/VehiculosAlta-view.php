<script>
$(document).ready(function() {
    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/getID.php";
    $.ajax({
        url: crudServiceBaseUrl + "?variable=get_ID", // Archivo PHP que contiene los datos
        type: "GET", // Método HTTP (GET o POST)
        success: function(info) {
            // Manejar la respuesta del servidor
            if (info) {
                $('#no_vehiculo_folio').val(info);
                $('#no_vehiculo').val(info);
            } else {
                // $("#resultado").html("Error: " + response.message);
            }
        }
    });
});
</script>

<div class="row gx-3">
    <div class="col-sm-12">

        <div class="card mb-3">
            <div class="card-body">

                <div class="card-header">
                    <h5 class="card-title">Agregar Vehículo</h5>
                </div>

                <div class="col-sm-12">
                    <div class="bg-light rounded-2 px-3 py-2 mb-3">
                        <h6 class="m-0">Datos del Vehículo</h6>
                    </div>
                </div>
                <form class="row g-3 needs-validation FormularioAjax"
                    action="<?php echo APP_URL; ?>app/ajax/vehiculosAjax.php" method="POST" autocomplete="off"
                    id="vehiculo_catalogo" enctype="multipart/form-data">
                    <input type="hidden" name="vehiculosCatalogo" value="registrar">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label for="no_vehiculo" class="form-label">No. de Vehículo</label>
                            <input type="text" class="form-control" id="no_vehiculo_folio" disabled>
                            <input type="hidden" class="form-control" id="no_vehiculo" name="no_vehiculo">

                            <div class="invalid-feedback">Por favor, ingresa el número de vehículo.</div>
                        </div>

                        <!-- tipo vehiculo -->
                        <div class="col-md-4">
                            <div class="k-d-flex k-justify-content-center">
                                <div class="k-w-300">
                                    <label for="tipos_vehiculos" style="padding-bottom: 9px;">Tipo de Vehículo</label>
                                    <input class="form-control" id="tipos_vehiculos" name="tipos_vehiculos"
                                        style="width: 100%;" />
                                </div>
                            </div>
                            <script id="noDataTemplatetipos_vehiculos" type="text/x-kendo-tmpl">
                                <div>No se encontró dentro de la base de datos desea guardar a : - '#: instance.text() #' ?</div>
<br />
<button class="k-button" onclick="addNewtipos_vehiculos('#: instance.element[0].id #', '#: instance.text() #')">¿Agregar nuevo tipo de Vehículo? </button>
</script>
                            <!-- segunda seccion  -->
                            <script>
                            var tipos_vehiculos = [];
                            var sampleDataNexttipos_vehiculos = 0;

                            function getIndexByIdtipos_vehiculos(id) {
                                var idx, l = tipos_vehiculos.length;
                                for (var j = 0; j < l; j++) {
                                    if (tipos_vehiculos[j].ID == id) {
                                        return j;
                                    }
                                }
                                return null;
                            }

                            function addNewtipos_vehiculos(widgetId, value) {
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                var widget = $('#' + widgetId).getKendoComboBox();
                                var dataSource = widget.dataSource;
                                var id = getIndexByIdtipos_vehiculos(sampleDataNexttipos_vehiculos);
                                if (confirm('¿Está seguro?')) {
                                    dataSource.add({
                                        ID: id,
                                        NOMBRE: value
                                    });
                                    dataSource.one('sync', function() {
                                        widget.close();
                                    });
                                    dataSource.sync();
                                    $.ajax({
                                        url: crudServiceBaseUrl + "?catalogo_droplist=registrar",
                                        data: {
                                            TABLA: 'd_tipo_vehiculo',
                                            VALUE: value
                                        },
                                        type: 'post',
                                        success: function(data) {
                                            alert('la inserción: ' + data);
                                        }
                                    });
                                }
                            };
                            </script>
                            <script>
                            $(document).ready(function() {
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                var tipos_vehiculos_data = new kendo.data.DataSource({
                                    transport: {
                                        read: function(e) {
                                            $.getJSON(crudServiceBaseUrl +
                                                "?catalogo_droplist=leer&TABLA=d_tipo_vehiculo",
                                                function(result) {
                                                    var data = JSON.stringify(result, null, 2);
                                                    tipos_vehiculos = result;
                                                    console.log(tipos_vehiculos);
                                                    sampleDataNexttipos_vehiculos =
                                                        tipos_vehiculos.length;
                                                    console.log(tipos_vehiculos);
                                                    e.success(tipos_vehiculos);

                                                });

                                        },
                                        create: function(e) {
                                            e.data.ID = sampleDataNexttipos_vehiculos++;
                                            tipos_vehiculos.push(e.data);
                                            console.log(tipos_vehiculos);
                                            e.success(e.data);
                                        },
                                        parameterMap: function(options, operation) {
                                            if (operation !== "read" && options.models) {
                                                return {
                                                    models: kendo.stringify(options.models)
                                                };
                                            }
                                        }
                                    },
                                    schema: {
                                        model: {
                                            id: "ID",
                                            fields: {
                                                ID: {
                                                    type: "number"
                                                },
                                                NOMBRE: {
                                                    type: "string"
                                                }
                                            }
                                        }
                                    }
                                });
                                $("#tipos_vehiculos").kendoComboBox({
                                    filter: "startswith",
                                    dataTextField: "NOMBRE",
                                    dataValueField: "ID",
                                    dataSource: tipos_vehiculos_data,
                                    change: onChange,
                                    noDataTemplate: $("#noDataTemplatetipos_vehiculos").html()
                                });

                                function onChange() {
                                    var dropdownlist_tipos_vehiculos = $("#tipos_vehiculos").data(
                                        "kendoComboBox");

                                    var selectedDataItem_tipos_vehiculos = dropdownlist_tipos_vehiculos
                                        .dataItem();

                                    console.log(selectedDataItem_tipos_vehiculos.NOMBRE);
                                    const cadena = selectedDataItem_tipos_vehiculos.NOMBRE;


                                    if (cadena.includes("Tracto")) {
                                        $("#no_motorContainer").show();
                                        $("#tipoCombustibleContainer").show();
                                        $("#capacidadCombustibleContainer").show();
                                        $("#verificacionMecanicaContainer").show();
                                        $("#file_verificacionMecanicaContainer").show();
                                        $("#vigenciaContainer").show();
                                        $("#verificacionAmbientalContainer").show();
                                        $("#vigenciaVerificacionAmbientalContainer").show();
                                        $("#file_verificacionAmbientalContainer").show();
                                        $("#operadorContainer").show();
                                        $("#remolqueContainer").show();
                                        $("#tarjetaCirculacionContainer").show();
                                        $("#file_tarjetaCirculacionContainer").show();
                                        $("#remolqueAsignaContainer").show();
                                        $("#gpsContainer").show();
                                        
                                        $("#dobleArticuladoContainer").show();
                                        $("#placasContainer").show();
                                        $("#tipo_remolqueContainer").hide();
                                    } else if (selectedDataItem_tipos_vehiculos.NOMBRE == 'Remolque') {
                                        $("#tipo_remolqueContainer").show();
                                        $("#verificacionMecanicaContainer").show();
                                        $("#file_verificacionMecanicaContainer").show();
                                        $("#vigenciaContainer").show();
                                        $("#tarjetaCirculacionContainer").show();
                                        $("#file_tarjetaCirculacionContainer").show();
                                        $("#placasContainer").show();
                                        $("#tipoCombustibleContainer").hide();
                                        $("#capacidadCombustibleContainer").hide();
                                        $("#no_motorContainer").hide();
                                        $("#operadorContainer").hide();
                                        $("#remolqueContainer").hide();
                                        $("#verificacionAmbientalContainer").hide();
                                        $("#vigenciaVerificacionAmbientalContainer").hide();
                                        $("#file_verificacionAmbientalContainer").hide();
                                        $("#remolqueAsignaContainer").hide();
                                        $("#dobleArticuladoContainer").hide();
                                        $("#gpsContainer").show();

                                    } else if (selectedDataItem_tipos_vehiculos.NOMBRE == 'Dolly') {
                                        $("#tipo_remolqueContainer").hide();
                                        $("#verificacionMecanicaContainer").show();
                                        $("#file_verificacionMecanicaContainer").show();
                                        $("#vigenciaContainer").show();
                                        $("#placasContainer").hide();
                                        $("#tipoCombustibleContainer").hide();
                                        $("#capacidadCombustibleContainer").hide();
                                        $("#no_motorContainer").hide();
                                        $("#operadorContainer").hide();
                                        $("#remolqueContainer").hide();
                                        $("#verificacionAmbientalContainer").hide();
                                        $("#vigenciaVerificacionAmbientalContainer").hide();
                                        $("#file_verificacionAmbientalContainer").hide();
                                        $("#tarjetaCirculacionContainer").hide();
                                        $("#file_tarjetaCirculacionContainer").hide();
                                        $("#remolqueAsignaContainer").hide();
                                        $("#dobleArticuladoContainer").hide();
                                        $("#gpsContainer").hide();

                                    } else if (selectedDataItem_tipos_vehiculos.NOMBRE != 'Remolque' &&
                                        selectedDataItem_tipos_vehiculos.NOMBRE != 'Particular' &&
                                        selectedDataItem_tipos_vehiculos.NOMBRE != 'Dolly') {
                                        $("#no_motorContainer").show();
                                        $("#placasContainer").show();
                                        $("#tipoCombustibleContainer").show();
                                        $("#capacidadCombustibleContainer").show();
                                        $("#verificacionMecanicaContainer").show();
                                        $("#file_verificacionMecanicaContainer").show();
                                        $("#vigenciaContainer").show();
                                        $("#tarjetaCirculacionContainer").show();
                                        $("#file_tarjetaCirculacionContainer").show();
                                        $("#verificacionAmbientalContainer").show();
                                        $("#vigenciaVerificacionAmbientalContainer").show();
                                        $("#file_verificacionAmbientalContainer").show();
                                        $("#operadorContainer").hide();
                                        $("#remolqueContainer").hide();
                                        $("#tipo_remolqueContainer").hide();
                                        $("#remolqueAsignaContainer").hide();
                                        $("#dobleArticuladoContainer").hide();
                                        $("#gpsContainer").hide();

                                    }

                                };

                            });
                            </script>

                        </div>

                        <!-- imagen unidad -->
                        <div class="col-md-4">
                            <label for="validationCustom04" class="form-label">Imagen de la unidad / JPG, JPEG, PNG.
                                (MAX
                                5MB)</label>
                            <input class="form-control" type="file" id="formFile" name="unidad_foto"
                                accept=".jpg, .png, .jpeg">

                            <div class="invalid-feedback">
                                Se verificará!
                            </div>
                        </div>

                        <!-- tipo remolque -->
                        <div class="col-md-4" id="tipo_remolqueContainer" style="display: none;">
                            <div class="k-d-flex k-justify-content-center">
                                <div class="k-w-300">
                                    <label for="tipos_remolques" style="padding-bottom: 9px;">Tipo de remolque</label>
                                    <input class="form-control" id="tipos_remolques" name="tipos_remolques"
                                        style="width: 100%;" />
                                </div>
                            </div>
                            <script id="noDataTemplatetipos_remolques" type="text/x-kendo-tmpl">
                                <div>No se encontró dentro de la base de datos desea guardar a : - '#: instance.text() #' ?</div>
                <br />
            <button class="k-button" onclick="addNewtipos_remolques('#: instance.element[0].id #', '#: instance.text() #')">¿Agregar nuevo tipo de remolques? </button>
        </script>
                            <!-- segunda seccion  -->
                            <script>
                            var tipos_remolques = [];
                            var sampleDataNexttipos_remolques = 0;

                            function getIndexByIdtipos_remolques(id) {
                                var idx, l = tipos_remolques.length;
                                for (var j = 0; j < l; j++) {
                                    if (tipos_remolques[j].ID == id) {
                                        return j;
                                    }
                                }
                                return null;
                            }

                            function addNewtipos_remolques(widgetId, value) {
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                var widget = $('#' + widgetId).getKendoComboBox();
                                var dataSource = widget.dataSource;
                                var id = getIndexByIdtipos_remolques(sampleDataNexttipos_remolques);
                                if (confirm('¿Está seguro?')) {
                                    dataSource.add({
                                        ID: id,
                                        NOMBRE: value
                                    });
                                    dataSource.one('sync', function() {
                                        widget.close();
                                    });
                                    dataSource.sync();
                                    $.ajax({
                                        url: crudServiceBaseUrl + "?catalogo_droplist=registrar",
                                        data: {
                                            TABLA: 'd_tipos_remolques',
                                            VALUE: value
                                        },
                                        type: 'post',
                                        success: function(data) {
                                            alert('la inserción: ' + data);
                                        }
                                    });
                                }
                            };
                            </script>
                            <script>
                            $(document).ready(function() {
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                var tipos_remolques_data = new kendo.data.DataSource({
                                    transport: {
                                        read: function(e) {
                                            $.getJSON(crudServiceBaseUrl +
                                                "?catalogo_droplist=leer&TABLA=d_tipos_remolques",
                                                function(result) {
                                                    var data = JSON.stringify(result, null, 2);
                                                    tipos_remolques = result;
                                                    console.log(tipos_remolques);
                                                    sampleDataNexttipos_remolques =
                                                        tipos_remolques.length;
                                                    console.log(tipos_remolques);
                                                    e.success(tipos_remolques);

                                                });

                                        },
                                        create: function(e) {
                                            e.data.ID = sampleDataNexttipos_remolques++;
                                            tipos_remolques.push(e.data);
                                            console.log(tipos_remolques);
                                            e.success(e.data);
                                        },
                                        parameterMap: function(options, operation) {
                                            if (operation !== "read" && options.models) {
                                                return {
                                                    models: kendo.stringify(options.models)
                                                };
                                            }
                                        }
                                    },
                                    schema: {
                                        model: {
                                            id: "ID",
                                            fields: {
                                                ID: {
                                                    type: "number"
                                                },
                                                NOMBRE: {
                                                    type: "string"
                                                }
                                            }
                                        }
                                    }
                                });
                                $("#tipos_remolques").kendoComboBox({
                                    filter: "startswith",
                                    dataTextField: "NOMBRE",
                                    dataValueField: "ID",
                                    dataSource: tipos_remolques_data,
                                    change: onChange,
                                    noDataTemplate: $("#noDataTemplatetipos_remolques").html()
                                });

                                function onChange() {
                                    var dropdownlist_tipos_remolques = $("#tipos_remolques").data(
                                        "kendoComboBox");
                                    var dropdownlist_area = $("#area").data("kendoComboBox");

                                    var selectedDataItem_tipos_remolques = dropdownlist_tipos_remolques
                                        .dataItem();
                                    var selectedDataItem_area = dropdownlist_area.dataItem();
                                    if ((selectedDataItem_area.NOMBRE == 'Operativa') && (
                                            selectedDataItem_tipos_remolques.NOMBRE == 'Operativo' ||
                                            selectedDataItem_tipos_remolques.NOMBRE == 'Operador')) {
                                        $('#licenciaContainer').show();
                                        $('#licenciaVigenciaContainer').show();
                                        $('#folioExamenMedicoContainer').show();
                                        $('#examenMedicoContainer').show();
                                        $('#folioAntiContainer').show();
                                        $('#fechaAntiContainer').show();
                                        $('#folioAntecedentesContainer').show();


                                    } else {
                                        console.log("No se ha seleccionado ningún elemento.");
                                        $('#licenciaContainer').hide();
                                        $('#licenciaVigenciaContainer').hide();
                                        $('#folioExamenMedicoContainer').hide();
                                        $('#examenMedicoContainer').hide();
                                        $('#folioAntiContainer').hide();
                                        $('#fechaAntiContainer').hide();
                                        $('#folioAntecedentesContainer').hide();
                                    }
                                };
                            });
                            </script>
                        </div>

                        <div class="mb-3" id="gpsContainer" style="display: none;" >
                            <label class="form-label">GPS
                            </label>
                            <div class="m-0">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gps" id="si" value="si">
                                    <label class="form-check-label" for="alContado">SI</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gps" id="no" value="no" checked>
                                    <label class="form-check-label" for="no">NO</label>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3" id="gps_proveedorContainer" style="display: none;">
                            <label for="proveedor_gps" class="form-label">Proveedor de GPS</label>
                            <input type="text" class="form-control" id="proveedor_gps" name="proveedor_gps">
                            <div class="invalid-feedback">Por favor, ingresa la proveedor.</div>
                        </div>
                        <div class="col-md-3" id="gps_imeiContainer" style="display: none;">
                            <label for="imei" class="form-label">IMEI</label>
                            <input type="text" class="form-control" id="imei" name="imei">
                            <div class="invalid-feedback">Por favor, ingresa la IMEI.</div>
                        </div>

                        <div class="col-md-3" id="gps_linkContainer" style="display: none;">
                            <label for="link_gps" class="form-label">Link</label>
                            <input type="text" class="form-control" id="link_gps" name="link_gps">
                            <div class="invalid-feedback">Por favor, ingresa link.</div>
                        </div>

                        <div class="col-md-3" id="gps_fechaContainer" style="display: none;">
                            <label for="fecha_instalacion_gps" class="form-label">Fecha Instalación GPS</label>
                            <input type="date" class="form-control" id="fecha_instalacion_gps"
                                name="fecha_instalacion_gps">
                            <div class="invalid-feedback">Por favor, ingresa la fecha_instalacion_gps.</div>
                        </div>


                        <script>
                        $(document).ready(function() {
                            $('input[name="gps"]').change(function() {
                                if ($(this).val() === 'si') {
                                    $('#gps_proveedorContainer').show();
                                    $('#gps_imeiContainer').show();
                                    $("#gps_fechaContainer").show();
                                    $("#gps_linkContainer").show();

                                } else {
                                    $('#gps_proveedorContainer').hide();
                                    $('#gps_imeiContainer').hide();
                                    $("#gps_fechaContainer").hide();
                                    $("#gps_linkContainer").hide();

                                }
                            });
                        });
                        </script>

                        <div class="col-md-3">
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca">
                            <div class="invalid-feedback">Por favor, ingresa la marca.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="modelo" class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo">
                            <div class="invalid-feedback">Por favor, ingresa el modelo.</div>
                        </div>
                        <div class="col-md-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" name="color">
                            <div class="invalid-feedback">Por favor, ingresa el color.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="anio" class="form-label">Año</label>
                            <input type="number" class="form-control" id="anio" name="anio" min="1900" max="2099">
                            <div class="invalid-feedback">Por favor, ingresa el año.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="serie" class="form-label">Serie</label>
                            <input type="text" class="form-control" id="serie" name="serie">
                            <div class="invalid-feedback">Por favor, ingresa la serie.</div>
                        </div>

                        <div class="col-md-3" id="placasContainer" style="display: none;">
                            <label for="placas" class="form-label">Placas</label>
                            <input type="text" class="form-control" id="placas" name="placas">
                            <div class="invalid-feedback">Por favor, ingresa las placas.</div>
                        </div>

                        <div class="col-md-3" id="tarjetaCirculacionContainer" style="display: none;">
                            <label for="tarjeta_circulacion" class="form-label">Tarjeta de Circulación</label>
                            <input type="text" class="form-control" id="tarjeta_circulacion" name="tarjeta_circulacion">
                            <div class="invalid-feedback">Por favor, ingresa la información de la tarjeta de
                                circulación.</div>
                        </div>


                        <div class="col-md-3" id="file_tarjetaCirculacionContainer" style="display: none;">
                            <label for="tarjeta_circulacion" class="form-label">Tarjeta de Circulación (PDF. MAX
                                5MB)</label>
                            <input class="form-control" type="file" id="tarjeta_circulacion" name="file_tarjeta_circulacion"
                                accept=".pdf">
                            <div id="error-tarjeta_circulacion" class="error"></div>
                        </div>



                        <div class="col-md-3" id="no_motorContainer" style="display: none;">
                            <label for="no_motor" class="form-label">No. de Motor</label>
                            <input type="text" class="form-control" id="no_motor" name="no_motor">
                            <div class="invalid-feedback">Por favor, ingresa el número de motor.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="valor_unidad" class="form-label">Valor de la Unidad</label>
                            <input type="number" class="form-control" id="valor_unidad" name="valor_unidad" step="0.01">
                            <div class="invalid-feedback">Por favor, ingresa el valor de la unidad.</div>
                        </div>
                        <div class="col-md-3">
                            <label for="no_factura" class="form-label">No. de Factura</label>
                            <input type="text" class="form-control" id="no_factura" name="no_factura">
                            <div class="invalid-feedback">Por favor, ingresa el número de factura.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="factura" class="form-label">Factura (PDF. MAX 5MB)</label>
                            <input class="form-control" type="file" id="factura" name="file_factura" accept=".pdf">
                            <div id="error-factura" class="error"></div>
                        </div>

                        <div class="col-md-12">
                            <label for="razon_social" class="form-label">Razón Social Propietario</label>
                            <input class="form-control" id="razon_social" name="razon_social" style="width: 100%;">
                            <div class="invalid-feedback">Por favor, ingresa la razón social del propietario.</div>
                            <script>
                            $(document).ready(function() {
                                var operador = [];
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                var operador_data = new kendo.data.DataSource({
                                    transport: {
                                        read: function(e) {
                                            $.getJSON(crudServiceBaseUrl +
                                                "?catalogo_droplist=leer_razon",
                                                function(result) {
                                                    var data = JSON.stringify(result, null, 2);
                                                    operador = result;

                                                    sampleDataNextoperador = operador.length;

                                                    e.success(operador);

                                                });

                                        },

                                        parameterMap: function(options, operation) {
                                            if (operation !== "read" && options.models) {
                                                return {
                                                    models: kendo.stringify(options.models)
                                                };
                                            }
                                        }
                                    },
                                    schema: {
                                        model: {
                                            id: "ID",
                                            fields: {
                                                ID: {
                                                    type: "number"
                                                },
                                                NOMBRE: {
                                                    type: "string"
                                                },
                                                RFC: {
                                                    type: "string"
                                                }
                                            }
                                        }
                                    }
                                });
                                $("#razon_social").kendoComboBox({

                                    template: '<span class="ID">#= RFC #</span> #= NOMBRE #',
                                    dataTextField: "NOMBRE",
                                    dataValueField: "ID",
                                    dataSource: operador_data,
                                    filter: "contains",
                                });

                            });
                            </script>

                        </div>

                        <div class="col-md-6" id="tipoCombustibleContainer" style="display: none;">
                            <label for="tipo_combustible" class="form-label">Tipo de Combustible</label>
                            <select class="form-select" id="tipo_combustible" name="tipo_combustible">
                                <option value="">Selecciona...</option>
                                <option value="gasolina">Gasolina</option>
                                <option value="diesel">Diesel</option>
                            </select>
                            <div class="invalid-feedback">Por favor, selecciona el tipo de combustible.</div>
                        </div>


                        <div class="col-md-6" id="capacidadCombustibleContainer" style="display: none;">
                            <label for="capacidad_combustible" class="form-label">Capacidad Combustible</label>
                            <input type="number" class="form-control" id="capacidad_combustible"
                                name="capacidad_combustible">
                            <div class="invalid-feedback">Por favor, ingresa la capacidad de combustible.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="aseguradora" class="form-label">Aseguradora</label>
                            <input type="text" class="form-control" id="aseguradora" name="aseguradora">
                            <div class="invalid-feedback">Por favor, ingresa la aseguradora.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="no_poliza" class="form-label">No. de Póliza</label>
                            <input type="text" class="form-control" id="no_poliza" name="no_poliza">
                            <div class="invalid-feedback">Por favor, ingresa el número de póliza.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="poliza_seguro" class="form-label">Póliza de Seguro (PDF. MAX 5MB)</label>
                            <input class="form-control" type="file" id="poliza_seguro" name="file_poliza_seguro"
                                accept=".pdf">
                            <div id="error-poliza_seguro" class="error"></div>
                        </div>

                        <div class="col-md-3">
                            <label for="vigencia_poliza" class="form-label">Vigencia de la Póliza</label>
                            <input type="date" class="form-control" id="vigencia_poliza" name="vigencia_poliza">
                            <div class="invalid-feedback">Por favor, ingresa la vigencia de la póliza.</div>
                        </div>

                        <div class="col-md-4" id="verificacionMecanicaContainer" style="display: none;">
                            <label for="verificacion_mecanica" class="form-label">Verificación Mecánica</label>
                            <input type="text" class="form-control" id="verificacion_mecanica"
                                name="verificacion_mecanica">
                            <div class="invalid-feedback">Por favor, ingresa la información de la verificación mecánica.
                            </div>
                        </div>

                        <div class="col-md-4" id="file_verificacionMecanicaContainer" style="display: none;">
                            <label for="verificacion_mecanica" class="form-label">Verificación Mecánica (PDF. MAX
                                5MB)</label>
                            <input class="form-control" type="file" id="verificacion_mecanica"
                                name="file_verificacion_mecanica" accept=".pdf">
                            <div id="error-verificacion_mecanica" class="error"></div>
                        </div>

                        <div class="col-md-4" id="vigenciaContainer" style="display: none;">
                            <label for="vigencia_verificacion_mecanica" class="form-label">Vigencia (Verificación
                                Mecánica)</label>
                            <input type="date" class="form-control" id="vigencia_verificacion_mecanica"
                                name="vigencia_verificacion_mecanica">
                            <div class="invalid-feedback">Por favor, ingresa la vigencia de la verificación mecánica.
                            </div>
                        </div>

                        <div class="col-md-4" id="verificacionAmbientalContainer" style="display: none;">
                            <label for="verificacion_ambiental" class="form-label">Verificación Ambiental</label>
                            <input type="text" class="form-control" id="verificacion_ambiental"
                                name="verificacion_ambiental">
                            <div class="invalid-feedback">Por favor, ingresa la información de la verificación
                                ambiental.</div>
                        </div>

                        <div class="col-md-4" id="file_verificacionAmbientalContainer" style="display: none;">
                            <label for="verificacion_ambiental" class="form-label">Verificación Ambiental (PDF. MAX
                                5MB)</label>
                            <input class="form-control" type="file" id="verificacion_ambiental"
                                name="file_verificacion_ambiental" accept=".pdf">
                            <div id="error-verificacion_ambiental" class="error"></div>
                        </div>

                        <div class="col-md-4" id="vigenciaVerificacionAmbientalContainer" style="display: none;">
                            <label for="vigencia_verificacion_ambiental" class="form-label">Vigencia (Verificación
                                Ambiental)</label>
                            <input type="date" class="form-control" id="vigencia_verificacion_ambiental"
                                name="vigencia_verificacion_ambiental">
                            <div class="invalid-feedback">Por favor, ingresa la vigencia de la verificación ambiental.
                            </div>
                        </div>
                        <!-- OPERADOR -->
                        <div class="col-md-12" id="operadorContainer" style="display: none;">
                            <label for="operador_asignado" class="form-label">Operador Asignado</label>
                            <input type="text" class="form-control" id="operador_asignado" name="operador_asignado"
                                style="width: 100%;">
                            <div class="invalid-feedback">Por favor, ingresa el nombre del operador asignado.</div>
                            <script>
                            $(document).ready(function() {
                                var operador = [];
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                var operador_data = new kendo.data.DataSource({
                                    transport: {
                                        read: function(e) {
                                            $.getJSON(crudServiceBaseUrl +
                                                "?catalogo_droplist=leer_operador",
                                                function(result) {
                                                    var data = JSON.stringify(result, null, 2);
                                                    operador = result;
                                                    sampleDataNextoperador = operador.length;
                                                    e.success(operador);
                                                });
                                        },
                                        parameterMap: function(options, operation) {
                                            if (operation !== "read" && options.models) {
                                                return {
                                                    models: kendo.stringify(options.models)
                                                };
                                            }
                                        }
                                    },
                                    schema: {
                                        model: {
                                            id: "ID",
                                            fields: {
                                                ID: {
                                                    type: "number"
                                                },
                                                NOMBRE: {
                                                    type: "string"
                                                },
                                                NOEMPLADO: {
                                                    type: "string"
                                                }
                                            }
                                        }
                                    }
                                });
                                $("#operador_asignado").kendoComboBox({
                                    template: '<span class="ID">#= NOEMPLADO #</span> #= NOMBRE #',
                                    dataTextField: "NOMBRE",
                                    dataValueField: "ID",
                                    dataSource: operador_data,
                                    filter: "contains"
                                });

                            });
                            </script>
                        </div>



                        <div class="mb-3" id="dobleArticuladoContainer" style="display: none;">
                            <label class="form-label">Doble articulado
                            </label>
                            <div class="m-0">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="dobleArticulado" id="doble_si"
                                        value="si">
                                    <label class="form-check-label" for="alContado">SI</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="dobleArticulado" id="doble_no"
                                        value="no" checked>
                                    <label class="form-check-label" for="no">NO</label>
                                </div>
                            </div>
                        </div>

                        <script>
                        $(document).ready(function() {
                            $('input[name="dobleArticulado"]').change(function() {
                                if ($(this).val() === 'si') {
                                    $('#dollyContainer').show();
                                    

                                } else {
                                    $('#dollyContainer').hide();

                                }
                            });
                        });
                        </script>
                        <div class="col-md-6" id="dollyContainer" style="display: none;">
                            <label for="remolque_asignado" class="form-label">Asignar DOLLY</label>
                            <input type="text" class="form-control" id="dolly_asignado" name="dolly_asignado"
                                style="width: 100%;">
                            <div class="invalid-feedback">Por favor, ingresa elremoolque asignado.</div>
                            <script>
                            $(document).ready(function() {
                                var operador = [];
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                var operador_data = new kendo.data.DataSource({
                                    transport: {
                                        read: function(e) {
                                            $.getJSON(crudServiceBaseUrl +
                                                "?catalogo_droplist=leer_dolly",
                                                function(result) {
                                                    var data = JSON.stringify(result, null,
                                                        2);
                                                    operador = result;

                                                    sampleDataNextoperador = operador
                                                        .length;

                                                    e.success(operador);

                                                });

                                        },

                                        parameterMap: function(options, operation) {
                                            if (operation !== "read" && options.models) {
                                                return {
                                                    models: kendo.stringify(options.models)
                                                };
                                            }
                                        }
                                    },
                                    schema: {
                                        model: {
                                            id: "ID",
                                            fields: {
                                                ID: {
                                                    type: "number"
                                                },
                                                NOMBRE: {
                                                    type: "string"
                                                }
                                            }
                                        }
                                    }
                                });
                                $("#dolly_asignado").kendoComboBox({

                                    template: '<span class="ID">#= NOMBRE #',
                                    dataTextField: "NOMBRE",
                                    dataValueField: "ID",
                                    dataSource: operador_data,
                                    filter: "contains",
                                });

                            });
                            </script>


                        </div>




                        <div class="col-md-12" id="remolqueAsignaContainer" style="display: none;">
                            <label for="remolque_asignado" class="form-label">Asignar Remolque</label>
                            <div id="example" role="application">
                                <div class="demo-section wide">
                                    <select id="optional"></select>
                                    <select id="selected"  name="reolques_asignados[]"></select>
                                </div>
                                </div>
                                <script>
                                $(document).ready(function() {
                                    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";

                                    var customerTemplate =
                                        '<span class="k-state-default" style="background-image: url(\'<?php echo APP_URL;?>#:data.FOTO#\')"></span>' +
                                        '<span class="k-state-default"><h3>#: data.NOMBRE #</h3><p>#: data.TIPO_REMOLQUE #</p></span>';
                                    var listbox2 = $("#optional").kendoListBox({
                                        dataTextField: "NOMBRE",
                                        dataValueField: "ID",
                                        template: customerTemplate,
                                        dataSource: {
                                            transport: {
                                                read: {
                                                    dataType: "json",
                                                    url: crudServiceBaseUrl +
                                                        "?catalogo_droplist=leer_remolque",
                                                }
                                            }
                                        },
                                        draggable: {
                                            placeholder: customPlaceholder
                                        },
                                        dropSources: ["selected"],
                                        connectWith: "selected",
                                        toolbar: {
                                            position: "right",
                                            tools: ["transferTo", "transferFrom"]
                                        }
                                    });

                                    var listbox1 = $("#selected").kendoListBox({
                                        dataTextField: "NOMBRE",
                                        dataValueField: "ID",
                                        template: customerTemplate,
                                        draggable: {
                                            placeholder: customPlaceholder
                                        },
                                        dropSources: ["optional"],
                                        connectWith: "optional",
                                        add: onAdd,
                                        change: onChange,
                                        dataBound: onDataBound,
                                        dragstart: onDragStart,
                                        drag: onDrag,
                                        drop: onDrop,
                                        dragend: onDragEnd,
                                        remove: onRemove,
                                        reorder: onReorder
                                    });

                                    function customPlaceholder(draggedItem) {
                                        return draggedItem
                                            .clone()
                                            .addClass("custom-placeholder")
                                            .removeClass("k-ghost");
                                    }

                                    function onChange(e) {
                                        console.log("change : " + getWidgetName(e));
                                    }

                                    function onAdd(e) {
                                        var bandera = 0;
                                        if ($('#doble_si').prop("checked") || $('#doble_no').prop("checked")) {
                                            if ($('#doble_si').prop("checked")) {
                                                bandera = 2;
                                            } else {
                                                bandera = 1;
                                            }

                                        } else {
                                            alert("Selecciona si es doble articulado");
                                        }
                                        var selectedListBox = $("#selected").data("kendoListBox");
                                        console.log(bandera);
                                        console.log(selectedListBox.dataSource._data.length);
                                        console.log(e.dataItems[0].ID);


                                        console.log();
                                        if (selectedListBox.dataSource._data.length == bandera) {

                                            selectedListBox.enable(listbox2.select(), false);
                                            selectedListBox.toolbar.element.find(".k-button").addClass(
                                                "k-state-disabled");

                                        }



                                    }

                                    function onChange(e) {
                                        console.log("change : " + getWidgetName(e));
                                    }

                                    function onDataBound(e) {

                                        console.log("dataBound : " + getWidgetName(e));

                                    }

                                    function onRemove(e) {
                                        console.log("remove : " + getWidgetName(e) + " : " + e.dataItems
                                            .length + " item(s)");
                                    };

                                    function onReorder(e) {
                                        console.log("reorder : " + getWidgetName(e));
                                    }

                                    function onDragStart(e) {
                                        console.log("dragstart : " + getWidgetName(e));
                                    }

                                    function onDrag(e) {
                                        console.log("drag : " + getWidgetName(e));
                                    }

                                    function onDrop(e) {
                                        console.log("drop : " + getWidgetName(e));
                                    }

                                    function onDragEnd(e) {
                                        console.log("dragend : " + getWidgetName(e));
                                    }

                                    function getWidgetName(e) {
                                        var listBoxId = e.sender.element.attr("id");
                                        var widgetName = listBoxId === "optional" ? "left widget" :
                                            "right widget";
                                        return widgetName;
                                    }

                                });
                                </script>

                                <style>
                                #example .demo-section {
                                    max-width: none;
                                    width: 780px;
                                }

                                #example .k-listbox {
                                    width: 326px;
                                    height: 350px;
                                }

                                #example .k-listbox:first-child {
                                    width: 360px;
                                    margin-right: 1px;
                                }

                                .k-ghost {
                                    display: none !important;
                                }

                                .custom-placeholder {
                                    opacity: 0.4;
                                }

                                #example .k-item {
                                    line-height: 1em;
                                }

                                /* Material Theme padding adjustment*/

                                .k-material #example .k-item,
                                .k-material #example .k-item.k-hover,
                                .k-materialblack #example .k-item,
                                .k-materialblack #examplel .k-item.k-hover {
                                    padding-left: 5px;
                                    border-left: 0;
                                }

                                .k-item>span {
                                    -webkit-box-sizing: border-box;
                                    -moz-box-sizing: border-box;
                                    box-sizing: border-box;
                                    display: inline-block;
                                    vertical-align: top;
                                    margin: 20px 10px 10px 5px;
                                }

                                #example .k-item>span:first-child,
                                .k-item.k-drag-clue>span:first-child {
                                    -moz-box-shadow: inset 0 0 30px rgba(0, 0, 0, .3);
                                    -webkit-box-shadow: inset 0 0 30px rgba(0, 0, 0, .3);
                                    box-shadow: inset 0 0 30px rgba(0, 0, 0, .3);
                                    margin: 10px;
                                    width: 50px;
                                    height: 50px;
                                    border-radius: 50%;
                                    background-size: 100%;
                                    background-repeat: no-repeat;
                                }

                                #example h3,
                                .k-item.k-drag-clue h3 {
                                    font-size: 1.2em;
                                    font-weight: normal;
                                    margin: 0 0 1px 0;
                                    padding: 0;
                                }

                                #example p {
                                    margin: 0;
                                    padding: 0;
                                    font-size: .8em;
                                }
                                </style>
                                <div class="invalid-feedback">Por favor, ingresa elremoolque asignado.</div>
                                <script>
                                $(document).ready(function() {
                                    var operador = [];
                                    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                    var operador_data = new kendo.data.DataSource({
                                        transport: {
                                            read: function(e) {
                                                $.getJSON(crudServiceBaseUrl +
                                                    "?catalogo_droplist=leer_remolque",
                                                    function(result) {
                                                        var data = JSON.stringify(result, null,
                                                            2);
                                                        operador = result;
                                                        sampleDataNextoperador = operador
                                                            .length;
                                                        e.success(operador);
                                                    });
                                            },
                                            parameterMap: function(options, operation) {
                                                if (operation !== "read" && options.models) {
                                                    return {
                                                        models: kendo.stringify(options.models)
                                                    };
                                                }
                                            }
                                        },
                                        schema: {
                                            model: {
                                                id: "ID",
                                                fields: {
                                                    ID: {
                                                        type: "number"
                                                    },
                                                    NOMBRE: {
                                                        type: "string"
                                                    },
                                                    TIPO_REMOLQUE: {
                                                        type: "string"
                                                    }
                                                }
                                            }
                                        }
                                    });
                                    $("#remolque_asignado").kendoComboBox({
                                        template: '<span class="ID">#= TIPO_REMOLQUE #</span> #= NOMBRE #',
                                        dataTextField: "NOMBRE",
                                        dataValueField: "ID",
                                        dataSource: operador_data,
                                        filter: "contains",
                                    });
                                });
                                </script>
                            </div>

                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
                                    <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>

                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
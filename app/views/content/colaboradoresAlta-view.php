<script>
$(document).ready(function() {
    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/getID.php";
    $.ajax({
        url: crudServiceBaseUrl + "?variable=colaboradorGet_ID", // Archivo PHP que contiene los datos
        type: "GET", // Método HTTP (GET o POST)
        success: function(info) {
            // Manejar la respuesta del servidor
            if (info) {
                $('#no_empleado_folio').val(info);
                $('#no_empleado').val(info);
            } else {
                // $("#resultado").html("Error: " + response.message);
            }
        }
    });
});
</script>

<!-- Row starts -->
<div class="row gx-3">
    <div class="col-sm-12">

        <div class="card mb-3">
            <div class="card-body">

                <div class="card-header">
                    <h5 class="card-title">Agregar colaboradores</h5>
                </div>

                <div class="col-sm-12">
                    <div class="bg-light rounded-2 px-3 py-2 mb-3">
                        <h6 class="m-0">Datos Personales</h6>
                    </div>
                </div>

                <form class="row g-3 needs-validation FormularioAjax"
                    action="<?php echo APP_URL; ?>app/ajax/colaboradoresAjax.php" method="POST" autocomplete="off"
                    id="form_colaboradores" enctype="multipart/form-data">
                    <input type="hidden" name="catalogo_colaboradores" value="registrar">
                    <div class="col-md-12">
                        <label for="no_empleado" class="form-label">No. de Empleado</label>
                        <input type="text" class="form-control" id="no_empleado_folio" name="no_empleado_folio"
                            disabled>
                        <input type="hidden" class="form-control" id="no_empleado" name="no_empleado">
                        <div class="invalid-feedback">Por favor, ingresa el número de empleado.</div>
                    </div>
                    <!-- AREA -->
                    <div class="col-md-6">
                        <div class="k-d-flex k-justify-content-center">
                            <div class="k-w-300">
                                <label for="area">Área</label>
                                <input class="form-control" id="area" name="area" style="width: 100%;" />
                            </div>
                        </div>
                        <script id="noDataTemplatearea" type="text/x-kendo-tmpl">
                            <div>No se encontró dentro de la base de datos desea guardar a : - '#: instance.text() #' ?</div>
                    <br />
                    <button class="k-button" onclick="addNewarea('#: instance.element[0].id #', '#: instance.text() #')">¿Agregar una nueva área? </button>
                </script>
                        <!-- segunda seccion  -->
                        <script>
                        var area = [];
                        var sampleDataNextarea = 0;

                        function getIndexByIdarea(id) {
                            var idx, l = area.length;
                            for (var j = 0; j < l; j++) {
                                if (area[j].ID == id) {
                                    return j;
                                }
                            }
                            return null;
                        }

                        function addNewarea(widgetId, value) {
                            var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                            var widget = $('#' + widgetId).getKendoComboBox();
                            var dataSource = widget.dataSource;
                            var id = getIndexByIdarea(sampleDataNextarea);
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
                                        TABLA: 'd_area',
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
                            var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                            var area_data = new kendo.data.DataSource({

                                transport: {
                                    read: function(e) {
                                        $.getJSON(crudServiceBaseUrl +
                                            "?catalogo_droplist=leer&TABLA=d_area",
                                            function(result) {
                                                var data = JSON.stringify(result, null, 2);
                                                area = result;
                                                console.log(area);
                                                sampleDataNextarea = area.length;
                                                console.log(area);
                                                e.success(area);

                                            });

                                    },
                                    create: function(e) {
                                        e.data.ID = sampleDataNextarea++;
                                        area.push(e.data);
                                        console.log(area);
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
                            $("#area").kendoComboBox({
                                filter: "startswith",
                                dataTextField: "NOMBRE",
                                dataValueField: "ID",
                                dataSource: area_data,
                                noDataTemplate: $("#noDataTemplatearea").html()
                            });

                        });
                        </script>

                    </div>
                    <!-- CARGO -->
                    <div class="col-md-6">
                        <div class="k-d-flex k-justify-content-center">
                            <div class="k-w-300">
                                <label for="cargo">Cargo</label>
                                <input class="form-control" id="cargo" name="cargo" style="width: 100%;" />
                            </div>
                        </div>
                        <script id="noDataTemplatecargo" type="text/x-kendo-tmpl">
                            <div>No se encontró dentro de la base de datos desea guardar a : - '#: instance.text() #' ?</div>
                    <br />
                    <button class="k-button" onclick="addNewcargo('#: instance.element[0].id #', '#: instance.text() #')">¿Agregar nuevo cargo? </button>
                </script>
                        <!-- segunda seccion  -->
                        <script>
                        var cargo = [];
                        var sampleDataNextcargo = 0;

                        function getIndexByIdcargo(id) {
                            var idx, l = cargo.length;
                            for (var j = 0; j < l; j++) {
                                if (cargo[j].ID == id) {
                                    return j;
                                }
                            }
                            return null;
                        }

                        function addNewcargo(widgetId, value) {
                            var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                            var widget = $('#' + widgetId).getKendoComboBox();
                            var dataSource = widget.dataSource;
                            var id = getIndexByIdcargo(sampleDataNextcargo);
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
                                        TABLA: 'd_cargo',
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
                            var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                            var cargo_data = new kendo.data.DataSource({
                                transport: {
                                    read: function(e) {
                                        $.getJSON(crudServiceBaseUrl +
                                            "?catalogo_droplist=leer&TABLA=d_cargo",
                                            function(result) {
                                                var data = JSON.stringify(result, null, 2);
                                                cargo = result;
                                                console.log(cargo);
                                                sampleDataNextcargo = cargo.length;
                                                console.log(cargo);
                                                e.success(cargo);

                                            });

                                    },
                                    create: function(e) {
                                        e.data.ID = sampleDataNextcargo++;
                                        cargo.push(e.data);
                                        console.log(cargo);
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
                            $("#cargo").kendoComboBox({
                                filter: "startswith",
                                dataTextField: "NOMBRE",
                                dataValueField: "ID",
                                dataSource: cargo_data,
                                change: onChange,
                                noDataTemplate: $("#noDataTemplatecargo").html()
                            });

                            function onChange() {
                                var dropdownlist_cargo = $("#cargo").data("kendoComboBox");
                                var dropdownlist_area = $("#area").data("kendoComboBox");

                                var selectedDataItem_cargo = dropdownlist_cargo.dataItem();
                                var selectedDataItem_area = dropdownlist_area.dataItem();
                                if ((selectedDataItem_area.NOMBRE == 'Operativa') && (selectedDataItem_cargo
                                        .NOMBRE == 'Operativo' || selectedDataItem_cargo.NOMBRE == 'Operador'
                                    )) {
                                    $('#licenciaContainer').show();
                                    $('#licenciaVigenciaContainer').show();
                                    $('#folioExamenMedicoContainer').show();
                                    $('#examenMedicoContainer').show();
                                    $('#folioAntiContainer').show();
                                    $('#fechaAntiContainer').show();
                                    $('#folioAntecedentesContainer').show();

                                    $('#fileLicenciaContainer').show();
                                    $('#fileExamenMedicoContainer').show();
                                    $('#fileAntiContainer').show();
                                    $('#fileAntecedentesContainer').show();



                                } else {
                                    console.log("No se ha seleccionado ningún elemento.");
                                    $('#licenciaContainer').hide();
                                    $('#licenciaVigenciaContainer').hide();
                                    $('#folioExamenMedicoContainer').hide();
                                    $('#examenMedicoContainer').hide();
                                    $('#folioAntiContainer').hide();
                                    $('#fechaAntiContainer').hide();
                                    $('#folioAntecedentesContainer').hide();

                                    $('#fileLicenciaContainer').hide();
                                    $('#fileExamenMedicoContainer').hide();
                                    $('#fileAntiContainer').hide();
                                    $('#fileAntecedentesContainer').hide();
                                }
                            };

                        });
                        </script>

                    </div>

                    <!-- SECCION DATOS PERSONALES -->
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required pattern="[a-zA-Z\s]+"
                            minlength="3">
                        <div class="invalid-feedback">Por favor, ingresa tu nombre. (Solo letras y espacios, min. 3
                            caracteres)
                        </div>
                    </div>

                    <!-- foto colaborador -->
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Foto del Colaborador / JPG, JPEG, PNG. (MAX
                            5MB)</label>
                        <input class="form-control" type="file" id="formFile" name="foto" accept=".jpg, .png, .jpeg">
                        <div class="invalid-feedback">
                            Se verificará!
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="ine_id" class="form-label">ID INE</label>
                        <input type="text" class="form-control" id="ine_id" name="ine_id" required>
                        <div class="invalid-feedback">Por favor, ingresa tu ID INE.</div>
                    </div>

                    <!-- file ine colaborador -->
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">INE / PDF (MAX
                            5MB)</label>
                        <input class="form-control" type="file" id="formFile" name="file_ine" accept=".pdf">
                        <div class="invalid-feedback">
                            Se verificará!
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="curp" class="form-label">CURP</label>
                        <input type="text" class="form-control" id="curp" name="curp" required>
                        <div class="invalid-feedback">Por favor, ingresa tu CURP.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="rfc" class="form-label">RFC</label>
                        <input type="text" class="form-control" id="rfc" name="rfc" required>
                        <div class="invalid-feedback">Por favor, ingresa tu RFC.</div>
                    </div>




                    <div class="col-xxl-4 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="calle">CALLE</label>
                            <input type="text" class="form-control" id="calle" name="calle">
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="numero_exterior">NÚMERO
                                EXTERIOR</label>
                            <input type="text" class="form-control" id="numero_exterior"
                                name="numero_exterior">
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="numero_interior">NÚMERO
                                INTERIOR</label>
                            <input type="text" class="form-control" id="numero_interior"
                                name="numero_interior">
                        </div>
                    </div>

                    <div class="col-xxl-4 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="cp">CP</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="cp" placeholder=""
                                    name="cp">
                                <button class="btn btn-outline-secondary text-body" type="button"
                                    id="busca_codigo_postal">
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                    <script>
                    $(document).ready(function() {
                        $('#busca_codigo_postal').click(function() {
                            var crudServiceBaseUrl =
                                "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                            var codigoPostal = $('#cp')
                                .val();
                            $.ajax({
                                url: crudServiceBaseUrl,
                                type: 'GET',
                                data: {
                                    cp: codigoPostal,
                                    catalogo_droplist: 'leer_cp'
                                },
                                dataType: 'json',
                                success: function(
                                    data) {
                                    if (data && data
                                        .length > 0
                                    ) {
                                        if (data
                                            .length >
                                            2) {
                                            // Convertir input a select
                                            var selectHtml =
                                                '<select id="colonia" class="form-select" name="colonia" >';
                                            data.forEach(
                                                function(
                                                    item
                                                ) {
                                                    selectHtml
                                                        +=
                                                        '<option value="' +
                                                        item
                                                        .ID +
                                                        '">' +
                                                        item
                                                        .CODIGO +
                                                        ', ' +
                                                        item
                                                        .ASENTAMIENTO +
                                                        '</option>';
                                                }
                                            );
                                            selectHtml
                                                +=
                                                '</select>';
                                            $('#colonia')
                                                .replaceWith(
                                                    selectHtml
                                                );


                                            var selectedId =
                                                $(
                                                    "#colonia")
                                                .val();
                                            var selectedItem =
                                                data
                                                .find(
                                                    item =>
                                                    item
                                                    .ID ==
                                                    selectedId
                                                );
                                            $('#localidad')
                                                .val(
                                                    selectedItem
                                                    .CLAVE
                                                );
                                            $('#municipio')
                                                .val(
                                                    selectedItem
                                                    .C_MUNICIPIO
                                                );
                                            $('#estado')
                                                .val(
                                                    selectedItem
                                                    .ESTADO
                                                );
                                            // Asignar evento change al select
                                            $('#colonia')
                                                .change(
                                                    function() {
                                                        var selectedId =
                                                            $(
                                                                "#colonia")
                                                            .val();
                                                        var selectedItem =
                                                            data
                                                            .find(
                                                                item =>
                                                                item
                                                                .ID ==
                                                                selectedId
                                                            );
                                                        $('#localidad')
                                                            .val(
                                                                selectedItem
                                                                .CLAVE
                                                            );
                                                        $('#municipio')
                                                            .val(
                                                                selectedItem
                                                                .C_MUNICIPIO
                                                            );
                                                        $('#estado')
                                                            .val(
                                                                selectedItem
                                                                .ESTADO
                                                            );
                                                    }
                                                );
                                        } else {
                                            // Rellenar campos directamente
                                            //fillFields(data[0]);

                                            var selectedItem =
                                                data[
                                                    0
                                                ];
                                            var selectHtml =
                                                '<input type="text" class="form-control" id="colonia" name="colonia">';
                                            $('#colonia')
                                                .replaceWith(
                                                    selectHtml
                                                );

                                            $('#colonia')
                                                .val(
                                                    selectedItem
                                                    .ASENTAMIENTO
                                                );
                                            $('#localidad')
                                                .val(
                                                    selectedItem
                                                    .CLAVE
                                                );
                                            $('#municipio')
                                                .val(
                                                    selectedItem
                                                    .C_MUNICIPIO
                                                );
                                            $('#estado')
                                                .val(
                                                    selectedItem
                                                    .ESTADO
                                                );
                                        }
                                    } else {
                                        alert(
                                            'No se encontraron resultados.');
                                        // Limpiar los campos si no hay resultados

                                    }
                                },
                                error: function() {
                                    alert(
                                        'Error al realizar la búsqueda.');
                                }
                            });
                        });
                    });
                    </script>


                    <div class="col-xxl-4 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="colonia">COLONIA</label>
                            <input type="text" class="form-control" id="colonia" name="colonia">
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="localidad">LOCALIDAD</label>
                            <input type="text" class="form-control" id="localidad" name="localidad">
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="referencia">REFERENCIA</label>
                            <input type="text" class="form-control" id="referencia" name="referencia">
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="municipio">MUNICIPIO</label>
                            <input type="text" class="form-control" id="municipio" name="municipio">
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="estado">ESTADO</label>
                            <input type="text" class="form-control" id="estado" name="estado">
                        </div>
                    </div>
                    <div class="col-xxl-4 col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" for="pais">PAÍS</label>
                            <input type="text" class="form-control" id="pais" name="pais" value="MÉX">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" required
                            pattern="[0-9]{10}" minlength="10" maxlength="10">
                        <div class="invalid-feedback">Por favor, ingresa tu número de teléfono (10 dígitos).</div>
                    </div>

                    <!-- SECCION OPERADORES -->
                    <div class="col-md-4" id="licenciaContainer" style="display: none;">
                        <label for="folio_licencia_federal" class="form-label">Folio Licencia Federal </label>
                        <input type="text" class="form-control" id="folio_licencia_federal"
                            name="folio_licencia_federal">
                    </div>

                    <!-- file licencia colaborador -->
                    <div class="col-md-4" id="fileLicenciaContainer" style="display: none;">
                        <label for="licencia_file" class="form-label">Licencia / PDF (MAX
                            5MB)</label>
                        <input class="form-control" type="file" id="licencia_file" name="file_licencia" accept=".pdf">
                        <div class="invalid-feedback">
                            Se verificará!
                        </div>
                    </div>

                    <div class="col-md-4" id="licenciaVigenciaContainer" style="display: none;">
                        <label for="vigencia_licencia_federal" class="form-label">Vigencia Licencia Federal </label>
                        <input type="date" class="form-control" id="vigencia_licencia_federal"
                            name="vigencia_licencia_federal">
                    </div>

                    <div class="col-md-4" id="folioExamenMedicoContainer" style="display: none;">
                        <label for="folio_examen_medico" class="form-label">Folio Examen Médico </label>
                        <input type="text" class="form-control" id="folio_examen_medico" name="folio_examen_medico">
                    </div>
                    <!-- file examen colaborador -->
                    <div class="col-md-4" id="fileExamenMedicoContainer" style="display: none;">
                        <label for="file_medico" class="form-label">Examen Medico / PDF (MAX
                            5MB)</label>
                        <input class="form-control" type="file" id="file_medico" name="file_examen_medico"
                            accept=".pdf">
                        <div class="invalid-feedback">
                            Se verificará!
                        </div>
                    </div>

                    <div class="col-md-4" id="examenMedicoContainer" style="display: none;">
                        <label for="fecha_examen_medico" class="form-label">Fecha Examen Médico </label>
                        <input type="date" class="form-control" id="fecha_examen_medico" name="fecha_examen_medico">
                    </div>
                    <div class="col-md-4" id="folioAntiContainer" style="display: none;">
                        <label for="folio_antidoping" class="form-label">Folio Antidoping </label>
                        <input type="text" class="form-control" id="folio_antidoping" name="folio_antidoping">
                    </div>
                    <!-- file examen Antidoping -->
                    <div class="col-md-4" id="fileAntiContainer" style="display: none;">
                        <label for="validationCustom04" class="form-label">Examen Antidoping / PDF (MAX
                            5MB)</label>
                        <input class="form-control" type="file" id="formFile" name="file_examen_antidoping"
                            accept=".pdf">
                        <div class="invalid-feedback">
                            Se verificará!
                        </div>
                    </div>

                    <div class="col-md-4" id="fechaAntiContainer" style="display: none;">
                        <label for="fecha_examen_antidoping" class="form-label">Fecha Examen Antidoping </label>
                        <input type="date" class="form-control" id="fecha_examen_antidoping"
                            name="fecha_examen_antidoping">
                    </div>
                    <div class="col-md-6" id="folioAntecedentesContainer" style="display: none;">
                        <label for="folio_carta_no_antecedentes" class="form-label">Folio Carta No Antecedentes Penales
                        </label>
                        <input type="text" class="form-control" id="folio_carta_no_antecedentes"
                            name="folio_carta_no_antecedentes">
                    </div>

                    <!-- file Carta No Antecedentes Penales -->
                    <div class="col-md-6" id="fileAntecedentesContainer" style="display: none;">
                        <label for="validationCustom04" class="form-label">Carta No Antecedentes Penales / PDF (MAX
                            5MB)</label>
                        <input class="form-control" type="file" id="formFile" name="file_carta_antecedentes"
                            accept=".pdf">
                        <div class="invalid-feedback">
                            Se verificará!
                        </div>
                    </div>

                    <!-- REFERENCIAS -->
                    <div class="col-md-12">
                        <label for="regimen" class="form-label">Referencia Personales</label>
                        <div id="grid"></div>
                        <input type="hidden" id="referencias" name="referencias">
                        <script>
                        $(document).ready(function() {
                            let data = []; // Datos iniciales del grid
                            let referencias = []; // Array para guardar las referencias
                            var dataSource = new kendo.data.DataSource({
                                pageSize: 20, // Opcional: paginación
                                transport: {
                                    create: function(e) {
                                        if (e.data.models) {
                                                //batch editing
                                                for (var i = 0; i < e.data.models.length; i++) {
                                                    e.data.models[i].Id = nextId++;
                                                }
                                                e.success(e.data.models);
                                            } else {
                                                e.data.Id = nextId++;
                                                e.success(e.data);
                                            }
                                            referencias.push(e.data);
                                            console.log(e.data);
                                            console.log(referencias);
                                            $("#referencias").val(JSON.stringify(referencias));
                                    },
                                    read: function(e) {
                                        e.success(data);
                                    },
                                    update: function(e) {
                                        e.success(e.data);
                                        // Actualizar el array referencias
                                        const index = referencias.findIndex(item => item.Id === e
                                            .data.Id);
                                        if (index !== -1) {
                                            referencias[index] = e.data;
                                            $("#referencias").val(JSON.stringify(referencias));
                                        }
                                    },
                                    destroy: function(e) {
                                        e.success(e.data);
                                        // Eliminar del array referencias
                                        referencias = referencias.filter(item => item.Id !== e.data
                                            .Id);
                                        $("#referencias").val(JSON.stringify(referencias));
                                    }
                                },
                                schema: {
                                    model: {
                                        id: "Id", // Clave primaria
                                        fields: {
                                            Id: {
                                                type: "number",
                                                editable: false
                                            }, // Tipo GUID
                                            nombre: {
                                                type: "string",
                                                validation: {
                                                    required: true
                                                }
                                            },
                                            direccion: {
                                                type: "string",
                                                validation: {
                                                    required: true
                                                }
                                            },
                                            aniosConocerlo: {
                                                type: "number",
                                                validation: {
                                                    required: true,
                                                    min: 0
                                                }
                                            },
                                            parentesco: {
                                                type: "string",
                                                validation: {
                                                    required: true
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                            $("#grid").kendoGrid({
                                dataSource: dataSource,
                                scrollable: true, // Habilitar scroll
                                editable: {
                                    mode: "inline",
                                    createAt: "top"
                                },
                                toolbar: ["create"],
                                columns: [{
                                        field: "nombre",
                                        title: "Nombre"
                                    },
                                    {
                                        field: "direccion",
                                        title: "Dirección"
                                    },
                                    {
                                        field: "aniosConocerlo",
                                        title: "Años de Conocerlo"
                                    },
                                    {
                                        field: "parentesco",
                                        title: "Parentesco"
                                    },
                                    {
                                        command: ["edit", "destroy"],
                                        title: "&nbsp;"
                                    }
                                ]
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
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Row ends -->
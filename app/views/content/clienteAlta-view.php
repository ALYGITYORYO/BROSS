<!-- Row starts -->
<div class="row gx-3">
    <div class="col-sm-12">

        <div class="card mb-3">
            <div class="card-body">

                <div class="card-header">
                    <h5 class="card-title">Agregar Cliente</h5>
                </div>

                <div class="col-sm-12">
                    <div class="bg-light rounded-2 px-3 py-2 mb-3">
                        <h6 class="m-0">Datos Personales</h6>
                    </div>
                </div>

                <form class="row g-3 needs-validation FormularioAjax"
                    action="<?php echo APP_URL; ?>app/ajax/clienteAjax.php" method="POST" autocomplete="off"
                    id="form_cliente" enctype="multipart/form-data">
                    <input type="hidden" name="catalogo_cliente" value="registrar">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                            <div class="invalid-feedback">Por favor, ingresa tu nombre. (Solo letras y espacios, min. 3
                                caracteres)</div>
                        </div>

                        <div class="col-md-6">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" class="form-control" id="rfc" name="rfc">
                            <div class="invalid-feedback">Por favor, ingresa un RFC válido. (Ej. AAA010101AAA)</div>
                        </div>

                        <div class="col-md-12">
                            <label for="domicilio" class="form-label">Domicilio Fiscal</label>
                        </div>

                        <div class="col-md-3">
                            <label for="calle" class="form-label">Calle</label>
                            <input type="text" class="form-control" id="calle" name="calle" required>
                            <div class="invalid-feedback">Por favor, ingresa la calle.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="numero_interior" class="form-label">Número Interior</label>
                            <input type="text" class="form-control" id="numero_interior" name="numero_interior">
                        </div>

                        <div class="col-md-3">
                            <label for="numero_exterior" class="form-label">Número Exterior</label>
                            <input type="text" class="form-control" id="numero_exterior" name="numero_exterior"
                                >
                            <div class="invalid-feedback">Por favor, ingresa el número exterior.</div>
                        </div>

                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="cp_origen">CP</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        id="cp_origen" placeholder="" name="cp_origen">
                                                                    <button class="btn btn-outline-secondary text-body"
                                                                        type="button" id="busca_codigo_postal">
                                                                        Buscar
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <script>
                                                            $(document).ready(function() {
                                                                $('#busca_codigo_postal').click(function() {
                                                                    var crudServiceBaseUrl =
                                                                        "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                                                                    var codigoPostal = $('#cp_origen')
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
                                                                                    $('#ciudad')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .CIUDAD
                                                                                            );
                                                                                    $('#municipio')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .MUNICIPIO
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
                                                                                                $('#municipio')
                                                                                                    .val(
                                                                                                        selectedItem
                                                                                                        .MUNICIPIO
                                                                                                        );
                                                                                                        $('#ciudad')
                                                                                                    .val(
                                                                                                        selectedItem
                                                                                                        .CIUDAD
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
                                                                                    $('#municipio')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .MUNICIPIO
                                                                                            );
                                                                                    $('#estado')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .ESTADO
                                                                                            );
                                                                                            $('#ciudad')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .CIUDAD
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
                                                        </div>

                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="colonia">COLONIA</label>
                                                                <input type="text" class="form-control"
                                                                    id="colonia" name="colonia">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="ciudad">CIUDAD</label>
                                                                <input type="text" class="form-control"
                                                                    id="ciudad" name="ciudad">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="municipio">MUNICIPIO</label>
                                                                <input type="text" class="form-control"
                                                                    id="municipio" name="municipio">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="estado">ESTADO</label>
                                                                <input type="text" class="form-control"
                                                                    id="estado" name="estado">
                                                            </div>
                                                        </div>


                        <div class="col-md-3">

                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo">
                            <div class="invalid-feedback">Por favor, ingresa un correo electrónico válido.</div>
                        </div>

                        <div class="col-md-3">

                            <label for="correo" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono">
                            <div class="invalid-feedback">Por favor, ingresa un teléfono.</div>
                        </div>



                        <div class="col-md-12">
                            <div class="k-d-flex k-justify-content-center">
                                <div class="k-w-300">
                                    <label for="regimen">Régimen</label>
                                    <input class="form-control" id="regimen" name="regimen" style="width: 100%;" />
                                </div>
                            </div>
                            <script id="noDataTemplateregimen" type="text/x-kendo-tmpl">
                                <div>No se encontró dentro de la base de datos desea guardar a : - '#: instance.text() #' ?</div>
                        <br />
                        <button class="k-button" onclick="addNewregimen('#: instance.element[0].id #', '#: instance.text() #')">¿Agregar nuevo regimen? </button>
                    </script>
                            <!-- segunda seccion  -->
                            <script>
                            var regimen = [];
                            var sampleDataNextregimen = 0;

                            function getIndexByIdregimen(id) {
                                var idx, l = regimen.length;
                                for (var j = 0; j < l; j++) {
                                    if (regimen[j].ID == id) {
                                        return j;
                                    }
                                }
                                return null;
                            }

                            function addNewregimen(widgetId, value) {
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                                var widget = $('#' + widgetId).getKendoComboBox();
                                var dataSource = widget.dataSource;
                                var id = getIndexByIdregimen(sampleDataNextregimen);
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
                                            TABLA: 'd_regimen',
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
                                var regimen_data = new kendo.data.DataSource({
                                    transport: {
                                        read: function(e) {
                                            $.getJSON(crudServiceBaseUrl +
                                                "?catalogo_droplist=leer&TABLA=d_regimen",
                                                function(result) {
                                                    var data = JSON.stringify(result, null, 2);
                                                    regimen = result;
                                                    console.log(regimen);
                                                    sampleDataNextregimen = regimen.length;
                                                    console.log(regimen);
                                                    e.success(regimen);

                                                });

                                        },
                                        create: function(e) {
                                            e.data.ID = sampleDataNextregimen++;
                                            regimen.push(e.data);
                                            console.log(regimen);
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
                                $("#regimen").kendoComboBox({
                                    filter: "startswith",
                                    dataTextField: "NOMBRE",
                                    dataValueField: "ID",
                                    dataSource: regimen_data,
                                  
                                    noDataTemplate: $("#noDataTemplateregimen").html()
                                });

                                

                            });
                            </script>

                        </div>


                        <div class="mb-3">
                            <label class="form-label">Ccondiciones de ventas pactada
                                <span class="text-danger">*</span></label>
                            <div class="m-0">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="condiciones" id="alContado"
                                        value="contado" checked>
                                    <label class="form-check-label" for="alContado">Al Contado</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="condiciones" id="aCredito"
                                        value="credito">
                                    <label class="form-check-label" for="aCredito">A Crédito</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3" id="diasCreditoContainer" style="display: none;">
                            <label class="form-label" for="diasCredito">Días de Crédito <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="diasCredito" name="diasCredito" min="1">
                        </div>

                        <script>
                        $(document).ready(function() {
                            $('input[name="condiciones"]').change(function() {
                                if ($(this).val() === 'credito') {
                                    $('#diasCreditoContainer').show();
                                } else {
                                    $('#diasCreditoContainer').hide();
                                    $("#diasCredito").val(""); //limpiar el input
                                }
                            });
                        });
                        </script>

                        <div class="col-md-12">
                            <label for="regimen" class="form-label">Domicilios Operativos</label>
                            <div id="grid"></div>
                            <input type="hidden" id="domicilios" name="domicilios">

                            <script>
                            $(document).ready(function() {
                                let data = [];
                                let domicilios = [];
                                var nextId = data.length + 1;

                                var dataSource = new kendo.data.DataSource({
                                    pageSize: 20,
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
                                            domicilios.push(e.data);
                                            console.log(e.data);
                                            console.log(domicilios);
                                            $("#domicilios").val(JSON.stringify(domicilios));
                                        },
                                        read: function(e) {
                                            e.success(data);
                                            console.log(e.data);
                                        },
                                        update: function(e) {
                                            if (e.data.models) {
                                                //batch editing
                                                e.success(e.data.models);
                                            } else {
                                                e.success(e.data);
                                            }
                                        },
                                        destroy: function(e) {
                                            if (e.data.models) {
                                                //batch editing
                                                e.success(e.data.models);
                                            } else {
                                                e.success(e.data);
                                            }
                                        }
                                    },
                                    schema: {
                                        model: {
                                            id: "Id",
                                            fields: {
                                                Id: {
                                                    type: "number",
                                                    editable: false,
                                                    nullable: true
                                                },
                                                domicilioOperativo: {
                                                    type: "string",
                                                    validation: {
                                                        required: true
                                                    }
                                                },
                                                contacto: {
                                                    type: "string",
                                                    validation: {
                                                        required: true
                                                    }
                                                },
                                                telefono: {
                                                    type: "string",
                                                    validation: {
                                                        required: true
                                                    }
                                                },
                                                correoElectronico: {
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

                                    scrollable: {
                                        virtual: true
                                    },
                                    editable: {
                                        mode: "inline",
                                        createAt: "top"
                                    },
                                    toolbar: ["create"],
                                    pageable: {
                                        numeric: false,
                                        previousNext: false,
                                        messages: {
                                            display: "Showing {2} data items"
                                        }
                                    },
                                    columns: [{
                                            field: "domicilioOperativo",
                                            title: "Domicilio Operativo"
                                        },
                                        {
                                            field: "contacto",
                                            title: "Contacto"
                                        },
                                        {
                                            field: "telefono",
                                            title: "Teléfono"
                                        },
                                        {
                                            field: "correoElectronico",
                                            title: "Correo Electrónico"
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
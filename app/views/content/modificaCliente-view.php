<?php 

use app\controllers\remisionController;

$requestUri = $_SERVER['REQUEST_URI'];
if (strpos($requestUri, 'ID=') !== false) {
    $parts = explode('ID=', $requestUri);
    $id = explode('&', $parts[1])[0];
   // echo "El ID es: " . $id;
} else {
    echo "ID no encontrado.";
}

?>


<script>
$(document).ready(function() {
    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/clienteAjax.php";

    let id = <?=$id;?>;
    $.ajax({
        type: "POST",
        url: crudServiceBaseUrl,
        data: {
            catalogo_cliente: "leercliente",
            ID: id
        },
        success: function(response) {
            let data_cliente = JSON.parse(response);
            // console.log(data_cliente);
            if (data_cliente.length == 1) {

                data_set = data_cliente[0];

                $('#id_cliente').val("<?=$id;?>");
                $('#nombre').val(data_set[0].NOMBRE);
                $('#rfc').val(data_set[0].RFC);
                $('#calle').val(data_set[0].CALLE);
                $('#numero_interior').val(data_set[0].NUM_INT);
                $('#numero_exterior').val(data_set[0].NUM_EXT);
                $('#cp').val(data_set[0].CP);
                $('#colonia').val(data_set[0].COLONIA);
                $('#ciudad').val(data_set[0].CIUDAD);
                $('#municipio').val(data_set[0].MUNICIPIO);
                $('#estado').val(data_set[0].ESTADO);
                $('#correo').val(data_set[0].CORREO);
                $('#telefono').val(data_set[0].TELEFONO);
                $('#domicilios').val(data_set[0].DOMICILIOS);




                $("#regimen").data("kendoComboBox").value(data_set[0].REGIMEN);

                if (data_set[0].CONDICIONES == "credito") {
                    $("#aCredito").prop("checked", true);
                    $('#diasCreditoContainer').show();
                    $('#diasCredito').val(data_set[0].CREDITO);
                    $("#containerespacio").hide();
                } else {
                    $("#alContado").prop("checked", true);
                    $('#diasCreditoContainer').hide();
                    $("#containerespacio").show();
                }




                var jsonData = data_set[0].DOMICILIOS;
                var dataToLoad = JSON.parse(jsonData);

                // Obtener el DataSource del grid
                var grid = $("#grid").data("kendoGrid");
                var dataSource = grid.dataSource;
                dataSource.data(dataToLoad);
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
                    <input type="hidden" name="catalogo_cliente" value="actualizar">
                    <input type="hidden" name="id_cliente" id="id_cliente">

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
                            <input type="text" class="form-control" id="numero_exterior" name="numero_exterior">
                            <div class="invalid-feedback">Por favor, ingresa el número exterior.</div>
                        </div>

                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="cp">CP</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="cp" placeholder="" name="cp">
                                    <button class="btn btn-outline-secondary text-body" type="button"
                                        id="busca_codigo_postal">
                                        Buscar
                                    </button>
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
                                <label class="form-label" for="colonia">COLONIA</label>
                                <input type="text" class="form-control" id="colonia" name="colonia">
                            </div>
                        </div>

                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="ciudad">CIUDAD</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="municipio">MUNICIPIO</label>
                                <input type="text" class="form-control" id="municipio" name="municipio">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="estado">ESTADO</label>
                                <input type="text" class="form-control" id="estado" name="estado">
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
                                                    //console.log(regimen);
                                                    sampleDataNextregimen = regimen.length;
                                                    //console.log(regimen);
                                                    e.success(regimen);

                                                });

                                        },
                                        create: function(e) {
                                            e.data.ID = sampleDataNextregimen++;
                                            regimen.push(e.data);
                                            //console.log(regimen);
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

                                function getDomiciliosData() {
                                    let data = $("#domicilios").val();
                                    return data ? JSON.parse(data) : [];
                                }

                                function setDomiciliosData(data) {
                                    $("#domicilios").val(JSON.stringify(data));
                                }


                                function generateNewId(data) {
                                    // Encuentra el ID más alto y suma 1
                                    const maxId = data.reduce((max, item) => Math.max(max, item.Id || 0), 0);
                                    return maxId + 1;
                                }

                                var dataSource = new kendo.data.DataSource({
                                    pageSize: 20,
                                    transport: {
                                        create: function(e) {
                                            var domicilios = getDomiciliosData();
                                            // Asignar nuevo ID único
                                            e.data.Id = generateNewId(domicilios);
                                            domicilios.push(e.data);
                                            setDomiciliosData(domicilios);
                                            e.success(e.data);
                                        },
                                        read: function(e) {


                                        },
                                        update: function(e) {
                                            // Actualizar registro
                                            var domicilios = getDomiciliosData();
                                            console.log(e.data.Id);
                                            var index = domicilios.findIndex(item => item.Id === e
                                                .data.Id);
                                            if (index !== -1) {
                                                domicilios[index] = e.data;
                                                setDomiciliosData(domicilios);
                                                e.success();
                                            } else {
                                                e.error("Registro no encontrado");
                                            }
                                        },
                                        destroy: function(e) {}
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

</div>


<!-- App body ends -->


<script>
$(document).ready(function() {
    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/getID.php";
    $.ajax({
        url: crudServiceBaseUrl + "?variable=cotizadorGet_ID", // Archivo PHP que contiene los datos
        type: "GET", // Método HTTP (GET o POST)
        success: function(info) {
            // Manejar la respuesta del servidor
            if (info) {
                $('#folio_id').val(info);
                $('#folio').val(info);
            } else {
                // $("#resultado").html("Error: " + response.message);
            }
        }
    });
});
</script>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Cotización</h5>
                </div>
                <div class="card-body">


                    <form class="row g-3 needs-validation FormularioAjax"
                        action="<?php echo APP_URL; ?>app/ajax/cotizadorAjax.php" method="POST" autocomplete="off"
                        id="cotizador" enctype="multipart/form-data">
                        <input type="hidden" name="moduloCotizador" value="registrar">

                        <div class="row gx-3">
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="folio">FOLIO</label>
                                    <input type="text" class="form-control" id="folio_id" name="folio_id" disabled>
                                    <input type="hidden" class="form-control" id="folio" name="folio">

                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="cliente">CLIENTE</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente"
                                        style="width: 100%;">
                                    <div class="invalid-feedback">Por favor, ingresa elremoolque asignado.</div>
                                    <script>
                                    $(document).ready(function() {
                                        var operador = [];
                                        var crudServiceBaseUrl =
                                            "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                        var operador_data = new kendo.data.DataSource({
                                            transport: {
                                                read: function(e) {
                                                    $.getJSON(crudServiceBaseUrl +
                                                        "?catalogo_droplist=leer_cliente",
                                                        function(result) {
                                                            var data = JSON.stringify(result,
                                                                null,
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
                                                        RFC: {
                                                            type: "string"
                                                        },
                                                        DIAS: {
                                                            type: "string"
                                                        },
                                                        CONDICIONES: {
                                                            type: "string"
                                                        }

                                                    }
                                                }
                                            }
                                        });
                                        $("#cliente").kendoComboBox({

                                            template: '<span class="ID">#= NOMBRE # , RFC #= RFC #',
                                            dataTextField: "NOMBRE",
                                            dataValueField: "ID",
                                            dataSource: operador_data,
                                            change: onChange,
                                            filter: "contains",

                                        });

                                        function onChange() {
                                            var dropdownlist_clientes_venta = $("#cliente").data(
                                                "kendoComboBox");
                                            var selectedDataItem_cliente = dropdownlist_clientes_venta
                                                .dataItem();

                                            const dias = selectedDataItem_cliente.DIAS;
                                            const condiciones = selectedDataItem_cliente.CONDICIONES;
                                            if (condiciones == "credito") {
                                                $("#diasCreditoContainer").show();
                                                $("#diasCredito").val(dias);
                                                $("#aCredito").prop('checked', true);
                                                $("#containerespacio").hide();
                                            } else {
                                                $("#alContado").prop('checked', true);
                                                $("#diasCreditoContainer").hide();
                                                $("#diasCredito").val("0");
                                                $("#containerespacio").show();

                                            }
                                        }
                                    });
                                    </script>
                                </div>
                            </div>


                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Condiciones de ventas pactada
                                    </label>
                                    <div class="m-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="condiciones"
                                                id="alContado" value="contado">
                                            <label class="form-check-label" for="alContado">Al Contado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="condiciones"
                                                id="aCredito" value="credito">
                                            <label class="form-check-label" for="aCredito">A Crédito</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-4 col-sm-6" id="diasCreditoContainer" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="diasCredito">Días de Crédito </label>
                                    <input type="number" class="form-control" id="diasCredito" name="diasCredito"
                                        min="1">
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-4 col-sm-6" id="containerespacio">
                                <div class="mb-3">
                                    <label class="form-label" for="">&nbsp; </label>

                                </div>
                            </div>

                            <script>
                            $(document).ready(function() {
                                $('input[name="condiciones"]').change(function() {
                                    if ($(this).val() === 'credito') {
                                        $('#diasCreditoContainer').show();
                                        $("#containerespacio").hide();
                                    } else {
                                        $('#diasCreditoContainer').hide();
                                        $("#diasCredito").val("0"); //limpiar el input
                                        $("#containerespacio").show();
                                    }
                                });
                            });
                            </script>




                            <div class="col-xxl-12 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title text-center">UBICACIONES</h5>
                                    </div>
                                </div>
                            </div>


                            <div class="row gx-3">
                                <div class="col-sm-12">
                                    <div class="accordion" id="accordionPanelsStayOpenExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                                    aria-controls="panelsStayOpen-collapseOne">
                                                    <h5 class="m-0">UBICACIÓN ORIGEN</h5>
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapseOne"
                                                class="accordion-collapse collapse show"
                                                aria-labelledby="panelsStayOpen-headingOne">
                                                <div class="accordion-body">

                                                    <div class="row gx-3">
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="id_ubicacion_origen">ID
                                                                    UBICACIÓN</label>
                                                                <input type="text" class="form-control"
                                                                    id="id_ubicacion_origen" name="id_ubicacion_origen"
                                                                    value="OR000000">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="calle_origen">CALLE</label>
                                                                <input type="text" class="form-control"
                                                                    id="calle_origen" name="calle_origen">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="numero_exterior_origen">NÚMERO EXTERIOR</label>
                                                                <input type="text" class="form-control"
                                                                    id="numero_exterior_origen"
                                                                    name="numero_exterior_origen">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="numero_interior_origen">NÚMERO INTERIOR</label>
                                                                <input type="text" class="form-control"
                                                                    id="numero_interior_origen"
                                                                    name="numero_interior_origen">
                                                            </div>
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
                                                                        "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
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
                                                                                        '<select id="colonia_origen" class="form-select" name="colonia_origen" >';
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
                                                                                    $('#colonia_origen')
                                                                                        .replaceWith(
                                                                                            selectHtml
                                                                                            );


                                                                                    var selectedId =
                                                                                        $(
                                                                                            "#colonia_origen")
                                                                                        .val();
                                                                                    var selectedItem =
                                                                                        data
                                                                                        .find(
                                                                                            item =>
                                                                                            item
                                                                                            .ID ==
                                                                                            selectedId
                                                                                            );
                                                                                    $('#localidad_origen')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .CLAVE
                                                                                            );
                                                                                    $('#municipio_origen')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .C_MUNICIPIO
                                                                                            );
                                                                                    $('#estado_origen')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .ESTADO
                                                                                            );
                                                                                    // Asignar evento change al select
                                                                                    $('#colonia_origen')
                                                                                        .change(
                                                                                            function() {
                                                                                                var selectedId =
                                                                                                    $(
                                                                                                        "#colonia_origen")
                                                                                                    .val();
                                                                                                var selectedItem =
                                                                                                    data
                                                                                                    .find(
                                                                                                        item =>
                                                                                                        item
                                                                                                        .ID ==
                                                                                                        selectedId
                                                                                                        );
                                                                                                $('#localidad_origen')
                                                                                                    .val(
                                                                                                        selectedItem
                                                                                                        .CLAVE
                                                                                                        );
                                                                                                $('#municipio_origen')
                                                                                                    .val(
                                                                                                        selectedItem
                                                                                                        .C_MUNICIPIO
                                                                                                        );
                                                                                                $('#estado_origen')
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
                                                                                        '<input type="text" class="form-control" id="colonia_origen" name="colonia_origen">';
                                                                                    $('#colonia_origen')
                                                                                        .replaceWith(
                                                                                            selectHtml
                                                                                            );

                                                                                    $('#colonia_origen')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .ASENTAMIENTO
                                                                                            );
                                                                                    $('#localidad_origen')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .CLAVE
                                                                                            );
                                                                                    $('#municipio_origen')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .C_MUNICIPIO
                                                                                            );
                                                                                    $('#estado_origen')
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
                                                        </div>

                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="colonia_origen">COLONIA</label>
                                                                <input type="text" class="form-control"
                                                                    id="colonia_origen" name="colonia_origen">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="localidad_origen">LOCALIDAD</label>
                                                                <input type="text" class="form-control"
                                                                    id="localidad_origen" name="localidad_origen">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="referencia_origen">REFERENCIA</label>
                                                                <input type="text" class="form-control"
                                                                    id="referencia_origen" name="referencia_origen">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="municipio_origen">MUNICIPIO</label>
                                                                <input type="text" class="form-control"
                                                                    id="municipio_origen" name="municipio_origen">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="estado_origen">ESTADO</label>
                                                                <input type="text" class="form-control"
                                                                    id="estado_origen" name="estado_origen">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="pais_origen">PAÍS</label>
                                                                <input type="text" class="form-control" id="pais_origen"
                                                                    name="pais_origen" value="MÉX">
                                                            </div>
                                                        </div>

                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="distancia_recorrida_origen">DISTANCIA
                                                                    RECORRIDA</label>
                                                                <input type="text" class="form-control"
                                                                    id="distancia_recorrida_origen"
                                                                    name="distancia_recorrida_origen" value="0">
                                                            </div>
                                                        </div>

                                                        <div class="col-xxl-12 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">Link
                                                                        GoogleMaps</span>
                                                                    <textarea class="form-control" id="abc14"
                                                                        name="diriniciogoogle"
                                                                        aria-label="With textarea"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                                    aria-controls="panelsStayOpen-collapseTwo">
                                                    <h5 class="m-0">UBICACIÓN DESTINO</h5>
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="panelsStayOpen-headingTwo">

                                                <div class="accordion-body">
                                                    <div class="row gx-3">
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="id_ubicacion_destino">ID
                                                                    UBICACIÓN</label>
                                                                <input type="text" class="form-control"
                                                                    id="id_ubicacion_destino"
                                                                    name="id_ubicacion_destino" value="DE000000">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="calle_destino">CALLE</label>
                                                                <input type="text" class="form-control"
                                                                    id="calle_destino" name="calle_destino">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="numero_exterior_destino">NÚMERO
                                                                    EXTERIOR</label>
                                                                <input type="text" class="form-control"
                                                                    id="numero_exterior_destino"
                                                                    name="numero_exterior_destino">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="numero_interior_destino">NÚMERO
                                                                    INTERIOR</label>
                                                                <input type="text" class="form-control"
                                                                    id="numero_interior_destino"
                                                                    name="numero_interior_destino">
                                                            </div>
                                                        </div>

                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="cp_destino">CP</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        id="cp_destino" placeholder="" name="cp_destino">
                                                                    <button class="btn btn-outline-secondary text-body"
                                                                        type="button" id="busca_codigo_postal_destino">
                                                                        Buscar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <script>
                                                            $(document).ready(function() {
                                                                $('#busca_codigo_postal_destino').click(function() {
                                                                    var crudServiceBaseUrl =
                                                                        "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                                                    var codigoPostal = $('#cp_destino')
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
                                                                                        '<select id="colonia_destino" class="form-select" name="colonia_destino" >';
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
                                                                                    $('#colonia_destino')
                                                                                        .replaceWith(
                                                                                            selectHtml
                                                                                            );


                                                                                    var selectedId =
                                                                                        $(
                                                                                            "#colonia_destino")
                                                                                        .val();
                                                                                    var selectedItem =
                                                                                        data
                                                                                        .find(
                                                                                            item =>
                                                                                            item
                                                                                            .ID ==
                                                                                            selectedId
                                                                                            );
                                                                                    $('#localidad_destino')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .CLAVE
                                                                                            );
                                                                                    $('#municipio_destino')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .C_MUNICIPIO
                                                                                            );
                                                                                    $('#estado_destino')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .ESTADO
                                                                                            );
                                                                                    // Asignar evento change al select
                                                                                    $('#colonia_destino')
                                                                                        .change(
                                                                                            function() {
                                                                                                var selectedId =
                                                                                                    $(
                                                                                                        "#colonia_destino")
                                                                                                    .val();
                                                                                                var selectedItem =
                                                                                                    data
                                                                                                    .find(
                                                                                                        item =>
                                                                                                        item
                                                                                                        .ID ==
                                                                                                        selectedId
                                                                                                        );
                                                                                                $('#localidad_destino')
                                                                                                    .val(
                                                                                                        selectedItem
                                                                                                        .CLAVE
                                                                                                        );
                                                                                                $('#municipio_destino')
                                                                                                    .val(
                                                                                                        selectedItem
                                                                                                        .C_MUNICIPIO
                                                                                                        );
                                                                                                $('#estado_destino')
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
                                                                                        '<input type="text" class="form-control" id="colonia_destino" name="colonia_destino">';
                                                                                    $('#colonia_destino')
                                                                                        .replaceWith(
                                                                                            selectHtml
                                                                                            );

                                                                                    $('#colonia_destino')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .ASENTAMIENTO
                                                                                            );
                                                                                    $('#localidad_destino')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .CLAVE
                                                                                            );
                                                                                    $('#municipio_destino')
                                                                                        .val(
                                                                                            selectedItem
                                                                                            .C_MUNICIPIO
                                                                                            );
                                                                                    $('#estado_destino')
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

                                                        
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="colonia_destino">COLONIA</label>
                                                                <input type="text" class="form-control"
                                                                    id="colonia_destino" name="colonia_destino">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="localidad_destino">LOCALIDAD</label>
                                                                <input type="text" class="form-control"
                                                                    id="localidad_destino" name="localidad_destino">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="referencia_destino">REFERENCIA</label>
                                                                <input type="text" class="form-control"
                                                                    id="referencia_destino" name="referencia_destino">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="municipio_destino">MUNICIPIO</label>
                                                                <input type="text" class="form-control"
                                                                    id="municipio_destino" name="municipio_destino">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="estado_destino">ESTADO</label>
                                                                <input type="text" class="form-control"
                                                                    id="estado_destino" name="estado_destino">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="pais_destino">PAÍS</label>
                                                                <input type="text" class="form-control"
                                                                    id="pais_destino" name="pais_destino" value="MÉX">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="distancia_recorrida_destino">DISTANCIA
                                                                    RECORRIDA</label>
                                                                <input type="text" class="form-control"
                                                                    id="distancia_recorrida_destino"
                                                                    name="distancia_recorrida_destino">
                                                            </div>
                                                        </div>

                                                        <div class="col-xxl-12 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">Link
                                                                        GoogleMaps</span>
                                                                    <textarea class="form-control" id="abc14"
                                                                        name="dirfinalgoogle"
                                                                        aria-label="With textarea"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">PUNTO DE FINAL (ESTADO)</label>
                                <select class="form-select" id="estadoFinal" name="estadofinal">
                                    <option value="">Selecciona un estado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">PUNTO DE FINAL (CIUDAD)</label>
                                <select class="form-select" id="ciudadFinal" name="ciudadfinal">
                                    <option value="">Selecciona una ciudad</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Dirección Inicio</span>
                                    <textarea class="form-control" id="abc14" name="dirinicio"
                                        aria-label="With textarea"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Dirección Final</span>
                                    <textarea class="form-control" id="abc14" name="dirfinal"
                                        aria-label="With textarea"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Link GoogleMaps Inicio</span>
                                    <textarea class="form-control" id="abc14" name="diriniciogoogle"
                                        aria-label="With textarea"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Link GoogleMaps Final</span>
                                    <textarea class="form-control" id="abc14" name="dirfinalgoogle"
                                        aria-label="With textarea"></textarea>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-12">
                            <div class="d-flex gap-2 ">

                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalXl" id="viajes">
                                    Ver Viajes
                                </button>
                            </div>
                        </div>
                        <!-- Modal XL -->
                        <div class="modal fade" id="exampleModalXl" tabindex="-1" aria-labelledby="exampleModalXlLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalXlLabel">
                                            Viajes hechos
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="grid_viajes"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                        $(document).ready(function() {
                            $("#viajes").on("click", function() {

                                var comboBox = $("#cliente").data("kendoComboBox");
                                var idcliente = comboBox.value();
                                var ciudad_inicio = $("#ciudadInicio").val();
                                var ciudad_final = $("#ciudadFinal").val();
                                LoadDataViajes(idcliente, ciudad_inicio, ciudad_final)
                            });
                        });
                        async function LoadDataViajes(idcliente, ciudad_inicio, ciudad_final) {
                            console.log('ID CLIENTE: ', idcliente);
                            var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/viajesAjax.php";
                            let viajes = await $.ajax({
                                type: "post",
                                url: crudServiceBaseUrl,
                                data: {
                                    viajesControllers: "viajes",
                                    cliente: idcliente,
                                    ciudad_inicio: ciudad_inicio,
                                    ciudad_final: ciudad_final
                                },
                                dataType: "json",
                            });
                            console.log(viajes);
                            var element = $("#grid_viajes").kendoGrid({
                                dataSource: {
                                    data: viajes,
                                    aggregate: [{
                                            field: "CANTIDAD",
                                            aggregate: "sum"
                                        },
                                        {
                                            field: "TOTAL",
                                            aggregate: "sum"
                                        },
                                        {
                                            field: "PRECIO",
                                            aggregate: "sum"
                                        }
                                    ],
                                    schema: {
                                        model: {
                                            ID: "ID",
                                            fields: {
                                                FOLIO: {
                                                    type: "string"
                                                },
                                                CLIENTE: {
                                                    type: "string"
                                                },
                                                VIAJE: {
                                                    type: "string"
                                                },
                                                MATERIAL: {
                                                    type: "string"
                                                },
                                                FECHA: {
                                                    type: "date"
                                                },
                                                PRECIO: {
                                                    type: "number",
                                                    format: "{0:c}"
                                                }
                                            }
                                        }
                                    }
                                },
                                sortable: true,
                                filterable: true,
                                columnMenu: true,
                                columns: [{
                                        field: "FOLIO",
                                        title: "FOLIO"
                                    }, {
                                        field: "CLIENTE",
                                        title: "CLIENTE"
                                    },
                                    {
                                        field: "VIAJE",
                                        title: "VIAJE"
                                    },
                                    {
                                        field: "MATERIAL",
                                        title: "MATERIAL"
                                    },
                                    {
                                        field: "FECHA",
                                        title: "FECHA COTIZACION",
                                        format: "{0: MMM dd yyyy-HH:mm}"
                                    },
                                    {
                                        field: "PRECIO",
                                        title: "PRECIO",
                                        format: "{0:c}"
                                    }
                                ]
                            });
                        }
                        </script>
                        <br>
                        <br>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="regimen" class="form-label">Material</label>
                                <div id="grid"></div>
                                <input type="hidden" id="materiales" name="materiales">
                                <script id="noDataTemplatetipos_material" type="text/x-kendo-tmpl">
                                    <div>No se encontró dentro de la base de datos desea guardar a : - '#: instance.text() #' ?</div>
                                        <br />
                                    <button class="k-button" onclick="addNewtipos_material('#: instance.element[0].id #', '#: instance.text() #')">¿Agregar nuevo tipo de material? </button>
                                </script>
                                 <script>
                                $(document).ready(function() {
                                    let data = [];
                                    let material = [];
                                    var nextId = data.length + 1;
                                    var dataSource = new kendo.data.DataSource({
                                        pageSize: 20,
                                        autoSync: true,
                                        transport: {
                                            create: function(e) {
                                                e.data.Id = kendo
                                                    .guid(); // Usar GUIDs para IDs únicos
                                                e.success(e.data);
                                                material.push(e.data);
                                                console.log(e.data);
                                                console.log(material);
                                                $("#materiales").val(JSON.stringify(material));
                                            },
                                            read: function(e) {
                                                e.success(data);
                                                console.log(e.data);
                                            },
                                            read: function(e) {
                                                e.success(data);
                                            },
                                            update: function(e) {
                                                e.success(e.data);
                                                // Actualizar el array referencias
                                                const index = material.findIndex(item => item
                                                    .Id === e
                                                    .data.Id);
                                                if (index !== -1) {
                                                    material[index] = e.data;
                                                    $("#materiales").val(JSON.stringify(
                                                        material));
                                                }
                                            },
                                        },
                                        schema: {
                                            model: {
                                                id: "Id",
                                                fields: {
                                                    MATERIAL: {
                                                        defaultValue: {
                                                            ID: 1,
                                                            NOMBRE: "SELECCIONA UN MATERIAL"
                                                        }
                                                    },
                                                    PESO: {
                                                        type: "number"
                                                    },
                                                    UNIDAD: {
                                                        type: "string"
                                                    }
                                                }
                                            }
                                        }
                                    });
                                    $("#grid").kendoGrid({
                                        dataSource: dataSource,
                                        scrollable: true, // Habilitar scroll
                                        toolbar: ["create"],
                                        columns: [{
                                                field: "MATERIAL",
                                                title: "material",
                                                editor: materialEditor,
                                                template: "#=MATERIAL.NOMBRE#"
                                            },
                                            {
                                                field: "PESO"
                                            },
                                            {
                                                field: "UNIDAD"
                                            },
                                            {
                                                command: ["destroy"],
                                                title: "&nbsp;"
                                            }
                                        ],
                                        editable: true
                                    });
                                });

                                function materialEditor(container, options) {
                                    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                    var tipos_material_data = new kendo.data.DataSource({
                                        transport: {
                                            read: function(e) {
                                                $.getJSON(crudServiceBaseUrl +
                                                    "?catalogo_droplist=leer&TABLA=d_material",
                                                    function(result) {
                                                        var data = JSON.stringify(result, null,
                                                            2);
                                                        tipos_material = result;
                                                        console.log(tipos_material);
                                                        sampleDataNexttipos_material =
                                                            tipos_material.length;
                                                        console.log(tipos_material);
                                                        e.success(tipos_material);
                                                    });
                                            },
                                            create: function(e) {
                                                e.data.ID = sampleDataNexttipos_material++;
                                                tipos_material.push(e.data);
                                                console.log(tipos_material);
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
                                    var comboBoxId = "materialComboBox_" + options.model.uid;
                                    $('<input id="' + comboBoxId + '" data-bind="value:' + options.field + '"/>')
                                        .appendTo(container)
                                        .kendoComboBox({
                                            filter: "startswith",
                                            dataTextField: "NOMBRE",
                                            dataValueField: "ID",
                                            dataSource: tipos_material_data,
                                            noDataTemplate: $("#noDataTemplatetipos_material").html()
                                        });
                                }
                                var tipos_material = [];
                                var sampleDataNexttipos_material = 0;

                                function getIndexByIdtipos_material(id) {
                                    var idx, l = tipos_material.length;
                                    for (var j = 0; j < l; j++) {
                                        if (tipos_material[j].ID == id) {
                                            return j;
                                        }
                                    }
                                    return null;
                                }

                                function addNewtipos_material(widgetId, value) {
                                    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                    var widget = $('#' + widgetId).getKendoComboBox();
                                    var dataSource = widget.dataSource;
                                    var id = getIndexByIdtipos_material(sampleDataNexttipos_material);
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
                                                TABLA: 'd_material',
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
                            </div>
                        </div>
                        <div class="col-xxl-6 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="fechaCarga">FECHA DE CARGA Y DESCARGA <span
                                        class="badge border border-info text-info dias"><i
                                            class="ri-arrow-right-s-fill"></i> Duración</span></label>
                                <div class="k-w-300">
                                    <div id="daterangepicker" class="form-control" title="daterangepicker"></div>
                                    <input type="date" id="fechaInicio" name="fechaInicio" style="display: none;">
                                    <input type="date" id="fechaFin" name="fechaFin" style="display: none;">
                                </div>
                                <script>
                                $(document).ready(function() {
                                    $("#daterangepicker").kendoDateRangePicker({
                                        "messages": {
                                            "startLabel": "Fecha de Carga",
                                            "endLabel": "Fecha Descarga"
                                        },
                                        format: "dd/MM/yyyy",
                                        change: onChange
                                    });

                                    function onChange() {
                                        var range = this.range();
                                        console.log("Change :: start - " + kendo.toString(range.start,
                                            'yyyy') + " end - " + kendo.toString(range.end, 'd'));
                                        $("#fechaInicio").val(kendo.toString(range.start, 'yyyy') + "-" +
                                            kendo.toString(range.start, 'MM') + "-" + kendo.toString(
                                                range.start, 'dd'));
                                        $("#fechaFin").val(kendo.toString(range.end, 'yyyy') + "-" + kendo
                                            .toString(range.end, 'MM') + "-" + kendo.toString(range.end,
                                                'dd'));
                                        const diffEnMilisegundos = new Date($("#fechaFin").val()) -
                                            new Date($("#fechaInicio").val());
                                        const diffEnDias = Math.ceil(diffEnMilisegundos / (1000 * 60 * 60 *
                                            24));
                                        $('.dias').text('Duración de ' + (diffEnDias + 1) + " días");
                                    }
                                });
                                </script>
                            </div>
                        </div>


                        <div class="col-xxl-6 col-lg-4 col-sm-6">
                            <div class="input-group" style="PADDING-TOP: 6%;">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="precio" placeholder="Precio"
                                    name="precio">
                            </div>
                        </div>

                        <div class="col-xxl-12 col-lg-12 col-sm-12">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">NOTAS</span>
                                    <textarea class="form-control" id="abc14" name="notas"
                                        aria-label="With textarea"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="col-xxl-6 col-lg-4 col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">FISCAL / NO FISCAL
                                </label>
                                <div class="m-0">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="fiscal" id="fiscal"
                                            value="fiscal">
                                        <label class="form-check-label" for="fiscal">Fiscal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="fiscal" id="nofiscal"
                                            value="no fiscal">
                                        <label class="form-check-label" for="nofiscal">No fiscal</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
                                <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 

use app\controllers\remisionController;

$requestUri = $_SERVER['REQUEST_URI'];
if (strpos($requestUri, 'ID=') !== false) {
    $parts = explode('ID=', $requestUri);
    $id = explode('&', $parts[1])[0];
    echo "El ID es: " . $id;
} else {
    echo "ID no encontrado.";
}

?>


<script>
$(document).ready(function() {
    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/getID.php";
    $.ajax({
        url: crudServiceBaseUrl + "?variable=remisionGet_ID", // Archivo PHP que contiene los datos
        type: "GET", // Método HTTP (GET o POST)
        success: function(info) {
            // Manejar la respuesta del servidor
            if (info) {
                $('#folio_id_remision').val(info);
                $('#folio_remision').val(info);

            } else {
                // $("#resultado").html("Error: " + response.message);
            }
        }
    });



});
</script>

<script>
$(document).ready(function() {
    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/remisionAjax.php";

    let id = <?=$id;?>;
    $.ajax({
        type: "POST",
        url: crudServiceBaseUrl,
        data: {
            remision: "leer",
            ID: id
        },
        success: function(response) {
            let data_cotizacion = JSON.parse(response);
            console.log(data_cotizacion);
            if (data_cotizacion.length == 1) {
                data_set = data_cotizacion[0];
                $("#folio_id_cotizacion").val(data_set[0].FOLIO);
                $("#folio_cotizacion").val(data_set[0].FOLIO);
                $("#cliente").data("kendoComboBox").value(data_set[0].CLIENTE);

                if (data_set[0].CONDICION == "credito") {
                    $("#aCredito").prop("checked", true);
                    $('#diasCreditoContainer').show();
                    $('#diasCredito').val(data_set[0].DIAS_CREDITO);
                    $("#containerespacio").hide();
                } else {
                    $("#alContado").prop("checked", true);
                    $('#diasCreditoContainer').hide();
                    $("#containerespacio").show();
                }            
                $("#notas").text(data_set[0].NOTAS);
                $("#diriniciogoogle").text(data_set[0].LINK_INICIO);
                $("#dirfinalgoogle").text(data_set[0].LINK_FINAL);

                $('#peso').val(data_set[0].PESO);
                $('#precio').val(data_set[0].PRECIO);
                //$("#tipos_material").data("kendoComboBox").value(data_set[0].MATERIAL);
                if (data_set[0].TIPO_FISCAL == "no fiscal") {
                    $("#nofiscal").prop("checked", true);
                } else {
                    $("#fiscal").prop("checked", true);
                }

                $('#id_ubicacion_origen').val(data_set[0].ID_ORIGEN);
                $('#calle_origen').val(data_set[0].CALLE_ORIGEN);
                $('#numero_exterior_origen').val(data_set[0].NUM_EXT_ORIGEN);
                $('#numero_interior_origen').val(data_set[0].NUM_INT_ORIGEN);
                $('#colonia_origen').val(data_set[0].COLONIA_ORIGEN);
                $('#localidad_origen').val(data_set[0].LOCALIDAD_ORIGEN);
                $('#referencia_origen').val(data_set[0].REFERENCIA_ORIGEN);
                $('#municipio_origen').val(data_set[0].MUNICIPIO_ORIGEN);
                $('#estado_origen').val(data_set[0].ESTADO_ORIGEN);
                $('#pais_origen').val(data_set[0].PAIS_ORIGEN);
                $('#cp_origen').val(data_set[0].CP_ORIGEN);
                $('#distancia_origen').val(data_set[0].DISTANCIA_ORIGEN);

                // Asignación de datos de destino
                $('#id_ubicacion_destino').val(data_set[0].ID_DESTINO_DESTINO);
                $('#calle_destino').val(data_set[0].CALLE_DESTINO);
                $('#numero_exterior_destino').val(data_set[0].NUM_EXT_DESTINO);
                $('#numero_interior_destino').val(data_set[0].NUM_INT_DESTINO);
                $('#colonia_destino').val(data_set[0].COLONIA_DESTINO);
                $('#localidad_destino').val(data_set[0].LOCALIDAD_DESTINO);
                $('#referencia_destino').val(data_set[0].REFERENCIA_DESTINO);
                $('#municipio_destino').val(data_set[0].MUNICIPIO_DESTINO);
                $('#estado_destino').val(data_set[0].ESTADO_DESTINO);
                $('#pais_destino').val(data_set[0].PAIS_DESTINO);
                $('#cp_destino').val(data_set[0].CP_DESTINO);
                $('#distancia_destino').val(data_set[0].DISTANCIA_DESTINO);
                // asignar fechas 
                var dateRangePicker = $("#daterangepicker").data("kendoDateRangePicker");
                dateRangePicker.range({
                                start: new Date(data_set[0].FECHA_CARGA+ "T00:00:00"),
                                end: new Date(data_set[0].FECHA_DESCARGA+ "T00:00:00")
                            })

                var fechaInicioStr = $("#fechaInicio").val(data_set[0].FECHA_CARGA);
                var fechaFinStr =  $("#fechaFin").val(data_set[0].FECHA_DESCARGA);
                var fechaInicio = new Date(data_set[0].FECHA_CARGA+ "T00:00:00");
                var fechaFin = new Date(data_set[0].FECHA_DESCARGA+ "T00:00:00");
                var diferenciaMilisegundos = fechaFin.getTime() - fechaInicio.getTime();
                var diferenciaDias = diferenciaMilisegundos / (1000 * 60 * 60 * 24);
                console.log(fechaInicio);
                $('.dias').text('Duración de ' + (diferenciaDias+1) + " días");
                var jsonData =data_set[0].MATERIAL ;
                var dataToLoad = JSON.parse(jsonData);

                // Obtener el DataSource del grid
                var grid = $("#grid_material").data("kendoGrid");
                var dataSource = grid.dataSource;
                dataSource.data(dataToLoad);
                $("#materiales").val(data_set[0].MATERIAL);
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
                    <h5 class="card-title">Remisiones</h5>
                </div>
                <div class="card-body">


                    <form class="row g-3 needs-validation FormularioAjax"
                        action="<?php echo APP_URL; ?>app/ajax/remisionAjax.php" method="POST" autocomplete="off"
                        id="remisiones" enctype="multipart/form-data">
                        <input type="hidden" name="remision" value="registrar">

                        <div class="row gx-3">
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="folio">FOLIO COTIZACIÓN</label>
                                    <input type="text" class="form-control" id="folio_id_cotizacion" name="folio_id"
                                        disabled>
                                    <input type="hidden" class="form-control" id="folio_cotizacion"
                                        name="folio_cotizacion">
                                </div>
                            </div>

                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="folio">FOLIO REMISIÓN</label>
                                    <input type="text" class="form-control" id="folio_id_remision" name="folio_id"
                                        value="<?php echo $FOLIO; ?>" disabled>
                                    <input type="hidden" class="form-control" id="folio_remision" name="folio_remision">
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
                                            "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
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


                            <div class="col-xxl- col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <label for="regimen" class="form-label">Vehículos</label>
                                    <div id="grid"></div>
                                    <input type="hidden" id="vehiculo" name="vehiculo">


                                    <script>
                                    $(document).ready(function() {
                                        var crudServiceBaseUrl =
                                            "<?php echo APP_URL; ?>app/ajax/vehiculosAjax.php";
                                        var dataSource = new kendo.data.DataSource({
                                            transport: {
                                                read: function(e) {
                                                    $.ajax({
                                                        url: crudServiceBaseUrl,
                                                        dataType: "json",
                                                        data: {
                                                            vehiculosCatalogo: "lista_vehiculos_remision"
                                                        },
                                                        type: 'post',
                                                        success: function(data) {
                                                            e.success(data);
                                                        }
                                                    });
                                                },
                                                create: function(e) {
                                                    e.success(e.data);
                                                },
                                                update: function(e) {

                                                    e.success(e.data);
                                                    // on failure
                                                },
                                                destroy: function(e) {
                                                    // on success
                                                    e.success();
                                                    // on failure
                                                }
                                            },
                                            error: function(e) {
                                                // handle data operation error
                                            },
                                            pageSize: 5,
                                            autoSync: true,

                                            schema: {
                                                model: {
                                                    id: 'ID',
                                                    fields: {
                                                        ID: {
                                                            editable: false,
                                                            nullable: true
                                                        },
                                                        IMG: {
                                                            type: 'string'
                                                        },
                                                        OPERADOR: {
                                                            type: 'string'
                                                        },
                                                        TIPO: {
                                                            type: 'string'
                                                        },
                                                        NOVEHICULO: {
                                                            type: 'string'
                                                        },
                                                        DOBLE_ARTICULADO: {
                                                            type: 'string'
                                                        },
                                                        GPS: {
                                                            type: 'string'
                                                        }
                                                    }
                                                }
                                            }
                                        });

                                        var element = $("#grid").kendoGrid({
                                            dataSource: dataSource,
                                            height: 600,
                                            sortable: true,
                                            pageable: true,
                                            detailInit: detailInit,
                                            change: onChange,
                                            columns: [{
                                                    selectable: true,
                                                    width: "50px"
                                                },
                                                {
                                                    field: "NOVEHICULO",
                                                    template: "<div class='product-photo' style='background-image: url(http://localhost:8080/BROSS/#:data.IMG#);'></div><div class='product-name'>#: NOVEHICULO #</div>"
                                                },
                                                {
                                                    field: "TIPO",
                                                },
                                                {
                                                    title: "DOBLE ARTICULADO",
                                                    field: "DOBLE_ARTICULADO",
                                                },
                                                {
                                                    field: "OPERADOR"
                                                },
                                                {
                                                    field: "GPS"
                                                }
                                            ]
                                        });
                                    });

                                    function detailInit(e) {
                                        var crudServiceBaseUrl1 =
                                            "<?php echo APP_URL; ?>app/ajax/vehiculosAjax.php";
                                        var datadrop = new kendo.data.DataSource({
                                            transport: {
                                                read: function(e) {
                                                    $.ajax({
                                                        url: crudServiceBaseUrl1,
                                                        data: {
                                                            vehiculosCatalogo: "drillRelacionRemolque"
                                                        },
                                                        dataType: "json",
                                                        type: 'post',
                                                        success: function(data) {
                                                            e.success(data);
                                                        }
                                                    });
                                                },
                                                create: function(e) {
                                                    // assign an ID to the new item
                                                    // on success
                                                    e.success(e.data);
                                                },
                                                update: function(e) {
                                                    // on success
                                                    e.success();
                                                    // on failure
                                                    //e.error("XHR response", "status code", "error message");
                                                },
                                                destroy: function(e) {
                                                    // locate item in original datasource and remove it
                                                    update.splice(getIndexByIdU(e.data.ID), 1);
                                                    // on success
                                                    e.success();
                                                    // on failure
                                                    //e.error("XHR response", "status code", "error message");
                                                }
                                            },
                                            error: function(e) {
                                                // handle data operation error
                                                alert("Status: " + e.status + "; Error message: " + e
                                                    .errorThrown);
                                            },
                                            autoSync: true,
                                            pageSize: 10,
                                            filter: {
                                                field: "ID",
                                                operator: "eq",
                                                value: e.data.ID
                                            },
                                            schema: {
                                                model: {
                                                    id: "ID",
                                                    fields: {
                                                        ID: {
                                                            type: 'string'
                                                        },
                                                        IMG: {
                                                            type: 'string'
                                                        },
                                                        NOVEHICULO: {
                                                            type: 'string'
                                                        },
                                                        TIPO: {
                                                            type: 'string'
                                                        },
                                                        TIPO_VEHICULO: {
                                                            type: 'string'
                                                        },
                                                    }
                                                }
                                            }
                                        });

                                        $("<div/>").appendTo(e.detailCell).kendoGrid({
                                            dataSource: datadrop,
                                            scrollable: false,
                                            sortable: true,
                                            pageable: true,
                                            columns: [{
                                                    field: "NOVEHICULO",
                                                    template: "<div class='product-photo' style='background-image: url(http://localhost:8080/BROSS/#:data.IMG#);'></div><div class='product-name'>#: NOVEHICULO #</div>"
                                                },
                                                {
                                                    field: "TIPO",
                                                    title: "TIPO DE REMOLQUE",
                                                },
                                                {
                                                    field: "TIPO_VEHICULO",
                                                    title: "REMOLQUE / DOLLY"
                                                }
                                            ]
                                        });
                                    }


                                    function onChange(arg) {
                                        var grid = $("#grid").data("kendoGrid");
                                        var selectedRows = grid.select();

                                        if (selectedRows.length > 0) {
                                            // Obtener el ID del elemento seleccionado
                                            var selectedItem = grid.dataItem(selectedRows[0]);
                                            var selectedId = selectedItem.ID;

                                            // Deshabilitar las filas no seleccionadas
                                            grid.tbody.find("tr").each(function() {
                                                var row = $(this);
                                                var item = grid.dataItem(row);

                                                if (item.ID !== selectedId) {
                                                    row.addClass(
                                                        "k-state-disabled"
                                                    ); // Agregar clase para deshabilitar visualmente
                                                    row.find("input[type='checkbox']").prop("disabled",
                                                        true); // Deshabilitar el checkbox
                                                } else {
                                                    row.removeClass(
                                                        "k-state-disabled"); // Habilitar la fila seleccionada
                                                    row.find("input[type='checkbox']").prop("disabled",
                                                        false); // Habilitar el checkbox
                                                }
                                            });
                                        } else {
                                            // Si no hay selección, habilitar todas las filas
                                            grid.tbody.find("tr").removeClass("k-state-disabled");
                                            grid.tbody.find("input[type='checkbox']").prop("disabled", false);
                                        }

                                        $("#vehiculo").val(this.selectedKeyNames());
                                        console.log("The selected product ids are: [" + this.selectedKeyNames().join(
                                            ", ") + "]");
                                    }
                                    </script>


                                    <style type="text/css">
                                    .k-pdf-export .k-clone,
                                    .k-pdf-export .k-loader-container {
                                        display: none;
                                    }

                                    .customer-photo {
                                        display: inline-block;
                                        width: 40px;
                                        height: 40px;
                                        border-radius: 50%;
                                        background-size: 32px 35px;
                                        background-position: center center;
                                        vertical-align: middle;
                                        line-height: 32px;
                                        box-shadow: inset 0 0 1px #999, inset 0 0 10px rgba(0, 0, 0, .2);
                                        margin-left: 5px;
                                    }

                                    .customer-name {
                                        display: inline-block;
                                        vertical-align: middle;
                                        line-height: 32px;
                                        padding-left: 3px;
                                    }

                                    .k-grid tr .checkbox-align {
                                        text-align: center;
                                        vertical-align: middle;
                                    }

                                    .product-photo {
                                        display: inline-block;
                                        width: 32px;
                                        height: 32px;
                                        border-radius: 50%;
                                        background-size: 32px 35px;
                                        background-position: center center;
                                        vertical-align: middle;
                                        line-height: 32px;
                                        box-shadow: inset 0 0 1px #999, inset 0 0 10px rgba(0, 0, 0, .2);
                                        margin-right: 5px;
                                    }

                                    .product-name {
                                        display: inline-block;
                                        vertical-align: middle;
                                        line-height: 32px;
                                        padding-left: 3px;
                                    }

                                    .k-rating-container .k-rating-item {
                                        padding: 4px 0;
                                    }

                                    .k-rating-container .k-rating-item .k-icon {
                                        font-size: 16px;
                                    }

                                    .dropdown-country-wrap {
                                        display: flex;
                                        flex-wrap: nowrap;
                                        align-items: center;
                                        white-space: nowrap;
                                    }

                                    .dropdown-country-wrap img {
                                        margin-right: 10px;
                                    }

                                    #grid .k-grid-edit-row>td>.k-rating {
                                        margin-left: 0;
                                        width: 100%;
                                    }
                                    </style>
                                </div>
                            </div>




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
                                                                    name="pais_origen">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="cp_origen">CP</label>
                                                                <input type="text" class="form-control" id="cp_origen"
                                                                    name="cp_origen">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="distancia_recorrida_origen">DISTANCIA
                                                                    RECORRIDA</label>
                                                                <input type="text" class="form-control"
                                                                    id="distancia_origen"
                                                                    name="distancia_recorrida_origen" value="0">
                                                            </div>
                                                        </div>

                                                        <div class="col-xxl-12 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">Link
                                                                        GoogleMaps</span>
                                                                    <textarea class="form-control" id="diriniciogoogle"
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
                                                                    id="pais_destino" name="pais_destino">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="cp_destino">CP</label>
                                                                <input type="text" class="form-control" id="cp_destino"
                                                                    name="cp_destino">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="distancia_recorrida_destino">DISTANCIA
                                                                    RECORRIDA</label>
                                                                <input type="text" class="form-control"
                                                                    id="distancia_destino"
                                                                    name="distancia_recorrida_destino">
                                                            </div>
                                                        </div>

                                                        <div class="col-xxl-12 col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">Link
                                                                        GoogleMaps</span>
                                                                    <textarea class="form-control" id="dirfinalgoogle"
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

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="regimen" class="form-label">Material</label>
                                <div id="grid_material"></div>
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
                                    $("#grid_material").kendoGrid({
                                        dataSource: dataSource,
                                        scrollable: true, // Habilitar scroll
                                        
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
                                            }
                                        ],
                                        editable: true
                                    });
                                });

                                function materialEditor(container, options) {
                                    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
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
                                    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
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
                                        <input type="date" id="fechaInicio" name="fechaInicio" style="display: none" >
                                        <input type="date" id="fechaFin" name="fechaFin" style="display: none" >
                                    </div>
                                    <script>
                                    $(document).ready(function() {
                                        var datarange = $("#daterangepicker").kendoDateRangePicker({

                                            "messages": {
                                                "startLabel": "Fecha de Carga",
                                                "endLabel": "Fecha Descarga"
                                            },
                                            // Ejemplo: 20 de noviembre de 2023
                                            format: "yyyy/MM/dd",
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
                                <div class="mb-3">
                                    <div class="input-group" style="PADDING-TOP: 6%;">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="precio" placeholder="Precio"
                                            name="precio">
                                    </div>
                                </div>
                            </div>


                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">NOTAS</span>
                                        <textarea class="form-control" id="notas" name="notas"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-12 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="peso">NÚMERO DE VIAJE ASIGNADO POR EL CLIENTE</label>
                                    <input type="text" class="form-control" id="num_viaje" name="num_viaje">
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

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="razon_social" class="form-label">Razón Social Propietario</label>
                                    <input class="form-control" id="razon_social" name="razon_social"
                                        style="width: 100%;">
                                    <div class="invalid-feedback">Por favor, ingresa la razón social del propietario.
                                    </div>
                                    <script>
                                    $(document).ready(function() {
                                        var operador = [];
                                        var crudServiceBaseUrl =
                                            "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                                        var operador_data = new kendo.data.DataSource({
                                            transport: {
                                                read: function(e) {
                                                    $.getJSON(crudServiceBaseUrl +
                                                        "?catalogo_droplist=leer_razon",
                                                        function(result) {
                                                            var data = JSON.stringify(result,
                                                                null, 2);
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
</div>
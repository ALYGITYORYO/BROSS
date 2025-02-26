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
    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/getID.php";
    $.ajax({
        url: crudServiceBaseUrl + "?variable=remisionGet_ID", // Archivo PHP que contiene los datos
        type: "GET", // Método HTTP (GET o POST)
        success: function(info) {
            // Manejar la respuesta del servidor
            if (info) {
                $('#folio_id_remision').val(info);
                $('#folio_id_remision').val(info);
            } else {
                // $("#resultado").html("Error: " + response.message);
            }
        }
    });



});
</script>

<script>
$(document).ready(function() {
    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/remisionAjax.php";

    let id = <?=$id;?>;
    let dataEmp = {};
    $.ajax({
        type: "POST",
        url: crudServiceBaseUrl,
        data: {
            remision: "leer",
            ID: id
        },
        success: function(response) {
            let data_cotizacion = JSON.parse(response);
            if (data_cotizacion.length == 1) {
                data_set = data_cotizacion[0];
                $("#folio_id_cotizacion").val(data_set.FOLIO);
                $("#cliente").data("kendoComboBox").value(data_set.CLIENTE);

                if (data_set.CONDICION == "credito") {
                    $("#aCredito").prop("checked", true);
                    $('#diasCreditoContainer').show();
                    $('#diasCredito').val(data_set.DIAS_CREDITO);
                    $("#containerespacio").hide();
                } else {
                    $("#alContado").prop("checked", true);
                    $('#diasCreditoContainer').hide();
                    $("#containerespacio").show();
                }

                $('#estadoInicio').append($('<option>', {
                    value: data_set.PUNTO_INICIO_EDO,
                    text: data_set.PUNTO_INICIO_EDO
                }));
                $('#estadoInicio').val(data_set.PUNTO_INICIO_EDO);

                $('#ciudadInicio').append($('<option>', {
                    value: data_set.PUNTO_INICIO_CIUDAD,
                    text: data_set.PUNTO_INICIO_CIUDAD
                }));
                $('#ciudadInicio').val(data_set.PUNTO_INICIO_CIUDAD);

                $('#estadoFinal').append($('<option>', {
                    value: data_set.PUNTO_FINAL_EDO,
                    text: data_set.PUNTO_FINAL_EDO
                }));
                $('#estadoFinal').val(data_set.PUNTO_FINAL_EDO);

                $('#ciudadFinal').append($('<option>', {
                    value: data_set.PUNTO_FINAL_CIUDAD,
                    text: data_set.PUNTO_FINAL_CIUDAD
                }));
                $('#ciudadFinal').val(data_set.PUNTO_FINAL_CIUDAD);

                $("#dirinicio").text(data_set.DIR_INICIO);
                $("#dirfinal").text(data_set.DIR_FINAL);                
                $("#notas").text(data_set.NOTAS);
                $("#linkinicio").text(data_set.LINK_INICIO);
                $("#linkfinal").text(data_set.LINK_FINAL);

                $('#peso').val(data_set.PESO);
                $('#precio').val(data_set.PRECIO);                
                $("#tipos_material").data("kendoComboBox").value(data_set.MATERIAL);            
                if (data_set.TIPO_FISCAL == "no fiscal") {
                    $("#nofiscal").prop("checked", true);
                }
                else{
                    $("#fiscal").prop("checked", true);
                }
                
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
                        id="cotizador" enctype="multipart/form-data">
                        <input type="hidden" name="moduloRemision" value="registrar">

                        <div class="row gx-3">
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="folio">FOLIO COTIZACIÓN</label>
                                    <input type="text" class="form-control" id="folio_id_cotizacion" name="folio_id"
                                        disabled>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="folio">FOLIO REMISIÓN</label>
                                    <input type="text" class="form-control" id="folio_id_remision" name="folio_id"
                                        value="<?php echo $FOLIO; ?>" disabled>
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


                            <div class="col-xxl- col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <label for="regimen" class="form-label">Vehículos</label>
                                    <div id="grid"></div>
                                    <input type="hidden" id="domicilios" name="domicilios">


                                    <script>
                                    $(document).ready(function() {
                                        var crudServiceBaseUrl =
                                            "<?php echo APP_URL; ?>app/Ajax/vehiculosAjax.php";
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
                                            "<?php echo APP_URL; ?>app/Ajax/vehiculosAjax.php";
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

                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">PUNTO DE INICIO (ESTADO)</label>
                                    <select class="form-select" id="estadoInicio" name="estadoinicio">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">PUNTO DE INICIO (CIUDAD)</label>
                                    <select class="form-select" id="ciudadInicio" name="ciudadinicio">
                                        <option >
                                            </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">PUNTO DE FINAL (ESTADO)</label>
                                    <select class="form-select" id="estadoFinal" name="estadofinal">
                                        <option>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">PUNTO DE FINAL (CIUDAD)</label>
                                    <select class="form-select" id="ciudadFinal" name="ciudadfinal">
                                        <option>
                                           </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Dirección Inicio</span>
                                        <textarea class="form-control" id="dirinicio" name="dirinicio"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Dirección Final</span>
                                        <textarea class="form-control" id="dirfinal" name="dirfinal"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Link GoogleMaps Inicio</span>
                                        <textarea class="form-control" id="linkinicio" name="diriniciogoogle"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Link GoogleMaps Final</span>
                                        <textarea class="form-control" id="linkfinal" name="dirfinalgoogle"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="material">MATERIAL</label>
                                    <input class="form-control" id="tipos_material" name="material"
                                        style="width: 100%;" />
                                </div>
                                <script id="noDataTemplatetipos_material" type="text/x-kendo-tmpl">
                                    <div>No se encontró dentro de la base de datos desea guardar a : - '#: instance.text() #' ?</div>
                                        <br />
                                    <button class="k-button" onclick="addNewtipos_material('#: instance.element[0].id #', '#: instance.text() #')">¿Agregar nuevo tipo de material? </button>
                                </script>
                                <!-- segunda seccion  -->
                                <script>
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
                                <script>
                                $(document).ready(function() {
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
                                    $("#tipos_material").kendoComboBox({
                                        filter: "startswith",
                                        dataTextField: "NOMBRE",
                                        dataValueField: "ID",
                                        dataSource: tipos_material_data,
                                        noDataTemplate: $("#noDataTemplatetipos_material").html()
                                    });
                                });
                                </script>
                            </div>

                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="peso">PESO</label>
                                    <input type="number" class="form-control" id="peso" name="peso"
                                        value="<?php echo $PESO; ?>" required>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="fechaCarga">FECHA DE CARGA Y DESCARGA <span
                                            class="badge border border-info text-info dias"><i
                                                class="ri-arrow-right-s-fill"></i> Duración</span></label>
                                    <div class="k-w-300">
                                        <div id="daterangepicker" class="form-control" title="daterangepicker"></div>
                                        <input type="date" id="fechaInicio" name="fechaInicio" style="display: none;"
                                            >
                                        <input type="date" id="fechaFin" name="fechaFin" style="display: none;"
                                            >
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
                                        name="precio" >
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
</div>
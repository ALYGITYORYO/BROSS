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

$objGETreed = new remisionController();
$json_string=$objGETreed->remisionLeer($id);    
$datos = json_decode($json_string, true);
$ID;
$FOLIO;
$CLIENTE;
$PUNTO_INICIO_EDO;
$PUNTO_INICIO_CIUDAD;
$DIR_INICIO;
$PUNTO_FINAL_EDO;
$PUNTO_FINAL_CIUDAD;
$DIR_FINAL;
$MATERIAL;
$PESO;
$FECHA_CARGA;
$FECHA_DESCARGA;
$PRECIO;
foreach ($datos as $item) { // Iterar sobre cada elemento del array principal
$ID = $item["ID"];
$FOLIO = $item["FOLIO"];
$CLIENTE = $item["CLIENTE"];
$PUNTO_INICIO_EDO = $item["PUNTO_INICIO_EDO"];
$PUNTO_INICIO_CIUDAD = $item["PUNTO_INICIO_CIUDAD"];
$DIR_INICIO =$item["DIR_INICIO"];
$PUNTO_FINAL_EDO = $item["PUNTO_FINAL_EDO"];
$PUNTO_FINAL_CIUDAD = $item["PUNTO_FINAL_CIUDAD"];
$DIR_FINAL = $item["DIR_FINAL"];
$MATERIAL =$item["MATERIAL"];
$PESO = $item["PESO"];
$FECHA_CARGA = $item["FECHA_CARGA"];
$FECHA_DESCARGA = $item["FECHA_DESCARGA"];
$PRECIO = $item["PRECIO"];
}

?>

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
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="folio">FOLIO REMISIÓN</label>
                                    <input type="text" class="form-control" id="folio_id" name="folio_id"
                                        value="<?php echo $FOLIO; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="cliente">CLIENTE</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente"
                                        style="width: 100%;" name="folio" value="<?php echo $CLIENTE; ?>">
                                    <div class="invalid-feedback">Por favor, ingresa el remolque asignado.</div>
                                </div>
                            </div>

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
                                            height: 543,
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
															read: function (e) {
																$.ajax({
																	url: crudServiceBaseUrl1,
                                                                    data:{vehiculosCatalogo:"drillRelacionRemolque"},
																	dataType: "json",
																	type: 'post',
																	success: function(data) {
																		e.success(data);
																	}
																});
															},
															create: function (e) {
																// assign an ID to the new item
																// on success
																e.success(e.data);
															},
															update: function (e) {
																// on success
																e.success();
																// on failure
																//e.error("XHR response", "status code", "error message");
															},
															destroy: function (e) {
																// locate item in original datasource and remove it
																update.splice(getIndexByIdU(e.data.ID), 1);
																// on success
																e.success();
																// on failure
																//e.error("XHR response", "status code", "error message");
															}
														},
														error: function (e) {
															// handle data operation error
															alert("Status: " + e.status + "; Error message: " + e.errorThrown);
														},
														autoSync: true,
														pageSize: 10,
														filter: { field: "ID", operator: "eq", value: e.data.ID },              
														schema: {
															model: {
																id: "ID",
																fields: {
																	ID: {type: 'string' },
																	IMG: {type: 'string'},
																	NOVEHICULO: {type: 'string'},
																	TIPO: {type: 'string'},
																	TIPO_VEHICULO: {type: 'string'},
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
                                        <option value="<?php echo $PUNTO_INICIO_EDO; ?>">
                                            <?php echo $PUNTO_INICIO_EDO; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">PUNTO DE INICIO (CIUDAD)</label>
                                    <select class="form-select" id="ciudadInicio" name="ciudadinicio">
                                        <option value="<?php echo $PUNTO_INICIO_CIUDAD; ?>">
                                            <?php echo $PUNTO_INICIO_CIUDAD; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">PUNTO DE FINAL (ESTADO)</label>
                                    <select class="form-select" id="estadoFinal" name="estadofinal">
                                        <option value="<?php echo $PUNTO_FINAL_EDO; ?>"><?php echo $PUNTO_FINAL_EDO; ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">PUNTO DE FINAL (CIUDAD)</label>
                                    <select class="form-select" id="ciudadFinal" name="ciudadfinal">
                                        <option value="<?php echo $PUNTO_FINAL_CIUDAD; ?>">
                                            <?php echo $PUNTO_FINAL_CIUDAD; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Dirección Inicio</span>
                                        <textarea class="form-control" id="abc14" name="dirinicio"
                                            aria-label="With textarea"><?php echo $DIR_INICIO; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Dirección Final</span>
                                        <textarea class="form-control" id="abc14" name="dirfinal"
                                            aria-label="With textarea"><?php echo $DIR_FINAL; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="material">MATERIAL</label>
                                    <input class="form-control" id="tipos_material" name="material" style="width: 100%;"
                                        value="<?php echo $MATERIAL; ?>" />
                                </div>
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
                                            value="<?php echo $FECHA_CARGA; ?>">
                                        <input type="date" id="fechaFin" name="fechaFin" style="display: none;"
                                            value="<?php echo $FECHA_DESCARGA; ?>">
                                    </div>
                                    <script>
                                    $(document).ready(function() {
                                        var start = new Date("<?php echo $FECHA_CARGA; ?>");
                                        var end = new Date(start.getFullYear(), start.getMonth(), start
                                            .getDate() + 20);

                                        var datarange = $("#daterangepicker").kendoDateRangePicker({
                                            startDate: new Date(
                                                "2023-11-15"), // Ejemplo: 15 de noviembre de 2023
                                            endDate: new Date("2023-11-20"),
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
                                <div class="input-group" style="PADDING-TOP: 6%;">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="precio" placeholder="Precio"
                                        name="precio" value="<?php echo $PRECIO; ?>">
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
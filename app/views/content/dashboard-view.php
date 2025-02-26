<?php
		use app\controllers\dashboardController;

		$objcards = new dashboardController();
		$json_string=$objcards->dashboardContent();    
    $datos = json_decode($json_string, true);
    $clientes=0;
    $cotizaciones=0;
    $vehiculos=0;
    foreach ($datos as $item) { // Iterar sobre cada elemento del array principal
      $clientes=$item['CLIENTES'];
      $cotizaciones=$item['COTIZACIONES'];
      $vehiculos=$item['VEHICULOS'];
  }
	?>
<!-- Row starts -->
<div class="row gx-3">
    <div class="col-xxl-12 col-sm-12">
        <div class="card mb-3 bg-2">
            <div class="card-body">
                <div class="py-4 px-3 text-white">
                    <img src="" id="saludo" width="45px">

                    <h6 id="textsaludo" style=" display: contents;"></h6>
                    <h2><?php echo $_SESSION['nombre']." ".$_SESSION['apellido']?></h2>
                    <h5>Pendientes de hoy.</h5>
                    <div class="mt-4 d-flex gap-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-box lg bg-arctic rounded-3 me-3">
                                <i class="ri-surgical-mask-line fs-4"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h2 class="m-0 lh-1">9</h2>
                                <p class="m-0">Entregados</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="icon-box lg bg-lime rounded-3 me-3">
                                <i class="ri-lungs-line fs-4"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h2 class="m-0 lh-1">3</h2>
                                <p class="m-0">incidencias</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="icon-box lg bg-peach rounded-3 me-3">
                                <i class="ri-walk-line fs-4"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h2 class="m-0 lh-1">2</h2>
                                <p class="m-0">en camino</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row ends -->

<!-- Row starts -->
<div class="row gx-3">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="p-2 border border-success rounded-circle me-3">
                        <div class="icon-box md bg-success-subtle rounded-5">
                            <i class="ri-file-user-line fs-4 text-success"></i>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <h2 class="lh-1" id="cantidadClientes"><?php  echo $clientes; ?></h2>
                        <p class="m-0">Clientes</p>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-1">
                    <a class="text-success" href="javascript:void(0);">
                        <span>ver más</span>
                        <i class="ri-arrow-right-line text-success ms-1"></i>
                    </a>
                    <div class="text-end">
                        <p class="mb-0 text-success">.</p>
                        <span class="badge bg-success-subtle text-success small">este mes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="p-2 border border-primary rounded-circle me-3">
                        <div class="icon-box md bg-primary-subtle rounded-5">
                            <i class="ri-lungs-line fs-4 text-primary"></i>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <h2 class="lh-1"><?php  echo $vehiculos; ?></h2>
                        <p class="m-0">Vehiculos</p>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-1">
                    <a class="text-primary" href="javascript:void(0);" data-bs-toggle="modal"
                    data-bs-target="#exampleModalXl_VEHICULOS">
                        <span>ver más</span>
                        <i class="ri-arrow-right-line ms-1"></i>
                    </a>
                    <div class="text-end">
                        <p class="mb-0 text-primary">+30%</p>
                        <span class="badge bg-primary-subtle text-primary small">este mes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalXl_VEHICULOS" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalXlLabel">
                        Vehículos
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id=grid_vehiculos></div>
                </div>
            </div>
        </div>
    </div>

    
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

                                        var element = $("#grid_vehiculos").kendoGrid({
                                            dataSource: dataSource,
                                            height: 600,
                                            sortable: true,
                                            pageable: true,
                                            detailInit: detailInit,
                                            columns: [
                                                {
                                                    field: "NOVEHICULO",
                                                    template: "<div class='product-photo' style='background-image: url(http://localhost:8080/BROSS/#:data.IMG#);'></div><div class='product-name'>#: NOVEHICULO #</div>"
                                                },
                                                {
                                                    field: "TIPO",
                                                },
                                                {
                                                    title: "Doble ATICULADO",
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

    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="p-2 border border-danger rounded-circle me-3">
                        <div class="icon-box md bg-danger-subtle rounded-5">
                            <i class="ri-microscope-line fs-4 text-danger"></i>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <h2 class="lh-1"><?php  echo $cotizaciones; ?></h2>
                        <p class="m-0">Cotizaciones</p>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-1">
                    <a class="text-danger" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#exampleModalXl_COTIZACIONES">
                        <span>ver más</span>
                        <i class="ri-arrow-right-line ms-1"></i>
                    </a>
                    <div class="text-end">
                        <p class="mb-0 text-danger">+60%</p>
                        <span class="badge bg-danger-subtle text-danger small">este mes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModalXl_COTIZACIONES" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalXlLabel">
                        Cotizaciones
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id=grid_cotizaciones></div>
                </div>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function() {
        var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/cotizadorAjax.php";
        var dataSourceR = new kendo.data.DataSource({
            transport: {
                read: function(e) {
                    $.ajax({
                        url: crudServiceBaseUrl,
                        dataType: "json",
                        data: {
                            moduloCotizador: "leer"
                        },
                        type: 'post',
                        success: function(dataq) {

                            e.success(dataq);
                        }
                    });
                },
                create: function(e) {

                    e.success(e.data);
                },
                update: function(e) {

                    e.success();
                    // on failure
                    //e.error("XHR response", "status code", "error message");
                },
                destroy: function(e) {

                    e.success();
                    // on failure
                    //e.error("XHR response", "status code", "error message");
                }
            },
            error: function(e) {
                // handle data operation error
                alert("Status: " + e.status + "; Error message: " + e.errorThrown);
            },
            pageSize: 10,
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
                        },
                        USUARIO: {
                            type: "string"
                        }

                    }
                }
            }
           
        });
        var element = $("#grid_cotizaciones").kendoGrid({
            dataSource: dataSourceR,
            sortable: true,
            filterable: true,
            columnMenu: true,
            pageable: true,
            autoSync: true,
            columns: [{
                    field: "FOLIO",
                    title: "FOLIO"
                }, {
                    field: "CLIENTE",
                    title: "CLIENTE"

                },
                {
                    field: "VIAJE",
                    title: "VIAJE",

                },
                {
                    field: "MATERIAL",
                    title: "MATERIAL",

                },
                {
                    field: "FECHA",
                    title: "FECHA COTIZACION",
                    format: "{0: MMM dd yyyy-HH:mm}",
                },
                {
                    field: "PRECIO",
                    title: "PRECIO",
                    format: "{0:c}"
                }, {
                    field: "USUARIO",
                    title: "USUARIO"
                },
                {
                    template: '<input style="width: 70%;" type="button" class="btn btn-success  aprovate" id="aprovate#:ID#"  onclick="cotizador(#:ID#);" value="Remisionar">',
                    title: ""

                }
            ],
            editable: true
        }).data("kendoGrid");

    });
    </script>

    <script>
    function cotizador(ID) {
        window.location.href = "<?php echo APP_URL; ?>remision?ID=" + ID;
    }
    </script>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="p-2 border border-warning rounded-circle me-3">
                        <div class="icon-box md bg-warning-subtle rounded-5">
                            <i class="ri-money-dollar-circle-line fs-4 text-warning"></i>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <h2 class="lh-1">$98,000</h2>
                        <p class="m-0">Total de ganancias</p>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-1">
                    <a class="text-warning" href="javascript:void(0);">
                        <span>ver más</span>
                        <i class="ri-arrow-right-line ms-1"></i>
                    </a>
                    <div class="text-end">
                        <p class="mb-0 text-warning">+20%</p>
                        <span class="badge bg-warning-subtle text-warning small">este mes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row ends -->



</div>
<!-- App body ends -->

<!-- App footer starts -->
<div class="app-footer bg-white">
    <span>© ERP BROSS admin 2025</span>
</div>
<!-- App footer ends -->

</div>
<!-- App container ends -->

</div>
<!-- Main container ends -->


</div>
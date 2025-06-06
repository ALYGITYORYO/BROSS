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
      $colaboradores=$item['COLABORADORES'];

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
                            <a href="<?php echo APP_URL; ?>listColaboradores">
                                <div class="icon-box lg bg-arctic rounded-3 me-3">
                                    <i class="ri-walk-line fs-4"></i>
                                </div>
                            </a>
                                <div class="d-flex flex-column">
                                    <h2 class="m-0 lh-1"><?php  echo $colaboradores; ?></h2>
                                    <p class="m-0">Colaboradores</p>
                                </div>
                            
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="icon-box lg bg-lime rounded-3 me-3">
                                <i class="ri-surgical-mask-line fs-4"></i>
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
                    <a class="text-success" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#exampleModalXl_CLIENTES">
                        <span>Vista rapida</span>
                        <i class="ri-arrow-right-line text-success ms-1"></i>
                    </a>
                    <div class="text-end">
                        <p class="mb-0 text-success">.</p>
                        <a href="<?php echo APP_URL; ?>listClientes" class="btn btn-outline-success btn-sm rounded-5"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Vista Clientes">
                            <i class="ri-edit-box-line"></i>
                        </a>
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
                            <i class="ri-truck-line fs-4 text-primary"></i>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <h2 class="lh-1"><?php  echo $vehiculos; ?></h2>
                        <p class="m-0">Vehículos c/ Remolque </p>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-1">
                    <a class="text-primary" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#exampleModalXl_VEHICULOS">
                        <span>Vista rapida</span>
                        <i class="ri-arrow-right-line ms-1"></i>
                    </a>
                    <div class="text-end">
                        <p class="mb-0 text-primary">.</p>
                        <a href="<?php echo APP_URL; ?>listLogistica" class="btn btn-outline-info btn-sm rounded-5"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Vista Vehiculos">
                            <i class="ri-edit-box-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalXl_VEHICULOS" tabindex="-1" aria-labelledby="exampleModalXlLabel"
        aria-hidden="true">
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


    <div class="modal fade" id="exampleModalXl_CLIENTES" tabindex="-1" aria-labelledby="exampleModalXlLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalXlLabel">
                        Clientes
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id=grid_clientes></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var crudServiceBaseUrl =
                "<?php echo APP_URL; ?>app/ajax/clienteAjax.php";
            var dataSource = new kendo.data.DataSource({
                transport: {
                    read: function(e) {
                        $.ajax({
                            url: crudServiceBaseUrl,
                            dataType: "json",
                            data: {
                                catalogo_cliente: "lista_clientes"
                            },
                            type: 'post',
                            success: function(data) {

                                e.success(data[0]);
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
                            NOMBRE: {
                                type: 'string'
                            },
                            RFC: {
                                type: 'string'
                            },
                            ESTADO: {
                                type: 'string'
                            },
                            REGIMEN: {
                                type: 'string'
                            },
                            TELEFONO: {
                                type: 'string'
                            }
                        }
                    }
                }
            });

            var element = $("#grid_clientes").kendoGrid({
                dataSource: dataSource,
                sortable: true,
                pageable: true,
                detailInit: detailInit_cliente,
                columns: [{
                        field: "NOMBRE",
                    },
                    {
                        field: "RFC",
                    },
                    {
                        field: "ESTADO"
                    },
                    {
                        field: "REGIMEN"
                    },
                    {
                        field: "TELEFONO",
                        title: "TELÉFONO"
                    }
                ]
            });
        });

        function detailInit_cliente(e) {
            var crudServiceBaseUrl1 =
                "<?php echo APP_URL; ?>app/ajax/clienteAjax.php";
            var datadrop = new kendo.data.DataSource({
                transport: {
                    read: function(e) {
                        $.ajax({
                            url: crudServiceBaseUrl1,
                            data: {
                                catalogo_cliente: "drillRelacionOperativo"
                            },
                            dataType: "json",
                            type: 'post',
                            success: function(data) {
                                console.log(data);
                                alert(data);
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
                    alert("Status: " + e.status + "; Error message: " + e.errorThrown);
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
                            id: {
                                type: 'string'
                            },
                            domicilioOperativo: {
                                type: 'string'
                            },
                            contacto: {
                                type: 'string'
                            },
                            telefono: {
                                type: 'string'
                            },
                            correoElectronico: {
                                type: 'string'
                            },
                        }
                    }
                }
            });

            var domicilios = e.data.DOMICILIOS ? JSON.parse(e.data.DOMICILIOS) : [];
            $("<div/>").appendTo(e.detailCell).kendoGrid({
                dataSource: domicilios,
                scrollable: false,
                sortable: true,
                pageable: true,
                columns: [

                    {
                        field: "domicilioOperativo",
                        title: "OPERACIÓN",
                    }, {
                        field: "contacto",
                        title: "CONTACTO",
                    }, {
                        field: "telefono",
                        title: "TELÉFONO",
                    },
                    {
                        field: "correoElectronico",
                        title: "CORREO"
                    }
                ]
            });
        }
    </script>



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
                            vehiculosCatalogo: "lista_vehiculos_logistica"
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
                        TRACTO: {
                            type: 'string'
                        },
                        PLACAS: {
                            type: 'string'
                        },
                        SERIE: {
                            type: 'string'
                        },
                        DOBLE: {
                            type: 'string'
                        }
                    }
                }
            }
        });

        var element = $("#grid_vehiculos").kendoGrid({
            dataSource: dataSource,
            sortable: true,
            pageable: true,
            detailInit: detailInit_v,
            columns: [{
                    field: "TRACTO",
                    template: "<div class='product-photo' style='background-image: url(<?php echo APP_URL; ?>#:data.IMG#);'></div><div class='product-name'>#: TRACTO #</div>"
                },
                {
                    field: "OPERADOR",
                },
                {                 
                    field: "PLACAS"
                },
                {
                    field: "SERIE"
                },
                {
                    field: "DOBLE",
                    title:"Doble articulado"
                }
            ]
        });
    });

    function detailInit_v(e) {
        var crudServiceBaseUrl1 =
            "<?php echo APP_URL; ?>app/ajax/vehiculosAjax.php";
        var datadrop = new kendo.data.DataSource({
            transport: {
                read: function(e) {
                    $.ajax({
                        url: crudServiceBaseUrl1,
                        data: {
                            vehiculosCatalogo: "drillRelacionRemolqueLog"
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
                alert("Status: " + e.status + "; Error message: " + e.errorThrown);
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
                        SERIE: {
                            type: 'string'
                        },
                        PLACAS: {
                            type: 'string'
                        }
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
                    field: "PLACAS",
                   
                },
                {
                    field: "SERIE",
                   
                },
                {
                    field: "TIPO",
                    title: "TIPO DE REMOLQUE",
                }
            ]
        });
    }
    </script>




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
                        <span>Vista rapida</span>
                        <i class="ri-arrow-right-line ms-1"></i>
                    </a>
                    <div class="text-end">
                        <p class="mb-0 text-danger">.</p>
                        <a href="<?php echo APP_URL; ?>listClientes" class="btn btn-outline-danger btn-sm rounded-5"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Vista Cotizaciones">
                            <i class="ri-edit-box-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModalXl_COTIZACIONES" tabindex="-1" aria-labelledby="exampleModalXlLabel"
        aria-hidden="true">
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
        var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/cotizadorAjax.php";
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

<div class="row gx-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Estatus de viajes </h5>
            </div>
            <div class="card-body">

                <!-- Table starts -->
                <div class="table-outer">
                    <div class="table-responsive">

                        <div id="grid_viajes_remisiones"></div>

                        <script type="text/x-kendo-template" id="template">
                            <div class="tabstrip">
                                        <ul>

                                        <li  class="k-state-active">
                                            VEHÍCULOS
                                        </li>
                                        <li>
                                            FOTOS
                                        </li>
                                        <li>
                                            DATOS
                                        </li>
                                        <li>
                                            INCIDENCIAS
                                        </li>					

                                        </ul>
                                        <div>
                                            <div class="VEHICULOS"></div>
                                        </div>
                                        <div>
                                            <div class="FOTOS"></div>
                                        </div>
                                        <div>
                                            <div class="DATOS"></div>
                                        </div>
                                        <div>
                                            <div class="DATOS"></div>
                                        </div>

                                        </div>

											</script>



                        <script>
                        $(document).ready(function() {
                            var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/viajesAjax.php";
                            var grid = $("#grid_viajes_remisiones").kendoGrid({
                                dataSource: {
                                    transport: {
                                        read: function(e) {
                                            // on success  
                                            $.ajax({
                                                url: crudServiceBaseUrl,
                                                data: {
                                                    viajesControllers: 'leer'
                                                },
                                                dataType: "json",
                                                type: 'post',
                                                success: function(dataq) {

                                                    e.success(dataq[0]);
                                                    console.log(dataq[0]);
                                                }
                                            });
                                        },
                                        error: function(e) {
                                            // handle data operation error
                                            alert("Status: " + e.status + "; Error message: " + e
                                                .errorThrown);
                                        },
                                    },
                                    schema: {
                                        model: {
                                            fields: {
                                                ID: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                ID_VEHI: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                FOLIO: {
                                                    type: "string"
                                                },
                                                CLIENTE: {
                                                    type: "string"
                                                },
                                                ORIGEN: {
                                                    type: "string"
                                                },
                                                DESTINO: {
                                                    type: "string"
                                                },
                                                OPERADOR: {
                                                    type: "string"
                                                },
                                                RZ: {
                                                    type: "string"
                                                },
                                                ESTATUS: {
                                                    type: "string"
                                                }
                                            }
                                        }
                                    },
                                    pageSize: 50,

                                },
                                height: 450,
                                //sortable: true, //ordenado
                                columnMenu: true,
                                //pageable: true, //foother 
                                groupable: true, //para agrupar
                                resizable: true, //columnas reajustables
                                reorderable: true, //reordenamiento de columnas
                                filterable: {
                                    mode: "row"
                                },
                                detailTemplate: kendo.template($("#template").html()),
                                dataBound: function() {
                                    this.expandRow(this.tbody.find("tr.k-master-row").first());
                                },
                                columns: [{
                                        field: "FOLIO",
                                        title: "FOLIO"
                                    },
                                    {
                                        field: "CLIENTE",
                                        title: "CLIENTE"
                                    },
                                    {
                                        field: "ORIGEN",
                                        title: "ORIGEN"
                                    },
                                    {
                                        field: "DESTINO",
                                        title: "DESTINO"
                                    },
                                    {
                                        field: "OPERADOR",
                                        title: "OPERADOR"
                                    },
                                    {
                                        field: "RZ",
                                        title: "RAZON SOCIAL"
                                    },
                                    {
                                        field: "ESTATUS",
                                        title: "ESTATUS"
                                    }
                                ],
                                detailInit: detailInit,

                            }).data("kendoGrid");
                        });


                        function detailInit(e) {

                            var drill_vehiculos = "<?php echo APP_URL; ?>app/ajax/viajesAjax.php";
                            var vehiculos_tab = new kendo.data.DataSource({
                                transport: {
                                    read: function(e) {
                                        $.ajax({
                                            url: drill_vehiculos,
                                            data: {
                                                viajesControllers: "drillVehiculos"
                                            },
                                            dataType: "json",
                                            type: 'post',
                                            success: function(data) {
                                                e.success(data);
                                                console.log(data);
                                            }
                                        });
                                    },
                                    create: function(e) {
                                        // on success
                                        e.success(e.data);
                                    },
                                    update: function(e) {
                                        // locate item in original datasource and update it

                                        // on success
                                        e.success();
                                        // on failure
                                        //e.error("XHR response", "status code", "error message");
                                    },
                                    destroy: function(e) {
                                        // locate item in original datasource and remove it

                                        // on success
                                        e.success();
                                        // on failure
                                        //e.error("XHR response", "status code", "error message");
                                    }
                                },
                                error: function(e) {
                                    // handle data operation error
                                    alert("Status: " + e.status + "; Error message: " + e.errorThrown);
                                },
                                autoSync: true,
                                pageSize: 10,
                                filter: {
                                    field: "ID_RELACION",
                                    operator: "eq",
                                    value: e.data.ID_VEHI
                                },
                                schema: {
                                    model: {
                                        id: "ID",
                                        fields: {
                                            IMG: {
                                                type: "string",
                                            },
                                            FOLIO: {
                                                type: "string",
                                            },
                                            TIPO_VEHICULO: {
                                                type: "string",
                                            }
                                        }
                                    }
                                }
                            });


                            var detailRow = e.detailRow;
                            var detailRow2 = e.detailRow;


                            detailRow.find(".tabstrip").kendoTabStrip({
                                animation: {
                                    open: {
                                        effects: "fadeIn"
                                    }
                                }
                            });
                            detailRow2.find(".tabstrip").kendoTabStrip({
                                animation: {
                                    open: {
                                        effects: "fadeIn"
                                    }
                                }
                            });



                            detailRow.find(".VEHICULOS").kendoGrid({
                                dataSource: vehiculos_tab,
                                scrollable: false,
                                sortable: true,
                                pageable: true,
                                columns: [{
                                        field: "FOLIO",
                                        template: "<div class='product-photo' style='background-image: url(http://localhost:8080/BROSS/#:data.IMG#);'></div><div class='product-name'>#: FOLIO #</div>"
                                    },
                                    {
                                        field: "TIPO_VEHICULO",
                                        title: "VEHICULO"
                                    }
                                ]
                            });
                        }
                        </script>




                    </div>
                </div>
                <!-- Table ends -->

                <!-- Modal starts -->
                <div class="modal fade" id="confirmModalSm" tabindex="-1" aria-labelledby="confirmModalSmLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalSmLabel">
                                    Confirm
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button type="button" class="btn btn-outline-secondary">
                                        Cancel
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        Book
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



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
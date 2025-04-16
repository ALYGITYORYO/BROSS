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
                        <div id="details"></div>
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
                                            <div class="DATOS">
                                            <ul>
                                            <li><label>FECHA LLEGADA:</label></li>
                                            <li><label>KILOMETRAJE:</label></li>
                                            <li><label>FECHA INICIO CARGA:</label></li>
                                            <li><label>FECHA FIN CARGA:</label></li>
                                            <li><label>FECHA RECEPCION DOCUMENTOS:</label></li>
                                            <li><label>FECHA INICIO RUTA:</label></li>
                                            <li><label>FECHA LLEGADA A DESTINO:</label></li>
                                            </ul>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="INCIDENCIAS"></div>
                                        </div>

                                        </div>

											</script>



                        <script>
                            var wnd, detailsTemplate,wnd1, detailsTemplate1;
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
                                height: 850,
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
                            //TABVEHICULOS
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
                            //TABIMAGENES
                            var images = new kendo.data.DataSource({
                                transport: {
                                    read: function(e) {
                                        $.ajax({
                                            url: drill_vehiculos,
                                            data: {
                                                viajesControllers: "drillimg"
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
                                        // assign an ID to the new item
                                        e.data.ID = sampleDataNextUP++;
                                        // save data item to the original datasource
                                        update.push(e.data);
                                        // on success
                                        e.success(e.data);
                                    },
                                    update: function(e) {
                                        // locate item in original datasource and update it
                                        update[getIndexByIdU(e.data.ID)] = e.data;


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
                                    field: "ID_VIAJE",
                                    operator: "eq",
                                    value: e.data.ID
                                },
                                schema: {
                                    model: {
                                        id: "ID",
                                        fields: {
                                            ID: {
                                                editable: false,
                                                nullable: true
                                            },
                                            USUARIO: {
                                                type: "string"
                                            },
                                            FECHA: {
                                                type: "date"

                                            },
                                            ESTATUS: {
                                                type: "string"

                                            },
                                            IMG: {
                                                type: "string"

                                            }
                                        }
                                    }
                                }
                            });
                            //TABINCIDENCIAS
                            var incidencias = new kendo.data.DataSource({
                                transport: {
                                    read: function(e) {
                                        $.ajax({
                                            url: drill_vehiculos,
                                            data: {
                                                viajesControllers: "incidenciadrill"
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
                                    field: "ID_VIAJE",
                                    operator: "eq",
                                    value: e.data.ID
                                },
                                schema: {
                                    model: {
                                        id: "ID",
                                        fields: {
                                            IMG: {
                                                type: "string",
                                            },
                                            TIPO_INSIDENCIA: {
                                                type: "string",
                                            },
                                            NOTA: {
                                                type: "string",
                                            }
                                            ,
                                            FECHA: {
                                                type: "date",
                                            }
                                        }
                                    }
                                }
                            });
                            var detailRow = e.detailRow;
                            var detailRow2 = e.detailRow;
                            var detailRow3 = e.detailRow;

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
                            detailRow3.find(".tabstrip").kendoTabStrip({
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
                            detailRow2.find(".FOTOS").kendoGrid({
                                dataSource: images,
                                sortable: true,
                                pageable: true,
                                columns: [{
                                        field: "IMG",
                                        title: " ",
                                        template: "<div class='product-photo' style='background-image: url(http://localhost:8080/BROSS/#:data.IMG#);'></div><div class='product-name'>#: ESTATUS #</div>"
                                    },
                                    {
                                        field: "FECHA",
                                        title: "FECHA INGRESO",
                                        format: "{0:yyyy-MM-dd HH:mm}"
                                    },
                                    {
                                        field: "USUARIO",
                                        title: "USUARIO"
                                    },
                                    {
                                        command: {
                                            text: "Ver",
                                            click: showDetails
                                        },
                                        title: " ",
                                    }
                                ]
                            });

                            detailRow3.find(".INCIDENCIAS").kendoGrid({
                                dataSource: incidencias,
                                sortable: true,
                                pageable: true,
                                columns: [{
                                        field: "IMG",
                                        title: " ",
                                        template: "<div class='product-photo' style='background-image: url(http://localhost:8080/BROSS/#:data.IMG#);'></div><div class='product-name'>#: TIPO_INCIDENCIA #</div>"
                                    },
                                    {
                                        field: "FECHA",
                                        title: "FECHA INCIDENCIA",
                                        format: "{0:yyyy-MM-dd HH:mm}"
                                    },
                                    {
                                        field: "NOTA",
                                        title: "NOTA"
                                    },
                                    {
                                        command: {
                                            text: "Ver",
                                            click: showDetails1
                                        },
                                        title: " ",
                                    }
                                ]
                            });

                            
                            wnd = $("#details").kendoWindow({
                                title: "Imagen ingresada",
                                modal: true,
                                visible: false,
                                resizable: true,
                                width: 700
                            }).data("kendoWindow");

                            detailsTemplate = kendo.template($("#template_imgen").html());

                            wnd1 = $("#details").kendoWindow({
                                title: "incidencia ingresada",
                                modal: true,
                                visible: false,
                                resizable: true,
                                width: 700
                            }).data("kendoWindow");

                            detailsTemplate1 = kendo.template($("#template_incidencia").html());

                        }
                        
                        function showDetails(e) {
                            e.preventDefault();                            
                            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                            wnd.content(detailsTemplate(dataItem));
                            wnd.center().open();
                        }

                        function showDetails1(e) {
                            e.preventDefault();                            
                            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                            wnd.content(detailsTemplate1(dataItem));
                            wnd.center().open();
                        }
                        </script>
                        <script type="text/x-kendo-template" id="template_imgen">
                            <div id="details-container">            
            <em>#= ESTATUS #</em>
            <img src="http://localhost:8080/BROSS/#:data.IMG#" alt="BROSS #: ESTATUS #" />

        </div>
    </script>

    <script type="text/x-kendo-template" id="template_incidencia">
                            <div id="details-container">            
            <em>#= TIPO_INCIDENCIA #</em>
            <img src="http://localhost:8080/BROSS/#:data.IMG#" alt="BROSS #: TIPO_INCIDENCIA #" />

        </div>
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
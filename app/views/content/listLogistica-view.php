<div class="row gx-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Logística de vehículos  </h5>
            </div>
            <div class="card-body">


            <div id="grid_logVehiculos"></div>
            <div id="details"></div>
            <script>
                var wnd,
                detailsTemplate;
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

        var element = $("#grid_logVehiculos").kendoGrid({
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
                },
                { 
					field: "ID", title: "Eliminar", 
					template: `<button style="width: 80%;" class="btn btn-danger" onclick="deleteVinculoVehiculo(#:ID#)">Eliminar</button>`
				},
                { command: { text: "Modificaciones", click: showDetails }, title: "Modificar", }
            ]
        });
    });
    
    
    wnd = $("#details")
                        .kendoWindow({
                            title: "Detalles del cliente",
                            modal: true,
                            visible: false,
                            resizable: false,
                            width: 300
                        }).data("kendoWindow");
    
    function showDetails(e) {
                    e.preventDefault();
                    detailsTemplate = kendo.template($("#template").html());
                    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                    wnd.content(detailsTemplate(dataItem));
                    wnd.center().open();
                }

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
<script>
    function deleteVinculoVehiculo(id){
    var crudServiceBaseUrl ="<?php echo APP_URL; ?>app/ajax/vehiculosAjax.php";
    Swal.fire({
    title: "ELIMINAR",
    text: "Razon por la cual se elimina ",
    input: 'textarea',
    inputAttributes: {
        'aria-label': 'Type your message here'
    },
    showCancelButton: true,
    inputValidator: (value) => {
        return new Promise((resolve) => {
            if (value === '') {
                resolve('Necesita ingresar la razon');
            } else {
                $.ajax({
                    url: crudServiceBaseUrl,
                    type: "POST",
                    data: {
                        vehiculosCatalogo: "eliminarLogV",
                        CAUSA:value,
                        ID: id
                    },
                    success: function(res) {
                        console.log(res);
                        Swal.fire({
                    title: "Operador, Tracto y Remolques Desvinculado",
                    type: "success"
                }).then(v =>  location.reload());

                    }
                });
            }
        });
    }
});
}
    </script>

<script type="text/x-kendo-template" id="template">
                <div id="details-container">
                    <h2>#= TRACTO # </h2>
                    <em>OPERADOR: #= OPERADOR #</em>
                    <dl>
                        <dt>Ciudad: #= SERIE #</dt><br>
                        <dt>Punto de Venta: #=PLACAS #</dt>
                    </dl>
					<center>
					<button type="button" class="btn btn-primary" onclick="modifica('#=ID#')">Abrir</button>
					<br>
					<button type="button" class="btn btn-success mt-2" onclick="transformClient('#=ID#')">Convertir a cliente</button>
					<br>
					<button type="button" class="btn btn-success mt-2" onclick="deleteClient('#=ID#')">Eliminar</button>
					
					</center>
                </div>
            </script> 
            </div>
        </div>
    </div>
</div>
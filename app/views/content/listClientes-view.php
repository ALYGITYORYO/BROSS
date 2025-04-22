<div class="row gx-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Clientes </h5>
            </div>
            <div class="card-body">


            <div id="grid_clientes"></div>
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
                        ,
                        CP: {
                            type: 'string'
                        }
                        ,
                        CONDICIONES: {
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
            columnMenu: true,
            groupable: true, //para agrupar
            resizable: true, //columnas reajustables
            reorderable: true, //reordenamiento de columnas
            filterable: {
            mode: "row"
            },

            detailInit: detailInit_cliente,
            columns: [
                {
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
                } ,
                {
                    field: "CP",
                    title: "CP"
                }
                ,
                {
                    field: "CONDICIONES",
                    title: "CONDICIONES"
                }
                ,
                {
                    template: '<input style="width: 70%;" type="button" class="btn btn-success  aprovate" id="aprovate#:ID#"  onclick="mod_cliente(#:ID#);" value="Modificar">',
                    title: ""
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
    function mod_cliente(ID) {
        window.location.href = "<?php echo APP_URL; ?>modificaCliente?ID=" + ID;
    }
    </script>
            </div>
        </div>
    </div>
</div>
<div class="row gx-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Vehiculos </h5>
            </div>
            <div class="card-body">


            <div id="grid_vehiculos"></div>
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
                            vehiculosCatalogo: "listar"
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
            pageSize: 10,
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
                        NOVEHICULO: {
                            type: 'string'
                        },
                        FOTO_UNIDAD: {
                            type: 'string'
                        },
                        TIPO_VEHICULO: {
                            type: 'string'
                        },
                        MARCA: {
                            type: 'string'
                        },
                        PLACAS: {
                            type: 'string'
                        }
                        ,
                        OPERADOR: {
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
            columnMenu: true,
            groupable: true, //para agrupar
            resizable: true, //columnas reajustables
            reorderable: true, //reordenamiento de columnas
            filterable: {
            mode: "row"
            },
            columns: [
                
                {
                    field: "NOVEHICULO",
                    title: "N° EMPLEADO",
                    template: "<div class='product-photo' style='background-image: url(<?php echo APP_URL; ?>/#:data.FOTO_UNIDAD#);'></div><div class='product-name'>#: NOVEHICULO #</div>"
                },
                {
                    field: "TIPO_VEHICULO"
                },
                {
                    field: "MARCA"
                },
                {
                    field: "PLACAS"                    
                } ,
                {
                    field: "OPERADOR",
                    title: "OPERADOR"
                }
                ,
                
                {
                    template: '<input style="width: 70%;" type="button" class="btn btn-success  aprovate" id="aprovate#:ID#"  onclick="mod_cliente(#:ID#);" value="Modificar">',
                    title: ""
                }
            ]
        });
    });
    </script>

<script>
    function mod_cliente(ID) {
        window.location.href = "<?php echo APP_URL; ?>modificaVehiculo?ID=" + ID;
    }
    </script>
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
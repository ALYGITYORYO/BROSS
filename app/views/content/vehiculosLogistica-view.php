<div class="row gx-3">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"> Logística de Vehículos </h5>
            </div>
            <div class="card-body">
<!-- Row starts -->

<form class="row g-3 needs-validation FormularioAjax"
                    action="<?php echo APP_URL; ?>app/ajax/logisticaAjax.php" method="POST" autocomplete="off"
                    id="form_logistica" enctype="multipart/form-data" >
                    <input type="hidden" name="moduloLogistica" value="registrar"> 
                      <div class="col-md-4">
                        <label for="operador_asignado" class="form-label">Operador Asignado</label>
                        <input type="text" class="form-control" id="operador_asignado" name="operador_asignado" style="width: 100%;" require>
                       
                        <script>
                            $(document).ready(function() {
                                var operador = [];
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                                var operador_data = new kendo.data.DataSource({
                                    transport: {
                                        read: function(e) {
                                            $.getJSON(crudServiceBaseUrl +
                                                "?catalogo_droplist=leer_operador",
                                                function(result) {
                                                    var data = JSON.stringify(result, null, 2);
                                                    operador = result;
                                                    sampleDataNextoperador = operador.length;
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
                                                NOEMPLADO: {
                                                    type: "string"
                                                }
                                            }
                                        }
                                    }
                                });
                                $("#operador_asignado").kendoComboBox({
                                    template: '<span class="ID">#= NOEMPLEADO #</span> #= NOMBRE #',
                                    dataTextField: "NOMBRE",
                                    dataValueField: "ID",
                                    required: true,
    validationMessage: "Este campo es obligatorio" ,
                                    dataSource: operador_data,
                                    filter: "contains"
                                });

                            });
                            </script>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Tracto </label>
                        <input type="text" class="form-control" id="tracto_asignado" name="tracto_asignado" style="width: 100%;">
                      <script>
                            $(document).ready(function() {
                                var operador = [];
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                                var operador_data = new kendo.data.DataSource({
                                    transport: {
                                        read: function(e) {
                                            $.getJSON(crudServiceBaseUrl +
                                                "?catalogo_droplist=leer_tracto",
                                                function(result) {
                                                    var data = JSON.stringify(result, null,
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
                                                }
                                                ,
                                                SERIE: {
                                                    type: "string"
                                                }
                                                ,
                                                PLACAS: {
                                                    type: "string"
                                                }
                                                ,
                                                IMG: {
                                                    type: "string"
                                                }
                                            }
                                        }
                                    }
                                });
                                $("#tracto_asignado").kendoComboBox({                                    
                                    dataTextField: "SERIE",
                                    dataValueField: "ID",                                   
                                    footerTemplate: 'Total #: instance.dataSource.total() # Tractos',
                                    valueTemplate: '<span class="selected-value" style="background-image: url(\'#:data.IMG#\')"></span><span>#:data.NOMBRE#</span>',
                                    template: '<span class="k-state-default" style="background-image: url(\'#:data.IMG#\')"></span>' +
                                  '<span class="k-state-default"><h4> SERIE: #: data.SERIE #</h4><p> PLACAS: #: data.PLACAS #</p> <p> ID TRACTO: #: data.NOMBRE #</p></span>',
                                    dataSource: operador_data,
                                    filter: "contains"
                                    
                                });

                            });
                            </script>
                      

                      </div>
                      <div class="col-md-4">
                      <label class="form-label">Doble articulado
                            </label>
                            <div class="m-0">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="dobleArticulado" id="doble_si"
                                        value="si">
                                    <label class="form-check-label" for="alContado">SI</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="dobleArticulado" id="doble_no"
                                        value="no" checked>
                                    <label class="form-check-label" for="no">NO</label>
                                </div>
                            </div>
                      </div>
                      <script>
                        $(document).ready(function() {
                            $('input[name="dobleArticulado"]').change(function() {
                                if ($(this).val() === 'si') {
                                    $('#dollyContainer').show();
                                    $('#remolque2Container').show();
                                    

                                } else {
                                    $('#dollyContainer').hide();
                                    $('#remolque2Container').hide();

                                }
                            });
                        });
                        </script>
                        <div class="col-md-4" id="dollyContainer" style="display: none;">
                            <label for="remolque_asignado" class="form-label">Asignar DOLLY</label>
                            <input type="text" class="form-control" id="dolly_asignado" name="dolly_asignado"
                                style="width: 100%;" require>
                           
                            <script>
                            $(document).ready(function() {
                                var operador = [];
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                                var operador_data = new kendo.data.DataSource({
                                    transport: {
                                        read: function(e) {
                                            $.getJSON(crudServiceBaseUrl +
                                                "?catalogo_droplist=leer_dolly",
                                                function(result) {
                                                    var data = JSON.stringify(result, null,
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
                                                SERIE: {
                                                    type: "string"
                                                }
                                                ,
                                                PLACAS: {
                                                    type: "string"
                                                }
                                                ,
                                                IMG: {
                                                    type: "string"
                                                }
                                            }
                                        }
                                    }
                                });
                                $("#dolly_asignado").kendoComboBox({

                                    dataTextField: "SERIE",
                                    dataValueField: "ID",                                   
                                    footerTemplate: 'Total #: instance.dataSource.total() # DOLLYs',
                                    valueTemplate: '<span class="selected-value" style="background-image: url(\'#:data.IMG#\')"></span><span>#:data.NOMBRE#</span>',
                                    template: '<span class="k-state-default" style="background-image: url(\'#:data.IMG#\')"></span>' +
                                  '<span class="k-state-default"><h4> SERIE: #: data.SERIE #</h4><p> PLACAS: #: data.PLACAS #</p> <p> ID TRACTO: #: data.NOMBRE #</p></span>',
                                    dataSource: operador_data,
                                    filter: "contains"
                                });

                            });
                            </script>


                        </div>

                      <div class="col-md-4" >
                      <label for="remolque_asignado" class="form-label">Asignar Remolque 1</label>
                      <input type="text" class="form-control" id="remolque1_asignado" name="remolque1_asignado" style="width: 100%;" require>
                      <script>
                            $(document).ready(function() {
                                var operador = [];
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                                var operador_data = new kendo.data.DataSource({
                                    transport: {
                                        read: function(e) {
                                            $.getJSON(crudServiceBaseUrl +
                                                "?catalogo_droplist=leer_remolque",
                                                function(result) {
                                                    var data = JSON.stringify(result, null,
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
                                                SERIE: {
                                                    type: "string"
                                                }
                                                ,
                                                PLACAS: {
                                                    type: "string"
                                                }
                                                ,
                                                FOTO: {
                                                    type: "string"
                                                }
                                            }
                                        }
                                    }
                                });
                                $("#remolque1_asignado").kendoComboBox({

                                    dataTextField: "SERIE",
                                    dataValueField: "ID",                                   
                                    footerTemplate: 'Total #: instance.dataSource.total() # Remolques',
                                    valueTemplate: '<span class="selected-value" style="background-image: url(\'#:data.FOTO#\')"></span><span>#:data.NOMBRE#</span>',
                                    template: '<span class="k-state-default" style="background-image: url(\'#:data.FOTO#\')"></span>' +
                                  '<span class="k-state-default"><h4> SERIE: #: data.SERIE #</h4><p> PLACAS: #: data.PLACAS #</p> <p> ID TRACTO: #: data.NOMBRE #</p></span>',
                                    dataSource: operador_data,
                                    filter: "contains"
                                });

                            });
                            </script>
                      </div>

                      <div class="col-md-4" id="remolque2Container" style="display: none;">
                      <label for="remolque_asignado" class="form-label">Asignar Remolque 2</label>
                      <input type="text" class="form-control" id="remolque2_asignado" name="remolque2_asignado" style="width: 100%;" require>
                      <script>
                            $(document).ready(function() {
                                var operador = [];
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/ajax/droplistAjax.php";
                                var operador_data = new kendo.data.DataSource({
                                    transport: {
                                        read: function(e) {
                                            $.getJSON(crudServiceBaseUrl +
                                                "?catalogo_droplist=leer_remolque",
                                                function(result) {
                                                    var data = JSON.stringify(result, null,
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
                                                SERIE: {
                                                    type: "string"
                                                }
                                                ,
                                                PLACAS: {
                                                    type: "string"
                                                }
                                                ,
                                                FOTO: {
                                                    type: "string"
                                                }
                                            }
                                        }
                                    }
                                });
                                $("#remolque2_asignado").kendoComboBox({

                                    dataTextField: "SERIE",
                                    dataValueField: "ID",                                   
                                    footerTemplate: 'Total #: instance.dataSource.total() # Tractos',
                                    valueTemplate: '<span class="selected-value" style="background-image: url(\'#:data.FOTO#\')"></span><span>#:data.NOMBRE#</span>',
                                    template: '<span class="k-state-default" style="background-image: url(\'#:data.FOTO#\')"></span>' +
                                  '<span class="k-state-default"><h4> SERIE: #: data.SERIE #</h4><p> PLACAS: #: data.PLACAS #</p> <p> ID TRACTO: #: data.NOMBRE #</p></span>',
                                    dataSource: operador_data,
                                    filter: "contains"
                                });

                            });
                            </script>
                      </div>

                      <div class="col-12">
                            <div class="d-flex gap-2 justify-content-end">

                                <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
                                <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>

                            </div>
                        </div>

                    </form>

            <!-- Row ends -->


            </div>
        </div>
    </div>
</div>


<style>

.dropdown-header {
    border-width: 0 0 1px 0;
    text-transform: uppercase;
}

.dropdown-header > span {
    display: inline-block;
    padding: 10px;
    margin-right: 30px;
}

.dropdown-header > span:first-child {
    width: 50px;
}

.k-list-container > .k-footer {
    padding: 10px;
}

.selected-value {
    display: inline-block;
    vertical-align: middle;
    width: 24px;
    height: 24px;
    background-size: 100%;
    margin-right: 5px;
    border-radius: 50%;
}

#customers-list .k-list-item-text {
   
}

/* Material Theme padding adjustment*/

.k-material #customers-list .k-list-item-text,
.k-material #customers-list .k-list-item-text.k-hover,
.k-materialblack #customers-list .k-list-item-text,
.k-materialblack #customers-list .k-list-item-text.k-hover {
    padding-left: 5px;
    border-left: 0;
}

#customers-list .k-list-item-text > span {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    display: inline-block;
    vertical-align: top;
    margin: 10px 5px 5px 2px;
}

#customers-list .k-list-item-text > span:first-child {
    -moz-box-shadow: inset 0 0 30px rgba(0,0,0,.3);
    -webkit-box-shadow: inset 0 0 30px rgba(0,0,0,.3);
    box-shadow: inset 0 0 30px rgba(0,0,0,.3);
    margin: 10px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-size: 100%;
    background-repeat: no-repeat;
}

#customers-list h3 {
    font-size: .5em;
   
    margin: 0 0 1px 0;
    padding: 0;
}

#customers-list p {
    margin: 0;
    padding: 0;
    font-size: .3em;
}

</style>

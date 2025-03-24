<script id="noDataTemplate" type="text/x-kendo-tmpl">
                                <div>
                                No data found. Do you want to add new item - '#: instance.filterInput.val() #' ?
                                </div>
                                <br />
                                <button class="k-button k-button-solid-base k-button-solid k-button-md k-rounded-md" onclick="addNew('#: instance.element[0].id #', '#: instance.filterInput.val() #')">Add new item
                                </button>
                            </script>
                            <script>
                            function addNew(widgetId, value) {
                                var widget = $("#" + widgetId).getKendoDropDownList();
                                var dataSource = widget.dataSource;
                                if (confirm("Are you sure?")) {
                                    
                                    
                                    dataSource.one("sync", function() {
                                        widget.select(dataSource.view().length - 1);
                                    });
                                    dataSource.sync();
                                }
                            };
                            </script>
                            <script>
                            $(document).ready(function() {
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                var dataSource = new kendo.data.DataSource({
                                    batch: true,
                                    transport: {
                                        read: {
                                            url: crudServiceBaseUrl +
                                                "?catalogo_droplist=leer", // Archivo PHP para obtener los regímenes existentes
                                            dataType: "json"
                                        },
                                        create: {
                                            url: crudServiceBaseUrl +
                                                "?catalogo_droplist=registrar", // Archivo PHP para guardar el nuevo régimen
                                            dataType: "json",
                                            type: "POST"
                                        },
                                        parameterMap: function(options, operation) {
                                            if (operation === "create" && options.models) {
                                                console.log(options.models[0].NOMBRE);
                                                console.log(options.models[0].ID);

                                                return {
                                                    text: options.models[0].NOMBRE
                                                }; // Enviar solo el nombre
                                            }
                                            return options; // Para read y otros operations
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
                                $("#especialidad").kendoDropDownList({
                                    filter: "startswith",
                                    dataTextField: "NOMBRE",
                                    dataValueField: "ID",
                                    dataSource: dataSource,
                                    noDataTemplate: $("#noDataTemplate").html()
                                });
                            });
                            </script>
                            <style>
                            .k-no-data {
                                display: table;
                                width: 100%;
                                padding-top: 20px;
                            }
                            </style>


<script id="noDataTemplate" type="text/x-kendo-tmpl">
                                <div>
                                No data found. Do you want to add new item - '#: instance.filterInput.val() #' ?
                                </div>
                                <br />
                                <button class="k-button k-button-solid-base k-button-solid k-button-md k-rounded-md" onclick="addNew('#: instance.element[0].id #', '#: instance.filterInput.val() #')">Add new item
                                </button>
                            </script>
                            <script>
                            function addNew(widgetId, value) {
                                var widget = $("#" + widgetId).getKendoDropDownList();
                                var dataSource = widget.dataSource;
                                if (confirm("Are you sure?")) {
                                    dataSource.add({
                                        ID: widgetId,
                                        NOMBRE: value
                                    });
                                    
                                    dataSource.one("sync", function() {
          var index = dataSource.view().length - 1;
          var newValue = dataSource.at(index).ID;
          widget.value(widget.value().concat([newValue]));
        });
        dataSource.sync();
                                    
                                }
                            };
                            </script>
                            <script>
                            $(document).ready(function() {
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                var dataSource = new kendo.data.DataSource({
                                    batch: true,
                                    transport: {
                                        read: {
                                            url: crudServiceBaseUrl +
                                                "?catalogo_droplist=leer", // Archivo PHP para obtener los regímenes existentes
                                            dataType: "json"
                                        },
                                        create: {
                                            url: crudServiceBaseUrl +
                                                "?catalogo_droplist=registrar", // Archivo PHP para guardar el nuevo régimen
                                            dataType: "json",
                                            type: "POST"
                                        },
                                        parameterMap: function(options, operation) {
                                            if (operation === "create" && options.models) {
                                                return {
                                                    text: options.models[0].NOMBRE
                                                }; // Enviar solo el nombre
                                            }
                                            return options; // Para read y otros operations
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
                                $("#especialidad").kendoDropDownList({
                                    filter: "startswith",
                                    dataTextField: "NOMBRE",
                                    dataValueField: "ID",
                                    dataSource: dataSource,
                                    noDataTemplate: $("#noDataTemplate").html()
                                });
                            });
                            </script>
                            <style>
                            .k-no-data {
                                display: table;
                                width: 100%;
                                padding-top: 20px;
                            }
                            </style>



























<div id="grid"></div>
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
                                        pageSize: 20,autoSync: true,
                                        transport: {
                                            create: function(e) {
                                        e.data.Id = kendo.guid(); // Usar GUIDs para IDs únicos
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
                                        const index = material.findIndex(item => item.Id === e
                                            .data.Id);
                                        if (index !== -1) {
                                            material[index] = e.data;
                                            $("#materiales").val(JSON.stringify(material));
                                        }
                                    },
                                        },
                                        schema: {
                                            model: {
                                                id: "Id",
                                                fields: {
                                                    MATERIAL: { defaultValue: { ID: 1, NOMBRE: "SELECCIONA UN MATERIAL"} },
                                                    
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

                                    $("#grid").kendoGrid({
                                        dataSource: dataSource,
                                        
                                        scrollable: true, // Habilitar scroll
                                        toolbar: ["create"],
                                        
                                        columns: [
                                            { field: "MATERIAL", title: "material",  editor: materialEditor, template: "#=MATERIAL.NOMBRE#" },
                                            {
                                                field: "PESO"
                                            },
                                            {
                                                field: "UNIDAD"
                                            },
                                            {
                                        command: [ "destroy"],
                                        title: "&nbsp;"
                                    }
                                        ],
                                        editable: true
                                    });

                                });


                                var tipos_material = [];
                                var sampleDataNexttipos_material = 0;
                                function materialEditor(container, options) {
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

                                    

                                    
    var comboBoxId = "materialComboBox_" + options.model.uid;

$('<input id="' + comboBoxId + '" data-bind="value:' + options.field + '"/>')
                                        .appendTo(container)
                                        .kendoDropDownList({
                                            filter: "startswith",
                                            
                                            dataTextField: "NOMBRE",
                                            dataValueField: "ID",
                                            dataSource: tipos_material_data,
                                            noDataTemplate: $("#noDataTemplatetipos_material").html(),
                                            change: function(e) {
                    var selectedItem = this.dataItem();
                    if (selectedItem) {
                        options.model.set(options.field, selectedItem);
                    } else {
                        options.model.set(options.field, null);
                    }
                }
                                        });
                                }


                                var categories = [{
            "ID": 1,
            "NOMBRE": "Beverages"
        }, {
            "ID": 2,
            "NOMBRE": "Condiments"
        }];

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
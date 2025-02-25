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
<script>
$(document).ready(function() {
    var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/getID.php";
    $.ajax({
        url: crudServiceBaseUrl + "?variable=cotizadorGet_ID", // Archivo PHP que contiene los datos
        type: "GET", // Método HTTP (GET o POST)
        success: function(info) {
            // Manejar la respuesta del servidor
            if (info) {
                $('#folio_id').val(info);
                $('#folio').val(info);
            } else {
                // $("#resultado").html("Error: " + response.message);
            }
        }
    });
});
</script>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Cotización</h5>
                </div>
                <div class="card-body">


                    <form class="row g-3 needs-validation FormularioAjax"
                        action="<?php echo APP_URL; ?>app/ajax/cotizadorAjax.php" method="POST" autocomplete="off"
                        id="cotizador" enctype="multipart/form-data">
                        <input type="hidden" name="moduloCotizador" value="registrar">

                        <div class="row gx-3">
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="folio">FOLIO</label>
                                    <input type="text" class="form-control" id="folio_id" name="folio_id" disabled>
                                    <input type="hidden" class="form-control" id="folio" name="folio">

                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="cliente">CLIENTE</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente"
                                        style="width: 100%;">
                                    <div class="invalid-feedback">Por favor, ingresa elremoolque asignado.</div>
                                    <script>
                                    $(document).ready(function() {
                                        var operador = [];
                                        var crudServiceBaseUrl =
                                            "<?php echo APP_URL; ?>app/Ajax/droplistAjax.php";
                                        var operador_data = new kendo.data.DataSource({
                                            transport: {
                                                read: function(e) {
                                                    $.getJSON(crudServiceBaseUrl +
                                                        "?catalogo_droplist=leer_cliente",
                                                        function(result) {
                                                            var data = JSON.stringify(result,
                                                                null,
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
                                                        RFC: {
                                                            type: "string"
                                                        },
                                                        DIAS: {
                                                            type: "string"
                                                        },
                                                        CONDICIONES: {
                                                            type: "string"
                                                        }

                                                    }
                                                }
                                            }
                                        });
                                        $("#cliente").kendoComboBox({

                                            template: '<span class="ID">#= NOMBRE # , RFC #= RFC #',
                                            dataTextField: "NOMBRE",
                                            dataValueField: "ID",
                                            dataSource: operador_data,
                                            change: onChange,
                                            filter: "contains",

                                        });

                                        function onChange() {
                                            var dropdownlist_clientes_venta = $("#cliente").data(
                                                "kendoComboBox");
                                            var selectedDataItem_cliente = dropdownlist_clientes_venta
                                                .dataItem();

                                            const dias = selectedDataItem_cliente.DIAS;
                                            const condiciones = selectedDataItem_cliente.CONDICIONES;
                                            if (condiciones == "credito") {
                                                $("#diasCreditoContainer").show();
                                                $("#diasCredito").val(dias);
                                                $("#aCredito").prop('checked', true);
                                                $("#containerespacio").hide();
                                            } else {
                                                $("#alContado").prop('checked', true);
                                                $("#diasCreditoContainer").hide();
                                                $("#diasCredito").val("0");
                                                $("#containerespacio").show();

                                            }
                                        }
                                    });
                                    </script>
                                </div>
                            </div>


                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Condiciones de ventas pactada
                                    </label>
                                    <div class="m-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="condiciones"
                                                id="alContado" value="contado">
                                            <label class="form-check-label" for="alContado">Al Contado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="condiciones"
                                                id="aCredito" value="credito">
                                            <label class="form-check-label" for="aCredito">A Crédito</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-4 col-sm-6" id="diasCreditoContainer" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label" for="diasCredito">Días de Crédito </label>
                                    <input type="number" class="form-control" id="diasCredito" name="diasCredito"
                                        min="1">
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-4 col-sm-6" id="containerespacio">
                                <div class="mb-3">
                                    <label class="form-label" for="">&nbsp; </label>

                                </div>
                            </div>

                            <script>
                            $(document).ready(function() {
                                $('input[name="condiciones"]').change(function() {
                                    if ($(this).val() === 'credito') {
                                        $('#diasCreditoContainer').show();
                                        $("#containerespacio").hide();
                                    } else {
                                        $('#diasCreditoContainer').hide();
                                        $("#diasCredito").val("0"); //limpiar el input
                                        $("#containerespacio").show();
                                    }
                                });
                            });
                            </script>


                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">PUNTO DE INICIO (ESTADO)</label>
                                    <select class="form-select" id="estadoInicio" name="estadoinicio">
                                        <option value="">Selecciona un estado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">PUNTO DE INICIO (CIUDAD)</label>
                                    <select class="form-select" id="ciudadInicio" name="ciudadinicio">
                                        <option value="">Selecciona Ciudad</option>
                                    </select>
                                </div>
                            </div>
                            <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const estadoSelect = document.getElementById('estadoInicio');
                                const ciudadSelect = document.getElementById('ciudadInicio');
                                const estadoSelect_f = document.getElementById('estadoFinal');
                                const ciudadSelect_f = document.getElementById('ciudadFinal');
                                // Datos de estados y ciudades (reemplaza con tu base de datos)
                                const datos = {
                                    "Aguascalientes": ["Aguascalientes", "Asientos", "Calvillo", "Cosío",
                                        "El Llano", "Jesús María", "Pabellón de Arteaga",
                                        "Rincón de Romos", "San Francisco de los Romo"
                                    ],
                                    "Baja California": ["Mexicali", "Tijuana", "Ensenada", "Tecate",
                                        "Playas de Rosarito"
                                    ],
                                    "Baja California Sur": ["La Paz", "Los Cabos", "Ciudad Constitución",
                                        "Loreto", "Mulegé"
                                    ],
                                    "Campeche": ["Campeche", "Carmen", "Champotón", "Hecelchakán",
                                        "Hopelchén", "Palizada", "Tenabo", "Escárcega", "Candelaria"
                                    ],
                                    "Chiapas": ["Tuxtla Gutiérrez", "Tapachula",
                                        "San Cristóbal de las Casas", "Comitán de Domínguez",
                                        "Villahermosa", "Ocosingo", "Cacahoatán", "Palenque", "Arriaga",
                                        "Motozintla"
                                    ],
                                    "Chihuahua": ["Chihuahua", "Ciudad Juárez", "Ciudad Cuauhtémoc",
                                        "Hidalgo del Parral", "Delicias", "Nuevo Casas Grandes",
                                        "Ojinaga", "Guerrero", "Bocoyna", "Jiménez"
                                    ],
                                    "Coahuila": ["Saltillo", "Torreón", "Monclova", "Piedras Negras",
                                        "Ciudad Acuña", "Sabinas", "San Pedro", "Frontera", "Múzquiz",
                                        "Allende"
                                    ],
                                    "Colima": ["Colima", "Manzanillo", "Tecomán", "Villa de Álvarez",
                                        "Armería", "Comala", "Coquimatlán", "Cuauhtémoc", "Ixtlahuacán"
                                    ],
                                    "Durango": ["Durango", "Gómez Palacio", "Ciudad Lerdo",
                                        "Victoria de Durango", "El Salto", "Cuencamé",
                                        "Santiago Papasquiaro", "Tepehuanes", "Mapimí", "Ocampo"
                                    ],
                                    "Estado de México": ["Toluca", "Ecatepec de Morelos", "Nezahualcóyotl",
                                        "Naucalpan de Juárez", "Tlalnepantla de Baz",
                                        "Cuautitlán Izcalli", "Atizapán de Zaragoza", "Metepec",
                                        "Huixquilucan", "Chimalhuacán"
                                    ],
                                    "Guanajuato": ["Guanajuato", "León", "Irapuato", "Celaya", "Salamanca",
                                        "San Miguel de Allende", "Querétaro", "Dolores Hidalgo",
                                        "San Francisco del Rincón", "Silao"
                                    ],
                                    "Guerrero": ["Chilpancingo de los Bravo", "Acapulco de Juárez",
                                        "Iguala de la Independencia", "Taxco de Alarcón",
                                        "Zihuatanejo de Azueta", "Tlapa de Comonfort", "Ometepec",
                                        "Coyuca de Benítez", "Atoyac de Álvarez", "Tecpan de Galeana"
                                    ],
                                    "Hidalgo": ["Pachuca de Soto", "Tulancingo de Bravo", "Tula de Allende",
                                        "Mineral de la Reforma", "Tepeji del Río de Ocampo",
                                        "Ixmiquilpan", "Huejutla de Reyes", "Actopan", "Apan",
                                        "Cuautepec de Hinojosa"
                                    ],
                                    "Jalisco": ["Guadalajara", "Zapopan", "Tlaquepaque", "Tonalá",
                                        "Puerto Vallarta", "Ciudad Guzmán", "Lagos de Moreno",
                                        "Tepatitlán de Morelos", "Ocotlán", "Arandas"
                                    ],
                                    "Michoacán": ["Morelia", "Uruapan", "Zamora", "Lázaro Cárdenas",
                                        "Pátzcuaro", "Apatzingán", "Sahuayo", "Ciudad Hidalgo",
                                        "La Piedad", "Tacámbaro"
                                    ],
                                    "Morelos": ["Cuernavaca", "Jiutepec", "Cuautla", "Temixco", "Zapata",
                                        "Xochitepec", "Yautepec", "Jojutla", "Tlaquiltenango",
                                        "Tlayacapan"
                                    ],
                                    "Nayarit": ["Tepic", "Bahía de Banderas", "Santiago Ixcuintla",
                                        "Tecuala", "Acaponeta", "Rosamorada", "Ixtlán del Río", "Jala",
                                        "Xalisco", "San Blas"
                                    ],
                                    "Nuevo León": ["Monterrey", "Guadalupe", "San Nicolás de los Garza",
                                        "Apodaca", "Escobedo", "Santa Catarina",
                                        "San Pedro Garza García", "Ciénega de Flores",
                                        "General Escobedo", "Juárez"
                                    ],
                                    "Oaxaca": ["Oaxaca de Juárez", "Juchitán de Zaragoza", "Salina Cruz",
                                        "Tehuantepec", "Tuxtepec", "Huajuapan de León",
                                        "Puerto Escondido", "Miahuatlán de Porfirio Díaz",
                                        "San Bartolo Coyotepec", "Santa Cruz Xoxocotlán"
                                    ],
                                    "Puebla": ["Puebla", "Tehuacán", "San Martín Texmelucan",
                                        "Cuautlancingo", "Atlixco", "Cholula", "Amozoc",
                                        "Izúcar de Matamoros", "Huauchinango", "Tecamachalco"
                                    ],
                                    "Querétaro": ["Santiago de Querétaro", "San Juan del Río",
                                        "Corregidora", "El Marqués", "Huimilpan", "Tequisquiapan",
                                        "Pedro Escobedo", "Cadereyta de Montes", "Jalpan de Serra",
                                        "Amealco de Bonfil"
                                    ],
                                    "Quintana Roo": ["Cancún", "Chetumal", "Playa del Carmen", "Cozumel",
                                        "Tulum", "Isla Mujeres", "Puerto Morelos", "Akumal", "Holbox"
                                    ],
                                    "San Luis Potosí": ["San Luis Potosí", "Soledad de Graciano Sánchez",
                                        "Ciudad Valles", "Matehuala", "Rioverde", "Tamazunchale",
                                        "Cerritos", "Cárdenas", "Ébano", "Salinas"
                                    ],
                                    "Sinaloa": ["Culiacán", "Mazatlán", "Los Mochis", "Guasave", "Navolato",
                                        "Sinaloa de Leyva", "Ahome", "El Fuerte", "Badiraguato",
                                        "Mocorito"
                                    ],
                                    "Sonora": ["Hermosillo", "Ciudad Obregón", "Nogales",
                                        "San Luis Río Colorado", "Guaymas", "Agua Prieta", "Navojoa",
                                        "Caborca", "Puerto Peñasco", "Cananea"
                                    ],
                                    "Tabasco": ["Villahermosa", "Cárdenas", "Comalcalco", "Macuspana",
                                        "Huimanguillo", "Paraíso", "Centla", "Teapa", "Jalpa de Méndez",
                                        "Nacajuca"
                                    ],
                                    "Tamaulipas": ["Ciudad Victoria", "Reynosa", "Matamoros",
                                        "Nuevo Laredo", "Tampico", "Ciudad Madero", "Altamira",
                                        "Río Bravo", "Valle Hermoso", "Xicoténcatl"
                                    ],
                                    "Tlaxcala": ["Tlaxcala", "Apizaco", "Huamantla", "Cuapiaxtla",
                                        "Zacatelco", "Chiautempan", "Contla de Juan Cuamatzi",
                                        "Tetla de la Solidaridad", "San Pablo del Monte", "Teolocholco"
                                    ],
                                    "Veracruz": ["Xalapa", "Veracruz", "Coatzacoalcos",
                                        "Poza Rica de Hidalgo", "Córdoba", "Minatitlán", "Tuxpan",
                                        "Orizaba", "Boca del Río", "Martínez de la Torre"
                                    ],
                                    "Yucatán": ["Mérida", "Valladolid", "Umán", "Progreso", "Tizimín",
                                        "Kanasín", "Tekax", "Motul", "Izamal", "Hunucmá"
                                    ],
                                    "Zacatecas": ["Zacatecas", "Guadalupe", "Fresnillo",
                                        "Jerez de García Salinas", "Río Grande", "Sombrerete",
                                        "Ojocaliente", "Villanueva", "Trancoso", "Mazapil"
                                    ]
                                };

                                // Función para llenar el select de estados
                                function llenarEstados() {
                                    for (const estado in datos) {
                                        const option = document.createElement('option');
                                        option.value = estado;
                                        option.text = estado;
                                        estadoSelect.appendChild(option);
                                    }
                                }

                                function llenarEstadosF() {
                                    for (const estado in datos) {
                                        const option = document.createElement('option');
                                        option.value = estado;
                                        option.text = estado;
                                        estadoSelect_f.appendChild(option);
                                    }
                                }

                                // Función para llenar el select de ciudades
                                function llenarCiudades(estado) {
                                    ciudadSelect.innerHTML =
                                        '<option value="">Selecciona una ciudad</option>'; // Limpiar opciones anteriores
                                    if (estado && datos[estado]) {
                                        datos[estado].forEach(ciudad => {
                                            const option = document.createElement('option');
                                            option.value = ciudad;
                                            option.text = ciudad;
                                            ciudadSelect.appendChild(option);
                                        });
                                    }
                                }

                                // Función para llenar el select de ciudades
                                function llenarCiudadesf(estado) {
                                    ciudadSelect_f.innerHTML =
                                        '<option value="">Selecciona una ciudad</option>'; // Limpiar opciones anteriores
                                    if (estado && datos[estado]) {
                                        datos[estado].forEach(ciudad => {
                                            const option = document.createElement('option');
                                            option.value = ciudad;
                                            option.text = ciudad;
                                            ciudadSelect_f.appendChild(option);
                                        });
                                    }
                                }
                                // Evento change para el select de estados
                                estadoSelect.addEventListener('change', () => {
                                    const estadoSeleccionado = estadoSelect.value;
                                    llenarCiudades(estadoSeleccionado);
                                });

                                // Evento change para el select de estados
                                estadoSelect_f.addEventListener('change', () => {
                                    const estadoSeleccionado_f = estadoSelect_f.value;
                                    llenarCiudadesf(estadoSeleccionado_f);
                                });

                                // Inicializar la página llenando el select de estados
                                llenarEstados();
                                llenarEstadosF();
                            });
                            </script>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">PUNTO DE FINAL (ESTADO)</label>
                                    <select class="form-select" id="estadoFinal" name="estadofinal">
                                        <option value="">Selecciona un estado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">PUNTO DE FINAL (CIUDAD)</label>
                                    <select class="form-select" id="ciudadFinal" name="ciudadfinal">
                                        <option value="">Selecciona una ciudad</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Dirección Inicio</span>
                                        <textarea class="form-control" id="abc14" name="dirinicio"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Dirección Final</span>
                                        <textarea class="form-control" id="abc14" name="dirfinal"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Link GoogleMaps Inicio</span>
                                        <textarea class="form-control" id="abc14" name="diriniciogoogle"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Link GoogleMaps Final</span>
                                        <textarea class="form-control" id="abc14" name="dirfinalgoogle"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex gap-2 ">

                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalXl" id="viajes">
                                        Ver Viajes
                                    </button>
                                </div>
                            </div>


                            <!-- Modal XL -->

                            <!-- Modal XL -->
                            <div class="modal fade" id="exampleModalXl" tabindex="-1"
                                aria-labelledby="exampleModalXlLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalXlLabel">
                                                Viajes hechos
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="grid_viajes"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            $(document).ready(function() {
                                $("#viajes").on("click", function() {

                                    var comboBox = $("#cliente").data("kendoComboBox");
                                    var idcliente = comboBox.value();
                                    var ciudad_inicio = $("#ciudadInicio").val();
                                    var ciudad_final = $("#ciudadFinal").val();
                                    LoadDataViajes(idcliente, ciudad_inicio, ciudad_final)
                                });
                            });
                            async function LoadDataViajes(idcliente, ciudad_inicio, ciudad_final) {
                                console.log('ID CLIENTE: ', idcliente);
                                var crudServiceBaseUrl = "<?php echo APP_URL; ?>app/Ajax/viajesAjax.php";


                                let viajes = await $.ajax({
                                    type: "post",
                                    url: crudServiceBaseUrl,
                                    data: {
                                        viajesControllers: "viajes",
                                        cliente: idcliente,
                                        ciudad_inicio: ciudad_inicio,
                                        ciudad_final: ciudad_final
                                    },
                                    dataType: "json",
                                });
                                console.log(viajes);

                                var element = $("#grid_viajes").kendoGrid({
                                    dataSource: {
                                        data: viajes,
                                        aggregate: [{
                                                field: "CANTIDAD",
                                                aggregate: "sum"
                                            },
                                            {
                                                field: "TOTAL",
                                                aggregate: "sum"
                                            },
                                            {
                                                field: "PRECIO",
                                                aggregate: "sum"
                                            }
                                        ],
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
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    sortable: true,
                                    filterable: true,
                                    columnMenu: true,
                                    columns: [{
                                            field: "FOLIO",
                                            title: "FOLIO"
                                        }, {
                                            field: "CLIENTE",
                                            title: "CLIENTE"
                                        },
                                        {
                                            field: "VIAJE",
                                            title: "VIAJE"
                                        },
                                        {
                                            field: "MATERIAL",
                                            title: "MATERIAL"
                                        },
                                        {
                                            field: "FECHA",
                                            title: "FECHA COTIZACION",
                                            format: "{0: MMM dd yyyy-HH:mm}"
                                        },
                                        {
                                            field: "PRECIO",
                                            title: "PRECIO",
                                            format: "{0:c}"
                                        }
                                    ]
                                });
                            }
                            </script>
                            <br>
                            <br>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="material">MATERIAL</label>
                                    <input class="form-control" id="tipos_material" name="material"
                                        style="width: 100%;" />
                                </div>
                                <script id="noDataTemplatetipos_material" type="text/x-kendo-tmpl">
                                    <div>No se encontró dentro de la base de datos desea guardar a : - '#: instance.text() #' ?</div>
                                        <br />
                                    <button class="k-button" onclick="addNewtipos_material('#: instance.element[0].id #', '#: instance.text() #')">¿Agregar nuevo tipo de material? </button>
                                </script>
                                <!-- segunda seccion  -->
                                <script>
                                var tipos_material = [];
                                var sampleDataNexttipos_material = 0;

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
                                <script>
                                $(document).ready(function() {
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
                                    $("#tipos_material").kendoComboBox({
                                        filter: "startswith",
                                        dataTextField: "NOMBRE",
                                        dataValueField: "ID",
                                        dataSource: tipos_material_data,
                                        noDataTemplate: $("#noDataTemplatetipos_material").html()
                                    });
                                });
                                </script>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="peso">PESO</label>
                                    <input type="number" class="form-control" id="peso" name="peso" required>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" for="fechaCarga">FECHA DE CARGA Y DESCARGA <span
                                            class="badge border border-info text-info dias"><i
                                                class="ri-arrow-right-s-fill"></i> Duración</span></label>


                                    <div class="k-w-300">
                                        <div id="daterangepicker" class="form-control" title="daterangepicker"></div>

                                        <input type="date" id="fechaInicio" name="fechaInicio" style="display: none;">
                                        <input type="date" id="fechaFin" name="fechaFin" style="display: none;">
                                    </div>
                                    <script>
                                    $(document).ready(function() {

                                        $("#daterangepicker").kendoDateRangePicker({
                                            "messages": {
                                                "startLabel": "Fecha de Carga",
                                                "endLabel": "Fecha Descarga"
                                            },
                                            format: "dd/MM/yyyy",
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
                                        name="precio">
                                </div>
                            </div>

                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">NOTAS</span>
                                        <textarea class="form-control" id="abc14" name="notas"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xxl-6 col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">FISCAL / NO FISCAL
                                    </label>
                                    <div class="m-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="fiscal" id="fiscal"
                                                value="fiscal">
                                            <label class="form-check-label" for="fiscal">Fiscal</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="fiscal" id="nofiscal"
                                                value="no fiscal">
                                            <label class="form-check-label" for="nofiscal">No fiscal</label>
                                        </div>
                                    </div>
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
<div class="row gx-3">
    <div class="col-sm-12">

        <div class="card mb-3">
            <div class="card-body">

                <div class="card-header">
                    <h5 class="card-title">Agregar Razones Sociales</h5>
                </div>

                <div class="col-sm-12">
                    <div class="bg-light rounded-2 px-3 py-2 mb-3">
                        <h6 class="m-0">Datos de Razones Sociales</h6>
                    </div>
                </div>
                <form class="row g-3 needs-validation FormularioAjax"
                    action="<?php echo APP_URL; ?>app/ajax/razonAjax.php" method="POST" autocomplete="off"
                    id="form_cliente" enctype="multipart/form-data">
                    <input type="hidden" name="catalogo_razon" value="registrar">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required
                                pattern="[a-zA-Z\s]+" title="Solo se permiten letras y espacios.">
                            <div class="invalid-feedback">Por favor, ingresa el nombre (Solo letras y espacios).</div>
                        </div>
                        <div class="col-md-6">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" class="form-control" id="rfc" name="rfc" required
                                pattern="^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{3})$"
                                title="Formato de RFC inválido. Ejemplos: AAA010101XXX o AAAA010101XXX">
                            <div class="invalid-feedback">Por favor, ingresa un RFC válido.</div>
                        </div>
                        <div class="col-12">
                            <label for="domicilio" class="form-label">Domicilio Fiscal</label>
                            </div>

                        <div class="col-md-3">
                            <label for="calle" class="form-label">Calle</label>
                            <input type="text" class="form-control" id="calle" name="calle" required>
                            <div class="invalid-feedback">Por favor, ingresa la calle.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="numero_interior" class="form-label">Número Interior</label>
                            <input type="text" class="form-control" id="numero_interior" name="numero_interior">
                        </div>

                        <div class="col-md-3">
                            <label for="numero_exterior" class="form-label">Número Exterior</label>
                            <input type="text" class="form-control" id="numero_exterior" name="numero_exterior"
                                required>
                            <div class="invalid-feedback">Por favor, ingresa el número exterior.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="colonia" class="form-label">Colonia</label>
                            <input type="text" class="form-control" id="colonia" name="colonia" required>
                            <div class="invalid-feedback">Por favor, ingresa la colonia.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="municipio" class="form-label">Municipio</label>
                            <input type="text" class="form-control" id="municipio" name="municipio" required>
                            <div class="invalid-feedback">Por favor, ingresa el municipio.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                            <div class="invalid-feedback">Por favor, ingresa la ciudad.</div>
                        </div>
                        <div class="col-md-3">
                            <label for="estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="estado" name="estado" required>
                            <div class="invalid-feedback">Por favor, ingresa la estado.</div>
                        </div>
                        <div class="col-md-3">
                            <label for="cp" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" id="cp" name="cp" required>
                            <div class="invalid-feedback">Por favor, ingresa la cp.</div>
                        </div>
                        <div class="col-12">
                            <label for="actividad" class="form-label">Actividad Económica</label>
                            <textarea class="form-control" id="actividad" name="actividad" rows="3" required></textarea>
                            <div class="invalid-feedback">Por favor, ingresa la actividad económica.</div>
                        </div>

                        <div class="col-md-4">
                            <label for="caat" class="form-label">Folio CAAT</label>
                            <input type="text" class="form-control" id="caat" name="caat" required>
                            <div class="invalid-feedback">Por favor, ingrese CAAT.</div>
                        </div>
                        <div class="col-md-4" >
                            <label for="file_caat" class="form-label">Documentación CAAT  (PDF. MAX
                                5MB)</label>
                            <input class="form-control" type="file" id="file_caat" name="file_caat"
                                accept=".pdf" required>
                            <div id="error-file_caat" class="error"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="vigenciaCaat" class="form-label">Vigencia CAAT</label>
                            <input type="date" class="form-control" id="vigenciaCaat" name="vigenciaCaat" required>
                            <div class="invalid-feedback">Por favor, ingresa la vigencia Caat.</div>
                        </div>


                        <div class="col-12">
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
                                <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
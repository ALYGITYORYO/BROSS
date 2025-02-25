<div class="row gx-3">
    <div class="col-sm-12">

        <div class="card mb-3">
            <div class="card-body">

                <div class="card-header">
                    <h5 class="card-title">Agregar Banco</h5>
                </div>

                <div class="col-sm-12">
                    <div class="bg-light rounded-2 px-3 py-2 mb-3">
                        <h6 class="m-0">Datos de Bancos</h6>
                    </div>
                </div>
                <form class="row g-3 needs-validation FormularioAjax"
                    action="<?php echo APP_URL; ?>app/ajax/bancoAjax.php" method="POST" autocomplete="off"
                    id="form_cliente" enctype="multipart/form-data">
                <input type="hidden" name="catalogo_banco" value="registrar">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombreBanco" class="form-label">Nombre del Banco</label>
                            <input type="text" class="form-control" id="nombreBanco" name="nombreBanco" required>
                            <div class="invalid-feedback">Por favor, ingresa el nombre del banco.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="numeroCuenta" class="form-label">Número de Cuenta</label>
                            <input type="text" class="form-control" id="numeroCuenta" name="numeroCuenta" required
                                pattern="[0-9]{10,20}"
                                title="Ingresa un número de cuenta válido (entre 10 y 20 dígitos numéricos).">
                            <div class="invalid-feedback">Por favor, ingresa un número de cuenta válido (entre 10 y 20
                                dígitos numéricos).</div>
                        </div>
                        <div class="col-md-6">
                            <label for="aliasCuenta" class="form-label">Alias del Número de Cuenta</label>
                            <input type="text" class="form-control" id="aliasCuenta" name="aliasCuenta" required>
                            <div class="invalid-feedback">Por favor, ingresa un alias para la cuenta.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="titularCuenta" class="form-label">Titular de la Cuenta</label>
                            <input type="text" class="form-control" id="titularCuenta" name="titularCuenta" required
                                pattern="[a-zA-Z\s]+" title="Solo se permiten letras y espacios.">
                            <div class="invalid-feedback">Por favor, ingresa el nombre del titular (Solo letras y
                                espacios).</div>
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
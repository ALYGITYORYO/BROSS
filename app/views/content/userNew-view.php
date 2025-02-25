    <!-- Row starts -->
    <div class="row gx-3">
              <div class="col-sm-12">
             
                <div class="card mb-3">
                  <div class="card-body">

                  <div class="card-header">
                    <h5 class="card-title">Agregar Usuario</h5>
                  </div>

                  <div class="col-sm-12">
                        <div class="bg-light rounded-2 px-3 py-2 mb-3">
                          <h6 class="m-0">Datos Personales</h6>
                        </div>
                      </div>
                    
                    <form class="row g-3 needs-validation FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data" >
                     
                    
	                  	<input type="hidden" name="catalogo_usuario" value="registrar">

                      <div class="col-md-3">
                        <label for="validationCustom01" class="form-label">Nombre</label>
                        
                        <input class="form-control" id="validationCustom01" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required  >
                        <div class="valid-feedback">Correcto!</div>
                        <div class="invalid-feedback">
                          Ingrese su nombre
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Apellido Paterno</label>
                        <input class="form-control" type="text" id="validationCustom02" name="apepat" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
                        <div class="valid-feedback">Correcto!</div>
                        <div class="invalid-feedback">
                          Ingrese su apellido paterno
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="validationCustom02" class="form-label">Apellido Materno</label>
                        
                        <input class="form-control" type="text" id="validationCustom02" name="apemat" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
                        <div class="valid-feedback">Correcto!</div>
                        <div class="invalid-feedback">
                        Ingrese su apellido materno
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="validationCustomUsername" class="form-label">Nombre de Usuario/NickName</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>                          
                            <input class="form-control" type="text" id="validationCustomUsername"
                            aria-describedby="inputGroupPrepend" name="usuario_usuario" pattern="[a-zA-Z0-9-_]{4,20}" maxlength="20" required >
                            <div class="valid-feedback">Correcto se validará!</div>
                            <div class="invalid-feedback">
                            Por favor ingrese un nombre de usuario 
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label for="validationCustom03" class="form-label">Correo</label>
                        
                        <input class="form-control" type="email" id="validationCustom03" name="usuario_email" maxlength="70" >
                        <div class="invalid-feedback">
                        Ingrese correo electrónico
                         </div>
                      </div>

                      <div class="col-md-6">
                        <label for="validationCustom03" class="form-label">Contraseña</label>                        
                        <input class="form-control" type="password" id="validationCustom03" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
                        <div class="invalid-feedback">
                        Su contraseña debe incluir al menos 7 caracteres                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="validationCustom03" class="form-label">Repatir contraseña</label>
                        
                        <input class="form-control" id="validationCustom03" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
                        <div class="invalid-feedback">
                        Su contraseña debe incluir al menos 7 caracteres                       </div>
                      </div>

                      <div class="col-md-3">
                        <label for="validationCustom04" class="form-label">Imagen / JPG, JPEG, PNG. (MAX 5MB)</label>
                        <input class="form-control" type="file" id="formFile" name="usuario_foto"  accept=".jpg, .png, .jpeg" >

                        <div class="invalid-feedback">
                          Se verificará!
                        </div>
                      </div>
                    
                     
                      <div class="col-12">
                      <div class="d-flex gap-2 justify-content-end">
                        
                          <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
			<button type="submit" class="btn btn-primary">Guardar</button>

                        </div>
                       </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

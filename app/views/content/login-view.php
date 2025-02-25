
<body class="login-bg">
<!-- Container starts -->
    <div class="container">

      <!-- Auth wrapper starts -->
      <div class="auth-wrapper">

        <!-- Form starts -->
        <form action="" id="formlog" class="login" method="POST"  autocomplete="false">

          <div class="auth-box">
            <a href="#" class="auth-logo mb-4">
              <img src="<?php echo APP_URL; ?>/app/views/images/bross_logo.png" alt="Bootstrap Gallery">
            </a>
            <p  class="text-uppercase text-center" id="textsaludo" style="margin-bottom: 0px;"></p>
            <p style="text-align: center; padding-top: 10px;">
            <img src=""  id="saludo" width="45px">
            </p>
            <div class="mb-3">
              <label class="form-label" for="usuario">Usuario <span class="text-danger">*</span></label>
              <input type="text" id="usuario" name="login_usuario" class="form-control" placeholder="Ingresa nombre de usuario">
            </div>

            <div class="mb-2">
              <label class="form-label" for="pwd">contraseña <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="password" id="password"  name="login_clave" class="form-control" placeholder="Ingresa su contraseña">
                <button class="btn btn-outline-secondary" type="button">
                  <i class="ri-eye-line text-primary"></i>
                </button>
              </div>
            </div>

           <br>
           <br>
           

            <div class="mb-3 d-grid gap-2">
              <button type="submit" class="btnlog btn btn-primary">Ingresar</button>
              
            </div>

          </div>

        </form>
        <!-- Form ends -->

      </div>
      <!-- Auth wrapper ends -->

    </div>
    <!-- Container ends -->
    <?php
	if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
		$insLogin->iniciarSesionControlador();
	}
?>
   

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login BROSS</title>
    <!-- Meta -->
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    
    <link rel="shortcut icon" href="assets/images/favicon.svg">

    <!-- *************
			************ CSS Files *************
		************* -->
    <link rel="stylesheet" href="assets/fonts/remix/remixicon.css">
    <link rel="stylesheet" href="assets/css/main.min.css">

  </head>

  <body class="login-bg">

    <!-- Container starts -->
    <div class="container">

      <!-- Auth wrapper starts -->
      <div class="auth-wrapper">

        <!-- Form starts -->
        <form action="" id="formlog">

          <div class="auth-box">
            <a href="#" class="auth-logo mb-4">
              <img src="assets/images/bross_logo.png" alt="Bootstrap Gallery">
            </a>
            <p  class="text-uppercase text-center" id="textsaludo" style="margin-bottom: 0px;"></p>
            <p style="text-align: center; padding-top: 10px;">
            <img src=""  id="saludo" width="45px">
            </p>
            <div class="mb-3">
              <label class="form-label" for="usuario">Usuario <span class="text-danger">*</span></label>
              <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingresa nombre de usuario">
            </div>

            <div class="mb-2">
              <label class="form-label" for="pwd">contraseña <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="password" id="password"  name="password" class="form-control" placeholder="Ingresa su contraseña">
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
     
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
    
    <script>
	$(function() {
		  var Aatrox = document.getElementById("saludo");
var f=new Date();
cad=f.getHours()+":"+f.getMinutes()+":"+f.getSeconds(); 
		if(parseInt(f.getHours())>=12&&parseInt(f.getHours())<=17){
			Aatrox.setAttribute("src", "assets/images/icons/tarde.png");
		$("#textsaludo").text("BUENAS TARDES BIENVENIDO");
		}
		else if(f.getHours()>=18&&f.getHours()<=24){
			Aatrox.setAttribute("src", "assets/images/icons/noche.png");
		$("#textsaludo").text("BUENAS NOCHES BIENVENIDO");
		}
		else if(f.getHours()>=1&&f.getHours()<=6){
			Aatrox.setAttribute("src", "assets/images/icons/w_tarde.png");
		$("#textsaludo").text("¿TRABAJANDO TARDE? BIENVENIDO");
		}
		else if(f.getHours()>=7&&f.getHours()<=9){
			Aatrox.setAttribute("src", "assets/images/icons/dia.png");
		$("#textsaludo").text(" BIENVENIDO BUEN DÍA");
		}
		else if(f.getHours()>=10&&f.getHours()<=11){
			Aatrox.setAttribute("src", "assets/images/icons/noche.png");
		$("#textsaludo").text("BUENAS NOCHES BIENVENIDO");
		} 
	})
	</script>
  </body>

</html>
<?php


    require_once "./config/app.php";
    require_once "./autoload.php";
    


    /*---------- Iniciando sesion ----------*/
    require_once "./app/views/inc/session_start.php";

    if(isset($_GET['views'])){
        $url=explode("/", $_GET['views']);
    }else{
        $url=["login"];
    }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
  <?php require_once './app/views/inc/head.php' ?>
  </head>

  <body>
  <?php
  use app\controllers\viewsController;
  use app\controllers\loginController;

  $insLogin = new loginController();

  $viewsController= new viewsController();
  $vista=$viewsController->obtenerVistasControlador($url[0]);

  if($vista=="login" || $vista=="404"){
    if($vista=="login"){
        if((!isset($_SESSION['id']) || $_SESSION['id']=="") || (!isset($_SESSION['usuario']) || $_SESSION['usuario']=="")){
            require_once "./app/views/content/".$vista."-view.php";
           
          }
          else{
            if(headers_sent()){
                echo "<script> window.location.href='".APP_URL."dashboard/'; </script>";
            }else{
                header("Location: ".APP_URL."dashboard/");
            }
          }
    }else{
        require_once "./app/views/content/".$vista."-view.php";
    }
     
  }else{

      # Cerrar sesion #
      
      if((!isset($_SESSION['id']) || $_SESSION['id']=="") || (!isset($_SESSION['usuario']) || $_SESSION['usuario']=="")){
        $insLogin->cerrarSesionControlador();
        exit();
         
      }
      else{
        require_once "./app/views/inc/header.php";
        require_once "./app/views/inc/navbar.php";
        require_once $vista;
      }
     

  }

  require_once './app/views/inc/script.php' ;
  
  ?>
   <script>
	$(function() {
		  var Aatrox = document.getElementById("saludo");
var f=new Date();
cad=f.getHours()+":"+f.getMinutes()+":"+f.getSeconds(); 
		if(parseInt(f.getHours())>=12&&parseInt(f.getHours())<=17){
			Aatrox.setAttribute("src", "<?php echo APP_URL; ?>app/views/icons/tarde.png");
		$("#textsaludo").text("BUENAS TARDES BIENVENIDO");
		}
		else if(f.getHours()>=18&&f.getHours()<=24){
			Aatrox.setAttribute("src", "<?php echo APP_URL; ?>app/views/icons/noche.png");
		$("#textsaludo").text("BUENAS NOCHES BIENVENIDO");
		}
		else if(f.getHours()>=0&&f.getHours()<=6){
			Aatrox.setAttribute("src", "<?php echo APP_URL; ?>app/views/icons/w_tarde.png");
		$("#textsaludo").text("¿TRABAJANDO TARDE? BIENVENIDO");
		}
		else if(f.getHours()>=7&&f.getHours()<=9){
			Aatrox.setAttribute("src", "<?php echo APP_URL; ?>app/views/icons/dia.png");
		$("#textsaludo").text(" BIENVENIDO BUEN DÍA");
		}
		else if(f.getHours()>=10&&f.getHours()<=11){
			Aatrox.setAttribute("src", "<?php echo APP_URL; ?>app/views/icons/noche.png");
		$("#textsaludo").text("BUENAS NOCHES BIENVENIDO");
		} 
	})
	</script>
  </body>
  </html>


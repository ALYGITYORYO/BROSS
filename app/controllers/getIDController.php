<?php

	namespace app\controllers;
	use app\models\mainModel;

	class getIDController extends mainModel{

		/*----------  OBTIENE ID  ----------*/
		public function getIDControlador(){

			# Almacenando datos#
			//$tabla = $_GET['TABLA'];
			$consecutivo=$this->ejecutarConsulta("SELECT `ID`,`NOVEHICULO` FROM `vehiculos` ORDER BY `ID` DESC;");
            if ($consecutivo->rowCount() > 0) {
                $fila = $consecutivo->fetch();
                $ultimoNovehiculo = $fila['NOVEHICULO'];

                // Extraer el número y sumarle 1
                $numero = intval(ltrim(substr($ultimoNovehiculo, 2), '0')) + 1; //Elimina "BR" y los 0 a la izquierda.

                $nuevoNovehiculo = "BR" . str_pad($numero, 4, "0", STR_PAD_LEFT); //Formatea el nuevo número.

                return $nuevoNovehiculo;
            } else {
                return "BR0001"; // Valor inicial si no hay registros
            }
            
			
		}

		/*----------       ID COLABORADOR            ----------*/
		public function colaboradorGetIDControlador(){
			$consecutivo=$this->ejecutarConsulta("SELECT `ID`,`NOEMPLEADO` FROM colaborador ORDER BY `ID` DESC");
            if ($consecutivo->rowCount() > 0) {
                $fila = $consecutivo->fetch();
                $ultimoNovehiculo = $fila['NOEMPLEADO'];

                // Extraer el número y sumarle 1
                $numero = intval(ltrim(substr($ultimoNovehiculo, 2), '0')) + 1; //Elimina "BR" y los 0 a la izquierda.

                $nuevoNovehiculo = "CO" . str_pad($numero, 4, "0", STR_PAD_LEFT); //Formatea el nuevo número.

                return $nuevoNovehiculo;
            } else {
                return "CO0001"; // Valor inicial si no hay registros
            }
		}

		public function cotizadorGetIDControlador(){
			$consecutivo=$this->ejecutarConsulta("SELECT `ID`,`FOLIO` FROM cotizador ORDER BY `ID` DESC;");
            if ($consecutivo->rowCount() > 0) {
                $fila = $consecutivo->fetch();
                $ultimoNovehiculo = $fila['FOLIO'];

                // Extraer el número y sumarle 1
                $numero = intval(ltrim(substr($ultimoNovehiculo, 2), '0')) + 1; //Elimina "BR" y los 0 a la izquierda.

                $nuevoNovehiculo = "CT" . str_pad($numero, 4, "0", STR_PAD_LEFT); //Formatea el nuevo número.

                return $nuevoNovehiculo;
            } else {
                return "CT0001"; // Valor inicial si no hay registros
            }
	    }

	public function remisionGetIDControlador(){
        $consecutivo=$this->ejecutarConsulta("SELECT `ID`,`FOLIO_REMISION` FROM remision ORDER BY `ID` DESC;");
        if ($consecutivo->rowCount() > 0) {
            $fila = $consecutivo->fetch();
            $ultimoNovehiculo = $fila['FOLIO_REMISION'];

            // Extraer el número y sumarle 1
            $numero = intval(ltrim(substr($ultimoNovehiculo, 2), '0')) + 1; //Elimina "BR" y los 0 a la izquierda.

            $nuevoNovehiculo = "RE" . str_pad($numero, 4, "0", STR_PAD_LEFT); //Formatea el nuevo número.

            return $nuevoNovehiculo;
        } else {
            return "RE0001"; // Valor inicial si no hay registros
        }
}
    
}
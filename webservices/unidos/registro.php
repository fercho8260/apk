<?php
	/* Extrae los valores enviados desde la aplicacion movil */
    $documento  = $_GET['documento'];
    $nombre1    = $_GET['nombre1'];
    $nombre2    = $_GET['nombre2'];
    $apellido1  = $_GET['apellido1'];
    $apellido2  = $_GET['apellido2'];
    $fechanac   = $_GET['fechanac'];
    $tiposang   = $_GET['tiposang'];
    $telmovil   = $_GET['telmovil'];
    $correo     = $_GET['correo'];
    $direccion  = $_GET['direccion'];
    $municipio  = $_GET['municipio'];
    $lider      = $_GET['usuario'];

    $host = 'sql308.byethost14.com';
    $bd = 'b14_20600558_prueba';
    $usuario = 'b14_20600558';
    $pass = '1098768795';

    $servidor = mysql_connect($host,$usuario,$pass) or die (mysql_error());

	mysql_set_charset("utf8",$servidor);

	$conexion = mysql_select_db($bd, $servidor);


    $sql = "SELECT * FROM tab_referidos WHERE id_documento = '$documento'";
     
    $result = mysql_query($sql);

    $check = mysql_fetch_row($result);

     /* verifica que el usuario y el email que no se encuentre registrado*/
     if($check)
     {
     	/*esta informacion se envia solo si la validacion es incorrecta */
     	$resultados["mensaje"] = "El referido ya existe";
		$resultados["validacion"] = "error";
     }
     else
     {

        $insert = "INSERT INTO tab_referidos (id_documento, apellido1, apellido2, nombre1, nombre2, fecnac, tipo_sang, tel_movil, correo, direccion_res, municipio_res, lider, dpto_vot, municipio_vot, puesto_vot, direccion_vot, mesa_vot, fecha_insc, observacion, longitud, latitud) VALUES ('$documento', '$apellido1', '$apellido2', '$nombre1', '$nombre2', '$fechanac', '$tiposang', '$telmovil', '$correo', '$direccion', '$municipio', '$lider',NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";

        $result2 = mysql_query($insert);
        if ($result2) {
            /*esta informacion se envia si la validacion es correcta */
            $resultados["mensaje"] = "Referido registrado correctamente";
            $resultados["validacion"] = "ok";
        }
        else{
            $resultados["mensaje"] = "Por favor intente nuevamente mas tarde.".mysql_error();
            $resultados["validacion"] = "sql";
        }
     	
     }

	/*convierte los resultados a formato json*/
	$resultadosJson = json_encode($resultados);
	/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
	echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
    mysql_close($servidor);
?>
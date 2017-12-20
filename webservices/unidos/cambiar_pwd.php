<?php
	/* Extrae los valores enviados desde la aplicacion movil */
    $npwd       = $_GET['nueva_pwd'];
    $rpwd       = $_GET['repetir_pwd'];
    $lider      = $_GET['usuario'];

    $host = 'sql308.byethost14.com';
    $bd = 'b14_20600558_prueba';
    $usuario = 'b14_20600558';
    $pass = '1098768795';

    $servidor = mysql_connect($host,$usuario,$pass) or die (mysql_error());

	mysql_set_charset("utf8",$servidor);

	$conexion = mysql_select_db($bd, $servidor);

    $update = "UPDATE tab_usuarios SET val_pwd = '$npwd' WHERE id_usuario = '$lider'";

    $result2 = mysql_query($update);
    if ($result2) {
        /*esta informacion se envia si la validacion es correcta */
        $resultados["mensaje"] = "Contraseña actualizada correctamente";
        $resultados["validacion"] = "ok";
    }
    else{
        $resultados["mensaje"] = "Por favor intente nuevamente mas tarde.".mysql_error();
        $resultados["validacion"] = "error";
    }

	/*convierte los resultados a formato json*/
	$resultadosJson = json_encode($resultados);
	/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
	echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
    mysql_close($servidor);
?>
<?php
	/* Extrae los valores enviados desde la aplicacion movil */
	$username = $_GET['username'];
    $email =    $_GET['email'];
    $password = $_GET['password'];

    $host = 'sql308.byethost14.com';
    $bd = 'b14_20600558_prueba';
    $usuario = 'b14_20600558';
    $pass = '1098768795';

    $servidor = mysql_connect($host,$usuario,$pass) or die (mysql_error());

	mysql_set_charset("utf8",$servidor);

	$conexion = mysql_select_db($bd, $servidor);


    $sql = "SELECT * FROM tab_usuarios WHERE id_usuario = '$username' AND email='$email'";
     
    $result = mysql_query($sql);

    $check = mysql_fetch_row($result);

     /* verifica que el usuario y el email que no se encuentre registrado*/
     if($check)
     {
     	/*esta informacion se envia solo si la validacion es incorrecta */
     	$resultados["mensaje"] = "El usuario ya existe";
		$resultados["validacion"] = "error";
     }
     else
     {
        $insert = "INSERT INTO tab_usuarios VALUES ('$username', '$email', '$password')";
        $result2 = mysql_query($insert);
        if ($result2) {
            /*esta informacion se envia si la validacion es correcta */
            $resultados["mensaje"] = "Usuario registrado correctamente";
            $resultados["validacion"] = "ok";
        }
        else{
            $resultados["mensaje"] = "Por favor intente nuevamente mas tarde.";
            $resultados["validacion"] = "sql";
        }
     	
     }

	/*convierte los resultados a formato json*/
	$resultadosJson = json_encode($resultados);
	/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
	echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
    mysql_close($servidor);
?>
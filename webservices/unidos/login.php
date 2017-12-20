<?php
	/* Extrae los valores enviados desde la aplicacion movil */
	$username = $_GET['username'];
    $password = $_GET['password'];

    $host = 'localhost';
    $bd = 'i4199213_reunion';
    $usuario = 'b16_20095033';
    $pass = '1098768795';

    $servidor = mysql_connect($host,$usuario,$pass) or die (mysql_error());

	mysql_set_charset("utf8",$servidor);

	$conexion = mysql_select_db($bd, $servidor);


    $sql = "SELECT * FROM tab_usuarios WHERE id_usuario = '$username' AND val_pwd='$password'";
     
    $result = mysql_query($sql);

     //$result = mysqli_query($con,$sql);
     
     //$fila = mysql_fetch_row($resultado);

     
     $check = mysql_fetch_row($result);

     /* verifica que el usuario y password concuerden correctamente */
     if($check)
     {
     	/*esta informacion se envia solo si la validacion es correcta */
     	$resultados["mensaje"] = "Validacion Correcta";
		$resultados["validacion"] = "ok";
     }
     else
     {
     	/*esta informacion se envia si la validacion falla */
		$resultados["mensaje"] = "Usuario y password incorrectos";
		$resultados["validacion"] = "error";
     }

	/*convierte los resultados a formato json*/
	$resultadosJson = json_encode($resultados);
	/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
	echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
    mysql_close($servidor);
?>
<?php
	/* Extrae los valores enviados desde la aplicacion movil */
    $documento  = $_GET['documento'];
    $lider      = $_GET['usuario'];

    $host = 'localhost';
    $bd = 'i4199213_reunion';
    $usuario = 'b16_20095033';
    $pass = '1098768795';

    $servidor = mysql_connect($host,$usuario,$pass) or die (mysql_error());

	mysql_set_charset("utf8",$servidor);

	$conexion = mysql_select_db($bd, $servidor);


    $sql = "SELECT * FROM tab_referidos WHERE id_documento = '$documento' AND lider = '$lider'";
     
    $result = mysql_query($sql);

    $datos = array();

     /* verifica que el usuario y el email que no se encuentre registrado*/
     if($result)
     {
     	/*esta informacion se envia solo si la validacion es incorrecta */
     	while ($obj = mysql_fetch_object($result)){
        $datos[] = array('id_documento'  => $obj->id_documento,
                         'tel_movil'     => $obj->tel_movil,
                         'correo'        => $obj->correo,
                         'direccion_res' => $obj->direccion_res,
                         'municipio_res' => $obj->municipio_res);
        }
     }
     else
     {
        /*esta informacion se envia si la validacion es correcta */
        $datos["id_documento"] = "";   	
     }

	/*convierte los resultados a formato json*/
	$resultadosJson = json_encode($datos);
	/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
	echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

    mysql_close($servidor);
?>
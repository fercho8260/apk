<?php
	/* Extrae los valores enviados desde la aplicacion movil */
    $documento  = $_GET['documento'];
    $lider      = $_GET['usuario'];

    $host = 'sql308.byethost14.com';
    $bd = 'b14_20600558_prueba';
    $usuario = 'b14_20600558';
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
                         'nombre1'       => $obj->nombre1,
                         'nombre2'       => $obj->nombre2,
                         'apellido1'     => $obj->apellido1,
                         'apellido2'     => $obj->apellido2,
                         'fecnac'        => $obj->fecnac,
                         'tipo_sang'     => $obj->tipo_sang,
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
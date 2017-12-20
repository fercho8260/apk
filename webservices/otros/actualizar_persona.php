<?php
/**
 * Actualiza un alumno especificado por su identificador
 */

require 'personas.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Actualizar alumno
    $retorno = personas::update(
        $body['id_documento'],
        $body['apellido1'],
        $body['apellido2'],
        $body['nombre1'],
        $body['nombre2'],
        $body['genero'],
        $body['fecnac'],
        $body['tipo_sang'],
        $body['tel_movil'],
        $body['correo']);

    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Actualizacion correcta"));
		echo $json_string;
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se actualizo el registro"));
		echo $json_string;
    }
}
?>

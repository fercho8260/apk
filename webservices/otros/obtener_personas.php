<?php
/**
 * Obtiene todas las alumnos de la base de datos
 */

require 'personas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $personas = personas::getAll();

    if ($personas) {

        $datos["estado"] = 1;
        $datos["personas"] = $personas;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}


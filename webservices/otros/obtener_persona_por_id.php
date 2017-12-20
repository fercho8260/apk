<?php
/**
 * Obtiene el detalle de un alumno especificado por
 * su identificador "id_documento"
 */

require 'personas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id_documento'])) { 

        // Obtener parámetro id_documento
        $parametro = $_GET['id_documento'];

        // Tratar retorno
        $retorno = personas::getById($parametro);


        if ($retorno) {

            $persona["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $persona["personas"] = $retorno;
            // Enviar objeto json de la persona
            print json_encode($persona);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}


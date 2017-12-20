<?php

/**
 * Representa el la estructura de las Alumnoss
 * almacenadas en la base de datos
 */
require 'Database.php';

class personas
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Alumnos'
     *
     * @param $idAlumno Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM tab_personas";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de un Alumno con un identificador
     * determinado
     *
     * @param $idAlumno Identificador del alumno
     * @return mixed
     */
    public static function getById($id_documento)
    {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT id_documento,
                            apellido1,
                            apellido2,
                            nombre1,
                            nombre2,
                            genero,
                            fecnac,
                            tipo_sang,
                            tel_movil,
                            correo
                             FROM tab_personas
                             WHERE id_documento = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_documento));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idAlumno      identificador
     * @param $nombre      nuevo nombre
     * @param $direccion nueva direccion
     
     */
    public static function update(
        $id_documento,
        $apellido1,
        $apellido2,
        $nombre1,
        $nombre2,
        $genero,
        $fecnac,
        $tipo_sang,
        $tel_movil,
        $correo
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE tab_personas" .
            " SET apellido1=?, apellido2=?, nombre1=?, nombre2=?, genero=?, fecnac=?, tipo_sang=?, tel_movil=?, correo=? " .
            "WHERE id_documento=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($apellido1, $apellido2, $nombre1, $nombre2, $genero, $fecnac, $tipo_sang, $tel_movil, $correo, $id_documento));

        return $cmd;
    }

    /**
     * Insertar un nuevo Alumno
     *
     * @param $nombre      nombre del nuevo registro
     * @param $direccion dirección del nuevo registro
     * @return PDOStatement
     */
    public static function insert(
        $id_documento,
        $apellido1,
        $apellido2,
        $nombre1,
        $nombre2,
        $genero,
        $fecnac,
        $tipo_sang,
        $tel_movil,
        $correo
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO tab_personas ( " .
            "id_documento," .
            "apellido1," .
            "apellido2," .
            "nombre1," .
            "nombre2," .
            "genero," .
            "fecnac," .
            "tipo_sang," .
            "tel_movil," .
            " correo)" .
            " VALUES( ?,?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $id_documento,
		        $apellido1,
		        $apellido2,
		        $nombre1,
		        $nombre2,
		        $genero,
		        $fecnac,
		        $tipo_sang,
		        $tel_movil,
		        $correo
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idAlumno identificador de la tabla Alumnos
     * @return bool Respuesta de la eliminación
     */
    public static function delete($id_documento)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM tab_personas WHERE id_documento=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_documento));
    }
}

?>
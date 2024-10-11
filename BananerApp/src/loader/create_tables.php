<?php
include('../config/conexion.php');
require('table_parameters.php');

// Crear las tablas
foreach($tablas_iniciales as $tabla => $atributos) {
    try {
        echo "Creando tabla $tabla...\n";
        $db->beginTransaction();
        $createTableQuery = "CREATE TABLE IF NOT EXISTS $tabla ($atributos);";
        $db->exec(statement: $createTableQuery);
        $db->commit();
    } catch (Exception $e) {
        $db->rollBack();
        echo "Error al crear la tabla $tabla: " . $e->getMessage();
    }
}

// Cargar los datos desde los archivos CSV
foreach($path_tablas as $tabla => $filePath) {
    try {
        echo "Cargando datos en la tabla $tabla desde $filePath...\n";
        $db->beginTransaction();
        
        // Leer el archivo CSV
        if (($handle = fopen(filename: $filePath, mode: "r")) !== FALSE) {
            $header = fgetcsv(stream: $handle, length: 1000, separator: ",");
            while (($data = fgetcsv(stream: $handle, length: 1000, separator: ",")) !== FALSE) {
                $values = array_map(callback: function($value) use ($db): mixed {
                    return $db->quote($value);
                }, array: $data);
                $insertQuery = "INSERT INTO $tabla (" . implode(separator: ", ", array: $header) . ") VALUES (" . implode(separator: ", ", array: $values) . ");";
                $db->exec(statement: $insertQuery);
            }
            fclose(stream: $handle);
        }

        $db->commit();
    } catch (Exception $e) {
        $db->rollBack();
        echo "Error al cargar datos en la tabla $tabla: " . $e->getMessage();
    }
}
?>
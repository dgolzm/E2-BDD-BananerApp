<?php
    include('../config/connection.php');
    require("table_parameters.php");
    require("utils.php");

    try {
        echo "INSETANDO DATOS\n";
        foreach($path_tablas as $tabla => $path) {
            $file = fopen($path, "r");

            if ($file) {
                $header = fgetcsv($file); // Nos saltamos la primera linea
                while (($data = fgetcsv($file, 0, ",")) !== false){
                    // Verificamos las restricciones antes de insertar
                    for ($i = 0; $i < count($data); $i++) {
                        if ($data[$i] == "") {
                            $data[$i] = Null; //Convertimos los campos vacios en NULL para evitar insertar datos vacios
                        }
                    }
                    //Realizamos la correccion
                    insertar_en_tabla($db, $tabla, $data);
                }
                fclose($file);
            } else {
                echo "Error al abrir el archivo $path\n";
            }
        }
    } catch (Exception $e) {
        echo "Error al cargar datos: " . $e->getMessage();
    }
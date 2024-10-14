<<<<<<< HEAD
<?php
    function remove_duplicates($input_file, $output_file, $key_columns) {
        $rows = array();
        $unique_keys = array("");
    
        if (($handle = fopen($input_file, "r")) !== false) {
            $header = fgetcsv($handle, 1000, ";"); // Leer la cabecera
            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                $key_values = array();
                foreach ($key_columns as $key_column) {
                    $key_values[] = $data[$key_column];
                }
                $key = implode("-", $key_values); // Crear una clave única combinando los valores de las columnas clave
    
                if (!in_array($key, $unique_keys)) {
                    echo "Agregando $key\n";
                    $unique_keys[] = $key;
                    $rows[] = $data;
                }
                else{
                    echo "Duplicado $key\n";
                }
            }
            fclose($handle);
        }
    
        if (($handle = fopen($output_file, "w")) !== false) {
            fputcsv($handle, $header, ";"); // Escribir la cabecera
            foreach ($rows as $row) {
                fputcsv($handle, $row, ";");
            }
            fclose($handle);
        }
    }
    // Usar la función para eliminar duplicados
    echo "Eliminando duplicados...\n";
    remove_duplicates('files/Prerrequisitos.csv', 'files/Prerrequisitos_unicos.csv', [1]);
    remove_duplicates('files/Notas.csv', 'files/Notas_unicas.csv', [4, 10, 11]);
    remove_duplicates('files/Planes.csv', 'files/Planes_unicos.csv', [0]);
    remove_duplicates('files/Asignaturas.csv', 'files/Asignaturas_unicas.csv', [0]);
    remove_duplicates('files/Planeacion.csv', 'files/Planeacion_unicos.csv', [5, 13, 17]);
    remove_duplicates('files/Estudiantes.csv', 'files/Estudiantes_unicos.csv', [3]);
    remove_duplicates('files/Docentes_Planificados.csv', 'files/Docentes_Planificados_unicos.csv', [0]);


    require_once('config/connection.php');
    require_once('create_tables.php');
    require_once('poblate_tables.php');
    echo "TODO LISTO\n";
?>
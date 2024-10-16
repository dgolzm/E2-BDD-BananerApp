<body>
    <h1>Porcentaje de aprobación por curso</h1>
    <?php
    require('../loader/config/connection.php'); 
    $periodo = $_POST["periodo"];

    if (empty($periodo)) {
        echo "<p>Error: No se proporcionó un período.</p>";
        exit;
    }

    echo "<p>Período proporcionado: $periodo</p>";

    try {
        // Verificar si la tabla planeacion contiene datos
        $checkQuery = "SELECT COUNT(*) as total FROM planeacion";
        $checkResult = $db->query($checkQuery);
        $total = $checkResult->fetch(PDO::FETCH_ASSOC)['total'];

        if ($total == 0) {
            echo "<p>La tabla 'planeacion' está vacía.</p>";
        } else {
            echo "<p>La tabla 'planeacion' contiene $total registros.</p>";

            // Consulta combinada
            $query = "SELECT p.ID_ASIGNATURA, p.ASIGNATURA, p.NOMBRE_DOCENTE, COUNT(CASE WHEN np.CALIFICACION >= 4 THEN 1 END) * 100.0 / COUNT(*) AS porcentaje_aprobacion
                      FROM planeacion p
                      LEFT JOIN nota_prueba np ON p.ID_ASIGNATURA = np.CODIGO_ASIGNATURA AND p.PERIODO = np.PERIODO_ASIGNATURA
                      WHERE p.PERIODO = :periodo
                      GROUP BY p.ID_ASIGNATURA, p.ASIGNATURA, p.NOMBRE_DOCENTE";
            $result = $db->prepare($query);
            $result->bindParam(':periodo', $periodo, PDO::PARAM_STR);
            $result->execute(); 

            $listas = $result->fetchAll(PDO::FETCH_ASSOC);   

            if (empty($listas)) {
                echo "<p>No se encontraron resultados para el período proporcionado.</p>";
            } else {
                echo '<table class="styled-table">
                        <tr>
                            <th>ID Asignatura</th>
                            <th>Asignatura</th>
                            <th>Nombre Docente</th>
                            <th>Porcentaje de Aprobación</th>
                        </tr>';
                foreach ($listas as $c) {
                    echo "<tr><td>{$c['ID_ASIGNATURA']}</td><td>{$c['ASIGNATURA']}</td><td>{$c['NOMBRE_DOCENTE']}</td><td>{$c['porcentaje_aprobacion']}%</td></tr>";
                }
                echo '</table>';
            }
        }
    } catch (PDOException $e) {
        echo "<p>Error en la consulta: " . $e->getMessage() . "</p>";
    }
    ?>
</body>
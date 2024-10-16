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
        // Consulta para obtener el porcentaje de aprobación
        $query = "SELECT np.CODIGO_ASIGNATURA, np.ASIGNATURA,
                         COUNT(CASE WHEN CAST(REPLACE(np.NOTA, ',', '.') AS FLOAT) >= 4 THEN 1 END) * 100.0 / COUNT(*) AS porcentaje_aprobacion
                  FROM nota_prueba np
                  WHERE np.PERIODO_ASIGNATURA = :periodo
                  GROUP BY np.CODIGO_ASIGNATURA, np.ASIGNATURA";
        $result = $db->prepare($query);
        $result->bindParam(':periodo', $periodo, PDO::PARAM_STR);
        $result->execute(); 

        $listas = $result->fetchAll(PDO::FETCH_ASSOC);   

        if (empty($listas)) {
            echo "<p>No se encontraron resultados para el período proporcionado.</p>";
        } else {
            echo '<table class="styled-table">
                    <tr>
                        <th>Período</th>
                        <th>Código Asignatura</th>
                        <th>Asignatura</th>
                        <th>Porcentaje de Aprobación</th>
                    </tr>';
            foreach ($listas as $c) {
                echo "<tr><td>{$periodo}</td><td>{$c['CODIGO_ASIGNATURA']}</td><td>{$c['ASIGNATURA']}</td><td>{$c['porcentaje_aprobacion']}%</td></tr>";
            }
            echo '</table>';
        }
    } catch (PDOException $e) {
        echo "<p>Error en la consulta: " . $e->getMessage() . "</p>";
    }
    ?>
</body>

<body>
    <h1>asfagf</h1>
 <?php


  require('../loader/config/connection.php'); 
  $curso = $_POST["periodo"];
  

  
  $query = "SELECT  * FROM nota_prueba WHERE Periodo_Asignatura LIKE '%".$curso. "%'";
  $result = $db->prepare($query);
  $result -> execute(); 

  $listas = $result -> fetchAll();   
 ?>
<table class="styled-table">
        <tr>
            <th>Curso</th>
            <th>Profesor</th>
            <th>Aprobacion</th>
        </tr>
        <?php
        foreach ($listas as $c) {
            echo "<tr><td>$c[0]</td><td>$c[1]</td><td>$c[2]</td></tr>";
        }
        ?>
    </table>
</body>
</body>

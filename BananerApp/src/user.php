<?php 
session_start();


include('templates/header.html'); 
?>

<body>
  <div class="user">
  <h1 class="title">Menu De Usuario</h1>
  <p class="description">Aquí podrás encontrar información sobre la base de datos de la universidad.</p>
  <br>

  <p class="prompt">Porcentaje de aprobacion por periodo:</p>
  <form class="form" action="consultas/consulta_periodo_cpa.php" method="post">
    <input class="form-input" type="text" required placeholder="Ingresa un curso" name="periodo"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>

  <p class="prompt">Porcentaje de aprobacion por curso</p>
  <form class="form" action="consultas/consulta_periodo_cpa.php" method="post">
    <input class="form-input" type="text" required placeholder="Ingresa un curso" name="periodo"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>

  <p class="prompt">Porcentaje de aprobacion historico por profesor:</p>
  <form class="form" action="consultas/consulta_aprobacion_historica.php.php" method="post">
    <input class="form-input" type="text" required placeholder="Ingresa un curso" name="artista"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>

  <p class="prompt">Proyeccion de cursos 2025 para estudiante:</p>
  <form class="form" action="consultas/consulta_propuesta2025.php" method="post">
    <input class="form-input" type="text" required placeholder="Ingresa numero de estudiante" name="artista"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>

  <p class="prompt">Historial academico de estudiante:</p>
  <form class="form" action="consultas/consulta_canciones_por_artista.php" method="post">
    <input class="form-input" type="text" required placeholder="Ingresa numero de estudiante" name="artista"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>

  <form method="POST" action="consultas/logout.php">
    <button type="submit" class="form-button">Volver a Iniciar Sesión</button>
  </form>
  </div>
</body>
</html>
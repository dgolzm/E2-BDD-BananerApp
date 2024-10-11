<?php
include_once 'DataLoader.php';
$dataLoader = new DataLoader();

// Archivos CSV a cargar
$asignaturasFile = 'files/Asignaturas.csv';
$docentes_planificadosFile = 'files/Docentes_planificados.csv';
$estudiantesFile = 'files/Estudiantes.csv';
$mallaFile = 'files/Malla.csv';
$notasFile = 'files/Notas.csv';
$planeacionFile = 'files/Planeacion.csv';
$planesFile = 'files/Planes.csv';
$prerrequisitosFile = 'files/Prerrequisitos.csv';

$dataLoader->loadCSV($asignaturasFile);
$dataLoader->loadCSV($docentes_planificadosFile);
$dataLoader->loadCSV($estudiantesFile);
$dataLoader->loadCSV($mallaFile);
$dataLoader->loadCSV($notasFile);
$dataLoader->loadCSV($planeacionFile);
$dataLoader->loadCSV($planesFile);
$dataLoader->loadCSV($prerrequisitosFile);

?>
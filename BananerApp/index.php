<?php
$host = 'localhost';
$dbname = 'bananerDB';
$user = 'your_username';
$password = 'your_password';

try {
    $dsn = "pgsql:host=$host;dbname=$dbname";
    $pdo = new PDO(dsn: $dsn, username: $user, password: $password);
    $pdo->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a PostgreSQL.";
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
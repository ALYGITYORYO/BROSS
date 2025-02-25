<?php
$host = 'localhost'; // Dirección del servidor
$dbname = 'bross_data'; // Nombre de la base de datos
$username = 'root'; // Nombre de usuario
$password = ''; // Contraseña

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Modo de error
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

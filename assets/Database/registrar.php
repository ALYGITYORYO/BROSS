<?php
require_once '../controllers/d_base.php';

    $username = "SYS1234";
    $password = "123";

    // Hash de la contraseña
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prevenir SQL Injection
    $stmt = $pdo->prepare('INSERT INTO users (USER, PASS) VALUES (:username, :password)');
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Usuario registrado con éxito']);
    } else {
        echo json_encode(['message' => 'Error al registrar usuario']);
    }

?>

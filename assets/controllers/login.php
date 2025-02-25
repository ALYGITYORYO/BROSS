<?php
require_once '../../vendor/autoload.php'; // Cargar autoload de Composer
require_once 'd_base.php'; // Incluir la conexión a la base de datos

use \Firebase\JWT\JWT;

// Definir una clave secreta para JWT
define('SECRET_KEY', 'mi_clave_secreta');

// Función para generar el JWT
function generarJWT($user_id) {
    $issuedAt = time();
    $expirationTime = $issuedAt + 3600;  // 1 hora de expiración
    $payload = array(
        "iss" => "mi_app",  // Emisor
        "iat" => $issuedAt,  // Hora de emisión
        "exp" => $expirationTime,  // Expiración
        "user_id" => $user_id  // ID del usuario
    );

    return JWT::encode($payload, SECRET_KEY, 'HS256');
}


// Verificar si se envió la solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el usuario y la contraseña desde la solicitud POST

    $username = $_POST['usuario'];
    $password = $_POST['password'];


    // Prevenir SQL Injection usando consultas preparadas
    $stmt = $pdo->prepare('SELECT * FROM users WHERE USER = :USER');
    $stmt->bindParam(':USER', $username, PDO::PARAM_STR);
    $stmt->execute();

    // Verificar si el usuario existe
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['PASS'])) {
        // Las credenciales son correctas, generar el JWT
        $token = generarJWT($user['ID']);
        // Retornar el token como respuesta
        session_start();
        $_SESSION["s_usuario"] = $username;
        echo json_encode(['token' => $token]);
    } else {
        // Credenciales incorrectas
        echo json_encode(['message' => 'Credenciales incorrectas']);
        http_response_code(401); // Unauthorized
       
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['message' => 'Método no permitido']);
}
?>

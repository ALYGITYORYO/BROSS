<?php
require_once '../../vendor/autoload.php'; // Cargar autoload de Composer
use \Firebase\JWT\JWT;

function validarJWT($jwt) {
    try {
        $decoded = JWT::decode($jwt, SECRET_KEY, array('HS256'));
        return $decoded;
    } catch (Exception $e) {
        return null; // Si el token no es válido, retornar null
    }
}
?>

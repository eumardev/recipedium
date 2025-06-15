<?php
session_start();
require './basededatos.php';

$db = new basededatos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['nombre'] ?? '';
    $pass = $_POST['clave'];

    $resultado = $db->comprobarUsuario($user, $pass);

    if ($resultado === 'not_found') {
        echo '<div class="error-message">El usuario no existe. Por favor, regístrese.</div>';
    } elseif ($resultado === 'incorrect') {
        echo '<div class="error-message">Credenciales incorrectas. Intente de nuevo.</div>';
    } elseif (is_array($resultado)) {
        $_SESSION['usuario'] = serialize($resultado);
        echo 'ok'; // Solo esto, sin redirección ni HTML extra
    }
}
?>
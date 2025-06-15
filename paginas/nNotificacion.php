<?php
session_start(); // Asegúrate de iniciar la sesión

include_once './basededatos.php';
$bd = new basededatos();

$remitente_ID = $_POST["remitente_ID"];
$destinatario = $_POST["destinatario"];
$mensaje = $_POST["mensaje"];

// Verificar si el destinatario es 'admin' o 'global'
if ($destinatario === 'soporte' || $destinatario === 'global') {
    $bd->crearNotificacion($remitente_ID, $destinatario, $mensaje);
    echo 'Notificación enviada correctamente.';
} else {
    // Verificar si el destinatario existe
    $usuario = $bd->getUsuarioPorNombre($destinatario);

    if (!$usuario) {
        $_SESSION['error'] = "Usuario no encontrado. Por favor, verifique el campo del usuario.";
        echo 'Usuario no encontrado. Por favor, verifique el campo del usuario.';
        exit();
    }

    // Obtener el ID del destinatario
    $cliente_ID = $usuario['id_usuario'];

    // Llamar al método para insertar la notificación en la base de datos
    $bd->crearNotificacion($remitente_ID, $destinatario, $mensaje);
    echo 'Notificación enviada correctamente.';
}
?>
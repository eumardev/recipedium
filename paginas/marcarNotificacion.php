<?php
include_once './basededatos.php';
$bd = new basededatos();

$id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
$id_notificacion = isset($_POST['id_notificacion']) ? intval($_POST['id_notificacion']) : 0;

if ($id_usuario > 0 && $id_notificacion > 0) {
    $bd->marcarNotificacionLeida($id_usuario, $id_notificacion);
    echo "ok";
} else {
    echo "error";
}


// $redir = "cargar('#principal','./portada.php');";
// header("Location:./app.php?$redir");
?>
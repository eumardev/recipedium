<?php
include_once './basededatos.php';
$bd = new basededatos;

$id_notificacion = $_POST['id_notificacion'] ?? 0;
if ($id_notificacion > 0) {
    $bd->delNotificacion($id_notificacion);
    echo "Notificación eliminada";
} else {
    echo "Error";
}
// $id=$_GET["id"];
// $bd->delNotficacion($id);
// $redir = "cargar('#principal','./portada.php');";
// header("Location:./app.php?$redir");
?>
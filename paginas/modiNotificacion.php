<?php
include_once './basededatos.php';
$bd = new basededatos();

$bloque = array();
$bloque[0] = $_POST['id_notificacion'];
$bloque[3] = $_POST['mensaje'];

$dat = serialize($bloque);

try {
    $bd->updateNotificacion($dat);
    echo "Notificacion modificada correctamente";
} catch (Exception $e) {
    echo "Error al modificar la notificación: " . htmlspecialchars($e->getMessage());
}
?>


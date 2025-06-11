<?php
include_once './basededatos.php';
$bd = new basededatos;
$bloque = array();
$bloque[0]=$_POST["id_usuario"];
$bloque[1]=$_POST["nombre"];
$bloque[2]=$_POST["DNI"];
$bloque[3]=$_POST["email"];
$bloque[4]=$_POST["clave"];
$bloque[5]=$_POST["tipo_usu"];
$dat=serialize($bloque);

try {
    $bd->updateUsuario($dat);
    echo '<div class="success-message">Usuario modificado correctamente</div>';
} catch (Exception $e) {
    echo '<div class="error-message">Error al modificar el usuario: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>
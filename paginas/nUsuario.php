<?php
include_once './basededatos.php';
$bd = new basededatos;
$bloque = array();
// $bloque[0]=$_POST["id_usuario"];
$bloque[1]=$_POST["nombre"];
$bloque[2]=$_POST["DNI"];
$bloque[3]=$_POST["email"];
$bloque[4]=$_POST["clave"];
$bloque[5]=$_POST["tipo_usu"];
$dat=serialize($bloque);
$existeUsu=$bd->usuarioRegistrado($dat);

if ($existeUsu > 0) {
    echo '<div class="error-message">Usuario, DNI o email ya registrado en la aplicación.</div>';
} else {
    $bd->setUsuario($dat);
    echo '<div class="success-message">Usuario creado correctamente.</div>';
}
?>
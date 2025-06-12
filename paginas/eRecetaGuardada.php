<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ./index.php");
    exit();
}

include_once './basededatos.php';
$bd = new basededatos();
$datosusuario = unserialize($_SESSION['usuario']);
$id_usuario = $datosusuario['id_usuario'];

if (isset($_POST['id'])) {
    $id_receta = $_POST['id'];
    $bd->delRecetaGuardada($id_usuario, $id_receta);
    echo "eliminada";
} else {
    echo "error";
}
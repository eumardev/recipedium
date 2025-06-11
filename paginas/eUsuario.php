<?php
include_once './basededatos.php';
$bd = new basededatos;

if (isset($_POST['id_usuario'])) {
    $id = $_POST['id_usuario'];
  
    if ($bd->delUsuario($id)) {
        echo 'eliminado';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}

// $redir = "cargar('#principal','./portada.php');";
// header("Location:./app.php?$redir");
?>
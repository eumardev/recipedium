<?php
include_once './basededatos.php';
$bd = new basededatos;

if (isset($_POST['id_receta'])) {
    $id = $_POST['id_receta'];
    if ($bd->delReceta($id)) { 
        echo 'eliminada';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}

// $id=$_GET["id"];
// $bd->delReceta($id);
// $redir = "cargar('#principal','./portada.php');";
// header("Location:./app.php?$redir");
?>
<?php
include_once './basededatos.php';
$bd = new basededatos();

session_start();
$datosusuario = unserialize($_SESSION['usuario']);
$id_usuario = $datosusuario['id_usuario'];
$id_receta = isset($_POST['id_receta']) ? intval($_POST['id_receta']) : 0;

if ($id_usuario > 0 && $id_receta > 0) {
    // Comprobar si el usuario es el autor de la receta
    if ($bd->esAutorReceta($id_usuario, $id_receta)) {
        echo 'No puedes guardar tu propia receta.';
        exit();
    }

    $bloque = array();
    $bloque[1] = $id_usuario;
    $bloque[2] = $id_receta;
    $dat = serialize($bloque);

    $existe = $bd->recetaGuardada($dat);
    if ($existe > 0) {
        echo 'La receta ya está guardada.';
    } else {
        $bd->addReceta($dat);
        echo 'Receta guardada correctamente';
    }
} else {
    echo "Datos inválidos.";
}


// nota: si en vez de declarar el array en linea 5 declaro directamente las variables, en la comprobación de la línea 10 compruebo esas variables y antes de serializar declaro el array y lo relleno con las variables, el código funciona igualmente:
/*
<?php
include_once './basededatos.php';
$bd = new basededatos();

$id_usuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : 0;
$id_receta = isset($_GET['id_receta']) ? intval($_GET['id_receta']) : 0;

if ($id_receta > 0 && $id_usuario > 0) {
    Crear el array $bloque
    $bloque = array($id_usuario, $id_receta);

    Serializar el array $bloque
    $dat = serialize($bloque);

    Llamar al método para insertar la receta en la base de datos
    $bd->addReceta($dat);

    Redirigir a la página principal después de añadir la receta a la lista del usuario
    $redir = "cargar('#principal','./portada.php');";
    header("Location: ./app.php?$redir");
    exit();
} else {
    echo "<p>Error: Datos inválidos.</p>";
}
?>
*/
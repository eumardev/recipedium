<?php
include_once './basededatos.php';
$bd = new basededatos();

// Obtener datos actuales de la receta para saber la ruta de la imagen anterior
$id_receta = $_POST["id_receta"];
$datosActuales = $bd->getRecetaId($id_receta);
$rutaImagenAnterior = isset($datosActuales['imagen']) ? $datosActuales['imagen'] : null;

$bloque = array();
$bloque[0] = $id_receta;
$bloque[1] = $_POST["titulo"];
$bloque[2] = $_POST["ingredientes"];
$bloque[3] = $_POST["tiempo_preparacion"];
$bloque[4] = $_POST["tiempo_total"];
$bloque[5] = $_POST["instrucciones"];
$bloque[6] = $_POST["id_usuario"];
$bloque[7] = isset($_POST["publica"]) ? 1 : 0; // Si el checkbox está marcado, el valor es 1, de lo contrario, es 0

// Manejo de la imagen
$rutaImagen = null;
$directorio = "../imagenes/";

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    // Si hay una imagen anterior, la borramos
    if ($rutaImagenAnterior && file_exists($rutaImagenAnterior)) {
        unlink($rutaImagenAnterior);
    }
    $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $nombreArchivo = 'receta_' . $id_receta . '_' . time() . '.' . $extension;
    $rutaDestino = $directorio . $nombreArchivo;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
        $rutaImagen = $rutaDestino;
    }
} elseif (isset($_POST['eliminar_foto']) && $_POST['eliminar_foto'] == 1) {
    // Si se solicita eliminar la imagen, la borramos
    if ($rutaImagenAnterior && file_exists($rutaImagenAnterior)) {
        unlink($rutaImagenAnterior);
    }
    $rutaImagen = '';
}

$bloque[8] = $rutaImagen;

// Serializar el array $bloque
$dat = serialize($bloque);

try {
    // Llamar al método para actualizar la receta en la base de datos
    $bd->updateReceta($dat);
    echo '<div class="success-message">Receta modificada correctamente</div>';
} catch (Exception $e) {
    echo '<div class="error-message">Error al modificar la receta: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>
<?php
include_once './basededatos.php';
$bd = new basededatos();

$bloque = array();
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
    $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    // Usamos un nombre único para evitar sobrescribir imágenes
    $nombreArchivo = 'receta_' . uniqid() . '_' . time() . '.' . $extension;
    $rutaDestino = $directorio . $nombreArchivo;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
        $rutaImagen = $rutaDestino;
    }
}

// Añade la ruta de la imagen al array $bloque en la posición 8
$bloque[8] = $rutaImagen;

// Serializar el array $bloque
$dat = serialize($bloque);

// Llamamos al método para insertar la receta en la base de datos
$bd->crearReceta($dat);

// Devolvemos una respuesta en lugar de redirigir
echo 'Receta creada correctamente.';
?>
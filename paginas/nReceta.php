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
$imagen = null;
// comprueba si se ha subido un archivo, en nuestro caso una foto y que no haya errores
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    // Si hay imagen, usa file_get_contents() para leer el contenido binario del archivo temporal subido y guarda ese contenido binario en la variable $imagen.
    $imagen = file_get_contents($_FILES['foto']['tmp_name']);
}
// Añade la imagen al array $bloque en la posición 8
$bloque[8] = $imagen;

// Serializar el array $bloque
$dat = serialize($bloque);

// Llamamos al método para insertar la receta en la base de datos
$bd->crearReceta($dat);

// Devolvemos una respuesta en lugar de redirigir
echo 'Receta creada correctamente.';

<?php
session_start(); // Iniciar la sesión si no está iniciada

if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no hay una sesión iniciada
    header("Location: ../index.php");
    exit();
}

include_once './basededatos.php';
$bd = new basededatos();
$datosusuario = unserialize($_SESSION['usuario']);
$id_usuario = $datosusuario['id_usuario']; // Obtener el ID del usuario de la sesión

$datos = $bd->getRecetasGuardadasPorUsuario($id_usuario);
?>

<div class="container">
    <h2>Recetas guardadas</h2>
    <div class="search-container">
        <label for="search" class="">Buscador de recetas</label>
        <input type="text" id="search" placeholder="Busca recetas por título...">
    </div>
    <div id="recetas-list" class="filter-list">
        <?php
        foreach ($datos as $receta) {
            echo "<div class=\"receta-item filter-item\">";
            echo "<div class=\"receta-titulo filter-text\"><h3>" . htmlspecialchars($receta['titulo']) . "</h3></div>";
            echo "<div class=\"receta-contenido\">";
            // Mostrar la foto si está disponible, el div se crea siempre para mantener la estructura
            echo "<div class=\"receta-imagen\">";
            if (!empty($receta['imagen']) && file_exists($receta['imagen'])) {
                echo "<img src=\"" . htmlspecialchars($receta['imagen']) . "\" alt=\"Imagen de la receta\">";
            }
            echo "</div>";
            echo "<div class=\"receta-data\">";
            echo "<p><strong>Ingredientes:</strong> " . htmlspecialchars($receta['ingredientes']) . "</p>";
            echo "<p><strong>Tiempo de preparación:</strong> " . htmlspecialchars($receta['tiempo_preparacion']) . "</p>";
            echo "<p><strong>Tiempo total:</strong> " . htmlspecialchars($receta['tiempo_total']) . "</p>";
            echo "<p><strong>Instrucciones:</strong> " . htmlspecialchars($receta['instrucciones']) . "</p>";
            echo "<p><strong>Autor:</strong> " . htmlspecialchars($receta['autor']) . "</p>";
            echo "</div>";
            echo "</div>";
            echo "<button class=\"btn eliminar-receta-guardada\" data-id=\"" . htmlspecialchars($receta['id_receta']) . "\">Eliminar</button>";
            echo "</div>";
        }
        ?>
    </div>
</div>
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

$datos = $bd->getRecetasPorUsuario($id_usuario);
?>

<div class="container">
    <h2>Mis Recetas</h2>
    <div class="search-container">
        <label for="search" class="">Buscador de recetas</label>
        <input type="text" id="search" placeholder="Buscar receta por título...">
    </div>
    <div id="recetas-list" class="filter-list">
        <?php
        foreach ($datos as $receta) {
            echo '<div class="filter-item receta-item" data-id="' . htmlspecialchars($receta['id_receta']) . '">';
            echo '<div class="filter-text receta-titulo"><h3>' . htmlspecialchars($receta['titulo']) . '</h3></div>';
            echo '<div class="receta-contenido">';
            echo '<div class="receta-imagen">';
            if ($receta['imagen']) {
                echo '<img src="data:image/jpeg;base64,' . base64_encode($receta['imagen']) . '" alt="Imagen de la receta">';
            }
            echo '</div>';
            echo '<div class="receta-data">';
            echo '<p><strong>ID:</strong> ' . htmlspecialchars($receta['id_receta']) . '</p>';
            echo '<p><strong>Ingredientes:</strong> ' . htmlspecialchars($receta['ingredientes']) . '</p>';
            echo '<p><strong>Tiempo de preparación (minutos):</strong> ' . htmlspecialchars($receta['tiempo_preparacion']) . '</p>';
            echo '<p><strong>Tiempo total (minutos):</strong> ' . htmlspecialchars($receta['tiempo_total']) . '</p>';
            echo '<p><strong>Instrucciones:</strong> ' . htmlspecialchars($receta['instrucciones']) . '</p>';
            echo '<p><strong>Pública:</strong> ' . htmlspecialchars($receta['publica'] ? 'Sí' : 'No') . '</p>';
            echo '<p><strong>Autor:</strong> ' . htmlspecialchars($receta['autor']) . '</p>';
            echo '</div>';
            echo '</div>';
            echo '<div class="receta-acciones">';
            echo '<a href="./app.php?opcion=1&id=' . htmlspecialchars($receta['id_receta']) . '" class="btn ">Modificar</a>';
            echo '<button class="btn eliminar-receta" data-id="' . htmlspecialchars($receta['id_receta']) . '">Eliminar</button>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <div id="divRespuesta"></div>
</div>
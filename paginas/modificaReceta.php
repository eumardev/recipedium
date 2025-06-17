<?php
include_once './basededatos.php';
$bd = new basededatos();
$datos = $bd->getRecetas();
?>

<div class="container">
    <h2>Listado global de Recetas a modificar</h2>
    <div class="search-container">
        <label for="search" class="">Buscador de recetas</label>
        <input type="text" id="search" placeholder="Busca recetas por título...">
    </div>
    <div id="recetas-list" class="filter-list">
        <?php
        foreach ($datos as $receta) {
            echo "<div class=\"receta-item filter-item\">";
            echo "<div class=\"receta-titulo\" class=\"filter-text\"><h3>" . htmlspecialchars($receta['titulo']) . "</h3></div>";
            echo "<div class=\"receta-contenido\">";
            // Mostrar la foto si está disponible
            echo '<div class="receta-imagen">';
            if (!empty($receta['imagen'])) {
                echo '<img src="' . htmlspecialchars($receta['imagen']) . '" alt="Imagen de la receta">';
            }
            echo '</div>';
            echo "<div class=\"receta-data\">";
            echo "<p><strong>ID:</strong> " . htmlspecialchars($receta['id_receta']) . "</p>";
            echo "<p><strong>Ingredientes:</strong> " . htmlspecialchars($receta['ingredientes']) . "</p>";
            echo "<p><strong>Tiempo de preparación (minutos):</strong> " . htmlspecialchars($receta['tiempo_preparacion']) . "</p>";
            echo "<p><strong>Tiempo total (minutos):</strong> " . htmlspecialchars($receta['tiempo_total']) . "</p>";
            echo "<p><strong>Instrucciones:</strong> " . htmlspecialchars($receta['instrucciones']) . "</p>";
            echo "<p><strong>Pública:</strong> " . htmlspecialchars($receta['publica'] ? 'Sí' : 'No') . "</p>";
            echo "<p><strong>Autor:</strong> " . htmlspecialchars($receta['autor']) . "</p>";
            echo "</div>";
            echo "</div>";
            echo "<div class=\"receta-acciones\">";
            echo "<a href=\"./app.php?opcion=1&id=$receta[id_receta]\" class=\"btn\">Modificar</a>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</div>
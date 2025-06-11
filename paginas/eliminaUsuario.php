<?php
include_once './basededatos.php';
$bd = new basededatos();
$datos = $bd->getUsuarios();
?>

<div class="container">
    <h2>Listado global de usuarios a eliminar</h2>
    <div class="search-container">
        <label for="search" class="">Buscador de usuarios</label>
        <input type="text" id="search" placeholder="Buscar usuario por nombre...">
    </div>
    <div id="user-list" class="filter-list">
        <?php
        foreach ($datos as $usuario) {
            echo '<div class="filter-item usuario-item" data-id="' . htmlspecialchars($usuario['id_usuario']) . '">';
            echo '<p class="filter-text userName"><strong>Nombre:</strong> ' . htmlspecialchars($usuario['nombre']) . '</p>';
            echo '<p class="user-id"><strong>ID:</strong> ' . htmlspecialchars($usuario['id_usuario']) . '</p>';
            echo '<p class="user-dni"><strong>DNI:</strong> ' . htmlspecialchars($usuario['DNI']) . '</p>';
            echo '<p class="user-email"><strong>Correo electrónico:</strong> ' . htmlspecialchars($usuario['email']) . '</p>';
            echo '<p class="user-clave"><strong>Clave:</strong> ' . htmlspecialchars($usuario['clave']) . '</p>';
            echo '<p class="user-tipo"><strong>Tipo de usuario:</strong> ' . htmlspecialchars($usuario['tipo_usu']) . '</p>';
            echo '<div class="user-actions">';
            echo '<button class="btn eliminar-usuario" data-id="' . htmlspecialchars($usuario['id_usuario']) . '">Eliminar</button>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <div id="divRespuesta"></div>
</div>
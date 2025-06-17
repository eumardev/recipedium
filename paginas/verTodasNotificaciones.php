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

$notificaciones = $bd->getNotificaciones(); // Obtener todas las notificaciones
?>

<body>
    <div class="container">
        <h2>Listado global de Notificaciones</h2>
        <div class="search-container">
            <label for="search" class="">Buscador de notificaciones</label>
            <input type="text" id="search" placeholder="Buscar notificación por mensaje...">
        </div>
        <div id="notificaciones-list" class="filter-list">
            <?php
            foreach ($notificaciones as $notificacion) {
                echo "<div id=\"notificacion-item\" class=\"filter-item card\">";
                echo "<div class=\"card-body\">";
                echo "<div id=\"notificacion-mensaje\" class=\"filter-text\"><p>" . htmlspecialchars($notificacion['mensaje']) . "</p></div>";
                echo "<div class=\"notificacion-detalles\">";
                echo "<p><strong>ID:</strong> " . htmlspecialchars($notificacion['id_notificacion']) . "</p>";
                echo "<p><strong>Remitente:</strong> " . htmlspecialchars($notificacion['remitente_nombre']) . "</p>";
                echo "<p><strong>Destinatario:</strong> " . htmlspecialchars($notificacion['cliente_nombre']) . "</p>";
                echo "<p><strong>Leída:</strong> " . ($notificacion['leida'] ? 'Sí' : 'No') . "</p>";   
                echo "<p><strong>Fecha:</strong> " . htmlspecialchars($notificacion['creado_en']) . "</p>";
                echo "</div>";
                echo "<div class=\"notificacion-acciones\">";
                echo "<a href=\"./app.php?opcion=3&id=" . htmlspecialchars($notificacion['id_notificacion']) . "\" class=\"btn\">Modificar</a>";
                echo "<button class=\"btn  eliminar-notificacion\" data-id=\"" . htmlspecialchars($notificacion['id_notificacion']) . "\">Eliminar</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

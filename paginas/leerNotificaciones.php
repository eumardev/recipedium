<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include_once './basededatos.php';
$bd = new basededatos();
$datosusuario = unserialize($_SESSION['usuario']);
$id_usuario = $datosusuario['id_usuario'];

$notificaciones = $bd->getNotificacionesNoLeidas($id_usuario);
?>

<body>
    <div class="container">
        <h2 class="">Leer Notificaciones</h2>
        <div class="search-container">
            <label for="search" class="">Buscador de notificaciones</label>
            <input type="text" id="search" placeholder="Buscar notificación por mensaje...">
        </div>
        <div id="notificaciones-list" class="filter-list">
            <?php
            if (count($notificaciones) === 0) {
                echo "<p>No existen notificaciones sin leer.</p>";
            } else {
                foreach ($notificaciones as $notificacion) {
                    echo "<div id=\"notificacion-item\" class=\"filter-item card\">";
                    echo "<div class=\"card-body\">";
                    echo "<div id=\"notificacion-mensaje\" class=\"filter-text\"><p>" . htmlspecialchars($notificacion['mensaje']) . "</p></div>";
                    // Mostrar el nombre del remitente
                    echo "<div class=\"notificacion-remitente\"><p><strong>Remitente:</strong> " . htmlspecialchars($notificacion['remitente_nombre']) . "</p></div>";
                    echo "<div class=\"notificacion-detalles\">";
                    echo "<p><strong>Leída:</strong> " . ($notificacion['leida'] ? 'Sí' : 'No') . "</p>";
                    echo "<div class=\"notificacion-acciones\">";
                    if (!$notificacion['leida']) {
                        echo "<button class=\"btn btn-success marcar-leida\" data-id-usuario=\"" . $id_usuario . "\" data-id-notificacion=\"" . $notificacion['id_notificacion'] . "\">Marcar como leída</button>";
                    }
                    echo "</div>";
                    echo "<p><strong>Fecha:</strong> " . htmlspecialchars($notificacion['creado_en']) . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
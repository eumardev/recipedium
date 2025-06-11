<?php
session_start(); // Iniciar la sesión si no está iniciada

if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no hay una sesión iniciada
    header("Location: ../index.php");
    exit();
}

$datosusuario = unserialize($_SESSION['usuario']);
$id_usuario = $datosusuario['id_usuario']; // Obtener el ID del usuario de la sesión
?>

<div class="container">
    <div class="form-container">     
            <h2 class="">Nueva Notificación</h2>   
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
        <form id="mensajeForm">
            <div class="form-group">
                <label for="destinatario" class="negrita ">Nombre del Destinatario (o "global" para todos los usuarios):</label>
                <input class="form-control" placeholder="Nombre del Destinatario"  name="destinatario" type="text" id="destinatario">
            </div>
            <div class="form-group">
                <label for="mensaje" class="negrita ">Mensaje:</label>
                <textarea class="form-control" placeholder="Mensaje de la notificación"  name="mensaje" id="mensaje"></textarea>
            </div>
            <input type="hidden" name="remitente_ID" value="<?php echo $id_usuario; ?>">
            <button type="submit" class="btn">Enviar Notificación</button>
        </form>
        <div id="divRespuesta"></div>
    </div>
</div>

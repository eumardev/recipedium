<?php
session_start(); // Iniciar la sesión si no está iniciada

if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no hay una sesión iniciada
    header("Location: index.php");
    exit();
}

$datosusuario = unserialize($_SESSION['usuario']);
$id_usuario = $datosusuario['id_usuario']; // Obtener el ID del usuario de la sesión
?>

<div class="container ">
    <div class="form-container">
        <h2 class="">Formulario de contacto</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
        <form id="contactoForm">
            <div class="form-group">
                <label for="mensaje" class="negrita ">Mensaje:</label>
                <textarea class="form-control" placeholder="Introduce tu consulta" name="mensaje" id="mensaje"></textarea>             
            </div>
            <input type="hidden" name="remitente_ID" value="<?php echo $id_usuario; ?>">
            <input type="hidden" name="destinatario" value="soporte">
            <button type="submit" class="btn">Enviar</button>
        </form>
        <div id="divRespuesta"></div>
    </div>
</div>
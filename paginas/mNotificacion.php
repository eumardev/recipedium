<?php
include_once './basededatos.php';
$bd = new basededatos();
$id = $_GET['id'];
$datos = $bd->getNotificacionId($id);
?>

<div class="container">
    <div class="">
        <div class="form-container">
            <h2 class="text-dark-bn">Modificar notificación</h2>
            <form id="modificaNotificacionForm" method="POST" enctype="multipart/form-data">
                <input name="id_notificacion" id="id_notificacion" type="hidden" value="<?php echo htmlspecialchars($datos['id_notificacion']); ?>">
                <input name="remitente_ID" id="remitente_ID" type="hidden" value="<?php echo htmlspecialchars($datos['remitente_ID']); ?>">
                <input  name="cliente_ID" type="hidden" id="cliente_ID" value="<?php echo htmlspecialchars($datos['cliente_ID']); ?>">
                
                <div class="form-group">
                    <label for="mensaje" class="negrita">Mensaje:</label>
                    <textarea class="form-control" placeholder="Mensaje de la notificación"  name="mensaje" id="mensaje"><?php echo htmlspecialchars($datos['mensaje']); ?></textarea>
                </div>

                <button type="submit" class="btn">Modificar</button>
            </form>
            <div id="divRespuestaModificacionNotificacion"></div>
        </div>
    </div>
</div>

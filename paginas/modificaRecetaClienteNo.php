<?php
include_once './basededatos.php';
$bd = new basededatos;
$id = $_GET['id'];
$datos = $bd->getRecetaId($id);
$datosusuario = unserialize($_SESSION['usuario']);
$id_usuario = $datosusuario['id_usuario']; // Obtener el ID del usuario de la sesión
?>

<div class="container ">
    <div class="form-container">
        <h2 class="">Modificar Receta</h2>
        <form id="modificaRecetaForm" method="POST" enctype="multipart/form-data">
            <input name="id_receta" id="id_receta" type="hidden" value="<?php echo $datos['id_receta']; ?>">
            <input name="id_usuario" id="id_usuario" type="hidden" value="<?php echo $id_usuario; ?>">

            <div class="form-group">
                <label for="titulo" class="negrita ">Título:</label>
                <input class="form-control " placeholder="Título de la receta"  name="titulo" type="text" id="titulo" value="<?php echo htmlspecialchars($datos['titulo']); ?>">
            </div>

            <div class="form-group">
                <label for="foto" class="negrita ">Foto (opcional):</label>
                <input class="form-control " name="foto" type="file" id="foto">
            </div>

            <div class="form-group">
                <label for="ingredientes" class="negrita ">Ingredientes:</label>
                <textarea class="form-control " placeholder="Ingredientes de la receta"  name="ingredientes" id="ingredientes"><?php echo htmlspecialchars($datos['ingredientes']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="tiempo_preparacion" class="negrita ">Tiempo de preparación (minutos):</label>
                <input class="form-control " placeholder="Tiempo de preparación en minutos"  name="tiempo_preparacion" type="text" id="tiempo_preparacion" value="<?php echo htmlspecialchars($datos['tiempo_preparacion']); ?>">
            </div>

            <div class="form-group">
                <label for="tiempo_total" class="negrita ">Tiempo total (minutos):</label>
                <input class="form-control " placeholder="Tiempo total en minutos"  name="tiempo_total" type="text" id="tiempo_total" value="<?php echo htmlspecialchars($datos['tiempo_total']); ?>">
            </div>

            <div class="form-group">
                <label for="instrucciones" class="negrita ">Instrucciones:</label>
                <textarea class="form-control " placeholder="Instrucciones de la receta"  name="instrucciones" id="instrucciones"><?php echo htmlspecialchars($datos['instrucciones']); ?></textarea>
            </div>

            <div class="form-group checkbox-container">
                <label for="publica" class="negrita ">¿Hacer pública?</label>
                <input type="checkbox" name="publica" id="publica" value="1" <?php echo $datos['publica'] ? 'checked' : ''; ?>>
            </div>

            <button type="submit" class="btn">Modificar</button>
        </form>
        <div id="divRespuestaModificacionReceta"></div>
    </div>
</div>
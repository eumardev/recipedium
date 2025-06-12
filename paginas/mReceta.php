<?php
include_once './basededatos.php';
$bd = new basededatos;
$id = $_GET['id'];
$datos = $bd->getRecetaId($id); ?>
<div class="container">
    <div class="">
        <div class="form-container">
            <h2 class=""> Modificar receta </h2>
            <form id="modificaRecetaForm" method="POST" enctype="multipart/form-data">
                <input name="id_receta" id="id_receta" type="hidden" value="<?php echo $datos['id_receta']; ?>">
                <input name="id_usuario" id="id_usuario" type="hidden" value="<?php echo $id_usuario; ?>">

                <div class="form-group">
                    <label for="titulo" class="negrita ">Título:</label>
                    <input class="form-control" placeholder="Título de la receta" name="titulo" type="text" id="titulo" value="<?php echo htmlspecialchars($datos['titulo']); ?>">
                </div>

                <div class="form-group">
                    <label for="foto" class="negrita ">Foto (opcional):</label>
                    <?php if ($datos['imagen']): ?>
                        <p>Imagen actual:</p>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($datos['imagen']); ?>" alt="Imagen de la receta" style="width: 100px; height: auto;">
                        <input type="checkbox" name="eliminar_foto" id="eliminar_foto" value="1"> Eliminar foto actual
                    <?php endif; ?>
                    <input class="form-control" name="foto" type="file" id="foto">
                </div>

                <div class="form-group">
                    <label for="ingredientes" class="negrita ">Ingredientes:</label>
                    <textarea class="form-control" placeholder="Ingredientes de la receta" name="ingredientes" id="ingredientes"><?php echo htmlspecialchars($datos['ingredientes']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="tiempo_preparacion" class="negrita ">Tiempo de preparación:</label>
                    <input class="form-control" placeholder="Tiempo de preparación" name="tiempo_preparacion" type="text" id="tiempo_preparacion" value="<?php echo htmlspecialchars($datos['tiempo_preparacion']); ?>">
                </div>

                <div class="form-group">
                    <label for="tiempo_total" class="negrita ">Tiempo total:</label>
                    <input class="form-control" placeholder="Tiempo total" name="tiempo_total" type="text" id="tiempo_total" value="<?php echo htmlspecialchars($datos['tiempo_total']); ?>">
                </div>

                <div class="form-group">
                    <label for="instrucciones" class="negrita ">Instrucciones:</label>
                    <textarea class="form-control" placeholder="Instrucciones de la receta" name="instrucciones" id="instrucciones"><?php echo htmlspecialchars($datos['instrucciones']); ?></textarea>
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
</div>
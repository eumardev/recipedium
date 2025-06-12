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
            <h2 class="">Nueva Receta</h2>
        <form id="recetaForm" method="POST" enctype="multipart/form-data" action="#">
            <div class="form-group">
                <label for="titulo" class="negrita ">Título:</label>
                <input class="form-control" placeholder="Título de la receta"  name="titulo" type="text" id="titulo" value="">
            </div>
            <div class="form-group">
                <label for="foto" class="negrita ">Foto (opcional):</label>
                <input class="form-control " name="foto" type="file" id="foto">
            </div>
            <div class="form-group">
                <label for="ingredientes" class="negrita ">Ingredientes:</label>
                <textarea class="form-control" placeholder="Ingredientes de la receta"  name="ingredientes" id="ingredientes"></textarea>
            </div>
            <div class="form-group">
                <label for="tiempo_preparacion" class="negrita ">Tiempo de preparación (minutos):</label>
                <input class="form-control " placeholder="Tiempo de preparación en minutos"  name="tiempo_preparacion" type="text" id="tiempo_preparacion" value="">
            </div>
            <div class="form-group">
                <label for="tiempo_total" class="negrita ">Tiempo total (minutos):</label>
                <input class="form-control " placeholder="Tiempo total en minutos"  name="tiempo_total" type="text" id="tiempo_total" value="">
            </div>
            <div class="form-group">
                <label for="instrucciones" class="negrita ">Instrucciones:</label>
                <textarea class="form-control " placeholder="Instrucciones de la receta"  name="instrucciones" id="instrucciones"></textarea>
            </div>
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
            <div class="form-group checkbox-container">
                <label for="publica" class="negrita ">¿Hacer pública?</label>
                <input type="checkbox" name="publica" id="publica" value="1">
            </div>
            <button type="submit" class="btn">Crear Receta</button>
        </form>
        <div id="divRespuesta"></div>
    </div>
</div>


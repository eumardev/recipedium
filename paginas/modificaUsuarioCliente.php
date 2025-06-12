<?php
session_start(); // Iniciar la sesión si no está iniciada

if (!isset($_SESSION['usuario'])) {
    // Redirigir al login si no hay una sesión iniciada
    header("Location: login.php");
    exit();
}

include_once './basededatos.php';
$bd = new basededatos();
$datosusuario = unserialize($_SESSION['usuario']);
$id_usuario = $datosusuario['id_usuario']; // Obtener el ID del usuario de la sesión

$datos = $bd->getUsuarioId($id_usuario);
?>

<div class="container ">
    <div class="form-container">
        <h2 class="">Modificar Usuario</h2>
        <form id="modificaUsuarioForm" method="POST">
            <div class="form-group">
                <label for="nombre" class="negrita ">Nombre:</label>
                <input class="form-control " placeholder="Nombre" name="nombre" type="text" id="nombre" value="<?php echo $datos[1]; ?>">
            </div>
            <div class="form-group">
                <label for="DNI" class="negrita ">DNI:</label>
                <input class="form-control " placeholder="DNI" name="DNI" type="text" id="DNI" value="<?php echo $datos[2]; ?>">
            </div>
            <div class="form-group">
                <label for="email" class="negrita ">Correo Electrónico:</label>
                <input class="form-control " placeholder="Correo Electrónico" name="email" type="email" id="email" value="<?php echo $datos[3]; ?>">
            </div>
            <div class="form-group">
                <label for="clave" class="negrita ">Clave:</label>
                <input class="form-control " placeholder="Clave" name="clave" type="password" id="clave" value="<?php echo $datos[4]; ?>">
            </div>
            <input type="hidden" name="tipo_usu" value="<?php echo $datos[5]; ?>">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
            <button type="submit" class="btn">Actualizar</button>
        </form>
        <div id="divRespuestaModificacion"></div>
    </div>
</div>
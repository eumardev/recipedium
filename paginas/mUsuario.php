<?php
include_once './basededatos.php';
$bd = new basededatos;
$id = $_GET['id'];
$datos = $bd->getUsuarioId($id); 
?>
<div class="container">
    <div class="form-container">
        <h2 class=""> Modificar Usuario </h2>
        <form id="modificaUsuarioForm" method="POST">
            <div class="form-group">
                <label for="usuario" class="negrita ">Nombre de usuario:</label>
                <!-- el input id no ha de ser visible al usuario por ello lo de hidden -->
                <input name="id_usuario" id="id_usuario" type="hidden" value="<?php echo $datos[0]; ?>">

                <input class="form-control " placeholder="Nombre de usuario" Política de privacidad name="nombre" type="text" id="nombre" value="<?php echo $datos[1]; ?>">
            </div>

            <div class="form-group">
                <label for="clave" class="negrita ">DNI:</label>
                <input class="form-control " placeholder="DNI/NIF de usuario" Política de privacidad name="DNI" type="text" id="DNI" value="<?php echo $datos[2]; ?>">
            </div>

            <div class="form-group">
                <label for="clave" class="negrita ">Correo electrónico:</label>
                <input class="form-control " placeholder="Email de usuario" Política de privacidad name="email" type="text" id="email" value="<?php echo $datos[3]; ?>">
            </div>

            <div class="form-group">
                <label for="clave" class="negrita ">Clave:</label>
                <input class="form-control " placeholder="Clave de usuario" Política de privacidad name="clave" type="text" id="clave" value="<?php echo $datos[4]; ?>">
            </div>

            <div class="form-group">
                <label for="tipo" class="negrita ">Tipo de Usuario:</label>
                <select class="form-control " name="tipo_usu" id="tipo_usu" required>
                    <?php
                    if ($datos[5] == "admin") {
                        echo "<option value='admin' selected>Admin</option>";
                        echo "<option value='cliente'>Cliente</option>";
                    } else {
                        echo "<option value='admin'>Admin</option>";
                        echo "<option value='cliente' selected>Cliente</option>";
                    }
                    ?> </select>
            </div>
            <input type="submit" class="btn" value="Actualizar">
        </form>
        <div id="divRespuestaModificacion"></div>
    </div>
</div>

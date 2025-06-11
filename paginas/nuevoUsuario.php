<?php
include_once './basededatos.php';
$bd = new basededatos;
?>

<div class="container">
    <div class="form-container">
            <h2 class="">Nuevo usuario</h2>
        <form id="usuarioForm" method="POST" action="#" >
            <div class="form-group">
                <label for="nombre" class="negrita ">Nombre de usuario:</label>
                <input class="form-control " placeholder="Nombre de usuario"  name="nombre" type="text" id="nombre" value="">
            </div>
            <div class="form-group">
                <label for="DNI" class="negrita ">DNI:</label>
                <input class="form-control " placeholder="DNI/NIF de usuario"  name="DNI" type="text" id="DNI" value="">
            </div>
            <div class="form-group">
                <label for="email" class="negrita ">Correo electrónico:</label>
                <input class="form-control " placeholder="Email de usuario"  name="email" type="text" id="email" value="">
            </div>
            <div class="form-group">
                <label for="clave" class="negrita ">Clave:</label>
                <input class="form-control " placeholder="Clave de usuario"  name="clave" type="text" id="clave" value="">
            </div>
            <div class="form-group">
                <label for="tipo_usu" class="negrita ">Tipo de usuario:</label>
                <select class="form-control " name="tipo_usu" id="tipo_usu">
                    <option value="admin">Admin</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>
            <button type="submit" class="btn">Registrarse</button>
        </form>
        <div id="divRespuesta"></div>
    </div>
</div>

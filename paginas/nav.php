<?php
session_start();
$datosusuario = unserialize($_SESSION['usuario']);
$nombre = $datosusuario['nombre'];
$tipo = $datosusuario['tipo_usu'];
$id_usuario = $datosusuario['id_usuario']; //para poder usar el id en la aplicacion 

include_once './basededatos.php';
$bd = new basededatos();
$notificacionesNoLeidas = $bd->getNotificacionesNoLeidas($id_usuario);
$hayNotificacionesNoLeidas = count($notificacionesNoLeidas) > 0;
?>

<nav class="navbar">
    <!-- <div class="menu-toggle">&#9776;</div> Icono de menú hamburguesa -->
    <div class="menu-toggle" aria-label="Abrir menú" tabindex="0"><span></span></div>
    <div class="nav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-expanded="false">Recetas</a>
                <ul class="dropdown-menu">
                    <?php
                    if ($tipo == 'admin') {
                        echo '
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./nuevaReceta.php\');"> Nueva Receta</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./modificaReceta.php\');"> Modificar Receta</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./eliminaReceta.php\');"> Eliminar Receta</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./verRecetasAdmin.php\');"> Ver todas las Recetas</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./verRecetasGuardadas.php?id=$id\');"> Ver Recetas Guardadas</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./buscarReceta.php\');"> Buscar Recetas en internet</a></li>';
                    } else if ($tipo == 'cliente') {
                        echo '
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./nuevaReceta.php\');"> Nueva Receta</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./verRecetasCliente.php\');"> Mis Recetas</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./verRecetasGuardadas.php?id=$id\');"> Ver Recetas Guardadas</a></li>
                         <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./buscarReceta.php\');"> Buscar Recetas en internet</a></li>';
                    }
                    ?>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" aria-expanded="false">Usuarios</a>
                <ul class="dropdown-menu">
                    <?php
                    if ($tipo == 'admin') {
                        echo '
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./nuevoUsuario.php\');"> Nuevo Usuario</a></li>
                        <li><hr class=""></li>        
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./modificaUsuario.php\');"> Modificar Usuario</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./eliminaUsuario.php\');"> Eliminar Usuario</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./verUsuarios.php\');"> Ver Usuarios</a></li>';
                    } else if ($tipo == 'cliente') {
                        echo '
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./modificaUsuarioCliente.php\');"> Modificar mis datos de Usuario</a></li>
                        ';
                    }
                    ?>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" aria-expanded="false">Notificaciones</a>
                <ul class="dropdown-menu">
                    <?php
                    if ($tipo == 'admin') {
                        echo '
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./nuevaNotificacion.php\');"> Nueva Notificación</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./modificaNotificacion.php\');"> Modificar Notificación</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./eliminaNotificacion.php\');"> Eliminar Notificación</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./verNotificacionesUsuario.php\');"> Mis Notificaciones</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./verTodasNotificaciones.php\');"> Ver Notificaciones</a></li>';
                    } else if ($tipo == 'cliente') {
                        echo '
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./nuevaNotificacionCliente.php\');"> Nueva Notificación</a></li>
                        <li><hr class=""></li>
                        <li><a class="dropdown-item" href="javascript:cargar(\'#principal\',\'./verNotificacionesUsuario.php\');"> Mis Notificaciones</a></li>';
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </div>
    <div class="" id="notification-icon">
        <a href="javascript:cargar('#principal','./leerNotificaciones.php');">
            <img src="../imagenes/<?php echo $hayNotificacionesNoLeidas ? 'envelope-red.svg' : 'envelope-outline.svg'; ?>" alt="Icono Notificaciones">
        </a>
    </div>
</nav>

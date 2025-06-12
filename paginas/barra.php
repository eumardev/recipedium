<?php
session_start();
$datosusuario = unserialize($_SESSION['usuario']);
$nombre = $datosusuario['nombre'];
$id_usuario = $datosusuario['id_usuario']; //para poder usar el id en la aplicacion 
?>

<div class="headerbar">
    <a class="" href="./app.php">
        <img src="../imagenes/logo_recipedium.svg" class="logo" alt="logotipo Recipedium" />
    </a>
    <div class="titulo-container">
    <h1 class="titulo">RECIPEDIUM</h1>
    <h2 class="tagline">Tu recetario de cocina y mucho más</h2>
    </div>
    <div class="user-info">
        <span class="username"><?php echo $nombre; ?></span>
        <!-- se añade evento onfocus y onblur para mejorar la accesibilidad tanto por teclado como con raton (onmouseover y onmouseout) -->
        <a href="./logout.php"><img  class="logout-icon" src="../imagenes/user_747578.png" alt="Cerrar sesión"
                onmouseover="this.src='../imagenes/user_747555.png';" onmouseout="this.src='../imagenes/user_747578.png';"
                 
                onfocus="this.src='../imagenes/user_747555.png';"
                onblur="this.src='../imagenes/user_747578.png';" /></a>
    </div>
</div>
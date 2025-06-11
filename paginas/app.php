<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../JS/funciones.js" defer></script>
    <script src="../JS/regex.js" defer></script>
    <script src="../JS/ajax.js" defer></script>
    <script src="../JS/faq.js" defer></script>

    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" media="(min-width: 768.1px) and (max-width: 991px)" href="../CSS/styles768To991.css">
    <link rel="stylesheet" media="(max-width: 768px)" href="../CSS/stylesTo768.css">
    <title>Recipedium</title>

</head>

<body>
    <div class="container-fluid" id="contenedor">
        <header>
            <div id="barra"></div>
        </header>
        <div id="nav">

        </div>
        <main>
            <div id="principal" class=""></div>
        </main>
        <div id="footer" class="footer">
        </div>


        <!-- con el siguiente bloque de codigo php vamos a definir la variable redir por defecto portada.php que se cargará en principal (main), pero si recibe alguna opcion, cargará el contenido del case que nos mostrará el archivo que esté dentro de cada opcion. El header,nav y footer se cargan mediante la funcion cargar -->
        <?php
        $redir = "cargar('#principal','./portada.php');";
        if (isset($_GET['opcion'])) {
            switch ($_GET['opcion']) {
                case 1:
                    $redir = "cargar('#principal','./verUsuarios.php');";
                    break;
                case 2:
                    $id = $_GET['id'];
                    $redir = "cargar('#principal','./mUsuario.php?id=$id');";
                    break;
                case 3:
                    $redir = "cargar('#principal','./modificaUsuarioCliente.php');";
                    break;
                case 4:
                    $redir = "cargar('#principal','./nuevoUsuario.php');";
                    break;
                case 5:
                    $redir = "cargar('#principal','./eliminaUsuario.php');";
                    break;
                case 6:
                    $redir = "cargar('#principal','./nuevaReceta.php');";
                    break;
                case 7:
                    $redir = "cargar('#principal','./verRecetasCliente.php');";
                    break;
                case 8:
                    $id = $_GET['id'];
                    $redir = "cargar('#principal','./verRecetasAdmin.php?id=$id');";
                    break;
                case 9:
                    $id = $_GET['id'];
                    $redir = "cargar('#principal','./mReceta.php?id=$id');";
                    break;
                case 10:
                    $id = $_GET['id'];
                    $redir = "cargar('#principal','./eliminaReceta.php?id=$id');";
                    break;
                case 11:
                    $redir = "cargar('#principal','./nuevaNotificacion.php');";
                    break;
                case 12:
                    $redir = "cargar('#principal','./nuevaNotificacionCliente.php');";
                    break;
                case 13:
                    $redir = "cargar('#principal','./verNotificaciones.php');";
                    break;
                case 14:
                    $redir = "cargar('#principal','./verTodasNotificaciones.php');";
                    break;
                case 15:
                    $id = isset($_GET['id']) ? $_GET['id'] : null;
                    if ($id) {
                        $redir = "cargar('#principal','./mNotificacion.php?id=$id');";
                    }
                    break;
                case 16:
                    $id_receta = isset($_GET['id_receta']) ? $_GET['id_receta'] : null;
                    $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
                    if ($id_receta && $id_usuario) {
                        $redir = "cargar('#principal','./aReceta.php?id_receta=$id_receta&id_usuario=$id_usuario');";
                    }
                    break;
            }
        }
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                cargar('#barra', './barra.php');
                cargar('#nav', './nav.php', function() {
                    iniciaHamburguesa();
                    iniciaNav();
                });
                <?php echo $redir; ?>
                cargar('#footer', './footer.php');
            });
        </script>
    </div>

</body>

</html>
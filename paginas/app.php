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


        <!-- con el siguiente bloque de codigo php vamos a definir la variable redir por defecto portada.php que se cargará en principal (main), pero si recibe alguna opcion, cargará el contenido del case que nos mostrará el archivo que esté dentro de cada opcion.  -->
        <?php
        $redir = "cargar('#principal','./portada.php');";
        if (isset($_GET['opcion'])) {
            switch ($_GET['opcion']) {
                case 1:
                    $id = $_GET['id'];
                    $redir = "cargar('#principal','./mReceta.php?id=$id');";
                    break;
                case 2:
                    $id = $_GET['id'];
                    $redir = "cargar('#principal','./mUsuario.php?id=$id');";
                    break;
                case 3:
                    $id = isset($_GET['id']) ? $_GET['id'] : null;
                    if ($id) {
                        $redir = "cargar('#principal','./mNotificacion.php?id=$id');";
                    }
                    break;
            }
        }
        ?>
        <!-- El header,nav y footer se cargan mediante la llamada a la funcion cargar de este acript, son estáticos sin embargo el contenido principal se carga dinamicamente a traés de la variable $redir que queda definida en los case del switch -->
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
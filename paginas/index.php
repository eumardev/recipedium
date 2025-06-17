<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>Recipedium</title>
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" media="(min-width: 768.1px) and (max-width: 991px)" href="../CSS/styles768To991.css">
    <link rel="stylesheet" media="(max-width: 768px)" href="../CSS/stylesTo768.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../JS/funciones.js" defer></script>
    <script src="../JS/regex.js" defer></script>
    <script src="../JS/ajax.js" defer></script>
</head>

<body>
    <header class="headerbar">
        <a href="../index.html"><img src="../imagenes/logo_recipedium.svg" alt="Logo Recipedium" class="logo"></a>
        <div class="titulo-container">
            <h1 class="titulo">RECIPEDIUM</h1>
            <h2 class="tagline">Tu recetario de cocina y mucho más</h2>
        </div>
    </header>
    <main class="main-index">
        <section id="login" class="form-section"
            <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'existe') echo 'style="display: none;"'; ?>>
            <h3>Login</h3>

            <form id="loginForm" action="#" method="POST">

                <label for="nombre_usuario">Nombre de usuario:</label>
                <input type="text" placeholder="Usuario" name="nombre" id="nombre_usuario" maxlength="15">
                <label for="clave_login">Clave:</label>
                <input type="password" name="clave" id="clave_login" placeholder="Clave" maxlength="20">
                <p>¿Olvidaste tu clave? Escríbenos a <a href="mailto:info@recipedium.com">info@recipedium.com</a>
                </p>
                <input type="submit" id="login" name="login" value="Iniciar Sesión">

                <?php if (isset($_SESSION['error_message'])) { ?>
                    <div class="error-message">
                        <?php echo $_SESSION['error_message']; ?>
                        <?php unset($_SESSION['error_message']); ?>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'creado'): ?>
                    <div class="success-message">
                        Usuario creado correctamente, ya puedes iniciar sesión.
                    </div>
                <?php endif; ?>
            </form>
            <div id="divRespuestaLogin"></div>
            <p>¿No tienes una cuenta? <a href="#" id="showRegisterForm">Regístrate aquí</a></p>
        </section>

        <section id="registro" class="form-section" style="display: none;">
            <h3>Registro</h3>
            <form id="registerForm" action="#" method="POST">
                <div class="form-group">
                    <label for="nombre">Usuario:</label>
                    <input placeholder="Nombre de usuario" name="nombre" type="text" id="nombre" value="">
                </div>
                <div class="form-group">
                    <label for="DNI">DNI:</label>
                    <input placeholder="DNI/NIF de usuario" name="DNI" type="text" id="DNI" value="">
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input placeholder="Email de usuario" name="email" type="text" id="email" value="">
                </div>
                <div class="form-group">
                    <label for="clave">Clave:</label>
                    <input placeholder="Clave de usuario" name="clave" type="password" id="clave" value="">
                </div>
                <input type="hidden" name="tipo_usu" value="cliente">
                <button type="submit">Registrarse</button>
            </form>
            <div id="divRespuestaRegistro"></div>
            <p>¿Ya tienes una cuenta? <a href="#" id="showLoginForm">Inicia sesión aquí</a></p>
        </section>

    </main>
    <footer class="footer">
        <div class="footer-left">
            <div>
                <a href="./privacidad.html" class="footer-link">Política de privacidad</a>
            </div>
            <div>
                <a href="./información_legal.html" class="footer-link">Información legal</a>
            </div>
            <div>
                <a href="./faq.html" class="footer-link">FAQ´s</a>
            </div>
        </div>
        <div class="footer-center">
            &copy; <?php echo date("Y"); ?> Recipedium. Todos los derechos reservados.
        </div>
        <div class="footer-right">
            <a href="https://www.youtube.com/@Recipedium" target="_blank"><img src="../imagenes/youtube.png"
                    alt="Youtube" class="social-icon"></a>
            <a href="https://wa.me/34605019788" target="_blank"><img src="../imagenes/whatsapp_4494495.png" alt="Whatsapp"
                    class="social-icon"></a>
            <a href="https://instagram.com/recipedium" target="_blank"><img src="../imagenes/instagram_4494489.png"
                    alt="Instagram" class="social-icon"></a>
        </div>
    </footer>
</body>

</html>
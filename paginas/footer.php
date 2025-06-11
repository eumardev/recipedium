    <footer class="footer">
        <div class="footer-left">
            <div>
                <a href="javascript:cargar('#principal','./politicas.php');" class="footer-link">Política de privacidad</a>
            </div>
            <div>
                <a href="javascript:cargar('#principal','./informacion.php?id=<?php echo isset($id) ? $id : ''; ?>');" class="footer-link">Información legal</a>
            </div>
            <div>
                <a href="javascript:cargar('#principal','./FAQ.php?id=<?php echo isset($id) ? $id : ''; ?>');" class="footer-link">FAQ´s</a>
            </div>
            <div>
                <a href="javascript:cargar('#principal','./contacto.php?id=<?php echo isset($id) ? $id : ''; ?>');" class="footer-link">Contacto</a>
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
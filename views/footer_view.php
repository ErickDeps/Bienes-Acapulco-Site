<!-- ================= MENU LATERAL CON FILTRO DE BUSQUEDA ================= -->
<div class="overlay__menu">
    <div class="menu__lateral" id="menu-lateral">
            <button class="btn__cerrar-menu" id="btn-cerrar-menu">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="contenedor__menu">
                <ul class="menu">
                    <li class="menu__li">
                        <a href="<?php echo URL_BASE?>" class="menu__link">
                            <i class="fa-solid fa-house menu__icon"></i> Inicio
                        </a>
                    </li>
                    <li class="menu__li">
                        <a href="<?php echo URL_BASE?>#propiedades" class="menu__link">
                            <i class="fa-solid fa-images menu__icon"></i> Propiedades
                        </a>
                    </li>
                    <li class="menu__li">
                        <a href="#" class="menu__link">
                            <i class="fa-solid fa-paper-plane menu__icon"></i> contacto
                        </a>
                    </li>
                </ul>
            </div>
            <div class="contenedor__hr">
                <hr>
            </div>
            <div class="contenedor__filtro">
                <form action="<?= URL_BASE ?>" class="form__filtro-lateral" method="GET">
                    <input type="hidden" name="controller" value="Inmueble">
                    <input type="hidden" name="action" value="mostrarBusquedaInmuebles">
    
                    <div class="form-group form__group-buscar">
                        <label for="busqueda" class="input-label">Buscar</label>
                        <input type="text" name="busqueda" id="busqueda" placeholder="Búsqueda">
                    </div>
    
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select name="categoria" id="categoria">
                            <option value="default" disabled selected>Seleccionar</option>
                            <option value="renta">Renta</option>
                            <option value="venta">Venta</option>
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="recamaras">Recamaras</label>
                        <select name="recamaras" id="recamaras">
                            <option value="default" disabled selected>Seleccionar</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="3+">3+</option>
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="banios">Baños</label>
                        <select name="banios" id="banios">
                            <option value="default" disabled selected>Seleccionar</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="3+">3+</option>
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="garage">Estacionamiento</label>
                        <select name="garage" id="garage">
                            <option value="default" disabled selected>Seleccionar</option>
                            <option value="si">Sí</option>
                            <option value="no">No</option>
                        </select>
                    </div>
    
                    <button type="submit">
                        Buscar
                    </button>
                </form>
            </div>
        </div>
</div>

<footer>
        <div class="footer__bg">
            <div class="footer__container container">

                <ul class="footer__links">
                    <li>
                        <a href="#home" class="footer__link">Inicio</a>
                    </li>
                    <li>
                        <a href="#home" class="footer__link">Publicaciones</a>
                    </li>
                    <li>
                        <a href="#about" class="footer__link">¿Cómo publicar?</a>
                    </li>
                    <li>
                        <a href="#portfolio" class="footer__link">Contacto</a>
                    </li>
                </ul>
            
                <div class="footer__info">
                    <a href="/aviso-de-privacidad">Aviso de privacidad</a>
                    <a href="/terminos">Términos y condiciones</a>
                </div>
            
                <div class="footer__contacto">
                    <a href="https://wa.me/52XXXXXXXXXX" target="_blank"><i class="fa fa-whatsapp whatsapp-icon"></i> Contáctanos por WhatsApp</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 Bienes Acapulco – Todos los derechos reservados</p>
            </div>
        </div>
    </footer>
    
    <!--==================== SWIPER JS ====================-->
    <script src="assets/js/swiper-bundle.min.js" defer></script>

    <!--==================== EMAIL JS ====================-->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js" defer></script>

    <!--==================== IMAGENES PARA GALERIA ====================-->
    <script> const images = <?php echo json_encode($imagenes); ?>; </script>

    <!--==================== MAIN JS ====================-->
    <script src="assets/js/main.js" defer></script>
    <!--==================== SINGLE JS ====================-->
    <script src="assets/js/single.js" defer></script>
</body>
</html>
<?php require_once './views/header_view.php'; ?>
    <main>
        <div class="main__content container"> 
            <?php if(!$inmuebles): ?>
            <div class="contenedor__sin-propiedades">
                <h3 class="alerta">No hay propiedades recientes</h3>
            </div>
            <?php endif; ?>
        <section class="cards__content" id="propiedades">
            <!-- ========= CARD 1  ========== -->
             <?php foreach($inmuebles as $inmueble): ?>
            <div class="card">
                <div class="thumb swiper">
                    <div class="mySwiper">
                        <div class="swiper-wrapper">
                            <?php foreach($inmueble['imagenes'] as $imagen): ?>
                            <a href="<?= URL_BASE ?>?controller=inmueble&action=obtenerInmueblePorId&id=<?= $inmueble['id']?>" class="thumb__link swiper-slide">
                                <img src="<?php echo URL_BASE?>/assets/uploads/<?= $imagen['imagenes'] ?>" alt="TITULO_IMAGEN" class="img__card">
                            </a>
                            <?php endforeach; ?>  
                        </div> 
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Arrows -->
                        <div class="swiper-button-next" id="swiper-button-next">
                        <i class="fa-solid fa-angle-right swiper-navigation-icon"></i>
                        </div>
                        <div class="swiper-button-prev" id="swiper-button-prev">
                        <i class="fa-solid fa-angle-left swiper-navigation-icon"></i>
                        </div>
                </div>
                <div class="card__data">
                    <div class="category-group">
                        <p class="categoria"><?= $inmueble['categoria'] ?></p>
                        <p class="precio"><?= number_format($inmueble['precio'])?> MXN<span class="periodo"> <?= $inmueble['periodo'] ?></span></p>
                    </div>
                    <h4 class="card__titulo"><a href="RUTA_PUBLICACION_ID_SINGLE"><?= $inmueble['titulo'] ?></a></h4>
                    <p class="ubicacion"><i class="fa-solid fa-location-dot"></i>  <?= $inmueble['ubicacion'] ?></p>
                    <p class="dormitorios"><i class="fa-solid fa-bed"></i><span><?= $inmueble['recamaras'] ?></span> Rec</p>
                    <p class="banios"><i class="fa-solid fa-bath"></i> <span><?= $inmueble['banios'] ?></span> Ba</p>
                    <!-- <p class="telefono"><i class="fas fa-phone"></i> 999777666</p> -->
                </div> 
                <hr class="separador">
                <div class="card__more-information">
                    <p class="fecha"><?= fecha($inmueble['fecha']) ?> <i class="fas fa-paper"></i></p>
                    <a href="<?= URL_BASE ?>?controller=inmueble&action=obtenerInmueblePorId&id=<?= $inmueble['id']?>" class="link">Mas informacion</a>
                </div>
            </div>
            <?php endforeach; ?> 
                

            </section>
            <!-- ========= PAGINATION ========== -->
            <div class="pagination" id="pagination">
                <?php require_once './views/pagination.php'; ?>
            </div>
        </div> 
    </main>

<?php require_once './views/footer_view.php'; ?>
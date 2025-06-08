<?php require_once 'header_view.php'; ?>

 <main>
        <div class="main__content container">
            <?php if(!$resultados): ?>
                <div class="contenedor__sin-propiedades">
                    <h3 class="alerta">No hay resultados</h3>
                </div>
            <?php endif; ?>
        <section class="cards__content" id="propiedades">
            <!-- ========= CARD 1  ========== -->
             <?php foreach($resultados as $resultado): ?>
            <div class="card">
                <div class="thumb swiper">
                    <div class="mySwiper">
                        <div class="swiper-wrapper">
                            <?php foreach($resultado['imagenes'] as $imagen): ?>
                            <a href="<?= URL_BASE ?>?controller=inmueble&action=obtenerInmueblePorId&id=<?= $resultado['id']?>" class="thumb__link swiper-slide">
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
                        <p class="categoria"><?= $resultado['categoria'] ?></p>
                        <p class="precio"><?= number_format($resultado['precio'])?> MXN<span class="periodo"> <?= $resultado['periodo'] ?></span></p>
                    </div>
                    <h4 class="card__titulo"><a href="RUTA_PUBLICACION_ID_SINGLE"><?= $resultado['titulo'] ?></a></h4>
                    <p class="ubicacion"><i class="fa-solid fa-location-dot"></i>  <?= $resultado['ubicacion'] ?></p>
                    <p class="dormitorios"><i class="fa-solid fa-bed"></i><span><?= $resultado['recamaras'] ?></span> Rec</p>
                    <p class="banios"><i class="fa-solid fa-bath"></i> <span><?= $resultado['banios'] ?></span> Ba</p>
                    <!-- <p class="telefono"><i class="fas fa-phone"></i> 999777666</p> -->
                </div>
                <hr class="separador">
                <div class="card__more-information">
                    <p class="fecha"><?= fecha($resultado['fecha']) ?> <i class="fas fa-paper"></i></p>
                    <a href="<?= URL_BASE ?>?controller=inmueble&action=obtenerInmueblePorId&id=<?= $resultado['id']?>" class="link">Mas informacion</a>
                </div>
            </div>
            <?php endforeach; ?> 
                

            </section>
        </div>
    </main>








<?php require_once 'footer_view.php'; ?>
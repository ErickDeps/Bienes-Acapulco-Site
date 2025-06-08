<!DOCTYPE html>
<html lang="es"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fcf216840a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <title>Bienes Acapulco</title>
    <!-- ========= FAVICON  ========== -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <!-- ========= STYLES CSS  ========== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/public-styles.css">
    <!-- ========= FONTAWESOME 5  ========== -->
    <script src="https://kit.fontawesome.com/bc87e91a0d.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <header> 
        <button class="btn__menu-lateral" id="btn-menu-lateral">
            <i class="fa-solid fa-bars"></i>
        </button>
        <!-- ========= MENU  ========== -->
        <nav class="navbar container"> 
            <ul class="navbar__menu">
                <a href="<?php echo URL_BASE?>" class="menu__link">
                    <i class="fa-solid fa-house"></i> Inicio
                </a>
                <a href="#propiedades" class="menu__link">
                    <i class="fa-solid fa-images"></i> Propiedades
                </a>
                <a href="#" class="menu__link">
                    <i class="fa-solid fa-paper-plane"></i> contacto
                </a>
            </ul>
        </nav>

        <h1 class="logo"><a href="<?php echo URL_BASE?>">Bienes Acapulco</a></h1>
        <!-- ========= FILTER  ========== -->
        <div class="contenedor__filtro container">
            <form action="<?= URL_BASE ?>" class="form__filtro" method="GET">
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
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

        </div>
    </header>
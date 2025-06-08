<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ========= FONTAWESOME 5  ========== -->
    <script src="https://kit.fontawesome.com/bc87e91a0d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <title>Bienes Acapulco - Admin</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
</head>
<body>
  <div class="admin-container">
    
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Administrador</h2>
      <nav>
        <ul>
          <li><a href="<?=URL_BASE?>?controller=panel&action=dashboard">Dashboard</a></li>
          <li><a href="<?=URL_BASE?>?controller=panel&action=showcreate">Crear publicación</a></li>
          <li><a href="<?=URL_BASE?>?controller=panel&action=configuration">Configuración</a></li>
          <li><a href="<?=URL_BASE?>?controller=panel&action=logout">Salir</a></li>
        </ul>
      </nav>
    </aside>
    <!-- Contenido principal -->
    <main class="admin-main-content">
      <button class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </button>

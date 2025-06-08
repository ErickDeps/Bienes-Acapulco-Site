<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fcf216840a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <title>BienesAcapulco</title>
    <!-- ========= FAVICON  ========== -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <!-- ========= STYLES CSS  ========== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- ========= FONTAWESOME 5  ========== -->
    <script src="https://kit.fontawesome.com/bc87e91a0d.js" crossorigin="anonymous"></script>
    
</head>
<body>
    
    <div class="login__container container">
        <div class="login__content">
            <h2>Bienes Acapulco</h2>
            <h3>Iniciar sesión</h3>
            <form method="POST" action="?controller=session&action=login">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <?php if (isset($error)) : ?>
                    <div class="error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <button type="submit">Entrar</button>
            </form>
            <div class="register-link">
                ¿No tienes cuenta? <a href="?controller=session&action=showRegister">Regístrate aquí</a>
            </div>
        </div>
    </div>

</body>
</html>
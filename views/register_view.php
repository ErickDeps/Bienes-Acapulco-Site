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
            <h3>Registrarse</h3>
            <form method="POST" action="?controller=session&action=register">
                <input type="text" name="nombre" placeholder="Nombre" value="<?= isset($nombre) ? htmlspecialchars($nombre) : '' ?>">
                <input type="text" name="usuario" placeholder="Usuario" value="<?= isset($usuario) ? htmlspecialchars($usuario) : '' ?>">
                <input type="email" name="email" placeholder="Correo" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                <input type="password" name="password" placeholder="Contraseña">
                <input type="password" class="input" name="password2" id="password2" placeholder="Repite la contraseña">
                <div class="form-group">
                    <input type="checkbox" name="terminos" id="terminos" value="si" <?= (isset($terminos) && $terminos === 'si') ? 'checked' : '' ?>>
                    <label for="terminos" class="lbTerminos">Aceptar Términos y Condiciones</label>
                </div>
                <?php if (isset($error)) : ?>
                    <div class="error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <?php if (isset($success)) : ?>
                    <div class="success" id="msg-success"><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>
                <button type="submit">Entrar</button>
            </form>
            <div class="register-link">
                ¿Ya tienes cuenta? <a href="?controller=session&action=showlogin">Inicia sesión aquí</a>
            </div>
        </div>
    </div>
    <script src="<?= URL_BASE?>/assets/js/login.js" defer></script>
</body>
</html>
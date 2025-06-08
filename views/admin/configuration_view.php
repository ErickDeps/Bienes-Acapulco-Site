<?php require_once 'views/admin/aside_view.php' ?>

      <header>
        <h1>Configuration de cuenta</h1>
      </header>
    <div class="config-wrapper">
      <form action="<?= URL_BASE?>?controller=panel&action=actualizarUsuario" method="POST" class="config-form">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?= ucfirst(htmlspecialchars($datosUsuario['nombre']))?>">

        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($datosUsuario['usuario'])?>">
        
        <label for="email">Correo</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($datosUsuario['email'])?>">

        <label for="contrasena">Nueva Contraseña</label>
        <input type="password" id="contrasena" name="nueva_password">

        <label for="contrasena">Contraseña actual</label>
        <input type="password" id="contrasena" name="password_actual">

        <button type="submit" class="btn-guardar">Guardar</button>
      </form>

      <div class="config-delete">
        <h2>Eliminar cuenta</h2>
        <p>Una vez que elimines tu cuenta, no podrás recuperarla.</p>
        <form action="<?= htmlspecialchars(URL_BASE)?>?controller=panel&action=eliminarcuenta" method="POST" class="form__delete-account">
          <label for="contrasena">Contraseña</label>
          <input type="password" id="contrasena" name="password_confirm">
          <button type="submit" class="btn-eliminar">Eliminar cuenta</button>
        </form>
      </div>
  </div>



  </main>

<?php require_once 'views/admin/footer_view.php' ?>
<?php require_once 'views/admin/aside_view.php' ?>

    
      <header>
        <h1>Dashboard</h1>
      </header>
      <section>
        <h3>Bienvenido <?= htmlspecialchars($usuarioActivo);?></h3>
        <?php if(!$propiedades): ?>
            <div class="contenedor__sin-propiedades-admin">
                <h3 class="alerta">No hay propiedades</h3>
            </div>
        <?php else: ?>
        <table class="tabla-propiedades">
          <thead>
            <tr>
              <th>#</th>
              <th>Propiedad</th>
              <th>Vistas</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <!-- Filas -->
             <?php foreach($propiedades as $index => $propiedad): ?>
            <tr>
              <td><?= htmlspecialchars($index + 1)?></td>
              <td><?= htmlspecialchars($propiedad['titulo']);?></td>
              <td class="td-vistas">
                  <?= htmlspecialchars($propiedad['visitas'])?>
              </td>
              <td class="td-estado">
                  <?= htmlspecialchars($propiedad['estado'])?>
              </td>
              <td class="td-acciones">
                  <a target="_blank" href="<?= URL_BASE?>?controller=inmueble&action=obtenerInmueblePorId&id=<?= htmlspecialchars($propiedad['id']);?>" class="accion-link"><i class="fa-regular fa-eye accion-icon"></i> Ver</a>
                  <a href="<?= URL_BASE?>?controller=panel&action=eliminarpropiedad&id=<?= htmlspecialchars($propiedad['id']);?>" class="accion-link"><i class="fa-solid fa-trash accion-icon"></i> Borrar</a>
              </td>
            </tr>
            <?php endforeach; ?>            
          </tbody>
        </table>
        <?php endif; ?>
      </section>
    </main>

<?php require_once 'views/admin/footer_view.php' ?>
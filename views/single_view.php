<?php require_once 'header_view.php'; ?>

  <main class="single__container">
    
    <section class="single__info">
        <div class="single__gallery"> 
            <?php foreach ($imagenes as $index => $imagen): ?>
              <?php if($index <= 2): ?>
                <img src="<?= URL_BASE?>assets/uploads/<?php echo $imagen['imagenes']; ?>" data-index="<?php echo $index; ?>" class=" gallery-thumb <?php echo $index === 0 ? 'large' : ''; ?> <?php echo $index === 2 ? 'gallery-thumb' : ''; ?>">
              <?php endif; ?>
            <?php endforeach; ?>
            <i class="fa-solid fa-camera gallery-icon"></i>
        </div>
        <section class="single__data">
          <h2><?= $inmueble['titulo']; ?></h2>
          <p class="precio">$<?= number_format($inmueble['precio']); ?> MXN</p>
          <p class="ubicacion"><i class="fa-solid fa-location-dot"></i> <?= $inmueble['ubicacion']; ?></p>
          <ul class="single__detalles">
            <li><i class="fa-solid fa-bed"></i> Recamaras: <?= $inmueble['recamaras']; ?></li>
            <li><i class="fa-solid fa-bath"></i> Baños: <?= $inmueble['banios']; ?></li>
            <li><i class="fa-solid fa-car"></i> Estacionamiento: <?= $inmueble['garage']; ?></li>
          </ul>
          <div class="single__descripcion">
            <h3>Detalles</h3>
            <p>
              <?= nl2br($inmueble['descripcion']); ?> 
            </p>
          </div>
        </section>

    <!-- ========= MODAL IMAGENES  ========== -->

      <div id="gallery-modal" class="modal hidden">
        <span class="close">&times;</span>
        <img id="modal-image">
        <div class="modal-controls">
            <button id="prev" class="prev"><i class="fa-solid fa-angle-left"></i></button>
            <button id="next" class="next"><i class="fa-solid fa-angle-right"></i></button>
        </div>
      </div>

    </section>

    <!-- ========= FORMULARIO CONTACTO  ========== -->
    <section class="single__contacto">
        <div class="contact-box">
            <h2>Contacta al anunciante</h2>
            <form action="<?= URL_BASE?>?controller=inmueble&action=contactarAnunciante&id=<?= $inmueble['id']?>" method="post">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" required> 

            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Teléfono</label>
            <input type="tel" id="phone" name="phone">

            <label for="message">Mensaje</label>
            <textarea id="message" name="message" rows="4">Estoy interesado en la propiedad. ¿Podría brindarme más información?</textarea>

            <label class="checkbox-label">
                <input type="checkbox" id="whatsapp" name="whatsapp">
                Quiero que me contacten por WhatsApp
            </label>

            <button type="submit">Enviar mensaje</button>
            </form>

            <div class="extras">
            <a href="tel:+52<?= htmlspecialchars($inmueble['telefono']) ?>">📞 Llamar al anunciante</a>
            <a href="https://wa.me/52<?= htmlspecialchars($inmueble['telefono']) ?>?text=Hola%2C%20estoy%20interesado%20en%20la%20propiedad" target="_blank">💬 Contactar por WhatsApp</a>
            </div>

            <p class="small-text">Al enviar este mensaje, aceptas nuestra <a href="#">política de privacidad</a>.</p>
        </div>

    </section>

  </main>

  <?php require_once 'footer_view.php'; ?>
<?php require_once 'views/admin/aside_view.php' ?>


      <header>
        <h1>Publicar nueva propiedad</h1>
      </header>
      <section>
        <form action="<?=URL_BASE?>?controller=panel&action=publicarPropiedad" method="post" enctype="multipart/form-data" class="form__publicar-propiedad" id="formPublicar">
            <div class="group-left">
              <!-- CATEGORIA -->
              <div class="form-group">
                  <select name="categoria" id="categoria" class="categoria">
                      <option value="" disabled selected>Categoria</option>
                      <option value="Venta">Venta</option>
                      <option value="Renta">Renta</option>
                  </select>
              </div>
              <!-- TITULO -->
              <div class="form-group">
                  <input type="text" name="titulo" id="titulo" placeholder="Título">
              </div>
              <!-- PRECIO -->
              <div class="form-group">
                  <input type="number" name="precio" id="precio" placeholder="Precio">
              </div>
              <!-- UBICACION -->
              <div class="form-group">
                  <input type="text" name="ubicacion" id="ubicacion" placeholder="Ubicación">
              </div>
              <!-- DESCRIPCION -->
              <div class="form-group">
                  <textarea name="descripcion" id="descripcion" placeholder="Descripción"></textarea>
              </div>
            </div>
            <div class="group-right">
              <!-- RECAMARAS -->
              <div class="form-group">
                  <input type="number" name="recamaras" id="recamaras" placeholder="Número de Recámaras">
              </div>
              <!-- BAÑOS -->
              <div class="form-group">
                  <input type="number" name="banios" id="banios" placeholder="Número de Baños">
              </div>
              <!-- GARAGE -->
              <div class="form-group">
                  <select name="garage" id="garage">
                      <option value="">Estacionamiento</option>
                      <option value="si">Si</option>
                      <option value="no">No</option>
                  </select>
              </div>
              <!-- TELEFONO -->
              <div class="form-group">
                  <input type="text" name="telefono" id="telefono" placeholder="Teléfono de Contacto">
              </div>
              <!-- PERIODO -->
              <div class="form-group">
                  <select name="periodo" id="periodo" class="periodo">
                      <option value="" disabled selected>Periodo</option>
                      <option value="/ Noche">Por noche</option>
                      <option value="/ Mes">Por mes</option>
                  </select>
              </div>
            </div>
            <div class="group__button-file">
              <!-- FILES -->
              <div class="form-group">
                <input type="file" name="imagenes[]" id="file-input" value="Elegir Imágenes" multiple accept="image/*">
              </div>
              <!-- SUBMIT -->
              <button type="submit" class="btn-publicar">Publicar</button>
            </div>
          </form>
      </section>
    </main>

<?php require_once 'views/admin/footer_view.php' ?>
const formPublicar = document.getElementById('formPublicar');
const titulo = document.getElementById('titulo');
const precio = document.getElementById('precio');
const ubicacion = document.getElementById('ubicacion');
const descripcion = document.getElementById('descripcion');
const recamaras = document.getElementById('recamaras');
const banios = document.getElementById('banios');
const fileImagenes = document.getElementById('file-input');

formPublicar.addEventListener('submit', (e) => {
  if (
    categoria.value !== '' &&
    titulo.value.trim() !== '' &&
    precio.value.trim() !== '' &&
    ubicacion.value.trim() !== '' &&
    descripcion.value.trim() !== '' &&
    recamaras.value.trim() !== '' &&
    banios.value.trim() !== '' &&
    garage.value !== '' &&
    telefono.value.trim() !== '' &&
    fileImagenes.files.length > 0 &&
    (categoria.value !== 'Renta' || periodo.value !== '')
  ) {
    // todo está bien
  } else {
    e.preventDefault();
    alert('Por favor rellena todos los campos');
  }
});


categoria.addEventListener('change', () => {
    if (categoria.value == 'Renta') {
        periodo.classList.add('show');
        periodo.required = true;
    } else {
        periodo.classList.remove('show');
        periodo.required = false;
    }
});






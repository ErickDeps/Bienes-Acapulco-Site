// ====================> SLIDES DE INICIO <====================

document.querySelectorAll('.thumb').forEach(thumb => {
    const swiperContainer = thumb.querySelector('.mySwiper');
    const nextBtn = thumb.querySelector('.swiper-button-next');
    const prevBtn = thumb.querySelector('.swiper-button-prev');
    const pagination = thumb.querySelector('.swiper-pagination');
  
    const swiper = new Swiper(swiperContainer, {
      loop: true,
      navigation: {
        nextEl: nextBtn,
        prevEl: prevBtn,
      },
      // pagination: {
        // el: pagination,
        // clickable: true,
        // dynamicBullets: true,
        // dynamicMainBullets: true,
      // },
    });
  
    // Mostrar botones al pasar el mouse
    thumb.addEventListener('mouseover', () => {
      nextBtn.classList.add('show-buttons-slides');
      prevBtn.classList.add('show-buttons-slides');
    });
  
    thumb.addEventListener('mouseout', () => {
      nextBtn.classList.remove('show-buttons-slides');
      prevBtn.classList.remove('show-buttons-slides');
    });
  });

// ====================> MENU-LATERAL-RESPONSIVO <====================

  // ====================> MENU-LATERAL-RESPONSIVO <====================

const overlayMenu = document.querySelector('.overlay__menu');
const btnAbrir = document.querySelector('.btn__menu-lateral');
const btnCerrar = document.querySelector('.btn__cerrar-menu');
const menuLinks = document.querySelectorAll('.menu__link');

// Abrir menú
btnAbrir.addEventListener('click', () => {
    overlayMenu.style.display = 'block';
});

// Cerrar menú al presionar botón cerrar
btnCerrar.addEventListener('click', () => {
    overlayMenu.style.display = 'none';
});

// Cerrar menú al hacer clic en cualquier enlace
menuLinks.forEach(link => {
    link.addEventListener('click', () => {
        overlayMenu.style.display = 'none';
    });
});

// Cerrar menú al presionar tecla Esc
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        overlayMenu.style.display = 'none';
    }
});

// (Opcional) Cerrar al hacer clic fuera del menú
overlayMenu.addEventListener('click', (e) => {
    if (
        !e.target.closest('.contenedor__menu') &&
        !e.target.closest('.contenedor__filtro')
    ) {
        overlayMenu.style.display = 'none';
    }
});



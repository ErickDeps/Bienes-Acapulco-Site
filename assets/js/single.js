// ====================> GALERIA DE IMAGENES <====================
const modal = document.getElementById('gallery-modal');
const modalImage = document.getElementById('modal-image');
const closeBtn = document.querySelector('.close');
const nextBtn = document.getElementById('next');
const prevBtn = document.getElementById('prev');

let currentIndex = 0;

document.querySelectorAll('.gallery-thumb').forEach(img => {
    img.addEventListener('click', e => {
        currentIndex = parseInt(e.target.dataset.index);
        showImage(currentIndex);
        console.log(currentIndex);
        modal.classList.remove('hidden');
    });
});


closeBtn.onclick = () => modal.classList.add('hidden');

nextBtn.onclick = () => {
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
};

prevBtn.onclick = () => {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    showImage(currentIndex);
};
console.log(images[0].imagenes);
function showImage(index) {
    modalImage.src = 'assets/uploads/' + images[index].imagenes;
}

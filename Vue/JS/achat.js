let currentIndex = 0; // Indice de l'image actuellement affichée
const images = document.querySelectorAll('.carousel-image'); // Sélectionne toutes les images du carrousel

// Fonction pour changer l'image
function changeImage(direction) {
    // Enlève la classe 'active' de l'image actuelle
    images[currentIndex].classList.remove('active');

    // Change l'index selon la direction (1 ou -1)
    currentIndex = (currentIndex + direction + images.length) % images.length;

    // Ajoute la classe 'active' à la nouvelle image
    images[currentIndex].classList.add('active');
}

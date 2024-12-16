document.querySelector(".cfg").addEventListener('click', changeImage);
document.querySelector(".cfd").addEventListener('click', changeImage);


function changeImage(e){
    let currentIndex = 0;
    let index = e.target.classList[2] === 'cfd' ? 1 : -1

    const images = document.querySelectorAll('.carousel-image'); //Ensemble des images du carousel
    let ActiveImage = null;
    
    images.forEach(item => {
        if(item.classList.contains('active') === true){
            ActiveImage = item;
        }
        if(ActiveImage === null){
            currentIndex++;
        }
    })

    ActiveImage.classList.remove('active')
    // Change l'index selon la direction (1 ou -1)
    currentIndex = (currentIndex + index + images.length) % images.length;
    // Ajoute la classe 'active' à la nouvelle image
    images[currentIndex].classList.add('active');

}
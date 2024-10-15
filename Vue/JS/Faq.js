window.onscroll = ()=>{
    MovePicture() //FAQ
}

// Fonction simple pour déplacer l'image au scroll
function MovePicture() {
    var scrollPosition = window.scrollY; 
    var image = document.querySelector('.image1');

    // Déplace l'image de façon proportionnelle au scroll
    image.style.top = scrollPosition * 0.6 + 'px'; 

    var scrollPosition = window.scrollY; 
    var image = document.querySelector('.tableau'); 

    // Déplace l'image de façon proportionnelle au scroll
    image.style.top = scrollPosition * 0.4 + 'px'; 


    var scrollPosition = window.scrollY;
    var image = document.querySelector('.tableau2'); 

    // Déplace l'image de façon proportionnelle au scroll
    image.style.top = scrollPosition * 0.4 + 'px'; 
}
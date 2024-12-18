document.addEventListener("DOMContentLoaded", () => {
    const images = document.querySelectorAll('.carousel-image'); // Toutes les images du carrousel
    let currentIndex = 0; // Initialisation de l'index de l'image active

    // Sélectionne les flèches gauche et droite
    const flecheGauche = document.querySelector(".cfg");
    const flecheDroite = document.querySelector(".cfd");

    // Initialiser currentIndex pour trouver l'image active actuelle
    images.forEach((img, index) => {
        if (img.classList.contains('active')) {
            currentIndex = index;
        }
    });

    // Écouteurs d'événements pour les flèches
    flecheGauche.addEventListener('click', () => changeImage(-1));
    flecheDroite.addEventListener('click', () => changeImage(1));

    function changeImage(direction) {
        // Retirer la classe active de l'image actuelle
        images[currentIndex].classList.remove('active');

        // Mettre à jour l'index en fonction de la direction (gauche ou droite)
        currentIndex = (currentIndex + direction + images.length) % images.length;

        // Ajouter la classe active à la nouvelle image
        images[currentIndex].classList.add('active');
    }
});

document.querySelector(".boutton-valider").addEventListener('click', acceptOeuvre);
document.querySelector(".boutton-refuse").addEventListener('click', cancelOeuvre);

async function acceptOeuvre() {
    const responseUser = confirm("Etez-vous sûre de vouloir accepter cette oeuvre ?");
    if (responseUser === true) {
        const id = document.getElementById("id_oeuvre").value;

        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
            "id": id,
            "accept": true
        });

        const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: raw,
            redirect: "follow"
        };
        const response = await fetch("https://galeris/Galeris-APPG1E/statutoeuvre", requestOptions)
        const statuscode = response.status;
        if (statuscode === 200) {
            window.location.href = "https://galeris/Galeris-APPG1E/listeoeuvreattente";
        }
    }
    else {
        return;
    }
}

async function cancelOeuvre() {
    const responseUser = confirm("Etez-vous sûre de vouloir refuser cette oeuvre ?");
    if (responseUser === true) {
        const id = document.getElementById("id_oeuvre").value;

        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
            "id": id,
            "accept": false
        });

        const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: raw,
            redirect: "follow"
        };
        const response = await fetch("https://galeris/Galeris-APPG1E/statutoeuvre", requestOptions)
        const statuscode = response.status;
        if (statuscode === 200) {
            window.location.href = "https://galeris/Galeris-APPG1E/listeoeuvreattente";
        }
    }
    else {
        return;
    }
}
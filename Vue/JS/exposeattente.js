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
        console.log("ok")
        // Retirer la classe active de l'image actuelle
        images[currentIndex].classList.remove('active');

        // Mettre à jour l'index en fonction de la direction (gauche ou droite)
        currentIndex = (currentIndex + direction + images.length) % images.length;

        // Ajouter la classe active à la nouvelle image
        images[currentIndex].classList.add('active');
    }
});

document.querySelector(".boutton-valider").addEventListener('click', acceptExpose);
document.querySelector(".boutton-refuse").addEventListener('click', cancelExpose);

async function acceptExpose() {
    const responseUser = confirm("Etez-vous sûre de vouloir accepter cette exposé ?");
    if (responseUser === true) {
        const id = document.getElementById("id_expose").value;

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
        const response = await fetch("./statutexpose", requestOptions)
        const statuscode = response.status;
        if (statuscode === 200) {
            window.location.href = "./listeexposeattente";
        }
    }
    else {
        return;
    }
}

async function cancelExpose() {
    const responseUser = confirm("Etez-vous sûre de vouloir refuser cette exposé ?");
    if (responseUser === true) {
        const id = document.getElementById("id_expose").value;

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
        const response = await fetch("./statutexpose", requestOptions)
        const statuscode = response.status;
        if (statuscode === 200) {
            window.location.href = "./listeexposeattente";
        }
    }
    else {
        return;
    }
}

var map = L.map('map').setView([48.82, 2.28], 12);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var marker = L.marker([48.82, 2.28]).addTo(map);

L.marker([48.82, 2.28]).addTo(map)
    .bindPopup('<p class="maplocaux">10 Rue de Vanves, 92130 Vanves,<br> France<br><br>Latitude : 48,82 | Longitude : 2.28</p>')
    .openPopup();


document.querySelector(".profil-section").addEventListener('click', saveUserid)

async function saveUserid() {
    const id_utilisateur = document.getElementById("id_utilisateur").value;

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
        "id": id_utilisateur
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("https://galeris/Galeris-APPG1E/saveiduser", requestOptions)
    const statuscode = response.status;
    if (statuscode === 200) {
        window.location.href = "https://galeris/Galeris-APPG1E/utilisateur";
    }
}
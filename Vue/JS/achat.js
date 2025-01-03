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
    const btnFavoris = document.querySelector(".boutton-favoris");
    if(btnFavoris){
        btnFavoris.addEventListener("click", ajoutFavoris);
    }
});

setInterval(tempsRestants, 1000);

document.querySelectorAll(".boutton-retirer-panier").forEach(item => item.addEventListener("click", retirerpanier));
document.querySelectorAll(".boutton-panier").forEach(item => item.addEventListener("click", ajoutpanier));


function tempsRestants() {
    const elements = document.querySelectorAll('.temps-restant');

    elements.forEach(el => {
        const date_fin = new Date(el.dataset.fin);
        const date_actuelle = new Date();

        const temps_restants = date_fin - date_actuelle;
        if (temps_restants > 0) {
            const jours = Math.floor((temps_restants / (1000 * 60 * 60 * 24)));
            const heures = Math.floor((temps_restants % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((temps_restants % (1000 * 60 * 60)) / (1000 * 60));
            const secondes = Math.floor(((temps_restants % (1000 * 60)) / 1000));

            el.textContent = `${jours}j ${heures}h ${minutes}m ${secondes}s restant`;
        } else {
            window.location.href = "https://galeris/Galeris-APPG1E/";
        }
    });
}


async function ajoutpanier(){
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    
    const raw = JSON.stringify({
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const result = await fetch("https://galeris/Galeris-APPG1E/ajoutpanier", requestOptions);
    const statut = result.status;
    const text = await result.json();
    if(statut === 200){
        alert(text.panier);
        window.location.reload();
   }
}

async function retirerpanier(){
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    
    const raw = JSON.stringify({
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    const result = await fetch("https://galeris/Galeris-APPG1E/retirerpanier", requestOptions);
    const statut = result.status;
    const text = await result.json();
    if(statut === 200){
        alert(text.panier);
        window.location.reload();
   }
}

document.querySelectorAll(".boutton-supprimer").forEach(item => {
    item.addEventListener("click", supprimerOeuvre)
})

async function supprimerOeuvre(){
    const reponse = confirm("Etez-vous sûre de vouloir supprimer cette oeuvre ?");
    if(reponse === true){
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
    
        
        const raw = JSON.stringify({
        });
    
        const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: raw,
            redirect: "follow"
        };
    
        const result = await fetch("https://galeris/Galeris-APPG1E/supprimeroeuvre", requestOptions);
        const statut = result.status;
        const text = await result.json();
        
        if(statut === 200){
            alert(text.Success);
            window.location.href = "https://galeris/Galeris-APPG1E/";
        }
    }
}

async function ajoutFavoris(){
    
    const idOeuvre = document.querySelector("#id_oeuvre_<?php echo $oeuvre['id_oeuvre']?>")?.value 
       || "<?php echo $oeuvre['id_oeuvre']?>";

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const rawBody = JSON.stringify({
        "id_oeuvre": idOeuvre
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: rawBody,
        redirect: "follow"
    };

    const response = await fetch("https://galeris/Galeris-APPG1E/favoris", requestOptions);
    const status = response.status;
    const data = await response.json();

    if(status === 200){
        alert(data.message);
        
    } else {
        alert(data.error || "Une erreur s'est produite.");
    }
}
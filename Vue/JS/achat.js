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
            window.location.href = "./";
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
    const result = await fetch("./ajoutpanier", requestOptions);
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

    const result = await fetch("./retirerpanier", requestOptions);
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
    
        const result = await fetch("./supprimeroeuvre", requestOptions);
        const statut = result.status;
        const text = await result.json();
        
        if(statut === 200){
            alert(text.Success);
            window.location.href = "./";
        }
    }
}


document.getElementById("btnSignaleropenform").addEventListener("click", openFormSignaler)

async function openFormSignaler() {
    document.querySelector(".signaler-form").style.display = "block";
}

document.getElementById("btnSignaler").addEventListener("click", signaler)

async function signaler() {
    document.getElementById("btnSignaler").disabled = true;
    const raison = document.querySelector(".input-signalement").value;

    if (raison.length < 25) {
        alert("La raison de votre signalement doit contenir plus que 25 carctères.");
        return;
    }


    const resp = await fetch("./signaleroeuvre", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ raison: raison })
    });
    const data = await resp.json();
    if (resp.status === 200) {
        alert(data.Success);
        signalercloseForm()
        document.getElementById("btnSignaler").disabled = false;
    } else {
        alert(data.Error);
    }
}

document.querySelector(".signaler-close-button").addEventListener("click", signalercloseForm);

function closeForm() {
    document.querySelector(".enchere-form").style.display = "none";
    document.querySelector(".input-enchere").value = "";
    document.querySelector(".input-enchere").min = "";
}

function signalercloseForm() {
    document.querySelector(".signaler-form").style.display = "none";
    document.querySelector(".input-signalement").value = "";
}
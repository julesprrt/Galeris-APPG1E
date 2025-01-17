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


document.querySelectorAll(".boutton-offre").forEach(item => {
    item.addEventListener('click', verifyEnchere);
})

async function verifyEnchere() {
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
    const response = await fetch("./verifyenchere")
    const statuscode = response.status;
    const result = await response.json();

    if (statuscode === 200) {
        const validation = confirm(result.Success);
        if (validation) {
            document.querySelector(".enchere-form").style.display = "block";
            document.querySelector(".input-enchere").value = result.prix;
            document.querySelector(".input-enchere").min = result.prix;
        }
        else {
            alert("Vous pouvez modifier vos données de livraison sur la page livraison");
            window.location.href = "./livraison";
        }
    }
    else if (statuscode === 401) {
        alert(result.Error);
        window.location.href = "./livraison";
    }
}

document.querySelector(".input-enchere").addEventListener('input', changeInput);

function changeInput(e) {
    if (isNaN(parseFloat(e.target.value)) || parseFloat(e.target.value) < parseFloat(e.target.min)) {
        document.querySelector(".error").innerHTML = "Le prix ne doit pas être inférieur à " + e.target.min + " €";
    }
    else {
        document.querySelector(".error").innerHTML = "";
    }
}

document.querySelector(".close-button").addEventListener("click", closeForm);

function closeForm() {
    document.querySelector(".enchere-form").style.display = "none";
    document.querySelector(".input-enchere").value = "";
    document.querySelector(".input-enchere").min = "";
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

document.querySelector(".enchere-button").addEventListener("click", encherir);

async function encherir() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    const prix = document.querySelector(".input-enchere").value;
    const prixMin = document.querySelector(".input-enchere").min;

    if (isNaN(parseFloat(prix)) || parseFloat(prix) < parseFloat(prixMin)) {
        alert("Le prix ne doit pas être inférieur à " + prixMin + " €")
        return;
    }

    const raw = JSON.stringify({
        "prix": prix
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("./encherir", requestOptions)
    const statuscode = response.status;
    const result = await response.json();

    if (statuscode === 200) {
        console.log(result.payment.url)
        window.location.href = result.payment.url;
    }
    else if (statuscode === 401) {
        alert(result.Error);
        document.querySelector(".input-enchere").value = result.prix;
        document.querySelector(".input-enchere").min = result.prix;
    }
}

document.querySelectorAll(".boutton-supprimer").forEach(item => {
    item.addEventListener("click", supprimerOeuvre)
})

async function supprimerOeuvre() {
    const reponse = confirm("Êtes-vous sûre de vouloir supprimer cette œuvre ?");
    if (reponse === true) {
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

        if (statut === 200) {
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
        alert("La raison de votre signalement doit contenir plus de 25 caractères.");
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

document.querySelectorAll(".boutton-favoris").forEach(item => {
    item.addEventListener("click", ajoutfavoris);
});

document.querySelectorAll(".boutton-retirer-favoris").forEach(item => item.addEventListener("click", retirerfavoris));

async function ajoutfavoris(){
    console.log("ok")
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
    const result = await fetch("./ajoutfavoris", requestOptions);
    const statut = result.status;
    const text = await result.json();
    if(statut === 200){
        alert(text.favoris);
        window.location.reload();
   }
}

async function retirerfavoris(){
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

    const result = await fetch("./retirerfavoris", requestOptions);
    const statut = result.status;
    const text = await result.json();
    if(statut === 200){
        alert(text.favoris);
        window.location.reload();
   }
}



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
    const response = await fetch("./saveiduser", requestOptions)
    const statuscode = response.status;
    if (statuscode === 200) {
        window.location.href = "./utilisateur";
    }
}
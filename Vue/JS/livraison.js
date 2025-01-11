document.querySelectorAll(".btn-valider").forEach(element => {
    element.addEventListener("click", encherirCase)
});

async function encherirCase(){
    const nom = document.getElementById("nom").value;
    const prenom = document.getElementById("prenom").value;
    const pays = document.getElementById("pays").value;
    const adresse = document.getElementById("adresse").value;
    const postale = document.getElementById("codepostale").value;
    const ville = document.getElementById("ville").value;

    if(nom === "" || prenom === "" || pays === "" || adresse === "" || postale === "" || ville === ""){
        alert("Veuillez remplir l'ensemble des champs du formulaire");
    }

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    
    const raw = JSON.stringify({
        "nom" : nom,
        "prenom" : prenom,
        "pays" : pays,
        "adresse" : adresse,
        "postale" : postale,
        "ville" : ville
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    const result = await fetch("./validerlivraison", requestOptions);
    const statut = result.status;
    const text = await result.json();
    
    if(statut === 200){
        alert(text.Success);
        window.location.href = "./achat";
    }
    else{
        alert(text.Error);
    }
}

document.querySelectorAll(".btn-paiement").forEach((item)=> {
    item.addEventListener("click", venteCase)
})

async function venteCase(){
    const nom = document.getElementById("nom").value;
    const prenom = document.getElementById("prenom").value;
    const pays = document.getElementById("pays").value;
    const adresse = document.getElementById("adresse").value;
    const postale = document.getElementById("codepostale").value;
    const ville = document.getElementById("ville").value;

    if(nom === "" || prenom === "" || pays === "" || adresse === "" || postale === "" || ville === ""){
        alert("Veuillez remplir l'ensemble des champs du formulaire");
    }

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    
    const raw = JSON.stringify({
        "nom" : nom,
        "prenom" : prenom,
        "pays" : pays,
        "adresse" : adresse,
        "postale" : postale,
        "ville" : ville
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    const result = await fetch("./validerlivraison", requestOptions);
    const statut = result.status;
    const text = await result.json();
    
    if(statut === 200){
        alert(text.Success);
        await payer()
    }
    else{
        alert(text.Error);
    }
}

async function payer() {
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

    const result = await fetch("./paiement", requestOptions);
    const statut = result.status;
    const text = await result.json();
    if(statut === 200){
        window.location.href = text.payment;
   }
}

document.querySelectorAll(".btn-profil").forEach(item => {
    item.addEventListener("click", saveLivraisonProfil);
})

async function saveLivraisonProfil(){
    const nom = document.getElementById("nom").value;
    const prenom = document.getElementById("prenom").value;
    const pays = document.getElementById("pays").value;
    const adresse = document.getElementById("adresse").value;
    const postale = document.getElementById("codepostale").value;
    const ville = document.getElementById("ville").value;

    if(nom === "" || prenom === "" || pays === "" || adresse === "" || postale === "" || ville === ""){
        alert("Veuillez remplir l'ensemble des champs du formulaire");
    }

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    
    const raw = JSON.stringify({
        "nom" : nom,
        "prenom" : prenom,
        "pays" : pays,
        "adresse" : adresse,
        "postale" : postale,
        "ville" : ville
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    const result = await fetch("./validerlivraison", requestOptions);
    const statut = result.status;
    const text = await result.json();
    
    if(statut === 200){
        alert(text.Success);
        window.location.href = "./profil";
    }
    else{
        alert(text.Error);
    }
}
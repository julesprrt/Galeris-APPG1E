document.getElementById("upload").addEventListener("change", onFileSelected)
document.querySelector(".btn-vente").addEventListener("click", verificateAndSaveData)

function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();

    var imgtag = document.querySelectorAll(".myimage");
    var stop = false;
    imgtag.forEach(item => {
        if (item.title === "" && stop === false) {
            item.style.cursor = "pointer";
            item.title = "Supprimer l'image ?"
            reader.onload = function (event) {
                item.src = event.target.result;
            };
            item.addEventListener('click', eventOeuvre, item)
            reader.readAsDataURL(selectedFile);
            stop = true;
        }
    })
}

function eventOeuvre(event) {
    var result = confirm("Etez-vous sûre de vouloir supprimer votre image ?");
    if (result) {
        event.currentTarget.removeAttribute("src");
        event.currentTarget.removeAttribute("title");
        event.currentTarget.removeAttribute("style");
        event.currentTarget.removeEventListener("click", eventOeuvre);
    }
}


async function verificateAndSaveData() {
    const titre = document.getElementsByName("titre")[0].value;
    const categorie = document.getElementsByName("categorie")[0].value;
    const type = document.getElementsByName("vente")[0].value;
    const prix = document.getElementsByName("prix")[0].value;
    const nbJours = document.getElementsByName("nbjours")[0].value;
    const auteur = document.getElementsByName("auteur")[0].value;
    const description = document.getElementsByName("description")[0].value;

    let options = document.querySelectorAll("#categorie-selec option");
    let categorieId;
    options.forEach(item => {
        if (categorie === item.value) {
            categorieId = item.id;
        }
    })


    const image1 = document.getElementById("image1").attributes[5] === undefined ? "" : document.getElementById("image1").attributes[5].value;
    const image2 = document.getElementById("image2").attributes[5] === undefined ? "" : document.getElementById("image2").attributes[5].value;
    const image3 = document.getElementById("image3").attributes[5] === undefined ? "" : document.getElementById("image3").attributes[5].value;

    if (verificationData(titre, categorie, type, prix, nbJours) === false) {
        return;
    }

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
        "titre": titre,
        "type": type,
        "prix": prix,
        "nbJours": nbJours,
        "auteurs": auteur,
        "categorie": categorieId,
        "description": description,
        "image1": image1,
        "image2": image2,
        "image3": image3
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("https://galeris/Galeris-APPG1E/createvente", requestOptions)
    const statuscode = response.status;
    const result = await response.json();

    if (statuscode === 200) {
        alert(result.Success)
        document.querySelectorAll('.input-vente').forEach((item) => {
            item.value = "";
        });
        var imgtag = document.querySelectorAll(".myimage");

        imgtag.forEach(item => {
            item.src = "";
            item.title = "";
        })
    }
    else {
        alert(result.Error);
    }
}

function verificationData(titre, categorie, type, prix, nbJours) {
    if (titre === "") {
        alert("Le titre est obligatoire");
        return false;
    }

    if (categorie === "") {
        alert("La catégorie de l'oeuvre est obligatoire");
        return false;
    }

    if (type === "") {
        alert("Le type de vente est obligatoire");
        return false;
    }

    if (prix === "") {
        alert("Le prix est obligatoire");
        return false;
    }

    if (nbJours === "" || Number(nbJours) > 30) {
        alert("Le nombre de jours est obligatoire et doit être inférieur ou égal à 30 jours");
        return false;
    }
}
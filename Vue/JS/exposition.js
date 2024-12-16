document.querySelector('.btn-exposition').addEventListener('click', exposition);
document.getElementById("upload").addEventListener("change", onFileSelected)

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
            item.addEventListener('click',eventExpo, item)
            reader.readAsDataURL(selectedFile);
            stop = true;
        }
    })
}

function eventExpo(event) {
    var result = confirm("Etez-vous sûre de vouloir supprimer votre image ?");
    if (result) {
        event.currentTarget.removeAttribute("src");
        event.currentTarget.removeAttribute("title");
        event.currentTarget.removeAttribute("style");
        event.currentTarget.removeEventListener("click", eventExpo);
    }
}

async function exposition() {
    const title = document.getElementById('title').value;
    const date_debut = document.getElementById('date_debut').value;
    const date_fin = document.getElementById('date_fin').value;
    const description = document.getElementById('description').value.trim();

    const image1 = document.getElementById("image1").attributes[4] === undefined ? "" : document.getElementById("image1").attributes[4].value;
    const image2 = document.getElementById("image2").attributes[4] === undefined ? "" : document.getElementById("image2").attributes[4].value;
    const image3 = document.getElementById("image3").attributes[4] === undefined ? "" : document.getElementById("image3").attributes[4].value;

    if(verificationData(title,description,image1,date_debut,date_fin) === false){
        return;
    }

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
        "titre": title,
        "date_debut": date_debut,
        "date_fin": date_fin,
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
    const response = await fetch("https://galeris/Galeris-APPG1E/createexposition", requestOptions)
    const statuscode = response.status;
    const result = await response.json();
    if (statuscode === 200) {
        alert(result.Success)
        const expo = document.querySelectorAll(".input-exposition");
        expo.forEach(item => {
            item.value = "";
        })

        var imgtag = document.querySelectorAll(".myimage");

        imgtag.forEach(item => {
            item.src = "";
            item.title = "";
        })
        window.location.href = "https://galeris/Galeris-APPG1E";
    }
    else {
        alert(result.Error);
    }
}

function isDateBeforeToday(date) {
    return new Date() < new Date(date);
}

function verifDate(date_debut, date_fin) {
    return new Date(date_fin) > new Date(date_debut)
}

function verificationData(title, description, image1, date_debut, date_fin){
    if (title.trim() === "" || title.length > 50) {
        alert("Le titre est obligatoire et doit contenir moins de 50 caractères.")
        return false;
    }
    if (description.length < 50) {
        alert("La description est obligatoire et doit contenir plus de 50 caractères.")
        return false;
    }
    if (image1 === "") {
        alert("Vous devez ajouter au moins une image")
        return false;
    }
    if (date_debut === "" || isDateBeforeToday(date_debut) == false) {
        alert("La date de début est requise et doit être ultérieure à la date actuelle.")
        return false;
    }
    if (date_fin === "") {
        alert("La date de fin est requise.")
        return false;
    }
    const diffTime = Math.abs(new Date(date_fin) - new Date(date_debut));
    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
    if (diffDays > 14) {
        alert("La durée maximale est de deux semaines.")
        return false;
    }
    if (verifDate(date_debut, date_fin) === false) {
        alert("La date de fin doit être supérieure à la date de début.")
        return false;
    }
}
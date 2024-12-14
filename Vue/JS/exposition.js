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
            item.addEventListener('click', () => {
                var result = confirm("Etez-vous sûre de vouloir supprimer votre image ?");
                if (result) {
                    item.src = "";
                    item.title = "";
                }
            })
            reader.readAsDataURL(selectedFile);
            stop = true;
        }
    })
}


async function exposition() {
    const title = document.getElementById('title').value;
    const date_debut = document.getElementById('date_debut').value;
    const date_fin = document.getElementById('date_fin').value;
    const description = document.getElementById('description').value;
    
    const image1 = document.getElementById("image1").attributes[5] === undefined ? "" : document.getElementById("image1").attributes[5].value;
    const image2 = document.getElementById("image2").attributes[5] === undefined ? "" : document.getElementById("image2").attributes[5].value;
    const image3 = document.getElementById("image3").attributes[5] === undefined ? "" : document.getElementById("image3").attributes[5].value;

    if (title.trim() === "" || title.length > 50) {
        alert("Le titre est obligatoire et doit contenir moins de 50 caractères.")
        return;
    }
    if (date_debut === "" || isDateBeforeToday(date_debut) == false) {
        alert("La date de début est requise et doit être ultérieure à la date actuelle.")
        return;
    }
    if (date_fin === "") {
        alert("La date de fin est requise.")
        return;
    }
    const diffTime = Math.abs(new Date(date_fin) - new Date(date_debut));
    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
    if (diffDays > 14) {
        alert("La durée maximale est de deux semaines.")
        return;
    }
    if (verifDate(date_debut, date_fin) === false) {
        alert("La date de fin doit être supérieure à la date de début.")
        return;
    }
    console.log(diffDays)

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
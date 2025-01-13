document.getElementById("upload").addEventListener("change", onFileSelected)

function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();
    
    if(!selectedFile.type.includes("image")){
        alert("Type de fichier autorisé : image");
        return;
    }

    if(selectedFile.size >= 1000000){
        alert("Fichier trop lourd, 1 MB maximum");
        return;
    }

    var imgtag = document.querySelectorAll(".myimage");
    var stop = false;
    imgtag.forEach(item => {
        if (item.title === "" && stop === false) {
            item.style.cursor = "pointer";
            item.title = "Supprimer l'image ?"
            reader.onload = function (event) {
                item.src = event.target.result;
            };
            item.addEventListener('click',eventNews, item)
            reader.readAsDataURL(selectedFile);
            stop = true;
        }
    })
}

function eventNews(event) {
    var result = confirm("Etez-vous sûre de vouloir supprimer votre image ?");
    if (result) {
        event.currentTarget.removeAttribute("src");
        event.currentTarget.removeAttribute("title");
        event.currentTarget.removeAttribute("style");
        event.currentTarget.removeEventListener("click", eventNews);
    }
}

document.querySelector(".btn-news").addEventListener('click', news);

async function news() {
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value.trim();

    console.log(document.getElementById("image1").attributes)

    const image1 = document.getElementById("image1").attributes[3] === undefined ? "" : document.getElementById("image1").attributes[3].value;
    const image2 = document.getElementById("image2").attributes[3] === undefined ? "" : document.getElementById("image2").attributes[3].value;
    const image3 = document.getElementById("image3").attributes[3] === undefined ? "" : document.getElementById("image3").attributes[3].value;

    if(verificationData(title,description,image1) === false){
        return;
    }

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
        "titre": title,
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
    const response = await fetch("./createnews", requestOptions)
    const statuscode = response.status;
    const result = await response.json();
    if (statuscode === 200) {
        alert(result.Success)
        const expo = document.querySelectorAll(".input-news");
        expo.forEach(item => {
            item.value = "";
        })

        var imgtag = document.querySelectorAll(".myimage");

        imgtag.forEach(item => {
            item.src = "";
            item.title = "";
        })
        window.location.href = "./";
    }
    else {
        alert(result.Error);
    }
}

function verificationData(title, description, image1){
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
}
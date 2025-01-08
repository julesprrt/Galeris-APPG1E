const cbox = document.querySelectorAll(".oeuvreOBJ");

for (let i = 0; i < cbox.length; i++) {
    cbox[i].addEventListener("click", saveId);
}

async function saveId(event) {
    const divParent = event.currentTarget.querySelector(".oeuvre");
    const inputCache = divParent.querySelector("input[type='hidden']");

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
        "id": inputCache.value
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("https://galeris/Galeris-APPG1E/saveidhistorique", requestOptions)
    const statuscode = response.status;
    const text = await response.json();
    if (statuscode === 200) {
        let datefin = new Date(text.datefin);
        let today = new Date();
        console.log(today)
        if(text.estVendu === 0 && datefin.getTime() > today.getTime()){
            window.location.href = "https://galeris/Galeris-APPG1E/achat";
        }
        else{
            console.log("nok")
            //autre page dedié historique seulement
        }
    }
}


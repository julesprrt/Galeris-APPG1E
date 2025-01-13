
const cbox = document.querySelectorAll(".oeuvreOBJ");

setInterval(tempsRestants, 1000);


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
    const response = await fetch("https://galeris/Galeris-APPG1E/saveid", requestOptions)
    const statuscode = response.status;
    if (statuscode === 200) {
       window.location.href = "https://galeris/Galeris-APPG1E/achat";
    }
}

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
            el.parentNode.style.display = 'none';
        }
        
    }
    );
};



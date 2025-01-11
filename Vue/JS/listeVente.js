const sliderPrice = document.getElementById("slider-price").addEventListener("input", AffichageOeuvre)
const cbox = document.querySelectorAll(".oeuvreOBJ");
document.querySelectorAll(".check-categ").forEach(item => {
    item.addEventListener('change', AffichageOeuvre);
})

document.querySelectorAll(".check-vente").forEach(item => {
    item.addEventListener('change', AffichageOeuvre);
})

document.getElementById("titre-oeuvre").addEventListener("input", AffichageOeuvre);
document.getElementById("auteur-oeuvre").addEventListener("input", AffichageOeuvre);

setInterval(tempsRestants, 1000);

document.getElementById("reinit").addEventListener("click", reinit);
document.getElementById("tri-select").addEventListener("change", tri)

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
        reinit();
        window.location.href = "./achat";
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
    });
}

function AffichageOeuvre() {
    document.querySelectorAll(".check-categ").forEach(item => {
            var prixMax = document.getElementById("slider-price").value
            var titre = document.getElementById("titre-oeuvre").value;
            var auteur = document.getElementById("auteur-oeuvre").value;
            document.getElementById('value-slider').innerHTML = "Prix : " + prixMax + " €"
            document.querySelectorAll(".oeuvreOBJ").forEach(itemOeuvre => {
                if (titre.trim() !== "" && !itemOeuvre.attributes[5].value.toLowerCase().includes(titre.toLowerCase()) || Number(itemOeuvre.attributes[3].value) > Number(prixMax) || item.attributes[3].value === itemOeuvre.attributes[2].value && item.checked === false || auteur.trim() !== "" && !itemOeuvre.attributes[6].value.toLowerCase().includes(auteur.toLowerCase())) {
                    itemOeuvre.style.display = "none";
                }
                else if (item.attributes[3].value === itemOeuvre.attributes[2].value && item.checked === true) {
                    if (Number(itemOeuvre.attributes[3].value) <= Number(prixMax)) {
                        itemOeuvre.style.display = "";
                    }
                    if(itemOeuvre.attributes[5].value.toLowerCase().includes(titre.toLowerCase())){
                        itemOeuvre.style.display = "";
                    }
                    if(itemOeuvre.attributes[6].value.toLowerCase().includes(auteur.toLowerCase())){
                        itemOeuvre.style.display = "";
                    }
                }
            })
    })

    document.querySelectorAll(".check-vente").forEach(item => {
        document.querySelectorAll(".oeuvreOBJ").forEach(itemOeuvre => {
            if(item.checked === false && item.attributes[3].value === itemOeuvre.attributes[4].value){
                itemOeuvre.style.display = "none";
            }
        })
    })
}

function reinit(){
    document.querySelectorAll(".check-categ").forEach(item => {
        item.checked = true;
    })
    document.querySelectorAll(".check-vente").forEach(item => {
        item.checked = true;
    })
    document.getElementById("slider-price").value = document.getElementById("slider-price").attributes[3].value;
    document.getElementById('value-slider').innerHTML = "Prix : " + document.getElementById("slider-price").attributes[3].value + " €"
    document.getElementById("titre-oeuvre").value = "";
    document.getElementById("auteur-oeuvre").value = "";
    document.querySelectorAll(".oeuvreOBJ").forEach(itemOeuvre => {
            itemOeuvre.style.display = "";
    })
    document.getElementById("tri-select").value = "date";
    tri();
}

function tri(){
    const sort = document.getElementById("tri-select").value;
    const oeuvres = document.querySelectorAll('.oeuvreOBJ');
    if(sort === "date"){
        const datefin = Array.from(oeuvres, function(element) {
            return { name: new Date(element.attributes[7].value), element: element };  
        });
        const sortedDate = datefin.sort((a, b) => a.name > b.name ? 1 : -1)
        sortedDate.forEach((el, index) => el.element.style.order = index)
    }
    else if(sort === "prixmin"){
        const prixMin = Array.from(oeuvres, function(element) {
            console.log(parseFloat(element.attributes[3].value))
            return { name: parseFloat(element.attributes[3].value), element: element };  
        });
        const sortedPrixMin = prixMin.sort((a, b) => a.name > b.name ? 1 : -1)
        sortedPrixMin.forEach((el, index) => el.element.style.order = index)
    }
    else if(sort === "prixdec"){
        const prixDesc = Array.from(oeuvres, function(element) {
            return { name: parseFloat(element.attributes[3].value), element: element };  
        });
        const sortedPrixdesc = prixDesc.sort((a, b) => a.name < b.name ? 1 : -1)
        sortedPrixdesc.forEach((el, index) => el.element.style.order = index)
    }
}
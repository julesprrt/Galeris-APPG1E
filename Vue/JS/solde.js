document.getElementById("btn-env-banc").addEventListener('click', solde);

function solde() {
    console.log("ok")
    document.querySelector(".solde-form").style.display = "block";
}

document.querySelector(".close-button").addEventListener("click", closeForm);

function closeForm() {
    document.querySelector(".solde-form").style.display = "none";
    document.querySelector(".input-solde").value = "";
    document.querySelector(".input-idStripe").value = "";
}

document.querySelector(".solde-button").addEventListener("click", EnvoieSolde);

async function EnvoieSolde() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    const solde = document.querySelector(".input-solde").value;
    const soldeMax = document.querySelector(".input-solde").max;

    if(solde.trim() === ""){
        alert("Veuillez remplir l'ensemble des champs.")
        return;
    }

    if (isNaN(parseFloat(solde)) || parseFloat(solde) > parseFloat(soldeMax) || parseFloat(solde) < 1) {
        alert("Le solde ne doit pas être supérieur à " + soldeMax + " €")
        return;
    }

    const confirmation = confirm("Etez vous-sure de vouloir transférer " + solde + " € à votre compte Stripe ?");

    if (confirmation) {

        const raw = JSON.stringify({
            "solde": solde,
        });

        const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: raw,
            redirect: "follow"
        };
        const response = await fetch("https://galeris/Galeris-APPG1E/envoiesolde", requestOptions)
        const statuscode = response.status;
        const result = await response.json();

        if (statuscode === 200) {
            window.location.reload();
            alert(result.Success)
            closeForm()
        }
        else if (statuscode === 400) {
            alert(result.Error);
        }
    }
}
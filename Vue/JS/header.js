document.getElementById("deconnexion").addEventListener("click", Deconnexion);

async function Deconnexion(){
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
    const response = await fetch("./deconnexion", requestOptions)
    const statuscode = response.status;
    const result = await response.json();
    
    if(statuscode === 200){
        alert(result.Success)
        window.location.href = "./";
    }
    
    else{
        alert(result.Error);
    }
}

document.querySelector(".shearch").addEventListener('input', displayListOrNot)

function displayListOrNot(){
   const valeur =  document.querySelector(".shearch").value;
   if(valeur.length >= 3){
        document.querySelector(".shearch").setAttribute('list', 'galeris-list')
   }
   else{
        document.querySelector(".shearch").removeAttribute('list');
   } 

   const list = Array.from(document.querySelectorAll("#galeris-list option"));
   const item = list.find(el => el.attributes[1].value === valeur);
   console.log(item.attributes[0].value)
   if(item.attributes[0].value.includes("utilisateur_")){
        let element = item.attributes[0].value.split("utilisateur_")[1];
        document.querySelector(".shearch").value = "";
        saveIdUser(Number(element))
   }
   else if(item.attributes[0].value.includes("expose_")){
        let element = item.attributes[0].value.split("expose_")[1];
        document.querySelector(".shearch").value = "";
        saveIdExpose(Number(element))
   }
   else if(item.attributes[0].value.includes("oeuvre_")){
        let element = item.attributes[0].value.split("oeuvre_")[1];
        document.querySelector(".shearch").value = "";
        saveIdOeuvre(Number(element))
   }
}

async function saveIdExpose(id) {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
        "id": id
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("./saveidexpose", requestOptions)
    const statuscode = response.status;
    if (statuscode === 200) {
       window.location.href = "./expose";
    }
}

async function saveIdUser(id) {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
        "id": id
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

async function saveIdOeuvre(id) {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
        "id": id
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("./saveid", requestOptions)
    const statuscode = response.status;
    if (statuscode === 200) {
        window.location.href = "./achat";
    }
}

document.querySelectorAll(".product").forEach(item => {
    item.addEventListener('click', GoToProduct);
});


document.querySelectorAll(".remove-elm").forEach(item => {
    item.addEventListener('click', retirerfavoris);
});


async function GoToProduct(e){
    let elm = e.target;
    
    if(elm.nodeName === "BUTTON"){
        return;
    }
   
    while (elm && elm.nodeName !== "TR"){
        elm = elm.parentNode;
    }
    if(!elm) return;

    const id_oeuvre = parseInt(elm.getAttribute("id"));
    if(!id_oeuvre) return;

    
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({ "id": id_oeuvre });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    try {
        const response = await fetch("./saveid", requestOptions);
        if(response.status === 200){
            
            window.location.href = "./achat";
        }
    } catch(err){
        console.error(err);
    }
}


async function retirerfavoris(e){
    
    e.stopPropagation();

   
    const id_favoris = parseInt(e.currentTarget.getAttribute("id"));
    if(!id_favoris) return;

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    
    const raw = JSON.stringify({ "id" : id_favoris });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    try {
        const result = await fetch("./retirerfavorisid", requestOptions);
        const statut = result.status;
        const text = await result.json();
        if(statut === 200){
            alert(text.favoris);  
            window.location.reload();
        }
    } catch(err){
        console.error(err);
    }
}

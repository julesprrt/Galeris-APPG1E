document.querySelectorAll(".product").forEach(item => {
    item.addEventListener('click', GoToProduct);
})

document.querySelectorAll(".remove-elm").forEach(item => {
    item.addEventListener('click', retirerpanier)
})
async function GoToProduct(e){
    let elm = e;

    if(elm.target.nodeName === "BUTTON"){
        return;
    }

    if(elm.target.nodeName !== "TR"){
        elm = e.target.parentNode;
    }

    while(elm?.nodeName !== "TR" && elm?.target?.nodeName !== "TR"){
        elm = elm.parentNode
    }

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
        "id": parseInt(elm.attributes[1].value)
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

async function retirerpanier(e){
    console.log(parseInt(e.target.parentNode.attributes[1].value))
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    
    const raw = JSON.stringify({
        "id" : parseInt(e.target.parentNode.attributes[1].value)
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    const result = await fetch("./retirerpanierid", requestOptions);
    const statut = result.status;
    const text = await result.json();
    if(statut === 200){
        alert(text.panier);
        window.location.reload();
   }
}
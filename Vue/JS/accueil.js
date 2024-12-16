
const cbox = document.querySelectorAll(".oeuvreOBJ");

 for (let i = 0; i < cbox.length; i++) {
     cbox[i].addEventListener("click", saveId());
 }

async function saveId() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
        "id": document.getElementById("id_oeuvre").value
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
       // window.location.href = "https://galeris/Galeris-APPG1E/achat";

    }
    else {


    }
}

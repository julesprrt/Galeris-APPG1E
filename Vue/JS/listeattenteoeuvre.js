const OeuvreAccepted = document.querySelectorAll(".active");
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
    const response = await fetch("./saveid", requestOptions)
    const statuscode = response.status;
    if (statuscode === 200) {
       window.location.href = "./attenteoeuvre";
    }
}

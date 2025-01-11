const cbox = document.querySelectorAll(".newsOBJ");

 for (let i = 0; i < cbox.length; i++) {
     cbox[i].addEventListener("click", saveId);
 }

async function saveId(event) {
    const divParent = event.currentTarget.querySelector(".news");
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
    const response = await fetch("https://galeris/Galeris-APPG1E/saveidnews", requestOptions)
    const statuscode = response.status;
    if (statuscode === 200) {
       window.location.href = "./newsactu";
    }
}
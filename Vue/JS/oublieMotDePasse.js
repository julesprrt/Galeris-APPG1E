document.getElementById("btn-omdp").addEventListener("click", verifyMail);

async function verifyMail() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    document.getElementById("btn-omdp").disable = true;
    const raw = JSON.stringify({
        "email" : document.getElementById("email").value
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("https://galeris/Galeris-APPG1E/verifyMail", requestOptions)
    const statuscode = response.status;
    const result = await response.json();
    
    if(statuscode === 200){
        document.getElementById("btn-omdp").disable = false;
        alert(result.Success)
        window.location.href = "./codeunique";
    }
    else{
        document.getElementById("btn-omdp").disable = false;
        alert(result.Error);
    }
}
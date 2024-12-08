document.getElementById("btn-omdp").addEventListener("click", verifyMail);

async function verifyMail() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    
    const raw = JSON.stringify({
        "email" : document.getElementById("email").value
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("http://localhost:80/Galeris-APPG1E/verifyMail", requestOptions)
    const statuscode = response.status;
    const result = await response.json();
    
    if(statuscode === 200){
        alert(result.Success)
        document.querySelector(".error-message").textContent = "";
        window.location.href = "http://localhost:80/Galeris-APPG1E/codeunique";
    }
    else{
        alert(result.Error);
        document.querySelector(".error-message").textContent = result.Error;
    }
}
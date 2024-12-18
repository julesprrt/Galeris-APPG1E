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
    const response = await fetch("https://galeris/Galeris-APPG1E/deconnexion", requestOptions)
    const statuscode = response.status;
    const result = await response.json();
    
    if(statuscode === 200){
        alert(result.Success)
        window.location.href = "https://galeris/Galeris-APPG1E/";
    }
    
    else{
        alert(result.Error);
    }
}
//document.getElementById("togglePassword").addEventListener('click', passwordToggle);
document.querySelector(".submit-button").addEventListener('click', connexion);
document.getElementById("showmdp").addEventListener('click', passwordToggle);
document.getElementById("hidemdp").addEventListener('click', HidepasswordToggle);



//Afficher ou non le mot de passe
function passwordToggle(){
    const type = document.getElementById("passwordInput").getAttribute("type") === "password" ? "text" : "password";
    document.getElementById("passwordInput").setAttribute("type", type);
    document.getElementById("togglePassword").classList.toggle("show-password");
    
}


async function connexion() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    
    const raw = JSON.stringify({
        "email": document.getElementsByName("email")[0].value,
        "password" : document.getElementsByName("password")[0].value
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("https://galeris/Galeris-APPG1E/connexion", requestOptions)
    const statuscode = response.status;
    const result = await response.json();
    console.log(statuscode);
    
    if(statuscode === 200){
        alert(result.Success)
        document.querySelector('.error-message').innerHTML = "";
        document.querySelectorAll('.input-user').forEach((item)=> {
            item.value = "";
        })
        document.querySelectorAll('.input-user-first').forEach((item)=> {
            item.value = "";
        })
        window.location.href = "https://galeris/Galeris-APPG1E";
    }
    else if(statuscode === 401){
        alert(result.Information);
        document.querySelectorAll('.input-user').forEach((item)=> {
            item.value = "";
        })
        document.querySelectorAll('.input-user-first').forEach((item)=> {
            item.value = "";
        })
        window.location.href = "https://galeris/Galeris-APPG1E/inscription";
    }
    else{
        alert(result.Error);
        document.querySelector('.error-message').innerHTML = result.Error;
        document.querySelectorAll('.input-user').forEach((item)=> {
            item.value = "";
        })
    }
}

function passwordToggle(){
    document.getElementById("passwordInput").setAttribute("type", "text");
    document.getElementById("showmdp").style.display = 'none';
    document.getElementById("hidemdp").style.display = ''
}

function HidepasswordToggle(){
    document.getElementById("passwordInput"). setAttribute("type", "password");
    document.getElementById("hidemdp").style.display = 'none';
    document.getElementById("showmdp").style.display = '';
}
document.querySelector(".submit-button").addEventListener('click', register)
document.getElementById("showmdp").addEventListener('click', passwordToggle);
document.getElementById("hidemdp").addEventListener('click', HidepasswordToggle);
document.getElementById("showmdp2").addEventListener('click', passwordToggle2);
document.getElementById("hidemdp2").addEventListener('click', HidepasswordToggle2);


async function register() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    
    const raw = JSON.stringify({
        "firstName": document.getElementsByName("firstName")[0].value,
        "name": document.getElementsByName("name")[0].value,
        "email": document.getElementsByName("email")[0].value,
        "telephone": document.getElementsByName("telephone")[0].value,
        "password" : document.getElementsByName("password")[0].value,
        "confirmPassword" : document.getElementsByName("confirmPassword")[0].value,
        "cgu" : document.getElementById("check-inscription").checked
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("https://galeris/Galeris-APPG1E/inscription", requestOptions)
    const statuscode = response.status;
    const result = await response.json();
    
    if(statuscode === 200){
        alert(result.Success)
        document.querySelectorAll('.input-user').forEach((item)=> {
            item.value = "";
        })
        document.querySelectorAll('.input-user-first').forEach((item)=> {
            item.value = "";
        })
        document.getElementById("check-inscription").checked = false;
        document.querySelector('.error-message').innerHTML = "";
        window.location.href = "https://galeris/Galeris-APPG1E/codeunique"
    }
    
    else{
        alert(result.Error);
        document.querySelector('.error-message').innerHTML = result.Error;
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

function passwordToggle2(){
    document.getElementById("confPasswordInput").setAttribute("type", "text");
    document.getElementById("showmdp2").style.display = 'none';
    document.getElementById("hidemdp2").style.display = ''
}

function HidepasswordToggle2(){
    document.getElementById("confPasswordInput"). setAttribute("type", "password");
    document.getElementById("hidemdp2").style.display = 'none';
    document.getElementById("showmdp2").style.display = '';
}
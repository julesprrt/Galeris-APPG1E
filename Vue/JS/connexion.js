//document.getElementById("togglePassword").addEventListener('click', passwordToggle);
document.querySelector(".button-connection").addEventListener('click', connexion);

//Afficher ou non le mot de passe
function passwordToggle() {
    const type = document.getElementById("passwordInput").getAttribute("type") === "password" ? "text" : "password";
    document.getElementById("passwordInput").setAttribute("type", type);
    document.getElementById("togglePassword").classList.toggle("show-password");
}


async function connexion() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    const raw = JSON.stringify({
        "email": document.getElementsByName("email")[0].value,
        "password": document.getElementsByName("password")[0].value,
        "g-recaptcha-response": document.getElementById("g-recaptcha-response").value
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

    if (statuscode === 200) {
        alert(result.Success)
        document.querySelector('.error-message').innerHTML = "";
        document.querySelectorAll('.input-connexion').forEach((item) => {
            item.value = "";
        })
        document.querySelectorAll('.input-connexion-first').forEach((item) => {
            item.value = "";
        })
        grecaptcha.reset();
        window.location.href = "https://galeris/Galeris-APPG1E";
    }
    else if (statuscode === 401) {
        alert(result.Information);
        document.querySelectorAll('.input-connexion').forEach((item) => {
            item.value = "";
        })
        document.querySelectorAll('.input-connexion-first').forEach((item) => {
            item.value = "";
        })
        grecaptcha.reset();
    }
    else {
        alert(result.Error);
        document.querySelector('.error-message').innerHTML = result.Error;
        document.querySelectorAll('.input-connexion').forEach((item) => {
            item.value = "";
        })
        grecaptcha.reset();
    }
}
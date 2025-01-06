document.getElementById("btn-contact").addEventListener('click', contact);

async function contact() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    const raw = JSON.stringify({
        "email": document.getElementsByName("email")[0].value,
        "firstName": document.getElementsByName("firstName")[0].value,
        "name": document.getElementsByName("name")[0].value,
        "subject": document.getElementsByName("subject")[0].value,
        "message": document.getElementsByName("message")[0].value,
        "g-recaptcha-response": document.getElementById("g-recaptcha-response").value
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("https://galeris/Galeris-APPG1E/contact", requestOptions)
    const statuscode = response.status;
    const result = await response.json();
    if (statuscode === 200) {
        alert(result.Success);
        document.querySelector('.error-message').innerHTML = "";
        document.querySelectorAll('.contact-input').forEach((item) => {
            item.value = "";
        })
        window.location.href = "https://galeris/Galeris-APPG1E/";
    }
    else {
        alert(result.Error);
        document.querySelector('.error-message').innerHTML = result.Error;
    }
}
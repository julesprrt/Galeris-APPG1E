document.querySelector(".submit-button").addEventListener('click', register)


async function register() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    
    const raw = JSON.stringify({
        "firstName": document.getElementsByName("firstName")[0].value,
        "name": document.getElementsByName("name")[0].value,
        "userName": document.getElementsByName("userName")[0].value,
        "email": document.getElementsByName("email")[0].value,
        "telephone": document.getElementsByName("telephone")[0].value,
        "password" : document.getElementsByName("password")[0].value,
        "confirmPassword" : document.getElementsByName("confirmPassword")[0].value
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("http://localhost:80/inscription", requestOptions)
    const statuscode = response.status;
    const result = await response.json();
    
    if(statuscode === 200){
        alert(result.Success)
        document.querySelector('.error-message').innerHTML = "";
    }
    else{
        alert(result.Error);
        document.querySelector('.error-message').innerHTML = result.Error;
    }
}
document.getElementById("btn-contact").addEventListener('click', contact);

async function contact() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    console.log(document.getElementsByName("email")[0].value)
    const raw = JSON.stringify({
        "email": document.getElementsByName("email")[0].value,
        "firstName": document.getElementsByName("firstName")[0].value,
        "name": document.getElementsByName("name")[0].value,
        "subject": document.getElementsByName("subject")[0].value,
        "message": document.getElementsByName("message")[0].value
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("http://localhost:80/contact", requestOptions)
    console.log(response)
    const statuscode = response.status;
    const result = await response.json();
    if(statuscode === 200){
        alert(result.Success);
        document.querySelector('.error-message').innerHTML = "";
    }
    else{
        alert(result.Error);
        document.querySelector('.error-message').innerHTML = result.Error;
    }
}
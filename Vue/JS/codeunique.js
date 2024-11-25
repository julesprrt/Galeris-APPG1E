const inputs = document.querySelectorAll('.code-input input');

inputs.forEach((input, index) => {
    input.addEventListener('input', () => {
        if (input.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });
});

document.querySelector(".valid-code").addEventListener('click', register1)


async function register1() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    const code = document.getElementsByName("digit1")[0].value + document.getElementsByName("digit2")[0].value + document.getElementsByName("digit3")[0].value + document.getElementsByName("digit4")[0].value + document.getElementsByName("digit5")[0].value + document.getElementsByName("digit6")[0].value;
    console.log(code)
    const raw = JSON.stringify({
        "code" : code,
        
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };
    const response = await fetch("http://localhost:80/Galeris-APPG1E/codeunique", requestOptions)
    const statuscode = response.status;
    const result = await response.json();
    
    if(statuscode === 200){
        alert("ok")
        
    }
    
    else{
        

    }
};
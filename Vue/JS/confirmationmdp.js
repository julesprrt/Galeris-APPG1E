document.getElementById("showmdp").addEventListener('click', passwordToggle);
document.getElementById("hidemdp").addEventListener('click', HidepasswordToggle);
document.getElementById("showmdp2").addEventListener('click', passwordToggle2);
document.getElementById("hidemdp2").addEventListener('click', HidepasswordToggle2);
document.getElementById("resetPass").addEventListener('click', confpassword);

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


async function confpassword (){
    const passWord = document.getElementById("passwordInput").value
    const confPassWord = document.getElementById("confPasswordInput").value
    
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    if (passWord !== confPassWord) {
        alert("Les mots de passe ne correspondent pas !");
        return;
    }

    const raw = JSON.stringify({
        password: passWord,
        confirmPassword: confPassWord
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    }



        const response = await fetch("https://galeris/Galeris-APPG1E/confirmationmdp", requestOptions);
        const statuscode = response.status;
        const result = await response.json();

        if(statuscode === 200){
            alert(result.Success);
            document.querySelectorAll(".inputpassword").forEach(item => {
                item.value = "";
            });
            window.location.href = "https://galeris/Galeris-APPG1E/";
        }
        else {
            alert(result.Error);
            document.querySelectorAll(".inputpassword").forEach(item => {
                item.value = "";
            })
        }
   



}
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
    console.log("ok")
    const passWord = document.getElementById("passwordInput").value
    const confPassWord = document.getElementById("confPasswordInput").value
    
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    /*if (passWord !== confPassWord) {
        alert("Les mots de passe ne correspondent pas !");
        return;
    }*/

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


    try{
        const response = await fetch("http://localhost:80/Galeris-APPG1E/confirmationmdp", requestOptions);
        const statuscode = response.status;
        const result = await response.json();

        if(statuscode === 200){
            alert(result.Success)
           /* document.querySelectorAll('.input-inscription').forEach((item)=> {
                item.value = "";
            });*/
        }
        else {
            // Erreur
            alert(result.Error);
            //document.querySelector('.error-message').innerHTML = result.Error;
    }
    }
    catch (error){
        console.error("Erreur lors de la requête :", error);
        alert("Une erreur s'est produite. Veuillez réessayer.");
    }



}
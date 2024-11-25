document.getElementById("showmdp").addEventListener('click',passwordToggle);
document.getElementById("hidemdp").addEventListener('click',HidepasswordToggle);


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


async function confpassword (){
    const passWord = document.getElementById("passwordInput")[0].value
    const confPassWord = document.getElementById("confPasswordInput")[0].value

    

}
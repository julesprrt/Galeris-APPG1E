document.getElementById("affichermdp").addEventListener('click',passwordToggle);


function passwordToggle(){
    const type = document.getElementById("passwordInput").getAttribute("type") === "password" ? "text" : "password";
    document.getElementById("passwordInput").setAttribute("type", type);
    document.getElementById("togglePassword").classList.toggle("show-password");
    
}
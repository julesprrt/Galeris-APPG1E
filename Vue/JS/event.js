
document.addEventListener('keydown', function(e) {Zoom(e)});
document.addEventListener('wheel', function(e) {controle(e)});
  

function Zoom(event) {
    if (event.ctrlKey && (event.key === '+' || event.key === '-')) {
      event.preventDefault(); 
    }
}

function controle(event) {
    if (event.ctrlKey) {
      event.preventDefault(); 
    }
}

/*const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("passwordInput");

togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
    togglePassword.classList.toggle("show-password");
});*/
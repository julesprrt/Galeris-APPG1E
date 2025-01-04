
document.getElementById("btn-env-banc").addEventListener('click', solde);


function solde() {
    
    const button = document.getElementById('btn-env-banc');
    
    button.textContent = 'Envoie en cours';

    button.disabled = true;

    setTimeout(() => {
        button.textContent = 'Envoyer vers compte bancaire';
        button.disabled = false;
    }, 3000);
}

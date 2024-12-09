// Sélectionner les éléments pour les boutons plus, moins et ajout
let btnPlusAll = document.querySelectorAll('.qty-plus');
let btnMinusAll = document.querySelectorAll('.qty-minus');
let addButton = document.querySelector('#add_button');

// Ajouter les événements de clic aux boutons
btnPlusAll.forEach((btn) => {
    btn.addEventListener('click', increaseQuantity);
});

btnMinusAll.forEach((btn) => {
    btn.addEventListener('click', decreaseQuantity);
});

addButton.addEventListener('click', addArticle);

// Fonction pour augmenter la quantité
function increaseQuantity() {
    let qtyInput = this.previousElementSibling; // Input de quantité
    qtyInput.value = parseInt(qtyInput.value) + 1; // Incrémente la quantité
    updateSubtotal(this); // Met à jour le sous-total
}

// Fonction pour diminuer la quantité
function decreaseQuantity() {
    let qtyInput = this.nextElementSibling; // Input de quantité
    let newQty = parseInt(qtyInput.value) - 1;

    if (newQty >= 0) {
        qtyInput.value = newQty; // Réduit la quantité, pas en dessous de 0
        updateSubtotal(this); // Met à jour le sous-total
    }
}

// Fonction pour calculer et mettre à jour le sous-total
function updateSubtotal(elt) {
    // Récupère le parent de la quantité (la cellule de quantité)
    let quantityCell = elt.closest('td').querySelector('.qty');
    let qty = parseInt(quantityCell.value); // Récupère la quantité de l'input

    // Récupère le prix de l'article (cellule de prix)
    let priceCell = elt.closest('tr').querySelector('.price');
    let price = parseFloat(priceCell.innerText.replace('€', '').trim()); // Nettoie le prix

    // Calcul du sous-total
    let subtotal = price * qty;

    // Met à jour le sous-total dans la cellule correspondante
    elt.closest('tr').querySelector('.subtotal').innerText = subtotal.toFixed(2);

    // Met à jour le total global
    updateTotal();
}

// Fonction pour ajouter un article
function addArticle() {
    let name = document.querySelector('#name_product').value.trim();
    let price = parseFloat(document.querySelector('#price_product').value);

    // Vérifie que le nom et le prix sont valides
    if (!name || isNaN(price) || price <= 0) {
        alert("Veuillez entrer un nom valide et un prix supérieur à 0.");
        return;
    }

    // Crée une nouvelle ligne pour l'article
    const newRow = `
        <tr>
            <td class="article--name">
                <div style="margin-right:1rem"><img src="../html/images/tableau.png"></div> 
                <div>
                    <h3>${name}</h3> 
                    <a class="remove">Supprimer</a>
                </div>
            </td>
            <td class="quantity"> 
                <button class="qty-minus">-</button>
                <input type="text" readonly class="qty" value="1">
                <button class="qty-plus">+</button>
            </td>
            <td class="price">${price.toFixed(2)}€</td> 
            <td class="subtotal">${price.toFixed(2)}</td>
        </tr>
    `;

    // Ajoute la nouvelle ligne au tableau
    document.querySelector('#all_products').insertAdjacentHTML('beforeend', newRow);

    // Recharge les événements pour les nouveaux éléments
    loadNewElement();

    // Réinitialise les champs du formulaire
    document.querySelector('#name_product').value = "";
    document.querySelector('#price_product').value = "0";
}

// Fonction pour recharger les éléments et événements sur les nouveaux articles
function loadNewElement() {
    let btnPlusAll = document.querySelectorAll('.qty-plus');
    let btnMinusAll = document.querySelectorAll('.qty-minus');

    btnPlusAll.forEach((btn) => {
        btn.addEventListener('click', increaseQuantity);
    });
    btnMinusAll.forEach((btn) => {
        btn.addEventListener('click', decreaseQuantity);
    });
}

// Écouteur d'événements pour supprimer les articles du tableau
document.getElementById("all_products").addEventListener("click", function(event) {
    // Vérifie si l'élément cliqué est un lien avec la classe 'remove'
    if (event.target && event.target.classList.contains("remove")) {
        // Trouve la ligne correspondante à l'article
        const rowToRemove = event.target.closest("tr");

        // Supprime la ligne du tableau
        if (rowToRemove) {
            rowToRemove.remove();
            updateTotal(); // Met à jour le total après la suppression
        }
    }
});

// Fonction pour mettre à jour le total du panier
function updateTotal() {
    let total = 0;
    // Parcourt toutes les cellules de sous-total et les additionne
    document.querySelectorAll(".subtotal").forEach(function(subtotalCell) {
        let value = parseFloat(subtotalCell.textContent.replace(/[^\d.-]/g, "")) || 0;
        total += value;
    });

    // Met à jour l'affichage du total
    document.getElementById("total_display").textContent = total.toFixed(2) + " €";
}

document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("autocomplete");
    const suggestions = document.getElementById("suggestions");

    // Déclenche l'autocomplétion lorsqu'un utilisateur commence à taper
    input.addEventListener("input", async function () {
        const query = input.value.trim();

        // Si le champ est vide, on vide les suggestions
        if (!query) {
            suggestions.innerHTML = "";
            return;
        }

        try {
            // Appel à l'API Nominatim pour récupérer les adresses
            const response = await fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(query)}&format=json&addressdetails=1`);
            const data = await response.json();
            // Vide les suggestions existantes
            suggestions.innerHTML = "";

            if (data.length > 0) {
                data.forEach((item) => {
                    suggestions.style.display = "";
                    const li = document.createElement("li");
                    li.textContent = item.display_name; // Affiche l'adresse complète
                    li.classList.add("suggestion-item");
                    li.addEventListener("click", function () {
                        input.value = item.display_name; // Remplit le champ avec l'adresse sélectionnée
                        suggestions.innerHTML = ""; // Vide les suggestions
                        suggestions.style.display = "none";
                    });
                    suggestions.appendChild(li);
                });
            } else {
                const li = document.createElement("li");
                li.textContent = "Aucune adresse trouvée";
                li.style.color = "gray";
                suggestions.appendChild(li);
            }
        } catch (error) {
            console.error("Erreur lors de la récupération des adresses :", error);
        }
    });

    // Cache les suggestions si l'utilisateur clique en dehors
    document.addEventListener("click", function (event) {
        if (!suggestions.contains(event.target) && event.target !== input) {
            suggestions.innerHTML = "";
        }
    });
});

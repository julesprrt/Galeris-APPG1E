document.getElementById('photo-upload').addEventListener('change', function (event) {
    const file = event.target.files[0];

    if (file) {
        // Vérifiez le type de fichier 
        const allowedTypes = ['image/png', 'image/jpeg'];
        if (!allowedTypes.includes(file.type)) {
            alert("Veuillez sélectionner une image au format PNG ou JPEG.");
            return;
        }

        // Vérifiez la taille du fichier
        const maxSizeMB = 2; // Limite de 2 Mo
        if (file.size > maxSizeMB * 1024 * 1024) {
            alert("La taille de l'image ne doit pas dépasser 2 Mo.");
            return;
        }

        // Créez un lecteur de fichier pour afficher l'aperçu
        const reader = new FileReader();
        reader.onload = function (e) {
            const previewImage = document.getElementById('preview-image');
            previewImage.src = e.target.result; // Mise à jour de l'image
        };

        reader.readAsDataURL(file); // Lis le fichier comme URL de données
    }
});

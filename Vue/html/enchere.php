<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($oeuvre['Titre']); ?></title>
    <link rel="stylesheet" href="CSS/enchere.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/footer.css">
</head>
<body>

<header>
        <div class="logo">
            <a href="https://galeris/Galeris-APPG1E/">
                <img width="150" height="150" src="../images/logo-sans-fond.png" alt="Logo Galeris">
            </a>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="https://galeris/Galeris-APPG1E/">Accueil</a></li>
                <li><a href="#">Vente</a></li>
                <li><a href="#">Exposition</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Plus</a></li>
            </ul>
        </nav>
        <div class="barre_recherche">
            <input type="text" placeholder="Rechercher...">
            <div class="favori"><a href="favoris.html">❤️</a></div>
            <div class="panier"><a href="panier.html">🛒</a></div>
            <div class="utilisateur"><a href="https://galeris/Galeris-APPG1E/profil">👤</a></div>
        </div>
    
</header>

<div class="conteneur">
    <!-- Section gauche : Informations sur l'œuvre -->
    <div class="gauche">
        <!-- Image principale -->
        <img class="photo" src="<?php echo htmlspecialchars($images[0]['chemin_image']); ?>" alt="<?php echo htmlspecialchars($oeuvre['Titre']); ?>">

        <p>Cliquez sur l'image pour l'agrandir</p>

        <!-- Galerie de miniatures -->
        <div class="photos">
            <?php foreach ($images as $image): ?>
                <img src="<?php echo htmlspecialchars($image['chemin_image']); ?>" alt="Photo">
            <?php endforeach; ?>
        </div>

        <!-- Description de l'œuvre -->
        <div>
            <h1><?php echo htmlspecialchars($oeuvre['Titre']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($oeuvre['Description'])); ?></p>
        </div>
    </div>

    <!-- Section droite : Informations d'enchère -->
    <div class="droite">
        <div class="conteneur2">
            <h2>Prix actuel : <?php echo number_format($oeuvre['Prix'], 2, ',', ' '); ?> €</h2>
            <p>Enchère ouverte jusqu'au : <?php echo date('d/m/Y H:i', strtotime($oeuvre['Date_fin'])); ?></p>
            <button>Placer une enchère</button>
        </div>
    </div>
</div>

<footer>
        <div class="container-footer">
            <a class="title-footer">Qui sommes nous</a>
            <a class="item-footer" href="#">NovArt</a>
            <a class="item-footer" href="#">Galeris</a>
        </div>
        <div class="container-footer">
            <a class="title-footer">Aide</a>
            <a class="item-footer" href="https://galeris/Galeris-APPG1E/faq">Foire aux questions</a>
            <a class="item-footer" href="https://galeris/Galeris-APPG1E/contact">Contacts</a>
        </div>
        <div class="container-footer">
            <a class="title-footer">Informations légales</a>
            <a class="item-footer" href="https://galeris/Galeris-APPG1E/cgu">Conditions d'utilisations</a>
            <a class="item-footer" href="#">Mentions légales</a>
        </div>
</footer>

</body>
</html>

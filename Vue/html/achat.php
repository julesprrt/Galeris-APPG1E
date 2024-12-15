<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/Galeris-APPG1E/Vue/">
    <link rel="stylesheet" href="CSS/achat.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/style.css">
    <title><?php echo htmlspecialchars($oeuvre['Titre']); ?></title>
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

    <main>
        <section class="gauche">
            <section class="art-details">
                <div class="carousel-container">
                    <!-- Flèche gauche -->
                    <button class="carousel-fleche gauche cfg">&#10094;</button>

                    <div class="art-image">
                        <img src="..\images\oeuvre1-1.jpg" class="carousel-image active" alt="Photo Oeuvre 1">
                        <img src="..\images\oeuvre1-2.jpg" class="carousel-image" alt="Photo Oeuvre 2">
                        <img src="..\images\oeuvre1-3.jpg" class="carousel-image" alt="Photo Oeuvre 3">
                    </div>

                    <!-- Flèche droite -->
                    <button class="carousel-fleche droite cfd">&#10095;</button>
                </div>

                <div class="art-info">
                    <h1><?php echo htmlspecialchars($oeuvre['Titre']); ?></h1>
                    <p><?php echo nl2br(htmlspecialchars($oeuvre['Description'])); ?></p>
                </div>
            </section>

            <!-- Section : Œuvres similaires -->
            <section class="art-image-similaire">
                <h2>Oeuvres similaires</h2>
                <div class="tableau-similaire">
                    <img src="..\images\oeuvresim-1.png" alt="Tableau similaire 1">
                    <img src="..\images\oeuvresim-2.jpg" alt="Tableau similaire 2">
                    <img src="..\images\oeuvresim-3.jpg" alt="Tableau similaire 3">
                </div>
            </section>
        </section>

        <!-- Droite : Informations supplémentaires -->
        <section class="droite">
            <section class="profil-section">
                <div class="profil-info">
                    <img src="https://via.placeholder.com/50" alt="Photo de profil" class="photo-profil">
                    <div class="profil-nom">
                        <strong>Vendeur : <?php echo htmlspecialchars($oeuvre['nomvendeur']) . " " . htmlspecialchars($oeuvre['prenomvendeur']); ?></strong>
                    </div>
                </div>
            </section>

            <section class="info-prix">
                <div class="prix">
                    <span><strong>Prix :</strong> € <?php echo number_format($oeuvre['Prix'], 2, ',', ' '); ?></span>
                    <p><small>Publié le : <?php echo htmlspecialchars($oeuvre['Date_debut']); ?></small></p>
                </div>
            </section>

            <!-- Boutons d'actions -->
            <section class="actions">
                <button class="boutton-acheter">Acheter</button>
                <button class="boutton-message-vendeur">Message</button>
            </section>
        </section>
    </main>

    <!-- FOOTER -->
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
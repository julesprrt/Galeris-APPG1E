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
    <script src="https://galeris/Galeris-APPG1E/vue/JS/achat.js" defer></script>
    <title><?php echo htmlspecialchars($oeuvre['Titre']); ?></title>
    <script src="https://galeris/Galeris-APPG1E/vue/JS/header.js" defer></script>
    <title>Page d'Achat</title>
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
                <li><a href="https://galeris/Galeris-APPG1E/ventes">Vente</a></li>
                <li><a href="https://galeris/Galeris-APPG1E/exposes">Exposition</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Plus</a></li>
            </ul>
        </nav>
        <div class="barre_recherche">
            <input type="text" placeholder="Rechercher...">
            <div class="favori"> <a href="favoris.html">❤️ </a></div>
            <div class="panier"> <a href="panier.html"> 🛒 </a></div>
            <?php
            if ($connectUser === true) {
                echo '<div class="dropdown">
                            <div class="utilisateur"> 👤 </div>
                            <div class="dropdown-child">
                                <a href="https://galeris/Galeris-APPG1E/profil">Mon profil</a>
                                <a href="#">Mon solde</a>' .
                    (($userRole === true) ?
                        '<a href="https://galeris/Galeris-APPG1E/listeoeuvreattente">Oeuvres en attente</a>
                                    <a href="https://galeris/Galeris-APPG1E/listeexposeattente">Exposés en attente</a>' : "") .
                    '<a id="deconnexion">Déconnexion</a>
                            </div>
                           </div>';
            } else {
                echo '<div class="utilisateur"><a href="https://galeris/Galeris-APPG1E/connexion"> 👤 </a></div>';
            }
            ?>


        </div>
    </header>

    <main>
        <section class="gauche">
            <section class="art-details">
                <div class="carousel-container">
                    <!-- Flèche gauche -->
                    <button class="carousel-fleche gauche cfg">&#10094;</button>

                    <div class="art-image">
                        <?php foreach ($oeuvre['chemin_image'] as $index => $chemin): ?>
                            <img src="../<?php echo htmlspecialchars($chemin); ?>"
                                class="carousel-image <?php echo $index === 0 ? 'active' : ''; ?>"
                                alt="Image de <?php echo htmlspecialchars($oeuvre['Titre']); ?>">
                        <?php endforeach; ?>
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
                    <img src="../images/photodeprofil.jpg" alt="Photo de profil" class="photo-profil">
                    <div class="profil-nom">
                        <strong>Vendeur : <?php echo htmlspecialchars($oeuvre['nom']) . " " . htmlspecialchars($oeuvre['prenom']); ?></strong>
                    </div>
                </div>
            </section>

            <section class="info-prix">
                <div class="prix">
                    <span><strong>Auteur :</strong> <?php echo htmlspecialchars($oeuvre['auteur']) ?></span><br><br>
                    <span><strong>Prix :</strong> <?php echo number_format($oeuvre['Prix'], 2, ',', ' '); ?> € </span>
                    <p><small>Publié le : <?php echo htmlspecialchars($oeuvre['Date_debut']); ?></small></p>
                    <p><small class="temps-restant" data-fin="<?php echo $oeuvre["Date_fin"]  ?>">Temps restant : </small></p>
                </div>
            </section>

            <!-- Boutons d'actions -->
            <section class="actions">
                <?php
                    if($oeuvre["id_panier"] === null){
                        echo '<button class="boutton-panier">Ajouter au Panier</button>';
                    }
                    else{
                        echo '<button class="boutton-retirer-panier">Retirer du Panier</button>';
                    }
                ?>
                
                <button class="boutton-favoris">Ajouter au favoris</button>
            </section>
        </section>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container-footer">
            <a class="title-footer">Qui sommes-nous ?</a>
            <a class="item-footer" href="#">NovArt</a>
            <a class="item-footer" href="https://galeris/Galeris-APPG1E/galeris">Galeris</a>
        </div>
        <div class="container-footer">
            <a class="title-footer">Aide</a>
            <a class="item-footer" href="https://galeris/Galeris-APPG1E/faq">Foire aux questions</a>
            <a class="item-footer" href="https://galeris/Galeris-APPG1E/contact">Contact</a>
        </div>
        <div class="container-footer">
            <a class="title-footer">Informations légales</a>
            <a class="item-footer" href="https://galeris/Galeris-APPG1E/cgu">Conditions d'utilisations</a>
            <a class="item-footer" href="#">Mentions légales</a>
        </div>
    </footer>
</body>

</html>
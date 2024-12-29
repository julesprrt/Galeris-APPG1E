<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/Galeris-APPG1E/Vue/">
    <link rel="stylesheet" href="CSS/oeuvreExpose.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <title><?php echo htmlspecialchars($expose['titre']); ?></title>
    <script src="https://galeris/Galeris-APPG1E/vue/JS/header.js" defer></script>
    <script src="https://galeris/Galeris-APPG1E/vue/JS/expose.js" defer></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <title>Exposé</title>
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
                                <a href="#">Mon solde</a>'.
                                (($userRole === true)?
                                    '<a href="https://galeris/Galeris-APPG1E/listeoeuvreattente">Oeuvres en attente</a>
                                    <a href="https://galeris/Galeris-APPG1E/listeexposeattente">Exposés en attente</a>':"").
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
                        <?php foreach ($expose['chemin_image'] as $index => $chemin): ?>
                            <img src="../<?php echo htmlspecialchars($chemin); ?>"
                                class="carousel-image <?php echo $index === 0 ? 'active' : ''; ?>"
                                alt="Image de <?php echo htmlspecialchars($expose['titre']); ?>">
                        <?php endforeach; ?>
                    </div>



                    <!-- Flèche droite -->
                    <button class="carousel-fleche droite cfd">&#10095;</button>
                </div>


                <div class="art-info">
                    <h1><?php echo htmlspecialchars($expose['titre']); ?></h1>
                    <p><?php echo nl2br(htmlspecialchars($expose['desc'])); ?></p>
                </div>
            </section>

            <!-- Section : Œuvres similaires -->
            <section class="art-image-similaire">
                <h2>Exposes similaires</h2>
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
                        <strong>Exposition par : <?php echo htmlspecialchars($expose['nom']) . " " . htmlspecialchars($expose['prenom']); ?></strong>
                    </div>
                </div>
            </section>

            <section class="info-prix">
                <div class="prix">
                    <p><small>Du <?php echo htmlspecialchars($expose['date_debut']); ?> au <?php echo htmlspecialchars($expose['date_fin']); ?></small></p>
                </div>
            </section>
            <div class="adresse">
                <p><strong>Adresse : 10 Rue de Vanves, 92130 Vanves, France</strong></p>
            </div>
            <div id="map">

            </div>

            <!-- Boutons d'actions (modif expo pour l'utilisateur) -->
            <!--<section class="actions">
                <input type="hidden" id="id_expose" name="id_expose" value="<?php echo $expose["id_exhibition"] ?>">
                <button class="boutton-valider">Accepter</button>
                <button class="boutton-refuse">Refuser</button>
            </section>-->
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
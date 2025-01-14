<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="Vue/CSS/oeuvreExpose.css">
    <link rel="stylesheet" href="Vue/CSS/header.css">
    <link rel="stylesheet" href="Vue/CSS/footer.css">
    <link rel="stylesheet" href="Vue/CSS/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <title><?php echo htmlspecialchars($expose['titre']); ?></title>
    <script src="Vue/JS/header.js" defer></script>
    <script src="Vue/JS/expose.js" defer></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <title>Exposé</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="./">
                <img width="150" height="150" src="images/logo-sans-fond.png" alt="Logo Galeris">
            </a>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="./">Accueil</a></li>
                <li><a href="./ventes">Vente</a></li>
                <li><a href="./exposes">Exposition</a></li>
                <li><a href="./listenews">News</a></li>
                
            </ul>
        </nav>
        <div class="barre_recherche">
        <input type="text" placeholder="Rechercher..." class="shearch">
                <datalist id="galeris-list">
                        <?php
                            foreach($users as $user_barre){
                                echo '<option data-value="utilisateur_' . $user_barre["id_utilisateur"] . '" value="' . $user_barre["nom"] . ' ' . $user_barre["prenom"] . ' ' . $user_barre["id_utilisateur"] .' (utilisateur)">';
                            }
                            foreach($exposes as $expose_barre){
                                echo '<option data-value="expose_' . $expose_barre["id_exhibition"] . '" value="' . $expose_barre["titre"] . ' ' . $expose_barre["id_exhibition"] . ' (exposé)">';
                            }
                            foreach($oeuvres as $oeuvre_barre){
                                echo '<option data-value="oeuvre_' . $oeuvre_barre["id_oeuvre"] . '" value="' . $oeuvre_barre["Titre"] . ' ' . $oeuvre_barre["auteur"] . ' ' . $oeuvre_barre["id_oeuvre"] . ' (Oeuvre)">';
                            }
                                
                        ?>
                </datalist>
            <div class="favori"> <a href="./favoris">❤️ </a></div>
            <div class="panier"> <a href="./panier"> 🛒 </a></div>
            <?php
            if ($connectUser === true) {
                echo '<div class="dropdown">
                            <div class="utilisateur"> 👤 </div>
                            <div class="dropdown-child">
                                <a href="./profil">Mon profil</a>
                                <a href="./solde">Mon solde</a>'.
                                (($userRole === true)?
                                    '<a href="./listeoeuvreattente">Oeuvres en attente</a>
                                    <a href="./listeexposeattente">Exposés en attente</a>
                                    <a href="./dashboard">Tableau de bord</a>' : "") .
                                '<a class="deconnexion">Déconnexion</a>
                            </div>
                           </div>';
                } else {
                    echo '<div class="utilisateur"><a href="./connexion"> 👤 </a></div>';
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
                            <img src="./<?php echo htmlspecialchars($chemin); ?>"
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
                    <img src="images/oeuvresim-1.png" alt="Tableau similaire 1">
                    <img src="images/oeuvresim-2.jpg" alt="Tableau similaire 2">
                    <img src="images/oeuvresim-3.jpg" alt="Tableau similaire 3">
                </div>
            </section>
        </section>

        <!-- Droite : Informations supplémentaires -->
        <section class="droite">
            <section class="profil-section">
                <div class="profil-info">
                <?php echo '<input type="hidden" id="id_utilisateur" name="id_utilisateur" value="' . $expose["id_utilisateur"] . '">'; ?>
                    <img src="./<?php echo $expose['profil'] ?? 'ImageBD/Profil/avatarbasique.jpg'; ?>" alt="Photo de profil" class="photo-profil">
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
            <a class="item-footer" href="./novart">NovArt</a>
            <a class="item-footer" href="./galeris">Galeris</a>
        </div>
        <div class="container-footer">
            <a class="title-footer">Aide</a>
            <a class="item-footer" href="./faq">Foire aux questions</a>
            <a class="item-footer" href="./contact">Contact</a>
        </div>
        <div class="container-footer">
            <a class="title-footer">Informations légales</a>
            <a class="item-footer" href="./cgu">Conditions d'utilisations</a>
            <a class="item-footer" href="./mentionslegales">Mentions légales</a>
        </div>
    </footer>
</body>

</html>
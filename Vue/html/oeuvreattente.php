<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Vue/CSS/oeuvreExpose.css">
    <link rel="stylesheet" href="Vue/CSS/header.css">
    <link rel="stylesheet" href="Vue/CSS/footer.css">
    <link rel="stylesheet" href="Vue/CSS/style.css">
    <title><?php echo htmlspecialchars($oeuvre['Titre']); ?></title>
    <script src="Vue/JS/header.js" defer></script>
    <script src="Vue/JS/oeuvreattente.js" defer></script>
    <title>Attente Oeuvre</title>
</head>

<body>
    <header>
        <div class="logo"> <a href="./"><img src="images/logo.png"></a></div>

        <div class="ham-search-cote">
            <div class="hamburger-container">
                <img src="images/hamMenu.png" alt="Menu hamburger" id="ham-img" class="hamburger-image">
                <nav id="ham-menu" class="hamburgermenu">
                    <ul class="ham-menu-resp">
                        <li><a href="./">Accueil</a></li>
                        <li><a href="./ventes">Vente</a></li>
                        <li><a href="./exposes">Exposition</a></li>
                        <li><a href="./listenews">News</a></li>
                        <div class="favori2"> <a href="./favoris">❤️</a></div>
                        <div class="panier2"> <a href="./panier">🛒</a></div>
                        <?php
                        if ($connectUser === true) {
                            echo '<div class="dropdown2">
                                <div class="utilisateur2"> 👤 </div>
                                <div class="dropdown2-child">
                                    <a href="./profil">Mon profil</a>
                                    <a href="./solde">Mon solde</a>' .
                                (($userRole === true) ?
                                    '<a href="./listeoeuvreattente">Oeuvres en attente</a>
                                        <a href="./listeexposeattente">Exposés en attente</a>
                                        <a href="./dashboard">Tableau de bord</a>' : '') .
                                '<a class="deconnexion">Déconnexion</a>
                                </div>
                            </div>';
                        } else {
                            echo '<div class="utilisateur2"><a href="./connexion"> 👤 </a></div>';
                        }
                        ?>

                    </ul>
                </nav>
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
                    foreach ($users as $user_barre) {
                        echo '<option data-value="utilisateur_' . $user_barre["id_utilisateur"] . '" value="' . $user_barre["nom"] . ' ' . $user_barre["prenom"] . ' ' . $user_barre["id_utilisateur"] . ' (utilisateur)">';
                    }
                    foreach ($exposes as $expose_barre) {
                        echo '<option data-value="expose_' . $expose_barre["id_exhibition"] . '" value="' . $expose_barre["titre"] . ' ' . $expose_barre["id_exhibition"] . ' (exposé)">';
                    }
                    foreach ($oeuvres as $oeuvre_barre) {
                        echo '<option data-value="oeuvre_' . $oeuvre_barre["id_oeuvre"] . '" value="' . $oeuvre_barre["Titre"] . ' ' . $oeuvre_barre["auteur"] . ' ' . $oeuvre_barre["id_oeuvre"] . ' (Oeuvre)">';
                    }

                    ?>
                </datalist>
                <div class="favori"> <a href="./favoris">❤️</a></div>
                <div class="panier"> <a href="./panier">🛒</a></div>

                <?php
                if ($connectUser === true) {
                    echo '<div class="dropdown">
                                <div class="utilisateur"> 👤 </div>
                                <div class="dropdown-child">
                                    <a href="./profil">Mon profil</a>
                                    <a href="./solde">Mon solde</a>' .
                        (($userRole === true) ?
                            '<a href="./listeoeuvreattente">Oeuvres en attente</a>
                                        <a href="./listeexposeattente">Exposés en attente</a>
                                        <a href="./dashboard">Tableau de bord</a>' : '') .
                        '<a class="deconnexion">Déconnexion</a>
                                </div>
                            </div>';
                } else {
                    echo '<div class="utilisateur"><a href="./connexion"> 👤 </a></div>';
                }
                ?>


            </div>
        </div>

        <nav class="menu">
            <ul>
                <li><a href="./">Accueil</a></li>
                <li><a href="./ventes">Vente</a></li>
                <li><a href="./exposes">Exposition</a></li>
                <li><a href="./listenews">News</a></li>

            </ul>
        </nav>
        <div class="barre_recherche2">
            <input type="text" placeholder="Rechercher..." class="shearch">
            <datalist id="galeris-list">
                <?php
                foreach ($users as $user_barre) {
                    echo '<option data-value="utilisateur_' . $user_barre["id_utilisateur"] . '" value="' . $user_barre["nom"] . ' ' . $user_barre["prenom"] . ' ' . $user_barre["id_utilisateur"] . ' (utilisateur)">';
                }
                foreach ($exposes as $expose_barre) {
                    echo '<option data-value="expose_' . $expose_barre["id_exhibition"] . '" value="' . $expose_barre["titre"] . ' ' . $expose_barre["id_exhibition"] . ' (exposé)">';
                }
                foreach ($oeuvres as $oeuvre_barre) {
                    echo '<option data-value="oeuvre_' . $oeuvre_barre["id_oeuvre"] . '" value="' . $oeuvre_barre["Titre"] . ' ' . $oeuvre_barre["auteur"] . ' ' . $oeuvre_barre["id_oeuvre"] . ' (Oeuvre)">';
                }

                ?>
            </datalist>
            <div class="favori"> <a href="./favoris">❤️</a></div>
            <div class="panier"> <a href="./panier">🛒</a></div>

            <?php
            if ($connectUser === true) {
                echo '<div class="dropdown">
                            <div class="utilisateur"> 👤 </div>
                            <div class="dropdown-child">
                                <a href="./profil">Mon profil</a>
                                <a href="./solde">Mon solde</a>' .
                    (($userRole === true) ?
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
                        <?php foreach ($oeuvre['chemin_image'] as $index => $chemin): ?>
                            <img src="./<?php echo htmlspecialchars($chemin); ?>"
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

        </section>

        <!-- Droite : Informations supplémentaires -->
        <section class="droite">
            <section class="profil-section">
                <div class="profil-info">
                    <?php echo '<input type="hidden" id="id_utilisateur" name="id_utilisateur" value="' . $oeuvre["id_utilisateur"] . '">'; ?>
                    <img src="./<?php echo $oeuvre['profil'] ?? 'ImageBD/Profil/avatarbasique.jpg'; ?>"
                        alt="Photo de profil" class="photo-profil">
                    <div class="profil-nom">
                        <strong>Vendeur :
                            <?php echo htmlspecialchars($oeuvre['nom']) . " " . htmlspecialchars($oeuvre['prenom']); ?></strong>
                    </div>
                </div>
            </section>

            <section class="info-prix">
                <div class="prix">
                    <span><strong>Auteur :</strong> <?php echo htmlspecialchars($oeuvre['auteur']) ?></span><br><br>
                    <span><strong>Prix :</strong> € <?php echo number_format($oeuvre['Prix'], 2, ',', ' '); ?></span>
                    <p><small>Publié le : <?php echo htmlspecialchars($oeuvre['Date_debut']); ?></small></p>
                    <?php
                    if ($oeuvre["eco_responsable"] === 1) {
                        echo "<p><small class='eco'>Oeuvre éco-responsable</small></p>";
                        echo "<a href=" . $oeuvre['oeuvre_file'] . " download='fichier'>Fichier justificatif</a>";
                    }
                    ?>
                </div>
            </section>

            <!-- Boutons d'actions -->
            <section class="actions">
                <input type="hidden" id="id_oeuvre" name="id_oeuvre" value="<?php echo $oeuvre["id_oeuvre"] ?>">
                <button class="boutton-valider">Accepter</button>
                <button class="boutton-refuse">Refuser</button>
            </section>
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
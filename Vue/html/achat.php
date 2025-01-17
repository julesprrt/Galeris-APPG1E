<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Vue/CSS/acheter.css">
    <link rel="stylesheet" href="Vue/CSS/header.css">
    <link rel="stylesheet" href="Vue/CSS/footer.css">
    <link rel="stylesheet" href="Vue/CSS/style.css">
    <script src="Vue/JS/achat.js" defer></script>
    <script src="Vue/JS/header.js" defer></script>
    <title><?php echo htmlspecialchars($oeuvre['Titre']); ?></title>
    <title>Page d'Achat</title>
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
                                    '<a id="deconnexion">Déconnexion</a>
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

    <div class="signaler-form">
        <div class="btn-close-container">
            <button class="signaler-close-button" type="submit">X</button>
        </div>
        <p class="title-signaler">Signaler une oeuvre</p>
        <textarea type="text" class="input-signalement" cols="30" rows="10" name="signalement" placeholder="Raison : 25 caractères minimum"></textarea>
        <br>
        <p class="error"></p>
        <br>
        <div class="btn-container">
            <button id="btnSignaler" type="submit">Signaler</button>
        </div>
    </div>

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

                <div class="carousel-container2">

                    <div class="art-image">
                        <?php foreach ($oeuvre['chemin_image'] as $index => $chemin): ?>
                            <img src="./<?php echo htmlspecialchars($chemin); ?>"
                                class="carousel-image <?php echo $index === 0 ? 'active' : ''; ?>"
                                alt="Image de <?php echo htmlspecialchars($oeuvre['Titre']); ?>">
                        <?php endforeach; ?>
                    </div>
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
                    <img src="./<?php echo $oeuvre['profil'] ?? 'ImageBD/Profil/avatarbasique.jpg'; ?>" alt="Photo de profil" class="photo-profil ">

                    <div class="profil-nom">
                        <strong>Vendeur : <?php echo htmlspecialchars($oeuvre['nom']) . " " . htmlspecialchars($oeuvre['prenom']); ?></strong>
                    </div>
                </div>
            </section>

            <section class="info-prix">
                <div class="prix">
                    <span><strong>Auteur :</strong> <?php echo htmlspecialchars($oeuvre['auteur']) ?></span><br><br>
                    <?php if ($oeuvre['est_vendu'] == 0): ?>
                        <span><strong>Prix :</strong> <?php echo number_format($oeuvre['Prix'], 2, ',', ' '); ?> € </span>
                        <p><small>Publié le : <?php echo htmlspecialchars($oeuvre['Date_debut']); ?></small></p>
                        <p><small class="temps-restant" data-fin="<?php echo $oeuvre["Date_fin"] ?>">Temps restant : </small></p>
                    <?php else: ?>
                        <span><strong>Prix vendu : <?php echo number_format($oeuvre['Prix'], 2, ',', ' '); ?> €</strong></span>
                        <?php if (isset($oeuvre['Date_vente'])): ?>
                            <p><small>Vendu le : <?php echo htmlspecialchars($oeuvre['Date_vente']); ?></small></p>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php
                    if ($oeuvre["eco_responsable"] === 1) {
                        echo "<p><small class='eco'>Oeuvre éco-responsable</small></p>";
                        echo "<a href=" . $oeuvre['oeuvre_file'] .  " download='fichier'>Fichier justificatif</a>";
                    }
                    ?>
                </div>
            </section>

            <!-- Avant la section actions -->
            <input type="hidden" name="id_oeuvre" value="<?php echo $oeuvre['id_oeuvre']; ?>">

            <!-- Boutons d'actions -->
            <section class="actions">
                <?php if ($oeuvre['est_vendu'] == 0): ?>
                    <?php
                    if (new DateTime() < new DateTime($oeuvre["Date_fin"])) {
                        if ($user || $userRole) {
                            echo '<button class="boutton-supprimer">Supprimer</button>';
                        } else {
                            if ($panier === false) {
                                echo '<button class="boutton-panier">Ajouter au Panier</button>';
                            } else {
                                echo '<button class="boutton-retirer-panier">Retirer du Panier</button>';
                            }
                            if($favoris === false){
                                echo '<button class="boutton-favoris">Ajouter au favoris</button>';
                            }
                            else{
                                echo '<button class="boutton-retirer-favoris">Retirer favoris</button>';
                            }
                            
                        }
                    }
                    ?>
                <?php endif; ?>

                <!-- bouton signaler -->
                <button id="btnSignaleropenform" data-oeuvre-id=<?php echo $oeuvre['id_oeuvre'] ?>>Signaler cette œuvre</button>
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
            <!-- Correction orthographique -->
            <a class="item-footer" href="./cgu">Conditions d'utilisation</a>
            <a class="item-footer" href="./mentionslegales">Mentions légales</a>
        </div>
    </footer>
</body>

</html>
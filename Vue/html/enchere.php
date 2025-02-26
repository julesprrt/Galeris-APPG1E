<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($oeuvre['Titre']) ?> </title>

    <link rel="stylesheet" href="Vue/CSS/enchere.css">
    <link rel="stylesheet" href="Vue/CSS/style.css">
    <link rel="stylesheet" href="Vue/CSS/header.css">
    <link rel="stylesheet" href="Vue/CSS/footer.css">
    <script src="Vue/JS/enchere.js" defer></script>
    <script src="Vue/JS/header.js" defer></script>
</head>

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
                                        <a href="./listeexposeattente">Expositions en attente</a>
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
                                        <a href="./listeexposeattente">Expositions en attente</a>
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
                                    <a href="./listeexposeattente">Expositions en attente</a>
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

<body>
    <div class="enchere-form">
        <div class="btn-close-container">
            <button class="close-button" type="submit">X</button>
        </div>
        <p class="title-enchere">Place ton enchère</p>
        <input type="text" class="input-enchere" name="enchere" placeholder="Enchere" value="" min="" />
        <br>
        <p class="error"></p>
        <br>
        <div class="btn-container">
            <button class="enchere-button" type="submit">Enchérir</button>
        </div>
    </div>

    <div class="signaler-form">
        <div class="btn-close-container">
            <button class="signaler-close-button" type="submit">X</button>
        </div>
        <p class="title-signaler">Signaler une oeuvre</p>
        <textarea type="text" class="input-signalement" cols="30" rows="10" name="signalement"
            placeholder="Raison : 25 caractères minimum"></textarea>
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
                    <button class="carousel-fleche gauche cfg">&#10094;</button>
                    <div class="art-image">
                        <?php foreach ($oeuvre['chemin_image'] as $index => $chemin): ?>
                            <img src="./<?php echo htmlspecialchars($chemin); ?>"
                                class="carousel-image <?php echo $index === 0 ? 'active' : ''; ?>"
                                alt="Image de <?php echo htmlspecialchars($oeuvre['Titre']); ?>">
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-fleche droite cfd">&#10095;</button>
                </div>
                <div class="art-info">
                    <h1><?php echo htmlspecialchars($oeuvre['Titre']); ?></h1>
                    <p><?php echo nl2br(htmlspecialchars($oeuvre['Description'])); ?></p>
                </div>
            </section>
        </section>

        <section class="droite">
            <section class="profil-section">
                <div class="profil-info">
                    <?php echo '<input type="hidden" id="id_utilisateur" name="id_utilisateur" value="' . $oeuvre["id_utilisateur"] . '">'; ?>
                    <img src="./<?php echo $oeuvre['profil'] ?? 'ImageBD/Profil/avatarbasique.jpg'; ?>"
                        alt="Photo de profil" class="photo-profil">
                    <div class="profil-nom">
                        <strong>Vendeur :
                            <?php echo htmlspecialchars($oeuvre['nom']) . " " . htmlspecialchars($oeuvre['prenom']); ?>
                        </strong>
                    </div>
                </div>
            </section>
            <section class="info-prix">
                <div class="prix">
                    <?php
                    if ($oeuvre['prix_courant'] !== null) {
                        echo "<span><strong>Prix actuel : " . $oeuvre['prix_courant'] . " € </strong></span>";
                    } else {
                        echo "<span><strong>Prix actuel : " . $oeuvre['Prix'] . " € </strong></span>";
                    }
                    ?>
                    <p><small>Publié le : <?php echo htmlspecialchars($oeuvre['Date_debut']); ?></small></p>
                    <p><small class="temps-restant" data-fin="<?php echo $oeuvre["Date_fin"] ?>">Temps restant :</small></p>
                    <?php
                    if ($oeuvre["prenom_offreur"] !== null) {
                        echo "<p>Offreur : " . htmlspecialchars($oeuvre['nom_offreur']) . ' '
                            . htmlspecialchars($oeuvre['prenom_offreur']) . "</p>";
                    }
                    ?>
                    <?php
                    if ($oeuvre["eco_responsable"] === 1) {
                        echo "<p><small class='eco'>Oeuvre éco-responsable</small></p>";
                        echo "<a href=" . $oeuvre['oeuvre_file'] . " download='fichier'>Fichier justificatif</a>";
                    }
                    ?>
                </div>
            </section>
            <section class="actions">
                <?php
                if ($user || $userRole) {
                    echo '<button class="boutton-supprimer">Supprimer</button>';
                } else {
                    echo '<button class="boutton-offre">Enchérir</button>';
                    if ($favoris === false) {
                        echo '<button class="boutton-favoris">Ajouter au favoris</button>';
                    } else {
                        echo '<button class="boutton-retirer-favoris">Retirer du Favoris</button>';
                    }
                }
                ?>
                <button id="btnSignaleropenform">Signaler cette œuvre</button>
            </section>
            <?php
            if ($encheres->num_rows > 0) {
                echo "<table class='table-enchere'>
                    <caption class='enchere'>Enchères</caption>
                    <thead>
                        <tr>
                            <th>Offreur</th>
                            <th colspan='2'>Prix</th>
                            <th>Date enchère</th>
                        </tr>
                    </thead>
                    <tbody>";
                foreach ($encheres as $enchere) {
                    echo "<tr>
                        <td>" . $enchere["nom"] . " " . $enchere["prenom"] . "</td>
                        <td colspan='2'>" . $enchere["prix"] . " €</td>
                        <td>" . $enchere["date_enchere"] . "</td>
                        </tr>";
                }
                echo "</tbody>
                </table>";
            } else {
                echo "<strong>Aucune enchères</strong>";
            }
            ?>
        </section>
    </main>
</body>

<footer>
    <div class="social-network">
        <a href="#"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M14.2737 10.1635L23.2023 0H21.0872L13.3313 8.82305L7.14125 0H0L9.3626 13.3433L0 24H2.11504L10.3002 14.6806L16.8388 24H23.98M2.8784 1.5619H6.12769L21.0856 22.5148H17.8355"
                    fill="#1E1E1E" />
            </svg></a>
        <a href="#"><svg width="20" height="20" viewBox="0 0 25 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12.98 2.163C16.184 2.163 16.564 2.175 17.83 2.233C21.082 2.381 22.601 3.924 22.749 7.152C22.807 8.417 22.818 8.797 22.818 12.001C22.818 15.206 22.806 15.585 22.749 16.85C22.6 20.075 21.085 21.621 17.83 21.769C16.564 21.827 16.186 21.839 12.98 21.839C9.77598 21.839 9.39598 21.827 8.13098 21.769C4.87098 21.62 3.35998 20.07 3.21198 16.849C3.15398 15.584 3.14198 15.205 3.14198 12C3.14198 8.796 3.15498 8.417 3.21198 7.151C3.36098 3.924 4.87598 2.38 8.13098 2.232C9.39698 2.175 9.77598 2.163 12.98 2.163ZM12.98 0C9.72098 0 9.31298 0.014 8.03298 0.072C3.67498 0.272 1.25298 2.69 1.05298 7.052C0.99398 8.333 0.97998 8.741 0.97998 12C0.97998 15.259 0.99398 15.668 1.05198 16.948C1.25198 21.306 3.66998 23.728 8.03198 23.928C9.31298 23.986 9.72098 24 12.98 24C16.239 24 16.648 23.986 17.928 23.928C22.282 23.728 24.71 21.31 24.907 16.948C24.966 15.668 24.98 15.259 24.98 12C24.98 8.741 24.966 8.333 24.908 7.053C24.712 2.699 22.291 0.273 17.929 0.073C16.648 0.014 16.239 0 12.98 0ZM12.98 5.838C9.57698 5.838 6.81798 8.597 6.81798 12C6.81798 15.403 9.57698 18.163 12.98 18.163C16.383 18.163 19.142 15.404 19.142 12C19.142 8.597 16.383 5.838 12.98 5.838ZM12.98 16C10.771 16 8.97998 14.21 8.97998 12C8.97998 9.791 10.771 8 12.98 8C15.189 8 16.98 9.791 16.98 12C16.98 14.21 15.189 16 12.98 16ZM19.386 4.155C18.59 4.155 17.945 4.8 17.945 5.595C17.945 6.39 18.59 7.035 19.386 7.035C20.181 7.035 20.825 6.39 20.825 5.595C20.825 4.8 20.181 4.155 19.386 4.155Z"
                    fill="#1E1E1E" />
            </svg>
        </a>
        <a href="#"><svg width="20" height="20" viewBox="0 0 25 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M20.595 3.184C16.991 2.938 8.96398 2.939 5.36498 3.184C1.46798 3.45 1.00898 5.804 0.97998 12C1.00898 18.185 1.46398 20.549 5.36498 20.816C8.96498 21.061 16.991 21.062 20.595 20.816C24.492 20.55 24.951 18.196 24.98 12C24.951 5.815 24.496 3.451 20.595 3.184ZM9.97998 16V8L17.98 11.993L9.97998 16Z"
                    fill="#1E1E1E" />
            </svg>
        </a>
        <a href="#"><svg width="20" height="20" viewBox="0 0 25 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19.98 0H5.97998C3.21898 0 0.97998 2.239 0.97998 5V19C0.97998 21.761 3.21898 24 5.97998 24H19.98C22.742 24 24.98 21.761 24.98 19V5C24.98 2.239 22.742 0 19.98 0ZM8.97998 19H5.97998V8H8.97998V19ZM7.47998 6.732C6.51398 6.732 5.72998 5.942 5.72998 4.968C5.72998 3.994 6.51398 3.204 7.47998 3.204C8.44598 3.204 9.22998 3.994 9.22998 4.968C9.22998 5.942 8.44698 6.732 7.47998 6.732ZM20.98 19H17.98V13.396C17.98 10.028 13.98 10.283 13.98 13.396V19H10.98V8H13.98V9.765C15.376 7.179 20.98 6.988 20.98 12.241V19Z"
                    fill="#1E1E1E" />
            </svg>
        </a>
    </div>
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

</html>
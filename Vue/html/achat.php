<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Vue/CSS/achat.css">
    <link rel="stylesheet" href="Vue/CSS/header.css">
    <link rel="stylesheet" href="Vue/CSS/footer.css">
    <link rel="stylesheet" href="Vue/CSS/style.css">
    <script src="Vue/JS/achat.js" defer></script>
    <title><?php echo htmlspecialchars($oeuvre['Titre']); ?></title>
    <script src="Vue/JS/header.js" defer></script>
    <title>Page d'Achat</title>
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
                <li><a href="#">Plus</a></li>
            </ul>
        </nav>
        <div class="barre_recherche">
            <input type="text" placeholder="Rechercher...">
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
                                    <a href="./listeexposeattente">Exposés en attente</a>' : "") .
                    '<a id="deconnexion">Déconnexion</a>
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



                <div class="art-info">
                    <h1><?php echo htmlspecialchars($oeuvre['Titre']); ?></h1>
                    <p><?php echo nl2br(htmlspecialchars($oeuvre['Description'])); ?></p>
                </div>
            </section>

            <!-- Section : Œuvres similaires -->
            <section class="art-image-similaire">
                <h2>Oeuvres similaires</h2>
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
                    <img src="images/photodeprofil.jpg" alt="Photo de profil" class="photo-profil">
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

            <!-- Avant la section actions -->
            <input type="hidden" name="id_oeuvre" value="<?php echo $oeuvre['id_oeuvre']; ?>">

            <!-- Boutons d'actions -->
             
            <section class="actions">
                
                <?php
                    if($user || $userRole){
                        echo '<button class="boutton-modifier">Modifier</button>
                        <button class="boutton-supprimer">Supprimer</button>';
                    }
                    else{
                        
                        if($panier === false){
                            echo '<button class="boutton-panier">Ajouter au Panier</button>';
                        }
                        else{
                            echo '<button class="boutton-retirer-panier">Retirer du Panier</button>';
                        }
                     
                        if($favoris === false){   
                            echo '<button class="boutton-favoris">Ajouter au favoris</button>';
                        }
                        else{
                            echo '<button class="boutton-retirer-favoris">Retirer du Favoris</button>';
                        }
                    }
                ?>

                <!-- bouton signaler -->
                <button id="btnSignaleropenform" data-oeuvre-id=<?php echo $oeuvre['id_oeuvre']?>>Signaler cette œuvre</button>
            </section>
        </section>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container-footer">
            <a class="title-footer">Qui sommes-nous ?</a>
            <a class="item-footer" href="#">NovArt</a>
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
            <a class="item-footer" href="#">Mentions légales</a>
        </div>
    </footer>
</body>

</html>
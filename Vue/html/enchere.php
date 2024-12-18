<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($oeuvre['Titre']) ?> </title>
    <base href="/Galeris-APPG1E/Vue/">
    <link rel="stylesheet" href="CSS/enchere.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<header>
<div class="logo"> <img src="../images/logo.png"></div>
            <nav class="menu">
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Vente</a></li>
                    <li><a href="#">Exposition</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Plus</a></li>
                </ul>
            </nav>
            <div class="barre_recherche">
                <!-- Barre de recherche, les emojis sont responsives si on clique dessus -->
                <input type="text" placeholder="Rechercher...">
                <div class="favori"> <a href="favoris.html">❤️ </a></div>
                <div class="panier"> <a href="panier.html"> 🛒 </a></div>
                <div class="utilisateur"><a href="panier.html"> 👤 </a></div>
            </div>
</header>
<body>
<main>
    <div class="container">
        <div class="gauche">
            <h1><?php echo htmlspecialchars($oeuvre['Titre']); ?></h1>
            <p>Lot : <?= htmlspecialchars($oeuvre['id_oeuvre']) ?> | <?= htmlspecialchars($oeuvre['auteur'])?> </p>
            <div class="main-image">
                
            <?php foreach ($oeuvre['chemin_image'] as $index => $chemin): ?>
                            <img src="../<?php echo htmlspecialchars($chemin); ?>"
                                alt="Image de <?php echo htmlspecialchars($oeuvre['Titre']); ?>">
                        <?php endforeach; ?>

            </div>
            <p class="image-caption">Cliquez sur l'image pour l'agrandir</p>
            
            <div class="thumbnail-gallery">
                    <?php foreach ($oeuvre['chemin_image'] as $index => $chemin): ?>
                        <img src="../<?php echo htmlspecialchars($chemin); ?>"
                            alt="Image de <?php echo htmlspecialchars($oeuvre['Titre']); ?>">
                    <?php endforeach; ?>

                    <?php foreach ($oeuvre['chemin_image'] as $index => $chemin): ?>
                        <img src="../<?php echo htmlspecialchars($chemin); ?>"
                            alt="Image de <?php echo htmlspecialchars($oeuvre['Titre']); ?>">
                    <?php endforeach; ?>

                    <?php foreach ($oeuvre['chemin_image'] as $index => $chemin): ?>
                        <img src="../<?php echo htmlspecialchars($chemin); ?>"
                            alt="Image de <?php echo htmlspecialchars($oeuvre['Titre']); ?>">
                    <?php endforeach; ?>
            </div>

            <div class="description">
                <h2>À propos de ce lot</h2>
                <p><?= htmlspecialchars($oeuvre['Description']) ?></p>
            </div>
        </div>

        <div class="droite">
            <div class="auction-info">
                <p>A ouvert : <?= htmlspecialchars($oeuvre['Date_debut']) ?> </p>
                
                <p>Se ferme dans :<?= htmlspecialchars($oeuvre['Date_fin']) ?></p>
                
                <p>Prix actuel</p>
                <p class="prixActuel"><?= number_format($oeuvre['Prix'], 2, ',', ' ') ?> €</p>
                <button class="encherir">Enchérir</button>
                <button class="partager">Partager</button>
                <br>
                <hr>
                <div class="separer">
                    <p class="balise" > Offre(s) : 15 </p> <p class=balise> Date</p>
                </div>

                <div class="separer_offre">
                    <div class="offre">
                        <p>75 €</p>
                        <p>2024-12-17 10:10:15</p>
                    </div>
                    <div class="offre">
                        <p>75 €</p>
                        <p>2024-12-17 10:10:15</p>
                    </div>
                    <div class="offre">
                        <p>75 €</p>
                        <p>2024-12-17 10:10:15</p>
                    </div>
                    <div class="offre">
                        <p>75 €</p>
                        <p>2024-12-17 10:10:15</p>
                    </div>
                </div>

<div>
    
Voir toutes les offres 
                    </div>
</main> 
</body>


<footer>
 <!-- icones réseaux sociaux -->
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

            <!-- infos footer (aide, contact ...) -->
            <div class="container-footer">
                <a class="title-footer">Qui sommes nous</a>
                <a class="item-footer" href="#">NovArt</a>
                <a class="item-footer" href="#">Galeris</a>
            </div>
            <div class="container-footer">
                <a class="title-footer">Aide</a>
                <a class="item-footer" href="#">Foire aux questions</a>
                <a class="item-footer" href="#">Contacts</a>
            </div>
            <div class="container-footer">
                <a class="title-footer">Informations légales</a>
                <a class="item-footer" href="#">Conditions d'utilisations</a>
                <a class="item-footer" href="#">Mentions légales</a>
            </div>


</footer>
</html>
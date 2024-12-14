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
    <title>Page d'Achat</title>
</head>

<body>
    <header>
        <div class="logo"><a href="https://galeris/Galeris-APPG1E/"> <img width="150" height="150" src="../images/logo-sans-fond.png" src="../images/logo.png"></a></div>
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
            <!-- Barre de recherche, les emojis sont responsives si on clique dessus -->
            <input type="text" placeholder="Rechercher...">
            <div class="favori"> <a href="favoris.html">❤️ </a></div>
            <div class="panier"> <a href="panier.html"> 🛒 </a></div>
            <div class="utilisateur"><a href="https://galeris/Galeris-APPG1E/profil"> 👤 </a></div>
        </div>
    </header>

    <main>
        <section class="gauche">
            <section class="art-details">
                <div class="carousel-container">
                    <!-- Flèche gauche -->
                    <button class="carousel-fleche gauche cfg">&#10094; <!-- Les nombres chelous represente la flèche en Unicode --> </button>

                    <!-- Images que on va faire défiler avec les flèches, pour l'instant juste des exemples.-->
                    <div class="art-image">
                        <img src="..\images\oeuvre1-1.jpg" class="carousel-image active" alt="Photo Oeuvre 1"> <!-- La classe active est pour dire que c'est l'image affichée. -->
                        <img src="..\images\oeuvre1-2.jpg" class="carousel-image" alt="Photo Oeuvre 2">
                        <img src="..\images\oeuvre1-3.jpg" class="carousel-image" alt="Photo Oeuvre 3">
                    </div>

                    <!-- Flèche droite -->
                    <button class="carousel-fleche droite cfd">&#10095;</button>
                </div>

                <div class="art-info">
                    <h1>Peinture acrylique</h1>
                    <p>Peinte en 2020.<br>60 x 80 cm.</p>
                </div>
            </section>




            <section class="art-image-similaire">
                <!-- Voir comment faire pr afficher tableaux similaires, manque fonction en php -->
                <h2>Oeuvres similaires</h2>
                <div class="tableau-similaire">
                    <!-- A améliorer car les images renvoie à rien, alors c'est censé renvoyer à la page. -->
                    <img src="..\images\oeuvresim-1.png" alt="Tableau similaire 1">
                    <img src="..\images\oeuvresim-2.jpg" alt="Tableau similaire 2">
                    <img src="..\images\oeuvresim-3.jpg" alt="Tableau similaire 3">
                </div>
            </section>
        </section>

        <section class="droite">
            <section class="profil-section">
                <div class="profil-info">
                    <img src="https://via.placeholder.com/50" alt="Photo de profil" class="photo-profil">
                    <div class="profil-nom">
                        <!-- Tout est exemple ici, manque les fonctions PHP pour récupérer tout ce qui est nom, prix et tt les infos. -->
                        <strong>PIERRE PAUL</strong>
                    </div>
                    <div class="note">
                        ★★★★★<span class="valeur-note">4/5</span>
                        <!-- A améliorer, ici juste logo pour que le HTML sois beau pr l'instant, manque encore des infos à recup en PHP.-->
                    </div>
                </div>

                <div class="actions">
                    <button class="boutton-acheter">Acheter</button>
                    <button class="boutton-message-vendeur">Message</button>
                </div>

                <div class="info-prix">
                    <div class="prix">
                        <span>€ 100</span>
                        <!-- Prix de l'oeuvre, encore une fois, juste à titre d'exemple pr l'instant.  -->
                        <div class="réduction">Réduction 25%</div>
                        <!-- Ici par exemple, le 25 sera à recuperer dans le DB.-->
                        <p class="eco-info">Fait avec matériaux éco-responsables</p>
                    </div>
                </div>

                <div class="details">
                    <div class="publication">
                        <span>Publié le <strong>18/09/2024</strong></span>
                    </div>
                    <div class="livraison">
                        <span>Livraison à partir de <strong>2.99€</strong></span>
                    </div>
                </div>
            </section>


            <section class="map">
                <!-- Map ou on veut afficher l'endroit ou l'article est stocké.  A revoir pr l'instant juste pluggin Google Maps-->
                <div class="map-Maps">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.4667632450124!2d2.334453415674848!3d48.85950827928717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fc3e55aa8a1%3A0x7fcb8cf23a5d4f80!2sLouvre%20Museum!5e0!3m2!1sen!2sfr!4v1633345612345!5m2!1sen!2sfr"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </section>
        </section>
    </main>
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
            <a class="item-footer" href="https://galeris/Galeris-APPG1E/faq">Foire aux questions</a>
            <a class="item-footer" href="https://galeris/Galeris-APPG1E/contact">Contacts</a>
        </div>
        <div class="container-footer">
            <a class="title-footer">Informations légales</a>
            <a class="item-footer" href="https://galeris/Galeris-APPG1E/cgu">Conditions d'utilisations</a>
            <a class="item-footer" href="#">Mentions légales</a>
        </div>

    </footer>

    <script src="https://galeris/Galeris-APPG1E/vue/JS/achat.js"></script>
</body>

</html>
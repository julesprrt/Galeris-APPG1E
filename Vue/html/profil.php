<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Profil Utilisateur - Votre Projet</title>
    <link rel="stylesheet" href="../CSS/profil.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="https://galeris/Galeris-APPG1E/">
                <img src="../../images/logo.png" alt="Logo">
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
            <div class="utilisateur"><a href="https://galeris/Galeris-APPG1E/connexion">👤</a></div>
        </div>
    </header>


    <main>
        <section class="profil">
            <h2>Bienvenue, <?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?></h2>
            <div class="profil-info">
                <img src="images/avatar.png" alt="Photo de profil">
                <div class="details">
                    <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
                    <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
                    <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
                    <p><strong>Description :</strong> <?= htmlspecialchars($user['description'] ?? 'Non renseignée') ?></p>
                    <p><strong>Adresse :</strong> <?= htmlspecialchars($user['adresse'] ?? 'Non renseignée') ?></p>
                    <p><strong>Rôle :</strong> <?= htmlspecialchars($user['roles']) ?></p>
                    <p><strong>Date d'inscription :</strong> <?= htmlspecialchars($user['date_creation']) ?></p>
                    <p><strong>Inscrit à la newsletter :</strong> <?= $user['newsletter'] ? 'Oui' : 'Non' ?></p>
                </div>
            </div>
            <div class="actions">
                <a href="editionprofil.html" class="btn">Modifier le Profil</a>
            </div>
        </section>
    </main>

    <footer>
        <div class="social-network">
            <a href="#"><svg width="20" height="20" viewBox="0 0 24 24">
                    <path d="..." />
                </svg></a>
            <a href="#"><svg width="20" height="20" viewBox="0 0 25 24">
                    <path d="..." />
                </svg></a>
            <a href="#"><svg width="20" height="20" viewBox="0 0 25 24">
                    <path d="..." />
                </svg></a>
            <a href="#"><svg width="20" height="20" viewBox="0 0 25 24">
                    <path d="..." />
                </svg></a>
        </div>
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
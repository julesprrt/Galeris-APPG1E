<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modification de Profil</title>
    <link rel="stylesheet" href="../CSS/editionprofil.css">
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
            <h2>Modification de votre profil</h2>

            <!-- Affichage d'un message d'erreur si nécessaire -->
            <?php if (isset($error) && !empty($error)) : ?>
                <div class="error-message">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/Galeris-APPG1E/process-edition" method="POST" class="profil-form">
                <div class="profil-info">
                    <img src="images/avatar.png" alt="Photo de profil">
                    <div class="details">
                        <p>
                            <strong>Nom :</strong>
                            <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
                        </p>
                        <p>
                            <strong>Prénom :</strong>
                            <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
                        </p>
                        <p>
                            <strong>Email :</strong>
                            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                        </p>
                        <p>
                            <strong>Description :</strong>
                            <textarea name="description" rows="3" placeholder="Parlez un peu de vous..."><?= htmlspecialchars($user['description'] ?? '') ?></textarea>
                        </p>
                        <p>
                            <strong>Adresse :</strong>
                            <input type="text" name="adresse" value="<?= htmlspecialchars($user['adresse'] ?? '') ?>">
                        </p>
                    </div>
                </div>

                <h3>Modification du mot de passe</h3>
                <div class="password-section">
                    <p>
                        <strong>Ancien mot de passe :</strong>
                        <input type="password" name="old_password" placeholder="Entrez votre ancien mot de passe" required>
                    </p>
                    <p>
                        <strong>Nouveau mot de passe :</strong>
                        <input type="password" name="new_password" placeholder="Au moins 8 caractères, 1 majuscule, 1 chiffre">
                    </p>
                    <p>
                        <strong>Confirmer le nouveau mot de passe :</strong>
                        <input type="password" name="confirm_password" placeholder="Répétez le nouveau mot de passe">
                    </p>
                </div>

                <div class="actions">
                    <button type="submit" class="btn">Enregistrer les modifications</button>
                    <a href="/Galeris-APPG1E/profil" class="btn">Annuler</a>
                </div>
            </form>
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
            <a class="item-footer" href="/Galeris-APPG1E/faq">Foire aux questions</a>
            <a class="item-footer" href="/Galeris-APPG1E/contact">Contacts</a>
        </div>
        <div class="container-footer">
            <a class="title-footer">Informations légales</a>
            <a class="item-footer" href="/Galeris-APPG1E/cgu">Conditions d'utilisation</a>
            <a class="item-footer" href="#">Mentions légales</a>
        </div>
    </footer>
</body>

</html>
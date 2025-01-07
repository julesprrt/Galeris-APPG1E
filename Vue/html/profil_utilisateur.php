<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Profil utilisateur</title>
    <base href="/Galeris-APPG1E/Vue/">
    <link rel="stylesheet" href="CSS/profil.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <script src="https://galeris/Galeris-APPG1E/vue/JS/header.js" defer></script>
</head>

<body>
    <header>
        <h1>Profil de <?= htmlspecialchars($user['prenom']) . ' ' . htmlspecialchars($user['nom']) ?></h1>
    </header>

    <main>
        <section class="profil">
            <img src="../<?= htmlspecialchars($user['photodeprofil'] ?? 'ImageBD/Profil/avatarbasique.jpg') ?>" alt="Photo de profil" class="profile-image">
            <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Description :</strong> <?= htmlspecialchars($user['description'] ?? 'Non renseignée') ?></p>
        </section>

        <section class="oeuvres">
            <h2>Œuvres publiées</h2>
            <?php if (!empty($oeuvres)) : ?>
                <ul>
                    <?php foreach ($oeuvres as $oeuvre) : ?>
                        <li>
                            <img src="../<?= htmlspecialchars($oeuvre['chemin_image']) ?>" alt="<?= htmlspecialchars($oeuvre['titre']) ?>" class="oeuvre-image">
                            <p><strong><?= htmlspecialchars($oeuvre['titre']) ?></strong></p>
                            <p><?= htmlspecialchars($oeuvre['description']) ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>Aucune œuvre publiée.</p>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>
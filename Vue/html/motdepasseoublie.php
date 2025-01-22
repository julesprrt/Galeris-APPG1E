<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de Passe Oublié</title>
    <link rel="stylesheet" href="Vue/CSS/mdp.css">
    <link rel="stylesheet" href="Vue/CSS/style.css">
    <script src="Vue/JS/oublieMotDePasse.js" defer></script>
</head>
<body>
<h1 class="simpleTitle">Mot de Passe Oublié</h1>
<a href="./"><img src="images/logo-sans-fond.png" alt="Logo de Galeris" style="display: block; margin: 0 auto;" ></a>
</header>
<main>
    <form>
        <p class="simpleText">Entrez l'adresse e-mail associée à votre compte. Un lien vous sera envoyé pour réinitialiser votre mot
            de passe.</p>
        <label class="simpleText" for="email">Adresse e-mail :</label>
        <input type="email" id="email" name="email" required>
        <button type="button" class="simpleText simpleButtonHover" id="btn-omdp">Réinitialiser le mot de passe</button>
    </form>
</main>
<footer>
    <p class="simpleText">&copy; Galeris. Tous droits réservés.</p>
</footer>
</body>

</html>
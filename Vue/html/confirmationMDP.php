<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="Vue/CSS/confirmationmdp.css">
    <script src="JS/confirmationmdp.js" defer></script>
</head>
<header>
    <h1>Nouveau Mot de Passe</h1>
    <a href="./html/accueil.php"><img src="images/logo-sans-fond.png" alt="Logo de Galeris" style="display: block; margin: 0 auto;" id="logogaleris"></a>
</header>
<main>
    <form>
        <p>Entrez l'adresse e-mail associée à votre compte et nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>
        <label for="text">Nouveau mot de passe :</label>
        <div class="inputContainer">
            <input type="password" id="passwordInput" class="passInput" name="MotDePasse" required>
            <div id="diveye">
                <img src="images/eyes.png" alt="Afficher mot de passe" id="showmdp" class="show-password inputpassword">
                <img src="images/eye.png" alt="Cacher mot de passe" id="hidemdp" class="hide-password inputpassword" style="display : none">
            </div>
        </div>

        <label for="text">Confirmation du mot de passe :</label>
        <div class="inputContainer">
            <input type="password" id="confPasswordInput" class="passInput" name="MotDePasse" required>
            <div id="diveye">
                <img src="images/eyes.png" alt="Afficher mot de passe" id="showmdp2" class="show-password">
                <img src="images/eye.png" alt="Cacher mot de passe" id="hidemdp2" class="hide-password" style="display : none">
            </div>
        </div>

        <button type="button" id="resetPass">Réinitialiser le mot de passe</button>
    </form>
</main>
<footer>
    <p>&copy; Galeris. Tous droits réservés.</p>
</footer>

</html>
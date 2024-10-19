<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de Passe Oublié</title>
    <base href="/Vue/">
    <link rel="stylesheet" href="\css\motdepasseoublie.css">
</head>
<header></header>
<h1>Mot de Passe Oublié</h1>
<a href="../html/accueil.html"><img src="..\..\images\logo.png" alt="Logo de Galeris" style="display: block; margin: 0 auto;" ></a>
</header>
<main>
    <form action="/reset-password" method="post">
        <p>Entrez l'adresse e-mail associée à votre compte et nous vous enverrons un lien pour réinitialiser votre mot
            de passe.</p>
        <label for="email">Adresse e-mail :</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Réinitialiser le mot de passe</button>
    </form>
</main>
<footer>
    <p>&copy; Galeris. Tous droits réservés.</p>
</footer>
</body>

</html>
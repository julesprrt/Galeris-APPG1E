<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Unique</title>
    <link rel="stylesheet" href="Vue/CSS/codeunique.css">
</head>

<body>
    <div class="container">
        <h1>Entrez le code à 6 chiffres</h1>
        <form>
            <div class="code-input">
                <input type="number" name="digit1" maxlength="1" required>
                <input type="number" name="digit2" maxlength="1" required>
                <input type="number" name="digit3" maxlength="1" required>
                <input type="number" name="digit4" maxlength="1" required>
                <input type="number" name="digit5" maxlength="1" required>
                <input type="number" name="digit6" maxlength="1" required>
            </div>
            <button type="button" class="valid-code"></button>
        </form>
        <div class="resendcode">
            <a class="link-resendCode" id="resendcode">Renvoyer le code ?</a>
        </div>
    </div>

    <script src="Vue/JS/codeunique.js"></script>
</body>

</html>
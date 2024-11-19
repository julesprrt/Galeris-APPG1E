<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Galeris</title>
    <base href="/Galeris-APPG1E/Vue/">
    <link href="CSS/codeunique.css" rel="stylesheet">
    <link href="CSS/footer.css" rel="stylesheet">
    <link href="CSS/style.css" rel="stylesheet">
    <title>Code Unique</title>
    <link rel="stylesheet" href="../CSS/codeunique.css">
</head>

<body>

    <div class="container">
        <h1>Entrez le code à 6 chiffres</h1>
        <form action="verify_code.php" method="post">
            <div class="code-input">
                <input type="text" name="digit1" maxlength="1" required>
                <input type="text" name="digit2" maxlength="1" required>
                <input type="text" name="digit3" maxlength="1" required>
                <input type="text" name="digit4" maxlength="1" required>
                <input type="text" name="digit5" maxlength="1" required>
                <input type="text" name="digit6" maxlength="1" required>
            </div>
            <button type="submit"></button>
        </form>
    </div>

    <script src="../JS/codeunique.js"></script>
</body>

</html>
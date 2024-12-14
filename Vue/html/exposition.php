<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exposition - Galeris</title>
    <base href="/Galeris-APPG1E/Vue/">
    <link href="CSS/exposition.css" rel="stylesheet">
    <script src="https://galeris/Galeris-APPG1E/vue/JS/exposition.js" defer></script>
</head>

<body>

<h2>HTML Forms</h2>

<form>
  <label for="title">Titre:</label><br>
  <input type="text" id="title" name="title" value=""required><br><br>

  <label for="date_debut">Date de début:</label><br>
  <input type="date" id="date_debut" name="date_debut" value=""required><br><br>

  <label for="date_fin">Date de fin:</label><br>
  <input type="date" id="date_fin" name="date_fin" value=""required><br><br>

  <label for="description">Description:</label><br>
  <input type="text" id="description" name="description" value=""><br><br>

  <button class="submit-button button-validation" type="button">Confirmer</button>
  </form> 

</body>
</html>


<html>
  <head>
    <title>Paièment réussie</title>
    <base href="/Galeris-APPG1E/Vue/">
    <link rel="stylesheet" href="CSS/successPayment.css">
    <script src="https://galeris/Galeris-APPG1E/vue/JS/successPayment.js" defer></script>
  </head>
    <body>
    <?php
      if ($connectUser !== true) {
        echo '<div><a href="https://galeris/Galeris-APPG1E/connexion"> </a></div>';
      }
    ?>
      <div class="card">
      <div class="success">
        <i class="checkmark">✓</i>
      </div>
        <h1>Merci pour votre achat</h1> 
        <a href="https://galeris/Galeris-APPG1E"><button class="btn-accueil">Accueil</button></a>
      </div>
    </body>
</html>
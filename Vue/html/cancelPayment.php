<html>
  <head>
    <title>Paièment réussie</title>
    <base href="/Galeris-APPG1E/Vue/">
    <link rel="stylesheet" href="CSS/cancelPayment.css">
    <script src="https://galeris/Galeris-APPG1E/vue/JS/cancelPayment.js" defer></script>
  </head>
    <body>
      <?php
        if ($connectUser !== true) {
          echo '<div><a href="https://galeris/Galeris-APPG1E/connexion"></a></div>';
        }
      ?>
      <div class="card">
      <div class="cancel">
        <i class="cancelmark">✘</i>
      </div>
        <h1>Echec, réessayer plus tard</h1> 
        <a href="https://galeris/Galeris-APPG1E"><button class="btn-accueil">Accueil</button></a>
      </div>
    </body>
</html>
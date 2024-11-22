<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <base href="/Galeris-APPG1E/Vue/">
    <link rel="stylesheet" href="CSS/contact.css">
    <link rel="stylesheet" href="CSS/style.css">
    <script src="http://localhost/Galeris-APPG1E/vue/JS/contact.js" defer></script>
    
</head>
<body class="h-screen">
    
    <section id="contact">
        
        <div class="container">
            <div class="">
                <p class="title6"> Une quesion ? Un conseil ?</p>
                <h3 class="title3"> Contactez-nous </h3>
            </div>
    
            <form>
                <input class="contact-input" type="text" name="firstName" placeholder="Prénom" required>
                <input class="contact-input" type="text" name="name" placeholder="Nom de famille" required>
                <input class="contact-input" type="text" name="email" placeholder="Adresse mail" required>
                <div id="div-select">
                        <select name="subject" id="object-select" required>
                        <option value="">--Choississez le sujet du message--</option>
                        <option value="problem">J'ai un problème</option>
                        <option value="information">Je souhaite demander une information</option>
                        <option value="bug">Je souhaite remonter un bug</option>
                        <option value="others">Autres</option>
                        </select>
                </div>
                <textarea class="contact-input" name="message" cols="30" rows="10" placeholder="Message"></textarea>
                <button type="button" id="btn-contact">Envoyer</button>
                <p class="error-message"></p>
            </form>
        </div>
    </section>



</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <base href="/Vue/">
    <link rel="stylesheet" href="CSS/contact.css">
    <link rel="stylesheet" href="CSS/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="JS/contact.js" defer></script>
    
</head>
<body class="h-screen">
    
    <section id="contact">
        
        <div class="container">
            <div class="">
                <h6 class="tilte6"> Une quesion ? Un conseil ?</h6>
                <h3 class="title3"> Contactez-nous </h3>
            </div>
    
            <form>
                <input type="text" name="firstName" placeholder="Prénom" required>
                <input type="text" name="name" placeholder="Nom de famille" required>
                <input type="text" name="email" placeholder="Adresse mail" required>
                <input type="text" name="subject" placeholder="Sujet du message" required>
                <textarea name="message" cols="30" rows="10" placeholder="Message"></textarea>
                <button type="button" id="btn-contact">Envoyer</button>
                <p class="error-message"></p>
            </form>
        </div>
    </section>



</body>
</html>
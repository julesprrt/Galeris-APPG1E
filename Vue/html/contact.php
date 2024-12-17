<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <base href="/Galeris-APPG1E/Vue/">
    <link rel="stylesheet" href="CSS/contact.css">
    <link rel="stylesheet" href="CSS/style.css">
    <script src="https://galeris/Galeris-APPG1E/vue/JS/contact.js" defer></script>

</head>

<body>
    <section id="contact">
        <div class="container">
                <p class="bigTitle6"> Une question ? Un conseil ?</p>
                <p class="bigTitle3"> Contactez-nous </p>


            <form>
                <input class="contact-input simpleInput" type="text" name="firstName" placeholder="Prénom" required>
                <input class="contact-input simpleInput" type="text" name="name" placeholder="Nom de famille" required>
                <input class="contact-input simpleInput" type="text" name="email" placeholder="Adresse mail" required>

                <select name="subject" id="object-select" required>
                    <option value="">--Choississez le sujet du message--</option>
                    <option value="problem">J'ai un problème</option>
                    <option value="information">Je souhaite demander une information</option>
                    <option value="bug">Je souhaite remonter un bug</option>
                    <option value="others">Autres</option>
                </select>

                <textarea class="contact-input" name="message" cols="30" rows="10" placeholder="Message"></textarea>
                <button type="button" id="btn-contact" class="smallButton">Envoyer</button>
                <p class="error-message"></p>
            </form>
        </div>
    </section>



</body>

</html>
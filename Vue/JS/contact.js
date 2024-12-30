document.getElementById("btn-contact").addEventListener('click', contact);




async function ConfirmationEmailTemplate (firstName, name) {

    const imagePath = '../../images/logo-sans-fond.png'

    return `
      <html>
        <head>
          <style>
            body {
              font-family: Arial, sans-serif;
              line-height: 1.6;
              margin: 0;
              padding: 0;
              background-color: #f0da8c;
              color: #4C4241 ;
              border-radius: 20px;
            }
            .header {
              text-align: center;
              font-family: mono;
              padding: 10px 0;
            }
            .footer {
              text-align: center;
              padding: 10px 0;
              font-size: 12px;
            }
            .content {
              padding: 20px;
            }
            img {
              
            }
          </style>


        </head>
        <body>

          <div class="header">
            <h1> Galeris </h1>
          </div>

          <div class="content">
            <p>Bonjour ${firstName} ${name},</p>
            <p>Nous vous confirmons la bonne réception de votre message.</p>
            <p>Nous vous répondrons dans les plus brefs délais.</p>
            <p>Bien cordialement,</p>
            <p>L'équipe Galeris</p>
          </div>
          <div class="footer">
            <img src="${imagePath}" alt="Logo Galeris" />
            <p>© 2024 Galeris. Tous droits réservés.</p>
          </div>
        </body>
      </html>
    `;



}




async function contact() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    console.log(document.getElementsByName("email")[0].value)
    const raw = JSON.stringify({
        "email": document.getElementsByName("email")[0].value,
        "firstName": document.getElementsByName("firstName")[0].value,
        "name": document.getElementsByName("name")[0].value,
        "subject": document.getElementsByName("subject")[0].value,
        "message": document.getElementsByName("message")[0].value
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    const confirmOptions = {
        method: "POST",
        to: document.getElementsByName("email").value,
        headers: myHeaders,
        body: ConfirmationEmailTemplate(),
        redirect: "follow"
    }

    const response = await fetch("http://localhost:80/Galeris-APPG1E/contact", requestOptions)
    const confResponse = await fetch("http://localhost:80/Galeris-APPG1E/contact", confirmOptions)
    const statuscode = response.status;
    const result = await response.json();
    const result2 = await confResponse.json();
    if(statuscode === 200){
        alert(result.Success);
        document.querySelector('.error-message').innerHTML = "";
        document.querySelectorAll('.contact-input').forEach((item)=> {
        item.value = "";
        ConfirmationEmailTemplate();
        })
        window.location.href = "http://localhost:80/Galeris-APPG1E/";
    }
    else{
        alert(result.Error);
        document.querySelector('.error-message').innerHTML = result.Error;
    }
}








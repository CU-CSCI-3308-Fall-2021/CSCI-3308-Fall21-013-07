<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact form tutorial</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link
        href="https://fonts.googleapis.com/css?family=Robot+Condensed: 400, 700" rel="stylesheet">
    </head>
    <body>
        <main>
            <p>SEND E-MAIL</p>
            <form action="contactform.php" method="POST" class="contact-form">
                <input type="text" name="name" placeholder="Full name">
                <input type="text" name="mail" placeholder="Your e-mail">
                <input type="text" name="subject" placeholder="Subject">
                <textarea name="message" placeholder="Message"></textarea>
                <button type="submit" name="submit">SEND MAIL</button>
            </form>
        </main>
    </body>
</html>
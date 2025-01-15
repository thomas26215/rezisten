<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Envoyé</title>
    <link rel="stylesheet" href="./view/design/motdepasseoublie.css">
    <link rel="stylesheet" href="./view/design/global.css">
</head>
<body>
    <?php include_once("./view/header.view.php")?>
    <main>
        <form method="post" class="formContainer">
            <h1>Email Envoyé</h1>
            <p class="texte">Nous avons envoyé un email d'activation à </p>
            <p class="texte">*mail de l'utilisateur*</p>
        
            <?php
            if (isset($message)) {
                echo "<p class='success'>$message</p>";
            }
            if (isset($error)) {
                echo "<p class='error'>$error</p>";
            }
            ?>

            <div class="formContainer">
                <p class="texte">Merci de renseigner le code ici :</p>
                <a href="">Page de vérification</a>
            </div>

            <div class="formContainer">
                <p>Vous n'avez pas reçu l'e-mail ?</p>
                <a class="lienVerif" href="">Renvoyer l'e-mail de vérification</a>
            </div>
        </form>
    </main>
    <?php include_once("./view/footer.view.php")?>
</body>
</html>

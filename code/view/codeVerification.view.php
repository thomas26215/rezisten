<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code vérification</title>
    <link rel="stylesheet" href="./design/motdepasseoublie.css">
    <link rel="stylesheet" href="./design/global.css">
</head>
<body>
    <?php include_once("./view/header.view.php")?>
    <form method="post" class="formContainer">
        <h1>Saisir votre code de vérification</h1>
        <p class="texte">Veuillez entrer le code qui vous a été envoyé par mail à l'adresse suivant :</p>
        <p class="texte">*mail utilisateur*</p>
    
        <?php
        if (isset($message)) {
            echo "<p class='success'>$message</p>";
        }
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <input type="text" id="codeVerification" name="codeVerification">

        <div class="formContainer">
            <p>Vous n'avez pas reçu l'e-mail ?</p>
            <a href="">Renvoyer l'e-mail de vérification</a>
        </div>
    </form>
    <?php include_once("./view/footer.view.php")?>
</body>
</html>

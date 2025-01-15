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
            <p class="texte" style="margin-bottom: 0px">Nous avons envoyé un email d'activation à </p>
            <h2 style="margin-top: 0px;"><?=$email?></h2>
        
            <?php
            if (isset($message)) {
                echo "<p class='success'>$message</p>";
            }
            if (isset($error)) {
                echo "<p class='error'>$error</p>";
            }
            ?>
            <div class="formContainer">
                <button style="color: red; margin-top: 80px;" class="lienVerif" name="send" value="newCode">Renvoyer l'e-mail de vérification</button>
            </div>
        </form>
    </main>
    <?php include_once("./view/footer.view.php")?>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="./view/design/motdepasseoublie.css">
    
</head>
<body>
    <?php include_once("./view/header.view.php")?>
    <main>
        <h1>Mot de passe oublié</h1>
        <p class="texte">Veuillez saisir votre email de connexion afin de recevoir le lien de réinitialisation de votre mot de passe.</p>
    
        <form action="">
            <div class="email">
                <label for="email">Email <span>*</span>: </label>
                <input placeholder="Saisir votre email" type="email" name="email" id="email">
            </div>
            
            <div class="buttons">
                <button>Demander un nouveau mot de passe</button>
                <a href="login.view.php">Retour à la page de connexion</a>
            </div>
        </form>
    </main>
    <?php include_once("./view/footer.view.php")?>
</body>
</html>
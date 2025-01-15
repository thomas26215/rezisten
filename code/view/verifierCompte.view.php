<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifier Compte</title>
    <link rel="stylesheet" href="./view/design/motdepasseoublie.css">
</head>
<body>
    <?php include_once("./view/header.view.php")?>
    <main>
        <h1>Vérifier Compte</h1>
        <p class="texte">Veuillez saisir votre email de connexion afin de recevoir le lien de réinitialisation de votre mot de passe.</p>
    
        <form class="motdepasse" action="">
            <div class="email">
                <label for="email">Code de vérification <span>*</span>: </label>
                <input placeholder="Saisir votre code de vérification" type="code" name="code" id="code">
            </div>
            <div class="email">
                <label for="email">Email <span>*</span>: </label>
                <input placeholder="Saisir votre email" type="email" name="email" id="email">
            </div>
            <div class="email">
                <label for="email">Mot de passe <span>*</span>: </label>
                <input placeholder="Saisir votre mot de passe" type="password" name="password" id="password">
            </div>
            
            <div class="buttons">
                <button>Vérifier compte</button>
                <a href="login.view.php">Retour à la page de connexion</a>
            </div>
        </form>
    </main>
    <?php include_once("./view/footer.view.php")?>
</body>
</html>
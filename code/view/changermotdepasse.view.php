<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer mot de passe</title>
    <link rel="stylesheet" href="./view/design/motdepasseoublie.css">
    
</head>
<body>
    <?php include_once("header.view.php")?>
    <main>
        <h1>Changer le mot de passe</h1>
    
        <form action="">
            <div class="formContainer">
                <div class="email">
                    <label for="email">Email <span>*</span>: </label>
                    <input placeholder="Saisir votre email" type="email" name="email" id="email">
                </div>
                <div class="email">
                    <label for="email">Code reçu par mail <span>*</span>: </label>
                    <input placeholder="Ex: 1234" type="email" name="email" id="email">
                </div>
                <div class="email">
                    <label for="email">Nouveau mot de passe <span>*</span>: </label>
                    <input placeholder="*****" type="email" name="email" id="email">
                </div>
                <div class="email">
                    <label for="email">Confirmer nouveau mot de passe <span>*</span> : </label>
                    <input placeholder="*****" type="email" name="email" id="email">
                </div>
            </div>
            
            <div class="buttons">
                <button>Changer mot de passe</button>
                <a href="login.view.php">Retour à la page de connexion</a>
            </div>
        </form>
    </main>
    <?php include_once("footer.view.php")?>
</body>
</html>
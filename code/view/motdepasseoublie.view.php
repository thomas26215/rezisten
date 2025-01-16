<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="./view/design/motdepasseoublie.css">
</head>
<body>
    <?php include_once("./view/header.view.php") ?>
    <main>
        <h1>Mot de passe oublié</h1>
        <p class="texte">Veuillez saisir votre email de connexion afin de recevoir le lien de réinitialisation de votre mot de passe.</p>
    
        <?php if (!empty($message)): ?>
            <p class="success"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" class="motdepasse">
            <div class="email">
                <label for="email">Email <span>*</span>: </label>
                <input placeholder="adresse mail" type="email" name="email" id="email" required>
            </div>
            
            <div class="buttons">
                <button type="submit" name="send">Demander un nouveau mot de passe</button>
                <a href="index.php">Retour à la page de connexion</a>
            </div>
        </form>
    </main>
    <?php include_once("./view/footer.view.php") ?>
</body>
</html>


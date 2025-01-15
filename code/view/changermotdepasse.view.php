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

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($successMessage)): ?>
            <div class="success">
                <p><?php echo htmlspecialchars($successMessage); ?></p>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="motdepasse">
            <div class="formContainer">
                <div class="email">
                    <label for="email">Email <span>*</span>: </label>
                    <input placeholder="Saisir votre email" type="email" name="email" id="email" required>
                </div>
                <div class="email">
                    <label for="code">Code reçu par mail <span>*</span>: </label>
                    <input placeholder="Code" type="text" name="code" id="code" required>
                </div>
                <div class="email">
                    <label for="new_password">Nouveau mot de passe <span>*</span>: </label>
                    <input placeholder="*****" type="password" name="new_password" id="new_password" required>
                </div>
                <div class="email">
                    <label for="confirm_password">Confirmer nouveau mot de passe <span>*</span>: </label>
                    <input placeholder="*****" type="password" name="confirm_password" id="confirm_password" required>
                </div>
            </div>

            <div class="buttons">
                <button type="submit">Changer mot de passe</button>
                <a href="login.view.php">Retour à la page de connexion</a>
            </div>
        </form>
    </main>
    <?php include_once("footer.view.php")?>
</body>
</html>

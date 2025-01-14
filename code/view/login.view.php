<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <title>Se connecter</title>
    <link rel="stylesheet" href="./view/design/login.css">
</head>

<body>
    <?php include_once './view/header.view.php'; ?>
    <main>
        <h1>Se connecter</h1>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="?ctrl=loginAccount"> <!-- Action vers le contrôleur -->
            <div class="infos">
                <div>
                    <label for="mail">Adresse mail : </label>
                    <input type="email" name="mail" id="mail" placeholder="jean@jaimail.com" required value="<?php echo htmlspecialchars($formData['email']); ?>">
                </div>
                <div>
                    <label for="password">Mot de passe : </label>
                    <input type="password" name="password" id="password" placeholder="*******" required>
                </div>
            </div>
            <button class="connecter">Se connecter</button>
            <div class="buttons">
                <a href="index.php?ctrl=motdepasseoublie">   <!--TODO: Modifier le ligne-->
                    <button type="button" class="button-gris button">Mot de passe oublié</button>
                </a>
                <a href="index.php?ctrl=createAccount">
                    <button type="button" class="button-gris button">Créer un compte</button>
                </a>
            </div>
        </form>

    </main>
    <?php include_once './view/footer.view.php'; ?>
</body>
<script src="./view/js/dyslexique.js"></script>

</html>


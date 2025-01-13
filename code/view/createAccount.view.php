<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
    <link rel="stylesheet" href="./view/design/createAccount.css">
</head>

<body>
    <?php include_once("./view/header.view.php") ?>
    <div class="formContent">

        <h1>Créer mon compte</h1>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="?ctrl=createAccount">
            <div class="form">
                <div class="labelInput">
                    <label for="username">Pseudonyme <span>*</span> : </label>
                    <input type="text" placeholder="username" name="username" id="pseudo" required value="<?php echo htmlspecialchars($formData['username']); ?>">
                </div>

                <div class="labelInput">
                    <label for="first_name">Nom : </label>
                    <input type="text" name="first_name" id="nom" placeholder="prénom" value="<?php echo htmlspecialchars($formData['first_name']); ?>">
                </div>
                <div class="labelInput">
                    <label for="surname">Prénom : </label>
                    <input type="text" name="surname" id="surname" placeholder="nom" value="<?php echo htmlspecialchars($formData['surname']); ?>">
                </div>
                <div class="labelInput">
                    <label for="date">Date de naissance <span>*</span> : </label>
                    <input type="date" name="date" id="date" required value="<?php echo htmlspecialchars($formData['date']); ?>">
                </div>
                <div class="labelInput">
                    <label for="email">Adresse mail <span>*</span> : </label>
                    <input type="email" name="email" id="email" placeholder="Adresse email" required value="<?php echo htmlspecialchars($formData['email']); ?>">
                </div>
                <div class="labelInput">
                    <label for="password">Mot de passe <span>*</span> : </label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                </div>
                <div class="labelInput">
                    <label for="confirmpass">Confirmer votre mot de passe <span>*</span> : </label>
                    <input type="password" name="confirmpass" id="confirmpass" placeholder="Mot de passe" required>
                </div>
                <div class="labelInput">
                    <input type="checkbox" name="check" id="check" <?php echo $formData['check'] ? 'checked' : ''; ?>>
                    <label for="check">En cochant cette case, j'ai lu et accepte les <a class="cond" href="">Conditions
                            Générales d'Utilisation</a></label>
                </div>
            </div>
            <button class="creer" type="submit" name="auth" value="create">Créer mon compte</button>
            <button class="connecter button-gris" name="auth" value="login">Se connecter</button>
        </form>
    </div>
    <?php include_once("./view/footer.view.php"); ?>
</body>
<script src="./view/js/dyslexique.js"></script>

</html>


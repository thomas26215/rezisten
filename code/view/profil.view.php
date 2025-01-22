<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="./view/design/profil.css">
</head>

<body>
    <?php include_once("./view/headerProfile.view.php") ?>
    <main>
        <form class="non-style" method="post" action="?ctrl=profil">
            <button class="deconnect button-rouge" name="disconnect">Se déconnecter</button>
        </form>
        <div class="container">
            <div class="profilHead">
                <img src="./view/design/image/photoProfil.jpg" alt="photo profil">
                <p><?= $pseudo ?></p>
            </div>

        </div>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p class="text-error"><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="?ctrl=profil">

            <div>
                <label for="pseudo">Pseudo : </label>
                <input type="text" name="pseudo" id="pseudo" placeholder="<?= $pseudo ?>">
            </div>

            <div>
                <label for="mail">Adresse mail : </label>
                <input type="email" name="mail" id="mail" placeholder=<?= $mail ?>>
            </div>

            <button class="valider button-vert">Valider</button>
        </form>

        <div class="buttons">
            <button class="profil-button" id="toggleDyslexique">Mode dyslexique</button>

            <a href="index.php?ctrl=demandeCreateur">
                <button class="button-gris profil-button">Demander à être créateur</button>
            </a>
            <a href="index.php?ctrl=changermotdepasse&mode=authentified">
                <button class="button-gris profil-button">Modifier mon mot de passe</button>
            </a>
            <a href="index.php?ctrl=didacticiel">
                <button class="profil-button">Didacticiel</button>
            </a>
            </form>
        </div>
    </main>
    <?php include_once("./view/footer.view.php") ?>
</body>
<script src="./view/js/dyslexique.js"></script>

</html>
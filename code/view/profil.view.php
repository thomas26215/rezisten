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
    <?php include_once("./view/header.view.php") ?>
    <main>
        <div class="container">
            <div class="profilHead">
                <img src="./view/design/image/photoProfil.jpg" alt="photo profil">
                <p><?= $pseudo ?></p>
            </div>
            <form class="non-style" method="post" action="?ctrl=profil">
                <button class="deconnect button-rouge" name="disconnect">Se déconnecter</button>
            </form>
        </div>

        <form action="post">
            <div>
                <label for="pseudo">Pseudo : </label>
                <input type="text" name="pseudo" id="pseudo" placeholder=<?= $pseudo ?>>
            </div>

            <div>
                <label for="mail">Adresse mail : </label>
                <input type="email" name="mail" id="mail" placeholder=<?= $mail ?>>
            </div>

            <button class="valider button-vert">Valider</button>
        </form>

        <div class="buttons">
            <button class="" id="toggleDyslexique">Mode dyslexique</button>

            <a href="index.php?ctrl=demandeCreateur">
                <button class="button-gris">Faire la demande d'être créateur</button>
            </a>
            <a href="">
                <button class="button-gris">Modifier mon mot de passe</button>
            </a>
        </div>
    </main>
    <?php include_once("./view/footer.view.php") ?>
</body>
<script src="./view/js/dyslexique.js"></script>

</html>

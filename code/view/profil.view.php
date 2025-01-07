<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="design/profil.css">
</head>

<body>
    <?php include_once("header.view.php") ?>
    <main>
        <div class="container">
            <div class="profilHead">
                <img src="design/image/photoProfil.jpg" alt="photo profil">
                <p>Jano</p>
            </div>

            <a href="main.view.php">
                <button class="deconnect button-rouge">Se déconnecter</button>
            </a>
        </div>

        <form action="post">
            <div>
                <label for="pseudo">Pseudo : </label>
                <input type="text" name="pseudo" id="pseudo">
            </div>

            <div>
                <label for="mail">Adresse mail : </label>
                <input type="email" name="mail" id="mail" placeholder="jean@jaimail.com">
            </div>

            <button class="valider button-vert">Valider</button>
        </form>

        <div class="buttons">
            <a href="">
                <button class="button-gris">Mode dyslexique</button>
            </a>
            <a href="demandeCreateur.view.php">
                <button class="button-gris">Faire la demande d'être créateur</button>
            </a>
            <a href="">
                <button class="button-gris">Modifier mon mot de passe</button>
            </a>
        </div>
    </main>
    <?php include_once("footer.view.php") ?>
</body>

</html>
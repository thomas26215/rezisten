<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/design/profil.css">
</head>
<body>
    <?php include_once("header.view.php")?>
    
    <div>
        <img src="/design/images/photoProfil.jpg" alt="photo profil">
        <p>Jano</p>
    </div>

    <button>Se déconnecter</button>

    <form action="post">
        <div>
            <label for="pseudo">Pseudo : </label>
            <input type="text" name="pseudo" id="pseudo">
        </div>

        <div>
            <label for="mail">Adresse mail : </label>
            <input type="email" name="mail" id="mail" placeholder="jean@jaimail.com">
        </div>

        <button>Valider</button>
    </form>

    <div>
        <button>Mode dyslexique</button>
        <button>Faire la demande d'être créateur</button>
        <button>Modifier mon mot de passe</button>
    </div>
</body>
</html>
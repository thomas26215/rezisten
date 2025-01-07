<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="design/createAccount.css">
</head>

<body>
    <?php include_once("header.view.php") ?>
    <div class="formContent">

        <h1>Créer mon compte</h1>

        <form action="post">
            <div class="form">
                <div class="labelInput">
                    <label for="pseudo">Pseudonyme <span>*</span> : </label>
                    <input type="text" placeholder="Jano" name="pseudo" id="pseudo">
                </div>

                <div class="labelInput">
                    <label for="nom">Nom : </label>
                    <input type="text" name="nom" id="nom" placeholder="Jean">
                </div>
                <div class="labelInput">
                    <label for="prenom">Prénom : </label>
                    <input type="text" name="prenom" id="prenom" placeholder="Gaillard">
                </div>
                <div class="labelInput">
                    <label for="date">Date de naissance <span>*</span> : </label>
                    <input type="date" name="date" id="date">
                </div>
                <div class="labelInput">
                    <label for="mail">Adresse mail <span>*</span> : </label>
                    <input type="email" name="mail" id="mail" placeholder="jean@jaimail.com">
                </div>
                <div class="labelInput">
                    <label for="password">Mot de passe <span>*</span> : </label>
                    <input type="password" name="password" id="password" placeholder="********">
                </div>
                <div class="labelInput">
                    <label for="confirmpass">Confirmer votre mot de passe <span>*</span> : </label>
                    <input type="password" name="confirmpass" id="confirmpass">
                </div>
                <div class="labelInput">
                    <input type="checkbox" name="check" id="check">
                    <label for="check">En cochant cette case, j'ai lu et accepte les <a class="cond" href="">Conditions
                            Générales d'Utilisation</a></label>
                </div>
            </div>
            <a href="">
                <button class="creer" type="submit">Créer mon compte</button>
            </a>
            <a href="login.view.php">
                <button class="connecter button-gris">Se connecter</button>
            </a>
        </form>
    </div>
    <?php include_once("footer.view.php"); ?>
</body>

</html>
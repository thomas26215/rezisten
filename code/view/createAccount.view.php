<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="design/createAccount.css">
</head>
<body>
    <h1>Créer mon compte</h1>

    <form action="post">
        <label for="pseudo">Pseudonyme <span>*</span> : </label>
        <input type="text" placeholder="Jano" name="pseudo" id="pseudo">

        <label for="nom">Nom : </label>
        <input type="text" name="nom" id="nom" placeholder="Jean">

        <label for="prenom">Prénom : </label>
        <input type="text" name="prenom" id="prenom" placeholder="Gaillard">

        <label for="date">Date de naissance <span>*</span> : </label>
        <input type="date" name="date" id="date">
        
        <label for="mail">Adresse mail <span>*</span> : </label>
        <input type="email" name="mail" id="mail">

        <label for="password">Mot de passe <span>*</span> : </label>
        <input type="password" name="password" id="password">

        <label for="confirmpass">Confirmer votre mot de passe <span>*</span> : </label>
        <input type="password" name="confirmpass" id="confirmpass">

        <input type="checkbox" name="check" id="check">
        <label for="check">En cochant cette case, j'ai lu et accepte les <a href="">Conditions Générales d'Utilisation</a></label>

        <button type="submit">Créer mon compte</button>
        <a href="login.view.php">
            <button>Se connecter</button>
        </a>
    </form>

</body>
</html>
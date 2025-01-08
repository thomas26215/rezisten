<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande Créateur</title>
</head>
<body>
    <?php include_once 'header.view.php'; ?>
    <main>
        <h1>Demande créateur</h1>
        
        <form action="">
            <div>
                <div>
                    <label for="nom">Nom <span>*</span>: </label>
                    <input id="nom" name="nom" type="text" placeholder="Jean">
                </div>
                <div>
                    <label for="prenom">Prénom <span>*</span>: </label>
                    <input id="prenom" name="prenom" type="text" placeholder="Jean">
                </div>
            </div>
            <p>Merci de nous envoyer des documents pour prouver vos compétences afin de pouvoir écrire et publier vos histoires.</p>
            <button class="button-gris">Ajouter des documents</button>
            <button>Envoyer la demande</button>
        </form>
        
    </main>
    <?php include_once 'footer.view.php'; ?>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes histoires</title>
    <link rel="stylesheet" href="design/mesHistoires.css">
    <link rel="stylesheet" href="design/global.css">
</head>
<body>
    <?php include_once("headerHistoire.view.php")?>
    <main>
        <h1>Mes histoires</h1>

        <div class="histoires">
            <p class="titres">Publiées : </p>
            <div class="container">
                <p>Titre</p>
                <div >
                    <img class="modif" src="design/image/modifier.png" alt="Modifier">
                    <img class="poubelle" src="design/image/poubelle.png" alt="supprimer">
                </div>
            </div>
            <div class="container">
                <p>Titre</p>
                <div>
                    <img src="design/image/modifier.png" alt="Modifier">
                    <img src="design/image/poubelle.png" alt="supprimer">
                </div>
            </div>
        </div>
        <div class="histoires after">
            <p class="titres">Sauvegardées : </p>
            <div class="container">
                <p>Titre</p>
                <div>
                    <img src="design/image/modifier.png" alt="Modifier">
                    <img src="design/image/poubelle.png" alt="supprimer">
                </div>
            </div>
            <div class="container">
                <p>Titre</p>
                <div>
                    <img src="design/image/modifier.png" alt="Modifier">
                    <img src="design/image/poubelle.png" alt="supprimer">
                </div>
            </div>
            
        </div>
        <a href="ajouterDialogue.view.php">
            <button class="creer">Créer une histoire</button>
        </a>
    </main>
</body>
    <script src="./js/dyslexique.js"></script>
</html>
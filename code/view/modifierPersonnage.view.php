<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rézisten</title>
    <link rel="stylesheet" href="./design/global.css">
    <link rel="stylesheet" href="./design/modifierPersonnage.css">
</head>

<body>
    <?php include_once 'headerHistoire.view.php'; ?>
    <main class="flex-col">

        <h1>Vos personnages</h1>

        <section class="container">

            <section class="menu">
                <a href="./ajouterDialogue.view.php"><button class=button-gris>Consulter un personnage</button></a>
                <a href="./ajouterQuestion.view.php"><button class=button-gris>Ajouter un personnage</button></a>
                <a href="./afficherHistoire.view.php"><button>Modifier un personnage</button></a>
                <a href="./afficherHistoire.view.php"><button class=button-gris>Supprimer un personnage</button></a>
            </section>

        
                <article class="content">
                    
                    <h2 class="titre">Modifier un personnage</h2>

                    <div class="articleContainer">
                        <div class="noms">
                            <div>
                                <label for="prenom">Prénom</label>
                                <input maxlength="15" type="text" placeholder="Pierre">
                            </div>
                            <div>
                                <label for="nom">Nom</label>
                                <input maxlength="25" type="text" placeholder="Dupont">
                            </div>
                        </div>

                        <div class="image">
                            <p>Image</p>
                            <input type="file" id="photoUpload" name="photo" accept="image/*" style="display: none;">
                            <button id="photoSend">choose</button>
                            <span id="fileName">No file chosen</span>
                        </div>
                    </div>
                    
                </article>

                <section class="footer">
                    <a href="./ajouterDialogue.view.php"><button class=button-rouge>Quitter</button></a>
                    <a href="./ajouterQuestion.view.php"><button>Sauvegarder</button></a>
                </section>
            
        
        </section>
</body>
    <script src="./js/dyslexique.js"></script>

</html>
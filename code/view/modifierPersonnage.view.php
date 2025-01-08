<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rézisten</title>
    <link rel="stylesheet" href="./design/global.css">
    <link rel="stylesheet" href="./design/personnagePages.css">
</head>

<body>
    <?php include_once 'headerHistoire.view.php'; ?>
    <main class="flex-col">

        <h1>Vos personnages</h1>

        <section class="container">

            <section class="menu">
                <a href="./consulterPersonnage.view.php"><button class=button-gris>Consulter un personnage</button></a>
                <a href="./ajouterPersonnage.view.php"><button class=button-gris>Ajouter un personnage</button></a>
                <a href="./modifierPersonnage.view.php"><button>Modifier un personnage</button></a>
                <a href="./supprimerPersonnage.view.php"><button class=button-gris>Supprimer un personnage</button></a>
            </section>

        
                <article class="content">
                    
                    <h2 class="titre">Modifier un personnage</h2>

                    <div class="articleContainer">
                        <div class="personnage">
                            <label for="personnage">Personnage à modifier : </label>
                            <select name="personnage">
                                <option value="A">Jean</option><!-- mettre un foreache -->
                                <option value="B">a</option>
                                <option value="-">b</option>
                            </select>
                        </div>
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
                            <div class="imageChoisi">
                                <p>Image</p>
                                <input type="file" id="photoUpload" name="photo" accept="image/*" style="display: none;">
                                <img id="photoSend" src="./design/image/upload.png" alt="">
                                <span id="fileName">Pas de fichier ajoutée</span>
                            </div>
    
                            <div class="imageUser">
                                <img id="img" src="#" alt="Image preview" style="display: none; max-width: 240px;">
                            </div>
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
    <script src="./js/photoSelect.js"></script>
</html>
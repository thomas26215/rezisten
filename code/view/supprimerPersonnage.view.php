<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rézisten</title>
    <link rel="stylesheet" href="./design/global.css">
    <link rel="stylesheet" href="./design/personnagePages.css">
    <link rel="stylesheet" href="./design/popup.css">
</head>

<body>
    <?php include_once 'headerHistoire.view.php'; ?>
    
    <main class="flex-col">

        <h1>Vos personnages</h1>

        <section class="container">

            <section class="menu">
                <a href="./consulterPersonnage.view.php"><button class=button-gris>Consulter un personnage</button></a>
                <a href="./ajouterPersonnage.view.php"><button class=button-gris>Ajouter un personnage</button></a>
                <a href="./modifierPersonnage.view.php"><button class=button-gris>Modifier un personnage</button></a>
                <a href="./supprimerPersonnage.view.php"><button >Supprimer un personnage</button></a>
            </section>

        
                <article class="content">
                    
                    <h2 class="titre">Supprimer un personnage</h2>

                    <div class="articleContainer">
                        <div class="personnage">
                            <label for="personnage">Personnage à supprimer : </label>
                            <select name="personnage">
                                <option value="A">Jean</option><!-- mettre un foreache -->
                                <option value="B">a</option>
                                <option value="-">b</option>
                            </select>
                        </div>

                        <div class="supContainer">
                            <div>
                                <p style="font-weight: bold;">Prénom : </p>
                                <p>Jean</p>
                            </div>
                            <div>
                                <p style="font-weight: bold;">Nom : </p>
                                <p>Gaillard</p>
                            </div>
                        </div>

                        <div class="supContainer">
                            <img src="design/image/milicien.png" alt="" style="max-width: 240px;">
                            <div class="supprimer">
                                <button id="dialogPublier" class="button-rouge">Supprimer</button>
                            </div>
                        </div>
                        <?php include_once 'popup.view.php'; ?>
                    </div>
                    
                </article>

                <section class="footer">
                    <a href="#"><button id="dialogQuitter" class=button-rouge>Quitter</button></a>
                    <a href="./ajouterQuestion.view.php"><button>Sauvegarder</button></a>
                </section>
            
        
        </section>
</body>
    <script src="./js/popup.js"></script>
    <script src="./js/dyslexique.js"></script>
    <script src="./js/photoSelect.js"></script>
</html>
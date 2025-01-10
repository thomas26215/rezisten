<?php

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rézisten</title>
    <link rel="stylesheet" href="./view/design/global.css">
    <link rel="stylesheet" href="./view/design/creation.css">
    <link rel="stylesheet" href="./view/design/popup.css">
</head>

<body>
    <?php include_once './view/headerHistoire.view.php'; ?>
    <main class="flex-col">

        <h1>Création d'histoire</h1>

        <section class="container">
            <section class="header">
                <div>
                    <label for="titre">Titre : </label>
                    <input type="text" id="objet" name="objet" value="" required placeholder="Sabotage">
                </div>

                <div>
                    <label for="lieux">Lieux : </label>
                    <select name="example">
                        <option value="A">Prison</option><!-- mettre un foreache -->
                        <option value="B">Cimetiere</option>
                        <option value="-">Camps de concentration</option>
                    </select>
                    <a href="./consulterLieu.view.php"><img src="./view/design/image/info.png" alt="informations"
                            id="info"></a>
                </div>

                <div>
                    <label for="personnages">Personnages :</label>
                    <a href="./consulterPersonnage.view.php"><button class=button-gris>Consulter les personnages</button></a>
                </div>

            </section>

<!--       <input type="hidden" name="ctrl" value="choisirCategorie">
      <button type="submit">
        Choisir une catégorie
      </button>
    </form> 
            <form method=post class="flex-col ">  
                <input type="hidden" name="article" value="ajouterDialogue">
                <button>Ajouter un dialogue</button>

                <input type="hidden" name="article" value="ajouterQuestion">
                <button type="submit" class=button-gris>Ajouter une question</button>

                <input type="hidden" name="article" value="afficherHistoire">
                <button class=button-gris>Afficher toute l'histoire</button>
            </form>
            -->

            <section class="flex-col ">
                <form method=post><input type="hidden" name="article" value="ajouterDialogue"><button>Ajouter un dialogue</button></form>
                <form method=post><input type="hidden" name="article" value="ajouterQuestion"><button class=button-gris>Ajouter une question</button></form>
                <form method=post><input type="hidden" name="article" value="afficherHistoire"><button class=button-gris>Afficher toute l'histoire</button></form>
            </section> 


            <?php
            include_once $lien;
            ?>

            <section class="footer">
                <a href="#"><button id="dialogQuitter" class=button-rouge>Quitter</button></a>
                <a href="./ajouterQuestion.view.php"><button>Sauvegarder</button></a>

                <a href="#"><button id="dialogPublier" class=button-vert>Publier</button></a>
            </section>
            
            <?php include_once 'popup.view.php'; ?>
        </section>
        <script src="./js/popup.js"></script>
</body>
    <script src="./js/dyslexique.js"></script>
    
    <script>
        // Vérifiez si le mode dyslexique est activé dans le localStorage
        if (localStorage.getItem('dyslexique') === 'true') {
            document.body.classList.add('dyslexique');
        }

        // Ajoutez un écouteur d'événement au bouton pour basculer le mode dyslexique
        document.getElementById('toggleDyslexique').addEventListener('click', function() {
            document.body.classList.toggle('dyslexique');
            // Stockez la préférence dans le localStorage
            localStorage.setItem('dyslexique', document.body.classList.contains('dyslexique'));
        });
    </script>

</html>
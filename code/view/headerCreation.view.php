<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rézisten</title>
    <link rel="stylesheet" href="./design/global.css">
    <link rel="stylesheet" href="./design/headerCreation.css">
</head>
<body>
    <?php include_once 'headerHistoire.view.php'; ?>
    <main class="flex-col">
        
        <h1>Création d'histoire</h1>

        <section class="container">
            <section class="header">  
                <div>
                    <label for="titre">Titre :</label>
                    <input type="text" id="objet" name="objet" value="" required placeholder="Sabotage">
                </div>
                
                <div>
                    <label for="lieux">Lieux :</label>
                    <select name="example">
                        <option value="A">Prison</option> 
                        <option value="B">Cimetiere</option>
                        <option value="-">Camps de concentration</option>
                    </select>
                </div>
                
                <div>
                    <label for="personnages">Personnages :</label>
                    <a href="./login.view.php"><button>Consulter les personnages</button></a>
                </div>
                
            </section>
            
            <section class="menu">
                <a href="./ajouterDialogue.view.php"><button>Ajouter un dialogue</button></a>
                <a href="./ajouterQuestion.view.php"><button>Ajouter une question</button></a>
                <a href="./afficherHistoire.view.php"><button>Afficher toute l'histoire</button></a>
            </section>

            <section class="content">
                Lorem ipsum odor amet, consectetuer adipiscing elit. Ridiculus sit nisl laoreet facilisis aliquet. Potenti dignissim litora eget montes rhoncus sapien neque urna. Cursus libero sapien integer magnis ligula lobortis quam ut.
            </section>

            <section class="footer">
                <a href="./ajouterDialogue.view.php" ><button>Quitter</button></a>
                <a href="./ajouterQuestion.view.php"><button>Sauvegarder</button></a>
                <a href="./afficherHistoire.view.php"><button>Publier</button></a>
            </section>
        </section>
</body>
</html>
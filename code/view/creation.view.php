<?php
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création</title>
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

                <form action="index.php?ctrl=creation" method="get" class="formLieu">
                    <input type="hidden" name="ctrl" value="creation">
                    <input type="hidden" name="id" value=<?= $id ?>>
                    <input type="hidden" name="sauvegarder" value="sauvegarder">

                    <div class="inputsCont flex-col">
                        <div class="inputs ">
                            <label for="titre">Titre : </label>
                            <div class="flex-row">
                                <input id="titre" type="text" name="titre" value="<?= $titre ?>" required
                                    placeholder="Sabotage">
                            </div>
                        </div>


                        <div class="inputs ">
                            <label for="lieux">Lieux : </label>
                            <div class="lieuxInfo flex-row">
                                <select id="lieux" name="lieux">
                                    <?php foreach ($lieux as $lieu): ?>
                                        <option value="<?= $lieu->getId() ?>"
                                            <?= $lieu->getId() == $histoire->getPlace()->getId() ? 'selected' : '' ?>>
                                            <?= $lieu->getName() ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <a href="./index.php?ctrl=consulterLieu&id=<?= $histoire->getPlace()->getId() ?>">
                                    <img src="./view/design/image/info.png" alt="informations" id="info">
                                </a>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="id_lieu" id="id_lieu" value="">
                    <button>Sauvegarder</button>
                </form>

                <div class="inputs flex-col">
                    <label for="personnages">Personnages :</label>
                    <a href="./index.php?ctrl=personnages&article=consulterPersonnage&id=<?= $id ?>">
                        <button class="personnage button-gris" type="button">Gérer
                            les
                            personnages
                        </button>
                    </a>
                </div>
            </section>

            <div class="containerBox">
                <section class="buttonsContainer">
                    <form method=get>
                        <input type="hidden" name="ctrl" value="creation">
                        <input type="hidden" name="article" value="ajouterDialogue">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <button id="ajouterDialogue" class=button-gris>Ajouter un dialogue</button>
                    </form>
                    <form method=get>
                        <input type="hidden" name="ctrl" value="creation">
                        <input type="hidden" name="article" value="ajouterQuestion">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <button id="ajouterQuestion" class=button-gris>Ajouter une question</button>
                    </form>
                    <form method=get>
                        <input type="hidden" name="ctrl" value="creation">
                        <input type="hidden" name="article" value="afficherHistoire">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <button id="afficherHistoire" class=button-gris>Afficher toute l'histoire</button>
                    </form>
                </section>

                <?php
                include_once $lien;
                ?>


                <section class="footer flex-row">
                    <form method=get>
                        <input type="hidden" name="ctrl" value="mesHistoires">
                        <button type="button" id="quitterHistoireOuvrir" class=button-rouge>Quitter</button>
                    
                        <dialog class="dialog" id="dialogQuitterHistoire">
                            <div class="containerDialog">
                                <h2>Voulez vous quitter la page création ?</h2>
                                <div>

                                    <button type="submit" id="fermerQuitterHistoire" name="fermer" class="button-rouge">
                                        Quitter
                                    </button>
                                    <button type="button" id="revenirQuitterHistoire" class="button-vert">
                                        Revenir
                                    </button>
                                </div>
                            </div>
                        </dialog>
                    </form>

                    <form method="get">
                        <input type="hidden" name="ctrl" value="creation">
                        <input type="hidden" name="footer" value="publie">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <button type="button" id="publierHistoireOuvrir"
                            class="button-vert"><?php if ($histoire->getVisibility() == true): ?>
                                Mettre en privé
                            <?php else: ?>
                                Publier
                            <?php endif ?></button>
                        <dialog class="dialog" id="dialogPublierHistoire">
                            <div class="containerDialog">
                                <h2>Voulez vous <?php if ($histoire->getVisibility() == true): ?>
                                mettre en privé
                            <?php else: ?>
                                publier
                            <?php endif ?></button> votre histoire ?</h2>
                                <div>

                                    <button type="submit" id="fermerPublierHistoire" name="fermer" class="button-vert">
                                        Oui
                                    </button>
                                    <button type="button" id="revenirPublierHistoire" class="button-rouge">
                                        Non
                                    </button>
                                </div>
                            </div>
                        </dialog>
                    </form>
                </section>
            </div>



            <?php include_once 'popup.view.php'; ?>
        </section>
        <script src="./js/popup.js"></script>
    </main>
    <?php include_once './view/footerCreation.view.php'; ?>
</body>
<script src="./js/dyslexique.js"></script>

<script>
    // Vérifiez si le mode dyslexique est activé dans le localStorage
    if (localStorage.getItem('dyslexique') === 'true') {
        document.body.classList.add('dyslexique');
    }

    // Ajoutez un écouteur d'événement au bouton pour basculer le mode dyslexique
    document.getElementById('toggleDyslexique').addEventListener('click', function () {
        document.body.classList.toggle('dyslexique');
        // Stockez la préférence dans le localStorage
        localStorage.setItem('dyslexique', document.body.classList.contains('dyslexique'));
    });
</script>
<script>
    // Fonction pour mettre à jour le champ caché
    function updateHiddenField() {
        document.getElementById('id_lieu').value = document.getElementById('lieux').value;
    }

    // Exécuter au chargement de la page
    window.onload = function () {
        updateHiddenField();
        document.getElementById('lieux').addEventListener('change', updateHiddenField);
    };
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var currentUrl = window.location.search;
        var afficher = document.getElementById("afficherHistoire");
        var ajouterD = document.getElementById("ajouterDialogue");
        var ajouterQ = document.getElementById("ajouterQuestion");

        if (currentUrl.includes('article=afficherHistoire')) {
            afficher.classList.remove("button-gris");
        } else if (currentUrl.includes('article=ajouterDialogue')) {
            ajouterD.classList.remove("button-gris");
        } else if (currentUrl.includes('article=ajouterQuestion')) {
            ajouterQ.classList.remove("button-gris");
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // quitter page création
        var quitterHistoireOuvrir = document.getElementById('quitterHistoireOuvrir');
        var dialogQuitterHistoire = document.getElementById('dialogQuitterHistoire');
        var fermerQuitterHistoire = document.getElementById('fermerQuitterHistoire');
        var revenirQuitterHistoire = document.getElementById('revenirQuitterHistoire');

        if (quitterHistoireOuvrir && dialogQuitterHistoire && fermerQuitterHistoire && revenirQuitterHistoire) {
            quitterHistoireOuvrir.addEventListener('click', function () {
                dialogQuitterHistoire.showModal();
            });

            fermerQuitterHistoire.addEventListener('click', function () {
                dialogQuitterHistoire.close();
            });

            revenirQuitterHistoire.addEventListener('click', function () {
                dialogQuitterHistoire.close();
            });
        }

        // publier histoire
        var publierHistoireOuvrir = document.getElementById('publierHistoireOuvrir');
        var dialogPublierHistoire = document.getElementById('dialogPublierHistoire');
        var fermerPublierHistoire = document.getElementById('fermerPublierHistoire');
        var revenirPublierHistoire = document.getElementById('revenirPublierHistoire');

        if (publierHistoireOuvrir && dialogPublierHistoire && fermerPublierHistoire && revenirPublierHistoire) {
            publierHistoireOuvrir.addEventListener('click', function () {
                dialogPublierHistoire.showModal();
            });

            fermerPublierHistoire.addEventListener('click', function () {
                dialogPublierHistoire.close();
            });

            revenirPublierHistoire.addEventListener('click', function () {
                dialogPublierHistoire.close();
            });
        }
    });
</script>


</html>
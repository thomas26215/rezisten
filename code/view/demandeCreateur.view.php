<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande Créateur</title>
    <link rel="stylesheet" href="./view/design/demandeCreateur.css">
</head>
<body>
    <?php include_once './view/header.view.php'; ?>
    <main>
        <h1>Demande créateur</h1>
        
        <form action="index.php?action=demandeCreateur" method="post" enctype="multipart/form-data">
            <div class="infos">
                <div>
                    <label for="nom">Nom <span>*</span>: </label>
                    <input id="nom" name="nom" type="text" value="<?= htmlspecialchars($nom) ?>" required>
                </div>
                <div>
                    <label for="prenom">Prénom <span>*</span>: </label>
                    <input id="prenom" name="prenom" type="text" value="<?= htmlspecialchars($prenom) ?>" required>
                </div>
            </div>
            <p class="texte">Merci de nous envoyer des documents pour prouver vos compétences afin de pouvoir écrire et publier vos histoires.</p>
            <div class="image">
                <div class="imageChoisi">
                    <h2>Votre document : </h2>
                    <input type="file" id="photoUpload" name="photoUpload" accept=".pdf,.doc,.docx,image/*" style="display: none;">
                    <button type="button" id="photoSend" class="button-gris">Ajouter des documents</button>
                    <span id="fileName">Pas de document ajouté</span>
                </div>
            </div>
            <button type="submit" class="envoyer">Envoyer la demande</button>
        </form>
        
    </main>
    <?php include_once './view/footer.view.php'; ?>
</body>
<script src="./view/js/photoSelect.js"></script>
</html>
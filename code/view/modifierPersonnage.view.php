<article class="content">

    <h2 class="titre">Modifier un personnage</h2>
    <div class="articleContainer">

        <form method="post" action="index.php?ctrl=personnages&article=modifierPersonnage" class="articleContainer"
            enctype="multipart/form-data">
            <div class="personnage">
                <label for="personnage">Personnage à modifier : </label>
                <input type="hidden" name="ctrl" value="personnages">
                <input type="hidden" name="action" value="selectCharacter">
                <select name="selectedCharacter" id="personnage" onchange="this.form.submit()">
                    <option value="">Sélectionnez un personnage</option>
                    <?php foreach ($characters as $char) { ?>
                        <option value="<?= $char?->getId() ?? 0 ?>"><?= $char?->getFirstName() ?? "Jean" ?></option>
                    <?php } ?>
                </select>
            </div>

        </form>
        <?php if ($selectedCharacter): ?>
            <form method="post" action="index.php?ctrl=personnages&article=modifierPersonnage"
                enctype="multipart/form-data" class="articleContainer">
                <input type="hidden" name="ctrl" value="personnages">
                <input type="hidden" name="action" value="updateCharacter">
                <input type="hidden" name="characterId" value="<?= $selectedCharacter->getId() ?>">

                <div class="noms">
                    <div>
                        <label for="firstName">Prénom</label>
                        <input id="firstName" name="firstName" maxlength="15" type="text"
                            placeholder="<?= $selectedCharacter?->getFirstName() ?? "Jean"; ?>">
                    </div>

                </div>

                <div class="image">
                    <div class="imageChoisi">
                        <p>Image</p>
                        <input type="file" id="photoUpload" name="photoUpload" accept="image/*" style="display: none;">
                        <img id="photoSend"  src="./view/design/image/upload.png" alt="">
                        <span id="fileName">Pas de fichier ajoutée</span>
                    </div>

                    <div class="imageUser">
                        <?php
                        $imgSrc = '';
                        if ($selectedCharacter && $selectedCharacter->getCreator()->getId() == 4) {
                            $imgSrc = $imgURL . ($selectedCharacter->getImage() ?? "default") . ".webp";
                        } else if ($selectedCharacter) {
                            $imgSrc = './view/design/image/imageUser/' . ($selectedCharacter->getImage() ?? "default");
                        }
                        ?>
                        <img id="img" src="<?= $imgSrc ?>" alt="<?= $selectedCharacter?->getFirstName() ?? "Jean"; ?>"
                            alt="<?= $selectedCharacter?->getFirstName() ?? "Jean"; ?>" style="max-width: 240px;">
                    </div>
                </div>

                <button type="submit" class="button-vert">Enregistrer les modifications</button>
            </form>
        <?php else: ?>
            <p><?= $message?></p>
            <?php if (isset($errorMessage)) {
            ?> <p><?= $errorMessage?></p><?php
        }
        ?>
            <p>Aucun personnage sélectionné. Veuillez en choisir un dans la liste.</p>
        <?php endif; ?>
        

    </div>

</article>
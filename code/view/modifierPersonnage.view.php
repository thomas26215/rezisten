<article class="content">

    <h2 class="titre">Modifier un personnage</h2>

    <form method="post" action="index.php?ctrl=personnages&article=modifierPersonnage" class="articleContainer">
        <div class="personnage">
            <label for="personnage">Personnage à modifier : </label>
            <input type="hidden" name="ctrl" value="personnages">
            <input type="hidden" name="action" value="selectCharacter">
            <select name="selectedCharacter" id="personnage" onchange="this.form.submit()">
                <option value="">Sélectionnez un personnage</option>
                <?php foreach ($characters as $char) { ?>
                    <option value="<?= $char->getId() ?>"><?= htmlspecialchars($char->getFirstName()) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="noms">
            <div>
                <label for="prenom">Prénom</label>
                <input maxlength="15" type="text" placeholder="<?= $selectedCharacter?->getFirstName() ?? "Jean"; ?>">
            </div>

        </div>

        <div class="image">
            <div class="imageChoisi">
                <p>Image</p>
                <input type="file" id="photoUpload" name="photo" accept="image/*" style="display: none;">
                <img id="photoSend" src="./view/design/image/upload.png" alt="">
                <span id="fileName">Pas de fichier ajoutée</span>
            </div>

            <div class="imageUser">
                <img id="img" src="<?= $imgURL . $selectedCharacter?->getImage() ?? "img"; ?>"
                    alt="<?= $selectedCharacter?->getFirstName() ?? "Jean"; ?>" style=" max-width: 240px;">
            </div>
        </div>
    </form>

</article>
<article class="content">

    <h2 class="titre">Consulter un personnage</h2>

    <form method="post" action="index.php?ctrl=personnages&article=consulterPersonnage" class="articleContainer">
        <div class="personnage">
            <input type="hidden" name="ctrl" value="personnages">
            <input type="hidden" name="action" value="selectCharacter">
            <label for="personnage">Personnage à Consulter : </label>
            <select name="selectedCharacter" id="personnage" onchange="this.form.submit()">
                <option value="">Sélectionnez un personnage</option>
                <?php foreach ($characters as $char) { ?>
                    <option value="<?= $char?->getId() ?? 0 ?>"><?= $char?->getFirstName() ?? "Jean"?></option>
                <?php } ?>
            </select>
        </div>

        <div class="supContainer">
            <div>
                <p style="font-weight: bold;">Prénom : </p>
                <p><?= $selectedCharacter?->getFirstName() ?? "Jean"; ?></p>
            </div>

        </div>

        <div class="supContainer">
            <img src="<?= $imgURL . $selectedCharacter?->getImage() ?? "img"?>"
                alt="<?=$selectedCharacter?->getFirstName() ?? "Jean"; ?>" style="max-width: 240px;">


        </div>
        <input type="hidden" name="article" value="consulterPersonnage">

    </form>

</article>
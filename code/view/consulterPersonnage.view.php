<article class="content">

    <form method="post" action="index.php?ctrl=personnages&article=consulterPersonnage&id=<?= $id ?>" class="articleContainer">
        <div class="personnage">
            <input type="hidden" name="ctrl" value="personnages">
            <input type="hidden" name="action" value="selectCharacter">
            <label for="personnage">Personnage à Consulter : </label>
            <select name="selectedCharacter" id="personnage" onchange="this.form.submit()">
                <option value="">Sélectionnez un personnage</option>
                <?php foreach ($characters as $char) { ?>
                    <option value="<?= $char?->getId() ?? 0 ?>"><?= $char?->getFirstName() ?? "Jean" ?></option>
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
            <?php
            $imgSrc = '';

            if ($selectedCharacter && $selectedCharacter->getCreator()->getId() == 1) {
                $imgSrc = $imgURL . ($selectedCharacter->getImage() ?? "default") . ".webp";
            } else if ($selectedCharacter) {
                $imgSrc = $imgURL . ($selectedCharacter->getImage() ?? "default");
            }
            ?>
            <img src="<?= $imgSrc ?>" alt="<?= $selectedCharacter?->getFirstName() ?? "Jean"; ?>"
            alt="<?= $selectedCharacter?->getFirstName() ?? "Jean"; ?>" style="max-width: 240px;">


        </div>

        <input type="hidden" name="article" value="consulterPersonnage">

    </form>

</article>

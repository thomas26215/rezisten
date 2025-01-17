<article class="content">

    <div class="articleContainer">

        <form method="post" action="index.php?ctrl=personnages&article=supprimerPersonnage&id=<?= $id ?>"
            class="">
            <input type="hidden" name="ctrl" value="personnages">
            <input type="hidden" name="action" value="selectCharacter">
            <div class="personnage">
                <label for="personnage">Personnage à supprimer : </label>
                <select name="selectedCharacter" id="personnage" onchange="this.form.submit()">
                    <option value="">Sélectionnez un personnage</option>
                    <?php foreach ($characters as $char) { ?>
                        <option value="<?= $char?->getId() ?? 0 ?>"><?= htmlspecialchars($char->getFirstName()) ?></option>
                    <?php } ?>
                </select>
            </div>
            <input type="hidden" name="article" value="supprimerPersonnage">


        </form>

        <?php if ($selectedCharacter): ?>
            <div class="supContainer">
                <div>
                    <p style="font-weight: bold;">Prénom : </p>
                    <p><?= $selectedCharacter?->getFirstName() ?? " "; ?></p>
                </div>
            </div>

            <div class="supContainer imageButton">
                <?php
                $imgSrc = '';
                if ($selectedCharacter && $selectedCharacter->getCreator()->getId() == 4) {
                    $imgSrc = $imgURL . ($selectedCharacter->getImage() ?? "default") . ".webp";
                } else if ($selectedCharacter) {
                    $imgSrc = './view/design/image/imageUser/' . ($selectedCharacter->getImage() ?? "default");
                }
                ?>
                <img src="<?= $imgSrc ?>" alt="<?= $selectedCharacter?->getFirstName() ?? "Jean"; ?>"
                    alt="<?= $selectedCharacter?->getFirstName() ?? "Jean"; ?>" style="max-width: 240px;">
                <button type="button" id="dialogPublier" class="button-rouge">Supprimer</button>
                <div class="supprimer">
                    <form method="post" action="index.php?ctrl=personnages&article=supprimerPersonnage&id=<?= $id ?>">
                        <input type="hidden" name="ctrl" value="personnages">
                        <input type="hidden" name="characterId" value="<?= $selectedCharacter->getId() ?>">
                        <input type="hidden" name="action" value="supprimerPersonnage">
                        <input id="supprimerInput" type="hidden" name="fermer" value="false">

                        <dialog id="dialog">
                            <div class="containerDialog">
                                <h2>Voulez vous supprimer <?= $selectedCharacter?->getFirstName() ?? "Jean"; ?> ?</h2>
                                <div>

                                    <button type="submit" id="fermerPublier" name="fermer" class="button-vert">
                                        Supprimer personnage
                                    </button>
                                    <button type="button" id="fermerRevenir" class="button-rouge">
                                        Revenir
                                    </button>
                                </div>
                            </div>
                        </dialog>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <p><?= $message ?></p>
            <?php if (isset($errorMessage)) {
                ?>
                <p><?= $errorMessage ?></p><?php
            } ?>
            <p>Aucun personnage sélectionné. Veuillez en choisir un dans la liste.</p>
        <?php endif; ?>
    </div>

    <script>
        var submitSupprimer = document.getElementById("supprimerInput");
        var submitButton = document.getElementById("fermerPublier");

        submitButton.addEventListener("click", () => {
            submitSupprimer.value = "true";
        });
    </script>

</article>
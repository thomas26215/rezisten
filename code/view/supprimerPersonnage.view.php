<article class="content">
    <h2 class="titre">Supprimer un personnage</h2>

    <form method="post" action="index.php?ctrl=personnages&article=supprimerPersonnage" class="articleContainer">
        <input type="hidden" name="ctrl" value="personnages">
        <input type="hidden" name="action" value="selectCharacter">
        <div class="personnage">
            <label for="personnage">Personnage à supprimer : </label>
            <select name="selectedCharacter" id="personnage" onchange="this.form.submit()">
                <option value="">Sélectionnez un personnage</option>
                <?php foreach ($characters as $char) { ?>
                    <option value="<?= $char->getId() ?>"><?= htmlspecialchars($char->getFirstName()) ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="hidden" name="article" value="supprimerPersonnage">

        
    </form>

    <?php if (isset($selectedCharacter)) { ?>
        <div class="supContainer">
            <div>
                <p style="font-weight: bold;">Prénom : </p>
                <p><?= htmlspecialchars($selectedCharacter->getFirstName()) ?></p>
            </div>
        </div>

        <div class="supContainer">
            <img src="<?= $imgURL . $selectedCharacter->getImage() ?>"
                alt="<?= htmlspecialchars($selectedCharacter->getFirstName()) ?>" style="max-width: 240px;">
            <div class="supprimer">
                <button type="button" id="dialogPublier" class="button-rouge">Supprimer</button>
                <form method="post" action="index.php?ctrl=personnages&article=supprimerPersonnage">
                    <input type="hidden" name="ctrl" value="personnages">
                    <input type="hidden" name="characterId" value="<?= $selectedCharacter->getId() ?>">
                    <input type="hidden" name="article" value="supprimerPersonnage">
                    <input id="supprimerInput" type="hidden" name="fermer" value="true">

                    <dialog id="dialog">
                        <div class="containerDialog">
                            <h2>Voulez vous supprimer <?= htmlspecialchars($selectedCharacter->getFirstName()) ?> ?</h2>
                            <div>
                                
                                <button id="fermerPublier" name="fermer" class="button-vert">
                                    Supprimer personnage
                                </button>
                                <button id="fermerRevenir" class="button-rouge">
                                    Revenir 
                                </button>
                            </div>
                        </div>
                    </dialog>
                </form>
            </div>
        </div>
    <?php } ?>

    <script>
        var submitSupprimer = document.getElementById("supprimerInput");
        var submitButton = document.getElementById("fermerPublier");

        submitButton.addEventListener("click", () => {
            submitSupprimer.value == "true";
        });
    </script>
    
</article>
<article class="content">

    <form method="post" action="index.php?ctrl=personnages&article=ajouterPersonnage&id=<?= $id ?>"
        class="articleContainer" enctype="multipart/form-data">
        <input type="hidden" name="ctrl" value="personnages">
        <input type="hidden" name="article" value="ajouterPersonnage">
        <input type="hidden" name="action" value="ajouterCharacter">

        <div class="noms">
            <div>
                <label for="prenom">Prénom</label>
                <input maxlength="15" type="text" id="prenom" name="prenom" placeholder="Pierre">
            </div>

        </div>

        <div class="image">
            <div class="imageChoisi">
                <p>Image</p>
                <input type="file" id="photoUpload" name="photoUpload" accept="image/*" style="display: none;">
                <img id="photoSend" src="./view/design/image/upload.png" alt="">
                <span id="fileName">Pas de fichier ajoutée</span>
            </div>

            <div class="imageUser">
                <img id="img" src="#" alt="Image preview" style="display: none; max-width: 240px;">
            </div>
        </div>

        <button type="button" id="ajouterOuvrir">Ajouter personnage</button>
        <dialog class="dialog" id="dialogAjouter">
            <div class="containerDialog">
                <h2>Voulez vous enregistrer le personnage <?= $selectedCharacter?->getFirstName() ?? "Jean"; ?> ?</h2>
                <div>

                    <button type="submit" id="fermerAjouter" name="fermer" class="button-vert">
                        Oui
                    </button>
                    <button type="button" id="revenirAjouter" class="button-rouge">
                        Non
                    </button>
                </div>
            </div>
        </dialog>
        <p><?= $message ?></p>
        <?php if (isset($errorMessage)) {
            ?>
            <p><?= $errorMessage ?></p><?php
        }
        ?>
    </form>

</article>
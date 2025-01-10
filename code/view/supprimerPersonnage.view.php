<article class="content">

    <h2 class="titre">Supprimer un personnage</h2>

    <form method="get" class="articleContainer">
        <input type="hidden" name="ctrl" value="personnages">
        <div class="personnage">
            <label for="personnage">Personnage à supprimer : </label>
            <select name="personnage">
                <?php foreach ($character as $chara){ ?>
                <option value=""><?=$chara ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="supContainer">
            <div>
                <p style="font-weight: bold;">Prénom : </p>
                <p><?= $character->getFirstName();?></p>
            </div>
        </div>

        <div class="supContainer">
            <img src="<?= $character->getImage();?>" alt="<?= $character->getImage();?>" style="max-width: 240px;">
            <div class="supprimer">
                <button id="dialogPublier" class="button-rouge">Supprimer</button>
            </div>
        </div>
        <?php include_once './view/popup.view.php'; ?>
    </form>

</article>
<article class="content">

    <h2 class="titre">Consulter un personnage</h2>

    <div class="articleContainer">
        <div class="personnage">
            <label for="personnage">Personnage à Consulter : </label>
            <select name="personnage">
                <?php foreach ($character as $chara){  ?>
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
            <img src="<?= $character->getImage();?>" alt="" style="max-width: 240px;">

        </div>

    </div>

</article>
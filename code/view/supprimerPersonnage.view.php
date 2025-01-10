<article class="content">

    <h2 class="titre">Supprimer un personnage</h2>

    <div class="articleContainer">
        <div class="personnage">
            <label for="personnage">Personnage à supprimer : </label>
            <select name="personnage">
                <option value="A">Jean</option><!-- mettre un foreache -->
                <option value="B">a</option>
                <option value="-">b</option>
            </select>
        </div>

        <div class="supContainer">
            <div>
                <p style="font-weight: bold;">Prénom : </p>
                <p>Jean</p>
            </div>
            <div>
                <p style="font-weight: bold;">Nom : </p>
                <p>Gaillard</p>
            </div>
        </div>

        <div class="supContainer">
            <img src="./view/design/image/milicien.png" alt="" style="max-width: 240px;">
            <div class="supprimer">
                <button id="dialogPublier" class="button-rouge">Supprimer</button>
            </div>
        </div>
        <?php include_once './view/popup.view.php'; ?>
    </div>

</article>
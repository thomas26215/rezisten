<head>
        <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    
    <link rel="stylesheet" href="./view/design/afficherHistoire.css">
</head>
<article class="content"> 
    <div>
        <h2 class="titre"> Afficher toute l'histoire</h2>
    </div>
    <article>
        <form action="">


        <?php foreach($dialogues as $dialogue): ?>
            
            <section>
                <label for="personnage">Personnage qui parle : <?= $dialogue->getSpeaker()->getFirstName() ?? "questions"?></label>
            </section>
            <!-- il faut que le premier n'est pas de fleche vers le haut et que le dernier n'est pas de fleche vers le bas -->
            <section class=flex-row>
                <p>
                    <?= $dialogue->getContent() ?>
                </p>
                <div id="fleche">
                    <button class="bouton-modif">^</button>
                    <button class="bouton-modif">^</button>
                </div>
                <form method="GET">
                    <!-- faire un if, pour que si c'est une instance of Question, ca envoie les bonnes infos pour le ctrl -->
                    <input type="hidden" name="ctrl" value="creation">
                    <input type="hidden" name="article" value="afficherHistoire">
                    <input type="hidden" name="idDialogue" value= <?= $dialogue->getId() ?> >
                    <input type="hidden" name="typeDialogue" value=<?= $dialogue instanceof Dialog ?>>
                    <img src="./view/design/image/poubelle.png" alt="poubelle" id="poubelle"></button>  <!-- Lié au pop up -->
                </form>
            
            </section>
        <?php endforeach; ?>
            
        </form>
    </article>
    <!-- boutons -->
    <section class="last-button">
        <button class=button-rouge>Annuler</button>
        <button class=button-vert>Valider</button>
    </section>
</article>
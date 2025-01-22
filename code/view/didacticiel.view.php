<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Didacticiel</title>
    <link rel="stylesheet" href="./view/design/global.css">
    <link rel="stylesheet" href="./view/design/CGU.css">
</head>

<body>
    <?php include_once './view/headerHistoire.view.php'; ?>
    <main class="flex-col maindidac">
        <h1 class="centree">Bienvenue dans le didacticiel de Rezisten !</h1>
        <p class="centree">Sur notre application, vous disposerez de plusieurs fonctionnalités détaillées ci-dessous.
        </p>

        <h2>Votre profil</h2>
        <ul>
            <li>Dans votre profil, vous disposez d'un mode pour les dyslexiques afin d'adapter votre expérience.</li>
            <li>Vous pouvez également modifier votre mot de passe si l'envie vous en prend.</li>
            <li>Enfin, vous pouvez faire une demande pour devenir créateur !</li>
        </ul>

        <h2>Lecture d'histoire</h2>
        <p>Sur notre application, vous retrouverez 2 types d'histoires. Les histoires officielles écrites par les
            fondateurs de Rézisten et les histoires proposées par des personnes agréées.</p>
        <ul>
            <li>Nos histoires</li>
            <p>Chaque histoire est fictive et se déroule dans un lieu historique ! Les histoires sont des dialogues
                entre des personnages, fictifs pour la plupart, mais aussi des personnages historiques tels que Jean
                Moulin.</p>
            <p>
                À un moment de l'histoire, vous serez interrompus par une question vous invitant à visiter le lieu pour
                en apprendre plus sur celui-ci. La première question qui vous est proposée ne peut être répondue qu'en
                vous rendant sur place et vous proposera une fin plus complète (plus de dialogues, des événements plus
                impactants). Dans le cas où vous ne pourriez pas vous rendre sur place, vous pouvez changer de question
                pour une plus simple où la réponse se trouve dans la page "consulter lieux".
            </p>
            <p>À la fin d'une histoire, vous accéderez à une page vous expliquant succinctement la véritable histoire du
                lieu afin que vous puissiez différencier le réel de l'imaginaire !
            </p>
            <li>Les histoires des créateurs</li>
            <p>Pour les histoires des créateurs, le principe est relativement similaire, la différence est que vous
                aurez une seule question, ou vous devrez chercher la réponse sur internet.</p>
        </ul>
        <div class="centree">
            <form action="?" method="get">
                <input type="hidden" name="ctrl" value="histoire">
                <input type="hidden" name="idStory" value="1">
                <input type="hidden" name="idDialog" value="1">
                <button type="submit">Commencer la lecture -></button>
            </form>
        </div>
        <h2>Mission recrutement</h2>
        <p>Pour devenir créateur, vous pouvez cliquer sur le bouton ci-dessous. Vous serez redirigé sur un formulaire
            vous concernant afin de prouver que vous avez les compétences afin de devenir créateur d'histoire sur notre
            site. Vous êtes passionné, professeur, prouvez-nous votre passion pour la transmettre avec nous !</p>
        <div class="centree">

            <a href="index.php?ctrl=demandeCreateur">
                <button class="button-gris">Demander à être créateur</button>
            </a>
        </div>
        <h2>Créer une histoire</h2>
        <p>Pour nos créateurs voici comment vous approprier l'outil pour écrire vos propres histoires !</p>
        <p>Dans un premier temps, vous mettrez le titre qui vous convient, ainsi que le lieu correspondant. Il vous
            faudra cliquer sur le bouton sauvegarder afin de les enregistrer. Une fois le lieu enregistré, n'hésitez pas
            à cliquer sur le bouton
            <img src="./view/design/image/info.png" alt="informations" id="info"> pour en apprendre plus sur le lieu.
        </p>
        <p>
            En dessous, vous retrouverez un bouton pour gérer vos personnages, vous pourrez choisir parmi nos
            personnages. Il y a également la possibilité de créer, modifier, supprimer et consulter les personnages en
            cliquant sur les boutons correspondants.
        </p>
        <p>
            Ensuite, vous retrouverez des boutons vous permettant d'ajouter dialogues et question sur la partie haute de
            votre page. Vous pourrez également les déplacer, les modifier et les supprimer. Dans la partie "Afficher
            toute l'histoire", la question reste fixée en haut de la page et sa position est indiquée par "POSITION DE
            LA QUESTION" dans la partie.
        </p>
        <p>
            Enfin, vous pourrez demander la publication de votre histoire !
        </p>
        <p>Une fois validée, elle apparaîtra dans le "Chapitre des créateurs" !</p>


        <div class="flex-row centree">
            <img src="https://192.168.14.118/rezisten/imgPersonnage/raymond.webp" alt="Image du personnage numéro 1">
            <img src="https://192.168.14.118/rezisten/imgPersonnage/jean.webp" alt="Image du personnage numéro 2">
        </div>
    </main>
    <?php include_once './view/footer.view.php'; ?>
</body>
<script src="./view/js/dyslexique.js"></script>

</html>
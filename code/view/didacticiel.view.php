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
    <main class="flex-col">
        <h1>Bienvenue dans le didacticiel de Rezisten !</h1>
        <p>Sur notre applications vous disposerez de plusieurs fonctionnalité détaillé si dessous.</p>

        <h2>Votre profil</h2>
        <ul>
            <li>Dans votre profil vous disposez d'un mode pour les dyslexique afin d'adapter votre expérience.</li>
            <li>Vous pouvez également modifier votre mot de passe si l'envie vous en prends.</li>
            <li>Enfin, vous pouvez faire une demande pour devenir créateur !</li>
        </ul>

        <h2>Lecture d'histoire</h2>
        <p>Sur notre application, vous retrouverez 2 types d'histoires. Les histoires officiel écrite par les fondateurs
            de Rézisten et les histoires proposées par des personnes agréés.</p>
        <ul>
            <li>Nos histoires</li>
            <p>Chaque histoire est fictive et se déroule dans un lieu historique ! Les histoires sont des dialogues
                entre des personnages, fictif pour la plupart, mais aussi des personnages historique tel que Jean
                Moulin.</p>
            <p>
                A un moment de l'histoire vous serez interrompus par une question vous invitant à visiter le lieu pour
                en apprendre plus sur celui-ci.
                La première question qui vous est proposées ne peut être répondu qu'en vous rendant sur place et vous
                proposeras une fin plus complète (plus de dialogues, des évènements plus impactant).
                Dans le cas ou vous ne pourriez pas vous rendre sur place vous pouvez changer de question pour une plus
                simple où la réponse se trouve dans la page "consulter lieux".
            </p>
            <p>A la fin d'une histoire vous accéderez à une page vous expliquant succintement la véritable histoire du
                lieu afin que vous puissiez diférencier le réel de l'imaginaire !
            </p>
            <li>Les histoires des créateurs</li>
            <p>Pour les histoires des créateurs, le principe est relativement similaire, la différence est que vous
                aurez une seule question ou vous devrez chercher la réponse sur internet.</p>
        </ul>

        <form action="?" method="get">
            <input type="hidden" name="ctrl" value="histoire">
            <input type="hidden" name="idStory" value="1">
            <input type="hidden" name="idDialog" value="1">
            <input type="hidden" name="didacticiel" value="1">
            <button type="submit">Commencer la lecture -></button>
        </form>
        <h2>Mission recrutement</h2>
        <p>BLABLA CREATEUR</p>

        <a href="index.php?ctrl=demandeCreateur">
            <button class="button-gris">Faire la demande d'être créateur</button>
        </a>


        <div class="flex-row">
            <img src="https://192.168.14.118/rezisten/imgPersonnage/raymond.webp" alt="Image du personnage numéro 1">
            <img src="https://192.168.14.118/rezisten/imgPersonnage/jean.webp" alt="Image du personnage numéro 2">
        </div>
    </main>
    <?php include_once './view/footer.view.php'; ?>
</body>
<script src="./view/js/dyslexique.js"></script>

</html>
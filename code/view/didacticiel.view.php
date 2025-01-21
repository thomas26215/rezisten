<!DOCTYPE html>
<html lang="fr">

<head>
        <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Didacticiel</title>
    <link rel="stylesheet" href="./view/design/global.css">
</head>

<body>
    <?php include_once './view/headerHistoire.view.php'; ?>
    <main class="flex-col">
        <h1>Vous allez commencer votre lecture.</h1>
        <h2>Avant de rentrer dans l'histoire, voici comment se déroulera votre expérience</h2>
        <h3> - Vous serez placé dans la peau de plusieurs personnages ayant vécus a l'époque des faits</h3>
        <h4> - À un moment donné de votre lecture, vous devrez répondre à une question
            en lien avec un site historique. Vous aurez le choix entre deux questions et ce choix impactera 
            la suite de votre aventure.</h4>
        <h5> - Parmi les deux questions, vous pourrez toujours répondre à l'une d'entres elles à l'aide 
            des informations fournies. L'autre cependant vous demendera des connaissances plus poussés des 
            lieux en question, nous vous recommandons donc de les visiter afin de trouver la réponse.
        </h5>
        <h6>Bonne lecture !</h6>
        <form action="?" method="get">
                <input type="hidden" name="ctrl" value="histoire">
                <input type="hidden" name="idStory" value="1">
                <input type="hidden" name="idDialog" value="1">
                <input type="hidden" name="didacticiel" value="1">
            <button type="submit">Commencer la lecture -></button>
        </form>
    </main>
</body>
    <script src="./view/js/dyslexique.js"></script>

</html>
document.addEventListener('DOMContentLoaded', function () {
    // Recommencer tout
    var recommencerOuvrir = document.getElementById('recommencerOuvrir');
    var dialogRecommencer = document.getElementById('dialogRecommencer');
    var fermerRecommencer = document.getElementById('fermerRecommencer');
    var revenirRecommencer = document.getElementById('revenirRecommencer');

    if (recommencerOuvrir && dialogRecommencer && fermerRecommencer && revenirRecommencer) {
        recommencerOuvrir.addEventListener('click', function () {
            dialogRecommencer.showModal();
        });

        fermerRecommencer.addEventListener('click', function () {
            dialogRecommencer.close();
        });

        revenirRecommencer.addEventListener('click', function () {
            dialogRecommencer.close();
        });
    }
});
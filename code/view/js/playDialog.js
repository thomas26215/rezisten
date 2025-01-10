  // Récupérer l'élément audio
  const audioPlayer = document.getElementById("audioPlayer");

  // Affecter la source à l'élément audio
  audioPlayer.src = audioUrl;

  // Lire automatiquement l'audio
  audioPlayer.play().catch(error => {
    console.error("Échec lors de la lecture audio :", error);
  });

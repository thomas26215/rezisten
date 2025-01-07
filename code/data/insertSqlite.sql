-- Insertion dans la table UTILISATEURS
INSERT INTO UTILISATEURS (pseudo, prenom, nom, datenaiss, mail, mot_de_passe, role) 
VALUES 
('jdupont', 'Jean', 'Dupont', '1990-05-15', 'jean.dupont@email.com', 'motdepasse123', 'j'),
('mmartinc', 'Marie', 'Martin', '1985-09-22', 'marie.martin@email.com', 'securepass456', 'c'),
('admin1', 'Admin', 'Istrator', '1980-01-01', 'admin@email.com', 'adminpass789', 'a');

-- Insertion dans la table DEMANDES
INSERT INTO DEMANDES (id_utilisateur, doc) 
VALUES 
(1, 'carte_identite.pdf'),
(2, 'cv_marie_martin.doc');

-- Insertion dans la table LIEUX
INSERT INTO LIEUX (nom, type_lieu, description, commune, coordonnee) 
VALUES 
('Tour Eiffel', 'Monument', 'Célèbre tour en fer à Paris.', 'Paris', '48.8584° N, 2.2945° E'),
('Louvre', 'Musée', 'Musée d\'art célèbre.', 'Paris', '48.8606° N, 2.3376° E'),
('Mont Saint-Michel', 'Site historique', 'Îlot rocheux avec abbaye.', 'Normandie', '48.6368° N, -1.5110° W');

-- Insertion dans la table CHAPITRES
INSERT INTO CHAPITRES (numchap, titre, visible) 
VALUES 
(1, 'Introduction à l\'histoire', 1),
(2, 'Les aventures de Jean', 1),
(3, 'La quête de Marie', 1);

-- Insertion dans la table HISTOIRES
INSERT INTO HISTOIRES (titre, numchap, createur, id_lieu, background) 
VALUES 
('L\'épopée de Jean Dupont', 1, 1, 1, 'Aventure épique à Paris.'),
('Les mystères de Marie Martin', 2, 2, 2, 'Enquête mystérieuse au Louvre.');

-- Insertion dans la table PERSONNAGES
INSERT INTO PERSONNAGES (prenom, nom, img) 
VALUES 
('Jean', 'Dupont', 'jean_dupont.png'),
('Marie', 'Martin', 'marie_martin.png'),
('Pierre', 'Durand', 'pierre_durand.png');

-- Insertion dans la table DIALOGUES
INSERT INTO DIALOGUES (id_histoire, id, interlocuteur, contenu, bonus) 
VALUES 
(1, 1, 1, 'Bonjour! Je suis Jean.', FALSE),
(1, 2, 2, 'Salut Jean! Prêt pour l\'aventure?', TRUE),
(2, 1, 2, 'Qu\'est-ce qui se passe ici?', FALSE);

-- Insertion dans la table APPARITIONS
INSERT INTO APPARITIONS (id_histoire, id_perso) 
VALUES 
(1, 1),
(1, 2),
(2, 2);

-- Insertion dans la table QUESTIONS
INSERT INTO QUESTIONS (id_histoire, question, reponse, type) 
VALUES 
(1, 'Qui est le héros?', 'Jean Dupont', 'g'),
(2, 'Quel est le lieu principal?', 'Louvre', 's');

-- Insertion dans la table PROGRESSION
INSERT INTO PROGRESSION (id_utilisateur, id_hist, statut) 
VALUES 
(1, 1, TRUE),
(2, 2, FALSE);


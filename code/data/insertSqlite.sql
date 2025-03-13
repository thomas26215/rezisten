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
('Louvre', 'Musée', 'Musée d''art célèbre.', 'Paris', '48.8606° N, 2.3376° E'),
('Mont Saint-Michel', 'Site historique', 'Îlot rocheux avec abbaye.', 'Normandie', '48.6368° N, -1.5110° W');

-- Insertion dans la table CHAPITRES
INSERT INTO CHAPITRES (numchap, titre) 
VALUES 
(1, 'Introduction à l''histoire'),
(2, 'Les aventures de Jean'),
(3, 'La quête de Marie');

-- Insertion dans la table HISTOIRES
INSERT INTO HISTOIRES (titre, numchap, createur, id_lieu, background) 
VALUES 
('L''épopée de Jean Dupont', 1, 1, 1, 'Aventure épique à Paris.'),
('Les mystères de Marie Martin', 2, 2, 2, 'Enquête mystérieuse au Louvre.');

-- Insertion dans la table PERSONNAGES
INSERT INTO PERSONNAGES (prenom, img) 
VALUES 
('Jean Dupont', 'jean_dupont.png'),
('Marie Martin ', marie_martin.png)



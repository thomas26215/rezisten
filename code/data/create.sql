-- Table des utilisateurs
CREATE TABLE UTILISATEURS (
    id SERIAL PRIMARY KEY,  -- Identifiant unique auto-incrémenté pour chaque utilisateur
    pseudo VARCHAR(20) NOT NULL UNIQUE,   -- Nom d'utilisateur unique
    prenom VARCHAR(50),                      -- Prénom de l'utilisateur
    nom VARCHAR(50),                      -- Nom de famille de l'utilisateur
    datenaiss DATE NOT NULL,                -- Date de naissance de l'utilisateur
    mail VARCHAR(255) NOT NULL,             -- Adresse email de l'utilisateur (doit être unique)
    mot_de_passe TEXT NOT NULL,                 -- Mot de passe haché
                                            --(si false, il ne peut pas être dans la table créateur)
    role CHAR(1) NOT NULL,                  -- indique si l'utilisateur est un admin ou non, en théorie 1 seul admin
    CONSTRAINT mailFormat CHECK (mail LIKE '%@%.%'),  -- Vérification du format de l'email
    CONSTRAINT roleName CHECK (role IN('j','c','a')),
    CONSTRAINT pswdLength CHECK (LENGTH(mot_de_passe) >= 10) -- Vérification que le mot de passe a au moins 10 caractères
);

--Table des demandes de créateurs
CREATE TABLE DEMANDES(
    id_utilisateur INTEGER PRIMARY KEY,         -- Référence un utilisateur de la table UTILISATEURS
    doc VARCHAR(50),                  -- Nom d'un fichier image qui contient la carte d'identité de la personne
    FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEURS(id)
);

-- Table des lieux associés aux histoires
CREATE TABLE LIEUX (
    id SERIAL PRIMARY KEY,   -- Identifiant unique auto-incrémenté pour chaque lieu
    nom VARCHAR,
    type_lieu VARCHAR,
    description VARCHAR,
    commune VARCHAR,
    coordonnee VARCHAR
);

-- Table des chapitres 
CREATE TABLE CHAPITRES (
    numchap INT PRIMARY KEY,                  -- Numéro unique pour chaque chapitre 
    titre VARCHAR(50) NOT NULL,                -- Titre du chapitre 
);

-- Table des histoires associées aux chapitres
CREATE TABLE HISTOIRES (
    id SERIAL PRIMARY KEY,                     -- Identifiant unique au sein d'un chapitre
    titre VARCHAR(50) NOT NULL,              -- Titre de l'histoire
    numchap INTEGER NOT NULL,                -- Numéro du chapitre associé à cette histoire (peut être redondant si plusieurs chapitres)
    createur INTEGER,                         -- Référence à l'identifiant du créateur dans la table CREATEURS
    id_lieu INTEGER,                         -- Référence à l'identifiant du lieu dans la table LIEUX
    background varchar(50) NOT NULL,         -- Nom de l'image d'arrière plan de l'histoire stockée sur le serveur web
    visible boolean,                             -- vrai si le chapitre a été validé, faux sinon
    FOREIGN KEY (id_lieu) REFERENCES LIEUX(id),  -- Clé étrangère référencée à la table LIEUX
    FOREIGN KEY (numchap) REFERENCES CHAPITRES(numchap),  -- Clé étrangère référencée à la table CHAPITRES
    FOREIGN KEY (createur) REFERENCES UTILISATEURS(id)   -- Clé étrangère référencée à la table CREATEURS
);

-- Table des personnages du jeu
CREATE TABLE PERSONNAGES(
    id SERIAL PRIMARY KEY,          -- Identifiant du personnage pour faciliter l'unicité des n-uplets
    prenom varchar(50) NOT NULL,    -- Prenom du personnage
    img varchar(50) NOT NULL        -- Nom de l'image (le modèle) du personnage stockée ailleurs
);

-- Table des dialogues associés aux histoires
CREATE TABLE DIALOGUES (
    id INTEGER,                       -- Identifiant unique pour chaque dialogue
    id_histoire INTEGER,                     -- Référence à l'identifiant de l'histoire associée
    interlocuteur INTEGER,                    -- Référence au personnage qui dit ce dialogue
    contenu VARCHAR(400),                    -- Contenu du dialogue
    bonus BOOLEAN NOT NULL,                  -- Dialogue étant un bonus lié à la question spécifique
    PRIMARY KEY(id_histoire, id),     -- Clé primaire composite pour garantir l'unicité par histoire et dialogue
    FOREIGN KEY (id_histoire) REFERENCES HISTOIRES(id),  -- Clé étrangère référencée à la table HISTOIRES
    FOREIGN KEY (interlocuteur) REFERENCES PERSONNAGES(id)
);

-- Table des apparitions des personnages, permet de savoir dans quelle histoire se trouve quels personnages
CREATE TABLE APPARITIONS(
    id_histoire SERIAL,
    id_perso SERIAL,
    FOREIGN KEY (id_histoire) REFERENCES HISTOIRES(id),
    FOREIGN KEY (id_perso) REFERENCES PERSONNAGES(id),
    PRIMARY KEY(id_histoire,id_perso)
);

-- Table des questions associées aux histoires
CREATE TABLE QUESTIONS (
    id_histoire INTEGER,                    -- Référence à l'identifiant de l'histoire associée
    question VARCHAR(100) NOT NULL,         -- Question liée à l'histoire
    reponse VARCHAR(50) NOT NULL,           -- Réponse à la question
    type CHAR CHECK (type IN('g','s')),     -- Type de question ('g' pour générale, 's' pour spécifique)
    PRIMARY KEY(id_histoire,type),
    FOREIGN KEY (id_histoire) REFERENCES HISTOIRES(id)  -- Clé étrangère référencée à la table HISTOIRES
);


-- Table suivant la progression des utilisateurs dans les histoires
CREATE TABLE PROGRESSION (
    id_utilisateur INTEGER,                    -- Nom d'utilisateur lié à la progression 
    id_hist INTEGER,                         -- Référence à l'identifiant de l'histoire associée 
    statut BOOLEAN DEFAULT false,  -- Statut de progression si true : histoire finie, sinon histoire non tentée
    FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEURS(id),  -- Clé étrangère référencée à la table UTILISATEURS 
    FOREIGN KEY (id_hist) REFERENCES HISTOIRES(id),     -- Clé étrangère référencée à la table HISTOIRES 
    PRIMARY KEY (id_utilisateur, id_hist)          -- Clé primaire composite pour garantir l'unicité par utilisateur et histoire 
);



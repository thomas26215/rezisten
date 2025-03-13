-- Table des utilisateurs
CREATE TABLE USERS (
    id SERIAL PRIMARY KEY,  -- Identifiant unique auto-incrémenté pour chaque utilisateur
    username VARCHAR(20) NOT NULL UNIQUE,   -- Nom d'utilisateur unique
    prenom VARCHAR(50),                      -- Prénom de l'utilisateur
    nom VARCHAR(50),                         -- Nom de famille de l'utilisateur
    datenaissance DATE NOT NULL,                      -- Date de naissance de l'utilisateur
    mail VARCHAR(255) NOT NULL,             -- Adresse email de l'utilisateur (doit être unique)
    password TEXT NOT NULL,                     -- Mot de passe haché
    demandecreateur boolean,                    -- booléen indiquant si l'utilisateur a déjà demandé à être créateur 
                                                --(si false, il ne peut pas être dans la table créateur)
    CONSTRAINT mailFormat CHECK (mail LIKE '%@%.%'),  -- Vérification du format de l'email
    CONSTRAINT pswdLength CHECK (LENGTH(password) >= 10) -- Vérification que le mot de passe a au moins 10 caractères
);

-- Table des créateurs
CREATE TABLE CREATEURS (
    user_id INTEGER PRIMARY KEY,             -- Référence à l'identifiant de l'utilisateur dans la table USERS
    FOREIGN KEY (user_id) REFERENCES USERS(id)  -- Clé étrangère référencée à la table USERS
);

-- Table des administrateurs
CREATE TABLE ADMIN (
    createur_id INTEGER PRIMARY KEY,             -- Référence à l'identifiant de l'utilisateur dans la table USERS
    FOREIGN KEY (createur_id) REFERENCES CREATEURS(user_id)  -- Clé étrangère référencée à la table USERS
);

-- Table des lieux associés aux histoires
CREATE TABLE LIEUX (
    id_lieu SERIAL PRIMARY KEY,   -- Identifiant unique auto-incrémenté pour chaque lieu
    site_web VARCHAR(255),                   -- URL du site web associé au lieu (facultatif)
    nom VARCHAR(50) NOT NULL,                -- Nom du lieu (obligatoire)
    adresse VARCHAR(255)                     -- Adresse du lieu (facultatif)
);

-- Table des chapitres 
CREATE TABLE CHAPITRES (
    numchap INT PRIMARY KEY,                  -- Numéro unique pour chaque chapitre 
    titre VARCHAR(50) NOT NULL,                -- Titre du chapitre 
    visible boolean                             -- vrai si le chapitre a été validé, faux sinon
);

-- Table des histoires associées aux chapitres
CREATE TABLE HISTOIRES (
    id_histoire SERIAL PRIMARY KEY,                     -- Identifiant unique au sein d'un chapitre
    titre VARCHAR(50) NOT NULL,              -- Titre de l'histoire
    numchap INTEGER NOT NULL,                -- Numéro du chapitre associé à cette histoire (peut être redondant si plusieurs chapitres)
    createur INTEGER,                         -- Référence à l'identifiant du créateur dans la table CREATEURS
    id_lieu INTEGER,                         -- Référence à l'identifiant du lieu dans la table LIEUX
    background varchar(50) NOT NULL,         -- Nom de l'image d'arrière plan de l'histoire stockée sur le serveur web
    FOREIGN KEY (id_lieu) REFERENCES LIEUX(id_lieu),  -- Clé étrangère référencée à la table LIEUX
    FOREIGN KEY (numchap) REFERENCES CHAPITRES(numchap),  -- Clé étrangère référencée à la table CHAPITRES
    FOREIGN KEY (createur) REFERENCES CREATEURS(user_id)   -- Clé étrangère référencée à la table CREATEURS
);

-- Table des personnages du jeu
CREATE TABLE PERSONNAGES(
    id_perso SERIAL PRIMARY KEY,          -- Identifiant du personnage pour faciliter l'unicité des n-uplets
    prenom varchar(50) NOT NULL,    -- Prenom du personnage
    nom varchar(50) NOT NULL,       -- Nom du personnage
    img varchar(50) NOT NULL        -- Nom de l'image (le modèle) du personnage stockée ailleurs
);

-- Table des dialogues associés aux histoires
CREATE TABLE DIALOGUES (
    id_dialog INTEGER,                       -- Identifiant unique pour chaque dialogue
    id_histoire INTEGER,                     -- Référence à l'identifiant de l'histoire associée
    interlocuteur SERIAL,                    -- Référence au personnage qui dit ce dialogue
    contenu VARCHAR(400),                    -- Contenu du dialogue
    bonus BOOLEAN NOT NULL,
    PRIMARY KEY(id_histoire, id_dialog),     -- Clé primaire composite pour garantir l'unicité par histoire et dialogue
    FOREIGN KEY (id_histoire) REFERENCES HISTOIRES(id_histoire),  -- Clé étrangère référencée à la table HISTOIRES
    FOREIGN KEY (interlocuteur) REFERENCES PERSONNAGES(id_perso)
);

-- Table des apparitions des personnages, permet de savoir dans quelle histoire se trouve quels personnages
CREATE TABLE APPARITION(
    id_histoire SERIAL,
    id_perso SERIAL,
    FOREIGN KEY (id_histoire) REFERENCES HISTOIRES(id_histoire),
    FOREIGN KEY (id_perso) REFERENCES PERSONNAGES(id_perso),
    PRIMARY KEY(id_histoire,id_perso)
);

-- Table des questions associées aux histoires
CREATE TABLE QUESTIONS (
    --id INTEGER PRIMARY KEY AUTOINCREMENT,   -- Identifiant unique auto-incrémenté pour chaque question
    id_histoire INTEGER,                    -- Référence à l'identifiant de l'histoire associée
    question VARCHAR(100) NOT NULL,         -- Question liée à l'histoire
    reponse VARCHAR(50) NOT NULL,           -- Réponse à la question
    type CHAR CHECK (type IN('g','s')),     -- Type de question ('g' pour générale, 's' pour spécifique)
    PRIMARY KEY(id_histoire,type),
    FOREIGN KEY (id_histoire) REFERENCES HISTOIRES(id_histoire)  -- Clé étrangère référencée à la table HISTOIRES
);


-- Table suivant la progression des utilisateurs dans les histoires
CREATE TABLE PROGRESSION (
    user_id INTEGER,                    -- Nom d'utilisateur lié à la progression 
    id_hist INTEGER,                         -- Référence à l'identifiant de l'histoire associée 
    statut BOOLEAN DEFAULT false,  -- Statut de progression ('n' = non tenté, 'c' = en cours, 'f' = fini)
    FOREIGN KEY (user_id) REFERENCES USERS(id),  -- Clé étrangère référencée à la table USERS 
    FOREIGN KEY (id_hist) REFERENCES HISTOIRES(id_histoire),     -- Clé étrangère référencée à la table HISTOIRES 
    PRIMARY KEY (user_id, id_hist)          -- Clé primaire composite pour garantir l'unicité par utilisateur et histoire 
);



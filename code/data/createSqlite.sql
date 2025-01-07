-- Table des utilisateurs
CREATE TABLE UTILISATEURS (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    pseudo VARCHAR(20) NOT NULL UNIQUE,
    prenom VARCHAR(50),
    nom VARCHAR(50),
    datenaiss DATE NOT NULL,
    mail VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe TEXT NOT NULL,
    role CHAR(1) NOT NULL,
    CONSTRAINT mailFormat CHECK (mail LIKE '%@%.%'),
    CONSTRAINT roleName CHECK (role IN('j','c','a')),
    CONSTRAINT pswdLength CHECK (LENGTH(mot_de_passe) >= 10)
);

-- Table des demandes de créateurs
CREATE TABLE DEMANDES(
    id_utilisateur INTEGER PRIMARY KEY,
    doc VARCHAR(50),
    FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEURS(id)
);

-- Table des lieux associés aux histoires
CREATE TABLE LIEUX (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR,
    type_lieu VARCHAR,
    description VARCHAR,
    commune VARCHAR,
    coordonnee VARCHAR
);

-- Table des chapitres 
CREATE TABLE CHAPITRES (
    numchap INTEGER PRIMARY KEY,
    titre VARCHAR(50) NOT NULL,
    visible BOOLEAN
);

-- Table des histoires associées aux chapitres
CREATE TABLE HISTOIRES (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titre VARCHAR(50) NOT NULL,
    numchap INTEGER NOT NULL,
    createur INTEGER,
    id_lieu INTEGER,
    background VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_lieu) REFERENCES LIEUX(id),
    FOREIGN KEY (numchap) REFERENCES CHAPITRES(numchap),
    FOREIGN KEY (createur) REFERENCES UTILISATEURS(id)
);

-- Table des personnages du jeu
CREATE TABLE PERSONNAGES(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prenom VARCHAR(50) NOT NULL,
    img VARCHAR(50) NOT NULL
);

-- Table des dialogues associés aux histoires
CREATE TABLE DIALOGUES (
    id INTEGER,
    id_histoire INTEGER,
    interlocuteur INTEGER,
    contenu VARCHAR(400),
    bonus BOOLEAN NOT NULL,
    PRIMARY KEY(id_histoire, id),
    FOREIGN KEY (id_histoire) REFERENCES HISTOIRES(id),
    FOREIGN KEY (interlocuteur) REFERENCES PERSONNAGES(id)
);

-- Table des apparitions des personnages
CREATE TABLE APPARITIONS(
    id_histoire INTEGER,
    id_perso INTEGER,
    FOREIGN KEY (id_histoire) REFERENCES HISTOIRES(id),
    FOREIGN KEY (id_perso) REFERENCES PERSONNAGES(id),
    PRIMARY KEY(id_histoire,id_perso)
);

-- Table des questions associées aux histoires
CREATE TABLE QUESTIONS (
    id_histoire INTEGER,
    question VARCHAR(100) NOT NULL,
    reponse VARCHAR(50) NOT NULL,
    type CHAR CHECK (type IN('g','s')),
    PRIMARY KEY(id_histoire,type),
    FOREIGN KEY (id_histoire) REFERENCES HISTOIRES(id)
);

-- Table suivant la progression des utilisateurs dans les histoires
CREATE TABLE PROGRESSION (
    id_utilisateur INTEGER,
    id_hist INTEGER,
    statut BOOLEAN DEFAULT 0,
    FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEURS(id),
    FOREIGN KEY (id_hist) REFERENCES HISTOIRES(id),
    PRIMARY KEY (id_utilisateur, id_hist)
);


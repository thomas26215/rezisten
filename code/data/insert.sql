-- Création de 3 utilisateurs illustrant chacun un rôle spécifique.
INSERT INTO UTILISATEURS(pseudo,datenaiss,mail,mot_de_passe,role) VALUES('tritri','2005-06-14','tritri@gmail.com','1945lo1234','j');
INSERT INTO UTILISATEURS(pseudo,prenom,nom,datenaiss,mail,mot_de_passe,role) VALUES('aiel','quentin','pingouin','2005-10-12','aiel.gaming@gmail.com','lepgm2024du','j');
INSERT INTO UTILISATEURS(pseudo,prenom,nom,datenaiss,mail,mot_de_passe,role) VALUES('jeanm','jean','mejean','1978-10-31','jean.mejean@gmail.com','12hist34prof ','c');
INSERT INTO UTILISATEURS(pseudo,datenaiss,mail,mot_de_passe,role) VALUES ('admin_rezisten','1999-09-12','admin.rezisten@rezisten.fr','jesuisadmin2025','a');

-- Ajout d'une demande de créateur
INSERT INTO DEMANDES VALUES(2,'aiel-id.png');

--Création des deux premiers chapitres de l'histoire
INSERT INTO CHAPITRES(numchap,titre,visible) values(0,'prologue',true);

--Création d'une hisoitr pour le prologue et deux pour le chapitre 1
INSERT INTO HISTOIRES(titre,numchap,createur,id_lieu,background) values('le commencement',0,4,3,'hist_bg.webp');

--Création de deux personnages participants au prologue
INSERT INTO PERSONNAGES(prenom,nom,img) values('jean','dupont','jeandupont.webp');

--Création de dialogues pour l'histoire 1 qui correspond au premier niveau du prologue
INSERT INTO DIALOGUES(id, id_histoire,interlocuteur, contenu,bonus) values(0,1,1,'bonjour commandant !',false);



--Précision des apparitions dans la table prévue
INSERT INTO APPARITIONS values(1,1);

--Création des questions pour prologue
INSERT INTO QUESTIONS(id_histoire,question,reponse,type) values(1,'quelle date le début de la guerre ?','1er septembre','g');
INSERT INTO QUESTIONS(id_histoire,question,reponse,type) values(1,'qui est ce ?','général de gaulle','s');

--Spécification de la progression du joueur 2
INSERT INTO PROGRESSION(id_utilisateur,id_hist,statut) values(1,1,'t');


INSERT INTO PROGRESSION(id_utilisateur,id_hist,statut) values(2,1,'f');




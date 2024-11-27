-- Création de 3 utilisateurs illustrant chacun un rôle spécifique.
INSERT INTO USERS(username,prenom,datenaissance,mail,password,demandecreateur) values('admin','rezisten','2000-05-10',
'rezisten@gmail.com','wearerezisten1234',false);

INSERT INTO USERS(username,prenom,datenaissance,mail,password,demandecreateur) values('fontanit','tristan','2003-06-21',
'tristan@gmail.com','testtristan1234',true);

INSERT INTO USERS(username,prenom,datenaissance,mail,password,demandecreateur) values('toto','jean-toto','2002-07-22',
'totolegeek@gmail.com','totolepgm1234',false);

--Spécification d'un créateur et d'un admin
INSERT INTO CREATEURS values(2);
INSERT INTO CREATEURS values(1);
INSERT INTO ADMIN values(1);

--Création de deux lieux de base
INSERT INTO LIEUX(site_web,nom,adresse) values('montluc.fr','prison de mont-luc','8 rue de la résistance');
INSERT INTO LIEUX(site_web,nom,adresse) values('verdun.com','champ de verdun','9 impasse de la liberté');

--Création des deux premiers chapitres de l'histoire
INSERT INTO CHAPITRES(numchap,titre,visible) values(0,'prologue',true);
INSERT INTO CHAPITRES(numchap,titre,visible) values(1,'vers un nouveau lendemain',true);

--Création d'une hisoitr pour le prologue et deux pour le chapitre 1
INSERT INTO HISTOIRES(titre,numchap,createur,id_lieu,background) values('la chute',0,1,2,'verduncalme.webp');
INSERT INTO HISTOIRES(titre,numchap,createur,id_lieu,background) values('réunion militaire',1,1,1,'montluc.webp');
INSERT INTO HISTOIRES(titre,numchap,createur,id_lieu,background) values('début des combats',1,1,2,'montlucdetruit.webp');



--Création de deux personnages participants au prologue
INSERT INTO PERSONNAGES(prenom,nom,img) values('jean','dupont','jeandupont.jpeg');
INSERT INTO PERSONNAGES(prenom,nom,img) values('michel','durand','micheldurand.jpeg');

--Création de dialogues pour l'histoire 1 qui correspond au premier niveau du prologue
INSERT INTO DIALOGUES(id_dialog, id_histoire,interlocuteur, contenu) values(0,1,1,'bonjour commandant !');
INSERT INTO DIALOGUES(id_dialog, id_histoire,interlocuteur, contenu) values(1,1,1,'comment allez vous ?');
INSERT INTO DIALOGUES(id_dialog, id_histoire,interlocuteur, contenu) values(2,1,2,'tu as lu le journal ...?');

--Création d'un dialogue pour le niveau 2 dans le chapitre 1
INSERT INTO DIALOGUES(id_dialog, id_histoire,interlocuteur, contenu) values(0,2,1,'Tous à couvert !');

--Précision des apparitions dans la table prévue
INSERT INTO APPARITION values(1,1);
INSERT INTO APPARITION values(1,2);

--Création des questions pour prologue
INSERT INTO QUESTIONS(id_histoire,question,reponse,type) values(1,'quelle date le début de la guerre ?','1er septembre','g');
INSERT INTO QUESTIONS(id_histoire,question,reponse,type) values(1,'qui est ce ?','général de gaulle','s');

--Spécification de la progression du joueur 2
INSERT INTO PROGRESSION(user_id,id_hist,statut) values(2,1,'f');
INSERT INTO PROGRESSION(user_id,id_hist,statut) values(2,2,'f');
INSERT INTO PROGRESSION(user_id,id_hist,statut) values(2,3,'n');


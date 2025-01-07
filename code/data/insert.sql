-- Création de 3 utilisateurs illustrant chacun un rôle spécifique.
INSERT INTO UTILISATEURS(pseudo,datenaiss,mail,mot_de_passe,role) VALUES('tritri','2005-06-14','tritri@gmail.com','1945lo1234','j');
INSERT INTO UTILISATEURS(pseudo,prenom,nom,datenaiss,mail,mot_de_passe,role) VALUES('aiel','quentin','pingouin','2005-10-12','aiel.gaming@gmail.com','lepgm2024du','j');
INSERT INTO UTILISATEURS(pseudo,prenom,nom,datenaiss,mail,mot_de_passe,role) VALUES('jeanm','jean','mejean','1978-10-31','jean.mejean@gmail.com','12hist34prof ','c');
INSERT INTO UTILISATEURS(pseudo,datenaiss,mail,mot_de_passe,role) VALUES ('admin_rezisten','1999-09-12','admin.rezisten@rezisten.fr','jesuisadmin2025','a');

-- Ajout d'une demande de créateur
INSERT INTO DEMANDES VALUES(2,'aiel-id.png');

--Création des deux premiers chapitres de l'histoire
INSERT INTO CHAPITRES(numchap,titre,visible) values(0,'Prologue',true);
INSERT INTO CHAPITRES(numchap,titre,visible) values(0,'L''heure de résister',true);


--Création d'une hisoitr pour le prologue et deux pour le chapitre 1
INSERT INTO HISTOIRES(titre,numchap,createur,id_lieu,background) values('Un jour de septembre',0,8,3,'hist0_bg.webp');
INSERT INTO HISTOIRES(titre,numchap,createur,id_lieu,background) values('Une rencontre fortuite',0,4,3,'hist1_bg.webp');
INSERT INTO HISTOIRES(titre,numchap,createur,id_lieu,background) values('Sabotage',0,4,3,'hist2_bg.webp');


--Création de deux personnages participants au prologue
INSERT INTO PERSONNAGES(prenom,img) values('Raymond','raymond.webp'); --1
INSERT INTO PERSONNAGES(prenom,img) values('Pierre','pierre.webp');   --2
INSERT INTO PERSONNAGES(prenom,img) values('Jean','jean.webp');       --3
INSERT INTO PERSONNAGES(prenom,img) values('André','andre.webp');     --4
INSERT INTO PERSONNAGES(prenom,img) values('David','david.webp');     --5
INSERT INTO PERSONNAGES(prenom,img) values('Michel','michel.webp');   --6
INSERT INTO PERSONNAGES(prenom,img) values('Marie','marie.webp');     --7
INSERT INTO PERSONNAGES(prenom,img) values('Milicien','milicien.webp'); --8
INSERT INTO PERSONNAGES(prenom,img) values('Inconnu','inconnu.webp');   --9
INSERT INTO PERSONNAGES(prenom,img) values('Narrateur','narrateur.webp'); --10




--Création de dialogues pour l'histoire 1 qui correspond au premier niveau du prologue
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (1,1,10,'Les forces françaises se retirent peu à peu du front alors que le premier ministre a
démissionné il y a seulement quelques jours….',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (2,1,1,'Éteint ça, on va se faire repérer !',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (3,1,1,'𝑁𝑜𝑢𝑠 𝑒́𝑡𝑖𝑜𝑛𝑠 𝑡𝑜𝑢𝑠 𝑙𝑒𝑠 𝟻 𝑑𝑎𝑛𝑠 𝑠𝑎 𝑐ℎ𝑎𝑚𝑏𝑟𝑒 𝑐𝑎𝑟 𝑖𝑙 𝑒́𝑡𝑎𝑖𝑡 𝑙𝑒 𝑠𝑒𝑢𝑙 𝑎̀ 𝑛𝑒 𝑝𝑎𝑠 𝑜𝑠𝑒𝑟 𝑠𝑜𝑟𝑡𝑖𝑟 𝑑𝑎𝑛𝑠 𝑙𝑒𝑠 𝑐𝑜𝑢𝑙𝑜𝑖𝑟𝑠 𝑎𝑝𝑟𝑒̀𝑠
𝑙𝑒 𝑐𝑜𝑢𝑣𝑟𝑒 𝑓𝑒𝑢, 𝑐𝑒 𝑞𝑢𝑖 𝑛’𝑒́𝑡𝑎𝑖𝑡 𝑝𝑎𝑠 𝑑𝑢 𝑡𝑜𝑢𝑡 𝑙𝑒 𝑐𝑎𝑠 𝑑𝑒 𝑃𝑖𝑒𝑟𝑟𝑒 𝑑’𝑎𝑖𝑙𝑙𝑒𝑢𝑟𝑠..',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (4,1,2,'Mais non ! Arrête de t’inquiéter pour rien, les surveillants sont tous bien trop occupés à écouter la
leur de radio, il n’y a aucun risque pour nous.',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (5,1,10,'𝐽𝑒 𝑙𝑢𝑖 𝑡𝑒𝑛𝑑𝑠 𝑎𝑙𝑜𝑟𝑠 𝑢𝑛 𝑣𝑒𝑟𝑟𝑒. 𝐷𝑒 𝑙𝑎 𝑔𝑛𝑜𝑙𝑒 𝑓𝑎𝑖𝑡𝑒 𝑝𝑎𝑟 𝑚𝑜𝑛 𝑔𝑟𝑎𝑛𝑑-𝑝𝑒̀𝑟𝑒 𝑞𝑢𝑒 𝑗’𝑎𝑖 𝑟𝑎𝑚𝑒𝑛𝑒́ 𝑖𝑙 𝑦 𝑎 𝑑𝑒́𝑗𝑎̀ 𝑞𝑢𝑒𝑙𝑞𝑢𝑒𝑠
𝑠𝑒𝑚𝑎𝑖𝑛𝑒𝑠 𝑑𝑒 𝑐̧𝑎. 𝑅𝑎𝑦𝑚𝑜𝑛𝑑 𝑙’𝑎𝑐𝑐𝑒𝑝𝑡𝑒 𝑎 𝑐𝑜𝑛𝑡𝑟𝑒-𝑐œ𝑢𝑟 𝑒𝑡 𝑒𝑛 𝑝𝑟𝑒𝑛𝑑 𝑢𝑛𝑒 𝑔𝑜𝑟𝑔𝑒́𝑒.',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (6,1,1,'Ça ne vous fait pas peur vous qu’on ait perdu aussi vite ?',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (7,1,3,'Mais non ! Tout va bien, c’est de l’autre coté de la France, il n''y a pas de raison que ça nous impacte.
 ',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (8,1,2,'Exactement, maintenant amuse-toi avec nous ! ',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (9,1,5,'Le sort de tes parents ne t’inquiète pas pierre ?',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (10,1,10,'David est assis sur un lit dans un coin de la pièce, a son habitude.',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (11,1,5,'Ils habitent dans le nord pourtant non ?',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (12,1,10,'Pierre garde le sourire, mais son expression se crispe un peu en entendant ces mots. Après quelques moments
de réflexion, il rétorque.',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (13,1,2,'Non, ils se sont déjà eloignés des conflits depuis quelques mois. Demande plutôt a André, ses
parents à lui refusent de se mettre en sécurité ',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (14,1,4,'Et je les comprends, dans tous les cas personnes n’oserai les y forcer, ils sont bien trop puissants.',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (15,1,5,'L’argent ne sauve pas de tout tu sais ?',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (16,1,4,'C’est cela, et il ne fait pas le bonheur non plus.',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (16,1,2,'Bon ce n’est pas tout ça mais cette radio me déprime... J’ai entendu parler d’une radio qui diffuse
encore de la musique sur la fréquence 89.9, je vais essayer de la capter. ',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (17,1,10,'Pierre commence alors à manipuler la radio pendant un long moment. Jusqu''à ce que quelqu''un l''interrompe soudainement.',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (18,1,5,'Attends !',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (19,1,3,'Je crois que j’ai entendu quelque chose moi aussi, reviens en arrière.',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (20,1,1,'La radio grésille jusqu''à ce que retentissent des mots que nous n’oublierions jamais.',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (21,1,9,'Malgré nos efforts, nous avons été submergés par la force terrestre et aérienne de l''ennemi...',false);
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES (22,1,9,'Dès demain matin, nous engageons la mobilisation générales des citoyens français dans ces combats.',false);





--Précision des apparitions dans la table prévue
INSERT INTO APPARITIONS values(1,1);
INSERT INTO APPARITIONS values(1,2);
INSERT INTO APPARITIONS values(1,3);
INSERT INTO APPARITIONS values(1,4);
INSERT INTO APPARITIONS values(1,5);
INSERT INTO APPARITIONS values(1,9);
INSERT INTO APPARITIONS values(1,10);

--Création des questions pour prologue
INSERT INTO QUESTIONS(id_histoire,question,reponse,type) values(1,'quelle date le début de la guerre ?','1er septembre','g');
INSERT INTO QUESTIONS(id_histoire,question,reponse,type) values(1,'qui est ce ?','général de gaulle','s');

--Spécification de la progression du joueur 2
INSERT INTO PROGRESSION(id_utilisateur,id_hist,statut) values(1,1,'t');


INSERT INTO PROGRESSION(id_utilisateur,id_hist,statut) values(2,1,'f');




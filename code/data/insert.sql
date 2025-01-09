-- Création de 3 utilisateurs illustrant chacun un rôle spécifique.
INSERT INTO UTILISATEURS(pseudo,prenom,nom,datenaiss,mail,mot_de_passe,role) VALUES('tritri','tristan','font','2005-06-14','tritri@gmail.com','1945lo1234','j'),
('aiel','quentin','pingouin','2005-10-12','aiel.gaming@gmail.com','lepgm2024du','j'),
('jeanm','jean','mejean','1978-10-31','jean.mejean@gmail.com','12hist34prof ','c'),
('admin_rezisten','admin','admin','1999-09-12','admin.rezisten@rezisten.fr','jesuisadmin2025','a');

-- Ajout d'une demande de créateur
INSERT INTO DEMANDES VALUES(2,'aiel-id.png');

--Création des deux premiers chapitres de l'histoire
INSERT INTO CHAPITRES(numchap,titre) values(0,'Prologue'),
(1,'L''heure de résister');


--Création d'une hisoitr pour le prologue et deux pour le chapitre 1
INSERT INTO HISTOIRES(titre,numchap,createur,id_lieu,background,visible) values('Un jour de septembre',0,4,8,'hist0_bg.webp',true),
('Une rencontre fortuite',0,4,2,'hist1_bg.webp',true);


--Création de deux personnages participants au prologue
INSERT INTO PERSONNAGES(prenom,img) values('Raymond','raymond.webp'), --1
('Pierre','pierre.webp'),   --2
('Jean','jean.webp'),       --3
('André','andre.webp'),     --4
('David','david.webp'),     --5
('Michel','michel.webp'),   --6
('Marie','marie.webp'),     --7
('Milicien','milicien.webp'), --8
('Inconnu','inconnu.webp'),   --9
('Narrateur','narrateur.webp'); --10




--Création de dialogues pour l'histoire 1 qui correspond au premier niveau du prologue
-- Dialogues du prologue
INSERT INTO DIALOGUES (id, id_histoire, interlocuteur, contenu, bonus) 
VALUES 
(1, 1, 10, 'Les forces françaises se retirent peu à peu du front alors que le premier ministre a démissionné il y a seulement quelques jours….', false),
(2, 1, 1, 'Éteint ça, on va se faire repérer !', false),
(3, 1, 3, '𝑁𝑜𝑢𝑠 𝑒́𝑡𝑖𝑜𝑛𝑠 𝑡𝑜𝑢𝑠 𝑙𝑒𝑠 𝟻 𝑑𝑎𝑛𝑠 𝑠𝑎 𝑐ℎ𝑎𝑚𝑏𝑟𝑒 𝑐𝑎𝑟 𝑖𝑙 𝑒́𝑡𝑎𝑖𝑡 𝑙𝑒 𝑠𝑒𝑢𝑙 𝑎̀ 𝑛𝑒 𝑝𝑎𝑠 𝑜𝑠𝑒𝑟 𝑠𝑜𝑟𝑡𝑖𝑟 𝑑𝑎𝑛𝑠 𝑙𝑒𝑠 𝑐𝑜𝑢𝑙𝑜𝑖𝑟𝑠 𝑎𝑝𝑟𝑒̀𝑠 𝑙𝑒 𝑐𝑜𝑢𝑣𝑟𝑒 𝑓𝑒𝑢, 𝑐𝑒 𝑞𝑢𝑖 𝑛’𝑒́𝑡𝑎𝑖𝑡 𝑝𝑎𝑠 𝑑𝑢 𝑡𝑜𝑢𝑡 𝑙𝑒 𝑐𝑎𝑠 𝑑𝑒 𝑃𝑖𝑒𝑟𝑟𝑒 𝑑’𝑎𝑖𝑙𝑙𝑒𝑢𝑟𝑠..', false),
(4, 1, 2, 'Mais non ! Arrête de t’inquiéter pour rien, les surveillants sont tous bien trop occupés à écouter la leur de radio, il n’y a aucun risque pour nous.', false),
(5, 1, 3, '𝐽𝑒 𝑡𝑒𝑛𝑑𝑠 𝑎𝑙𝑜𝑟𝑠 𝑢𝑛 𝑣𝑒𝑟𝑟𝑒 à Raymond. 𝐷𝑒 𝑙𝑎 𝑔𝑛𝑜𝑙𝑒 𝑓𝑎𝑖𝑡𝑒 𝑝𝑎𝑟 𝑚𝑜𝑛 𝑔𝑟𝑎𝑛𝑑-𝑝𝑒̀𝑟𝑒 𝑞𝑢𝑒 𝑗’𝑎𝑖 𝑟𝑎𝑚𝑒𝑛𝑒́ 𝑖𝑙 𝑦 𝑎 𝑑𝑒́𝑗𝑎̀ 𝑞𝑢𝑒𝑙𝑞𝑢𝑒𝑠 semaines de ça. 𝑅𝑎𝑦𝑚𝑜𝑛𝑑 𝑙’𝑎𝑐𝑐𝑒𝑝𝑡𝑒 𝑎 𝑐𝑜𝑛𝑡𝑟𝑒-𝑐œ𝑢𝑟 𝑒𝑡 𝑒𝑛 𝑝𝑟𝑒𝑛𝑑 𝑢𝑛𝑒 𝑔𝑜𝑟𝑔𝑒́𝑒.', false),
(6, 1, 1, 'Ça ne vous fait pas peur vous qu’on ait perdu aussi vite ?', false),
(7, 1, 3, 'Mais non ! Tout va bien, c’est de l’autre coté de la France, il n''y a pas de raison que ça nous impacte.', false),
(8, 1, 2, 'Exactement, maintenant amuse-toi avec nous !', false),
(9, 1, 5, 'Le sort de tes parents ne t’inquiète pas pierre ?', false),
(10, 1, 10, 'David est assis sur un lit dans un coin de la pièce, a son habitude.', false),
(11, 1, 5, 'Ils habitent dans le nord pourtant non ?', false),
(12, 1, 10, 'Pierre garde le sourire, mais son expression se crispe un peu en entendant ces mots. Après quelques moments de réflexion, il rétorque.', false),
(13, 1, 2, 'Non, ils se sont déjà éloignés des conflits depuis quelques mois. Demande plutôt à André, ses parents à lui refusent de se mettre en sécurité', false),
(14, 1, 4, 'Et je les comprends, dans tous les cas personnes n’oserait les y forcer, ils sont bien trop puissants.', false),
(15, 1, 5, 'L’argent ne sauve pas de tout tu sais ?', false),
(16, 1, 4, 'C’est cela, et il ne fait pas le bonheur non plus.', false),
(17, 1, 2, 'Bon ce n’est pas tout ça mais cette radio me déprime... J’ai entendu parler d’une radio qui diffuse encore de la musique sur la fréquence 89.9, je vais essayer de la capter.', false),

--Début des questions
(18, 1, 10, 'Vous allez maintenant être confrontés à deux questions pour pouvoir faire avancer nos héros, à vous de choisir laquelle vous convient le mieux. La suite de cette histoire dépend entièrement de vous...', false),

--Le dialogue suivant est utilisé comme point de limite aux dialogues hors question
(19, 1, 10, 'limquestion', false),

--Dialogues liés à la question simple
(20, 1, 10, 'Pierre commence alors à manipuler la radio pendant un long moment. Jusqu''à ce que quelqu''un l''interrompe soudainement.', false),
(21, 1, 5, 'Attends !', false),
(22, 1, 3, 'Je crois que j’ai entendu quelque chose moi aussi, reviens en arrière.', false),
(23, 1, 3, 'La radio grésille jusqu''à ce que retentissent des mots que nous n’oublierions jamais.', false),
(24, 1, 9, 'Malgré nos efforts, nous avons été submergés par la force terrestre et aérienne de l''ennemi...', false),
(25, 1, 3, 'Puis... plus rien.', false),
(26, 1, 3, 'Ce n''est que le lendemain matin en lisant le journal que nous apprendrons que la guerre était déclarée et qu''une mobilisation nationale allait avoir lieu.', false),

--Diaogues liés à la fin de la question spécifique
(27,1,1,'Tu ferais mieux d’éteindre avant d’attirer des problèmes…',true),
(28,1,3,'Ah, laisse-le faire. Une petite musique ne va pas nous tuer.',true),
(29,1,10,'La radio grésille un moment, ne produisant que des interférences. Mais peu à peu, une voix s’élève, faible et semblant paniquer.',true),
(30,1,9,'Si quelqu''un... Ils arrivent... ne vous... cachez vous....',true),
(31,1,10,'Le silence dans la pièce devient pesant.',true),
(32,1,1,'C''était quoi ça ?',true),
(33,1,5,'Chut ! Écoutez...',true),
(34,1,10,'Pierre ajuste le bouton, cherchant à améliorer le signal, mais il disparaît presque immédiatement dans un grésillement qui semble interminable.',true),
(35,1,1,'Génial... C''est ça ta fameuse musique ?',true),
(36,1,3,'Ça ressemblait à un appel à l’aide… Non ? ',true),
(37,1,5,'Peut-être une vieille transmission, ça arrive quand la fréquence est inutilisée.',true),
(38,1,1,'Je ne sais pas. Mais je pense qu’il serait plus prudent d’éteindre.',true),
(39,1,10,'Pierre hésite, mais Raymond lui arrache presque la radio des mains pour la mettre hors tension.',true),
(40,1,3,'C''est à ce moment qu''on entend toquer à la porte de notre dortoir, je reconnais facilement la voix de ma propriétaire.',true),
(41,1,3,'Ce qu''elle nous expliqua ensuite nous n''aurions même pas pu l''imaginer... La pologne envahie et l''armée allemande en direction de nos frontières.',true),
(42,1,3,'Le lendemain nous étions tous mobilisés pour la bataille. Mais la bande de rebelles que nous étions n''allions pas accepter cela, on décida donc de fuir et de se cacher.',true),
(43,1,3,'La guerre fût déclarée le 3 septembre deux jours après.',true),
(44,1,3,'Durant un an et demi les combats sévirent, jusqu''à l''armistice du 22 juin 1940.',true),
(45,1,5,'La suite de notre histoire, elle commença un matin de juillet 1940 dans le sud ouest français.',true);







--Dialogues de l'histoire 1 chapitre 1
INSERT INTO DIALOGUES(id,id_histoire,interlocuteur,contenu,bonus) VALUES 
(1,2,10,'2 ans après la diffusion radio qui aura changé la vie de ces jeunes hommes....',false),
(2,2,3,'Raymond dégage les fougères derrière lesquelles nous nous sommes cachés pour s''assurer que nous ne soyons pas repérés.',false),
(3,2,1,'Ils arrivent bientôt ? ',false),
(4,2,3,'Sûrement, on est au point de rendez vous prévu de toute façon.',false),
(5,2,3,'Cela va bientôt faire 1 heure que l’on attend nos contacts au point de rendez-vous pour qu’il nous délivre un certain colis. L’ordre de mission était arrivé au maquis ce matin : escorter deux refugiés en lieu sûr. L’ordre avait été émis par Mr Jean Moulin en personne. 10 h plus tard, nous nous retrouvions donc en forêt, cachés derrière des fougères à attendre.',false),
(6,2,3,'Depuis maintenant 2 ans et demi nous avons perdu et la France est désormais coupée en deux. Au début, on se disait que cette situation serait temporaire, et puis ça a tenu et on a commencé a vivre avec.',false),
(7,2,3,'C’est devenu notre quotidien, seulement éclairci par les apparitions occasionnelles à la radio du Général de Gaulle. Jusqu’à ce qu’un jour je croise des lycéens de Valence distribuant des faux journaux pour ce qu’ils appellaient "La Résistance". Et c’est comme ça que nous avons rejoint le maquis voisin.',false),
(8,2,3,'Nous avons d’abord été surtout assigné à des missions de moindre importance, et un jour mes connaissances de la région m''ont amené à devenir l''acteur principal des escortes qui devaient être réalisées.. Je suis donc devenu le guide qui doit ouvrir des voies pour les refugiés qui fuient le nord et l’occupation. Et aujourd’hui n’était pas une exception.',false),
(9,2,3,'Soudain des bruits de pas nous sortent de notre torpeur...',false),
(10,2,3,'Ce doit être eux.',false),
(11,2,3,'Deux silhouettes se dessinent dans l’ombre et s’approchent de la lumière de notre lampe. Les deux visages que je vois apparaître m''étaient familières',false),
(12,2,3,'Monsieur et Madame Vasseur ?',false),
(13,2,7,'Jean ? Raymond ?',false),
(14,2,6,'C’est vous mes garçons ? Ça pour une surprise !',false),
(15,2,10,'Les parents de notre ami Pierre étaient apparus à notre lumière. Nous pouvions facilement deviner leur première question.',false),
(16,2,6,'Où est donc Pierre ?',false),
(17,2,10,'Demanda Michel en balayant les alentours d''un regard attentif.',false),
(18,2,3,'On a été séparés, mais il va bien ne vous inquiétez pas, vous le connaissez il se débrouille, il a eu sa propre mission avec André.',false),
(19,2,3,'',false),
(20,2,10,'Rétorqua rapidement Jean pour rassurer les parents de notre ami.',false),
(21,2,1,'Je suis désolé de vous interrompre, on doit partir rapidement pour éviter les patrouilles de la milice.',false),
(22,2,6,'Allons-y !',false),
(23,2,3,'En traversant la forêt j’explique aux parents de Pierre comment on a été amené à les retrouver, jusqu’à ce qu’un bruit me fasse m’interrompre.',false),
(24,2,3,'',false),
(25,2,3,'Nous nous jetons tous les quatre dans un recoin caché derrière le buisson que je viens de pointer. Peu de temps après, des bruits de pas passent devant nous.',false),
(26,2,1,'Des miliciens... Qu’est-ce qu’ils faisaient là ?',false),
(27,2,6,'Ils étaient sans doute à notre recherche.',false),
(28,2,1,'Non ça n’a aucun sens, pourquoi ils suivraient de simples réfugiés ?',false),
(29,2,6,'Vous supérieurs ne vous ont pas expliqué ?',false),
(30,2,3,'Confus par cette remarque je réponds sans trop réfléchir.',false),
(31,2,3,'Expliqué quoi ?',false),
(32,2,7,'Nous ne sommes pas de simples réfugiés, nous transportons des documents de la plus haute importance pour la Résistance, c’est pour ça que l’on doit arriver au plus vite et vivants !',false),
(33,2,3,'Je regarde Raymond qui semble aussi incrédule que moi.',false),
(34,2,3,'Après un temps à la réflexion je décide de rétablir l''ambiance qui devenait pesante.',false),
(35,2,3,'Et bien, on dirait que cette mission est un peu plus importante que ce que l’on pensait !',false),
(36,2,1,'Où doit on les emmener déjà ?',false),
(37,2,3,'À Meilhan, de l’autre côté de la colline.',false),
(38,2,1,'Alors dépêchons-nous, plus vite ils y seront mieux ce sera visiblement. Après toi Jean.',false),
(39,2,3,'Je tends l’oreille, et, n’entendant aucun bruit qui aurait pu laisser présager une présence humaine, je sors de notre cachette et fais signe à mes compagnons de me suivre',false),
(40,2,3,'Allons-y.',false),
(41,2,10,'Environ une heure plus tard.',false),
(42,2,1,'Enfin !',false),
(43,2,3,'Après presque une heure de marche nous arrivons enfin en vue des lumières de la ville.',false),
(44,2,7,'Nous y sommes ?',false),
(45,2,1,'Oui, on va pouvoir bientôt vous laisser.',false),
(46,2,3,'Alors que l’on s’avance vers l’orée de la forêt, je remarque une agitation inhabituellement tardive dans les rues : des fenêtres allumées, des bruits dans la pénombre.',false),
(47,2,3,'Faites attention, il se passe quelque chose de bizarre, longez les murs et restez dans l’ombre, il ne faut pas se faire repérer.',false),
(48,2,6,'Qu''est-ce qu’il se passe ?',false),
(49,2,3,'Je lui fais signe de faire le moins de bruit possible.',false),
(50,2,3,'Les rues et ruelles du petit village défilent alors que nous nous approchons de notre destination.',false),
(51,2,3,'Mais arrivés au dernier bloc ceux que je vois me permettent d''enfin comprendre l’agitation : un groupe de miliciens arpente les rues, visiblement à la recherche de quelque chose.',false),
(52,2,3,'Je fais signe aux autres de s’arrêter et leur explique la situation.',false),
(53,2,3,'Probablement ceux qu’on a vu tout à l’heure',false),

--Début des questions
(54,2,10,'Vous allez maintenant être confrontés à deux questions pour pouvoir aider nos héros, à vous de choisir laquelle vous convient le mieux. La suite de cette histoire dépend entièrement de vous...',false),

--Le dialogue suivant est utilisé comme point de limite aux dialogues hors question
(55,2,10,'limquestion',false),

--Dialogues de la fin générique
(56,2,1,'Allons y alors, ne trainons pas.',false),
(57,2,3,'Nous revenons sur nos pas, tournons quelques rues plus loin et arrivons à quelques mètres de la cabine.',false),
(58,2,3,'Je vais les appeler, ne faites rien qui pourrait attirer l’attention et restez silencieux.',false),
(59,2,3,'Je rentre dans l’espace exigu, compose le numéro et attend. Le téléphone sonne quelques secondes puis quelqu’un décroche',false),
(60,2,9,'Vous ne deviez pas utiliser ce numéro.',false),
(61,2,3,'Je sais, mais le point de chute est compromis, la milice est là.',false),
(62,2,9,'Alors amenez-les nous.',false),
(63,2,3,'Très bien.',false),
(64,2,3,'Je raccroche et ressors. Marie et Michel m’attendaient, de même pour Raymond qui s’était visiblement écarté quelques temps. Je le préviens des nouveautés de la situation.',false),
(65,2,3,'On doit les amener au maquis.',false),
(66,2,1,'On a un peu de route, on devrait y aller sans plus tarder',false),
(67,2,3,'Quelques temps plus tard dans la forêt, je sens Raymond nerveux.',false),
(68,2,3,'Quelque chose ne va pas Raymond ?',false),
(69,2,1,'Non, je n’aime juste pas quand les plans changent à la dernière minute.',false),
(70,2,3,'Je comprends, mais ne t’inquiète pas, tout va bien se passer.',false),
(71,2,6,'Euh… Jean ? On a un problème...',false),
(72,2,3,'Sur le chemin un homme nous barre la route, armé. Pendant ma discussion avec Raymond j’ai laissé
les vasseurs prendre de l’avance et j’ai relâché ma garde.',false),
(73,2,3,'Peu à peu des soldats sortent des buissons et nous encerclent…',false),



--Dialogues liés à la question spécifique au lieu
(74,2,3,'Des amis à moi ont vécus dans le village, leur maison devrait toujours être inoccupée, allons-y.',true),
(75,2,3,'Je les dirige vers les abords de la ville. Sur la route R aymond s’approche de moi, nerveux.',true),
(76,2,1,'Donc on les garde ?',true),
(77,2,3,'Pour l’instant du moins. On les amènera demain au point de chute initial.',true),
(78,2,3,'La maison, bien qu’inhabitée depuis plusieurs années, est restée dans un bon état. Je pousse la porte et
allume la lumière.',true),
(79,2,3,'Il n’y a sûrement plus rien a mangé mais les matelas devraient être là, vous devriez pouvoir vous
installer dans une chambre pour dormir.',true),
(80,2,3,'Les vasseurs montent à l’étage pendant que Raymond et moi nous installons dans le salon, sur ce qui semble être des 
canapés, difficile à dire au vu de la dégradation.',true),
(81,2,3,'Soudain, j’entends frapper à la porte. Je regarde avec angoisse à travers les rideaux, et reste figé de
peur tandis que les formes des miliciens se dessinent dans le noir.',true),
(82, 2, 3, 'Je fais signe à Raymond de s’occuper de nos amis et de s’enfuir, puis m’approche de la porte et l’ouvre.', true),
(83, 2, 3, 'Bonsoir messieurs, en quoi puis-je vous aider ?', true),
(84, 2, 8, 'Bien le bonsoir mon brave, excusez-nous de vous déranger si tardivement mais nous sommes à la recherche d’un couple de fugitifs. Est-ce que vous les auriez vus ?', true),
(85, 2, 3, 'Des fugitifs, vous dites ? Non, je n’ai vu personne, désolé.', true),
(86, 2, 8, 'Voilà qui est bien dommage. Mais dites-moi, nous pensions la maison abandonnée, et nous avons été étonnés de voir de la lumière. Vous êtes arrivé récemment ?', true),
(87, 2, 3, 'Oh, oui effectivement, il y a quelques jours seulement. Je ne suis que de passage, je voyage vers les Pyrénées pour y retrouver de la famille. Cela faisait plusieurs jours que je marchais, aussi ai-je décidé de m’arrêter quelques temps ici.', true),
(88, 2, 8, 'Je vois ! Mais voyez-vous, il y a quelque chose qui me dérange : des fugitifs, une maison abandonnée qui ne l’est plus, et un voyageur que personne n’a vu... et tout ça en une journée, cela fait beaucoup de coïncidences. Et je ne crois pas aux coïncidences...', true),
(89, 2, 8, 'Fouillez la maison ! Et vous !',true),
(90, 2, 8, '.    .    .',true),
(91, 2, 8, 'Vous allez venir avec nous.',true),
(92, 2, 3, 'Il semblerait que je n’ai plus qu’à espérer que Raymond ait réussi à s’enfuir avec les Vasseurs.', true);


--Dialogues de l'histoire 2 chapitre 1


--Apparitions du prologue
INSERT INTO APPARITIONS values
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 9),
(1, 10);

--Apparitions première histoire chapitre 1
INSERT INTO APPARITIONS VALUES
(2,1),
(2,3),
(2,6),
(2,7),
(2,8),
(2,9),
(2,10);

--Création des questions pour prologue
INSERT INTO QUESTIONS(id_histoire,question,reponse,type) values(1,'À quelle date a débutée les attaques allemandes ? (date complète jj/mm/aaaa)','01/09/1939','g'),
(1,'Quel évènement a marqué le lieu où se trouve nos personnages ?','6 juillet 1944 76 maquisards furent éxecutés','s');

--Pour l'histoire 1 chapitre 1
INSERT INTO QUESTIONS(id_histoire,question,reponse,type) values(2,'En quel année fût ériger le camp que fuient nos héros ?','1939','g'),
(2,'Ce camp fût un camp de travail intensif dès juillet 1942. Combien de prisonniers étaient encore
internés en mars 1943 ? ','70','s');




--Spécification de la progression du joueur 'tritri'
INSERT INTO PROGRESSION(id_utilisateur,id_hist,statut) values(1,1,'t');


INSERT INTO PROGRESSION(id_utilisateur,id_hist,statut) values(2,1,'f');




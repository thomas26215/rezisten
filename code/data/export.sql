--
-- PostgreSQL database dump
--

-- Dumped from database version 15.10 (Debian 15.10-0+deb12u1)
-- Dumped by pg_dump version 15.10 (Debian 15.10-0+deb12u1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: chapitres; Type: TABLE DATA; Schema: public; Owner: superrezi
--

INSERT INTO chapitres VALUES (0, 'Prologue');
INSERT INTO chapitres VALUES (1, 'L''heure de résister');
INSERT INTO chapitres VALUES (2, 'Au coeur de la tragédie');
INSERT INTO chapitres VALUES (100, 'Workshop');


--
-- Data for Name: lieux; Type: TABLE DATA; Schema: public; Owner: superrezi
--

INSERT INTO lieux VALUES (1, 'Cimetière des Espagnols du Camp de Judes', 'cimetière;camp de concentration', 'De nombreux soldats républicains espagnols moururent dans le camp de Judes. Dans le cimetière créé au lieu-dit « Les Places », 81 d''entre eux son inhumés. Longtemps laissé à l''abandon, ce cimetière a été réhabilité, en 1978, à l''initiative de Cesareo Bustos Delgrado, réfugié espagnol déporté à Mauthausen. ', 'Septfonds (Tarn-et-Garonne)', '44.1589514076204, 1.61863968417669');
INSERT INTO lieux VALUES (2, 'Mémorial du Camp de Judes', 'camp de concentration;monument', 'Le camp de Judes est un des six camps d''internement ouverts durant l''hiver 1939 afin d''y regrouper une partie des 500.000 réfugiés espagnols républicains. Par la suite, il fut utilisé pour d''autres populations, notamment pour regrouper des familles juives avant leur déportation. Avec l''Armistice, il devint centre de démobilisation pour les volontaires étrangers. A la libération, des français accusés de collaboration furent internés dans ce camp avant sa fermeture. De ce lieu, seuls quelques vestiges demeurent et, en 1996, un Mémorial fut élevé à la limite des terrains historiques du camp. ', 'Septfonds (Tarn-et-Garonne)', '44.1949926084632, 1.6182280032749');
INSERT INTO lieux VALUES (3, 'monument aux Cinquante Otages', 'monument', 'Inauguré le 22 octobre 1952, le monument aux Cinquante Otages a été élevé à la mémoire d''otages fusillés par les allemands pendant la Seconde Guerre mondiale. Le 20 octobre 1941, un commando de résistants communistes abat Karl Hotz, Feldkommandant des forces d''occupation nazies. Marcel Bourdarias et Spartaco Guisco sont arrêtés, torturés et exécutés le 17 avril 1942 au Mont-Valérien. Quant à Gilbert Brustlein, il parvient à fuir. En mesures de représailles, les autorités allemandes ordonnent l''exécution de 50 otages. Entre le 20 et le 22 octobre 1941, 27 otages sont exécutés à Châteaubriand, dont le jeune Guy Môquet, 16 à Nantes et 5 au Mont-Valérien. Par décret du 11 novembre 1941, le général de Gaulle fait de Nantes la première ville « Compagnon de la Libération ». En 1944, le conseil municipal prend la décision de dénommer le nouveau boulevard créé par le comblement de l''Erdre, « Cours des Cinquante Otages ». A son extrémité est érigé le monument commémoratif aux cinquante otages. Oeuvre de l''architecte Marcel Fradin et du sculpteur Jean Mazuet, il se présente sous la forme d''un « obélisque » de 13,5 mètres de haut composé de 5 lances monumentales recouvertes de cuivre et encadré des allégories de la Résistance et de la France renaissante. Le monument et le cours du même nom sont des éléments significatifs dans l''architecture urbaine de la Reconstruction à Nantes. ', 'Nantes (Loire-Atlantique)', '47.22053114530541, -1.55454803472518');
INSERT INTO lieux VALUES (4, 'Camp de Drancy, puis Cité de la Muette', 'camp de concentration;grand ensemble', 'Cité constituée de cinq tours de quinze étages et de barres de deux à quatre niveaux. Un bâtiment en fer à cheval parachève l''ensemble en 1934. Il n''en reste aujourd''hui qu''un immeuble de quatre étages formant un U autour d''une cour. Drancy devient ainsi la première ville de France à adopter le modèle américain des gratte-ciels. La cité est connue pour être le premier ensemble de bâtiments d''habitation où la préfabrication a été appliquée totalement. Durant la seconde guerre mondiale, la cité sert d''abord de camp de prisonniers de guerre puis de camp d''internement pour familles juives à partir d''août 1941. Un tunnel creusé en 1943 par les détenus existe toujours, ainsi que des graffiti et des inscriptions. ', 'Drancy (Seine-Saint-Denis)', '48.919947087492, 2.45521722260212');
INSERT INTO lieux VALUES (5, 'Naval Monument ou Mémorial américain de la Première Guerre mondiale', 'monument', 'Le Naval Monument de Brest est un mémorial érigé à l''initiative de l''American Battle Monuments Commission, institution fondée en 1923 par le Congrès des Etats-Unis pour prendre en charge la construction et l''entretien des cimetières militaires et mémoriaux américains situés en dehors du territoire des Etats-Unis. Ce monument commémore l''action de la Marine américaine dans les eaux européennes au cours de la Première guerre mondiale, depuis l''entrée en guerre des USA le 6 avril 1917 et la création de l''American Expeditionary Force jusqu''au rapatriement des derniers soldats américains en 1919. L''implantation de ce mémorial à Brest est lié à l''importance stratégique de cette ville dans le déploiement de l''AEF sur le sol français à la fois quartier général des forces navales et aéronavales américaines et principal port d''attache des navires de l''US Navy et de débarquement des troupes. Le bâtiment conçu par l''architecte de Chicago Howard Van Doren Shaw et réalisé, après la mort de celui-ci par son associé Ralph Milman est construit de 1930 à 1932 et inauguré en 1937. Les bas-reliefs qui ornent les façades sont l''oeuvre du sculpteur américain John Jenry Bradley Storrs. Entièrement détruit par les Allemands le 4 juillet 1941, jour de l''Independence Day, il est reconstruit à l''identique en 1958 par Ralph Milman et inauguré le 16 juillet 1960. Il se compose d''un tour en granite rose d''une cinquantaine de mètres de hauteur, enchâssée dans la fortification dominant le port de commerce, lieu de débarquement des troupes alliées. Elle est précédée d''une esplanade et d''un jardin public aménagés au centre du cours Dajot.', 'Brest (Finistère)', '48.3836658645556, -4.48635187079068');
INSERT INTO lieux VALUES (6, 'Hôtel du Ministère de l''Intérieur', 'ministère', 'Les locaux du 11, rue des Saussaies et du 11, rue Cambacérès ont été occupés dès le mois d''août 1940 par la Gestapo. Les trois cellules que l''on peut encore voir étaient alors utilisées comme locaux de détention provisoire. Parmi les résistants qui y furent internés, quelques uns nous ont laissé le témoignage émouvant de leurs souffrances, mais aussi de leurs espoirs et de leur foi. ', 'Paris 8e Arrondissement (Paris)', '48.8719848949863, 2.31672540905333');
INSERT INTO lieux VALUES (7, 'Batterie d''artillerie de Longues', 'batterie d''artillerie', 'Cette batterie, située sur une falaise dominant la Manche, est un témoignage du système défensif, dit Mur de l''Atlantique, mis en place par l''armée allemande pendant la Seconde Guerre mondiale. Située au coeur du secteur d''assaut allié, au sommet d''une falaise dominant la Manche, elle a joué un rôle stratégique crucial lors du débarquement du 6 juin 1944, ses quatre pièces de 150 mm et de 20 kilomètres de portée tirant sur les plages Omaha et Gold. Elle comprenait quatre casemates abritant une pièce d''artillerie ; les casemates sont précédées, au bord de la falaise, d''un ouvrage servant de télémètre et de poste de commandement de tir. C''est la seule batterie de la côte normande à avoir conservé ses canons. ', 'Longues-sur-Mer (Calvados)', '49.3458901313933, -0.693479165892528');
INSERT INTO lieux VALUES (8, 'Ancienne ferme du Priou', 'ferme;monument', 'La ferme du Priou est un haut lieu de la résistance gersoise, où périrent, le 6 juillet 1944, 76 maquisards du Meilhan, membres du groupe du Docteur Raynaud. Le monument commémoratif inauguré en 1947 évoque le sacrifice de ces résistants. Conçu par les architectes Hébrard et Bienvenu, et exécuté par l''entreprise Chamayou, il présente des bas-reliefs sculptés par X. Lefebure, X. Letu, L.-G. Buisseret et F. Guinard. ', 'Villefranche (Gers)', '43.416609549062, 0.699525378815311');
INSERT INTO lieux VALUES (9, 'Batterie de défense de plage', 'batterie d''artillerie', 'Batterie de défense de plage appartenant au système défensif du Mur de l''Atlantique mis en place par l''organisation Todt à partir de l''été 1942. La batterie d''Asnelles a joué un rôle particulièrement meurtrier lors du débarquement des forces alliées sur les côtes de Basse-Normandie au matin du 6 juin 1944. ', 'Asnelles (Calvados)', '49.3419946132509, -0.584517777873296');
INSERT INTO lieux VALUES (10, 'Camp Joffre, dit "Camp de Rivesaltes"', 'camp de concentration', 'Mis en place à partir de décembre 1939, le camp de Rivesaltes se compose d''une dizaine d''îlots comprenant chacun une soixantaine de baraques en briques et couvertures légères alignées autour d''une cour de rassemblement, et séparé des îlots voisins par des clôtures de barbelés. Camp destiné à l''internement des ressortissants étrangers se trouvant en France au moment de la déclaration de la guerre. Le camp sert de base aux troupes allemandes à partir de novembre 1942. Il devient lieu d''internement des prisonniers allemands en 1945. Par la suite, camp d''entraînement pour les troupes. Vente du conseil général des Pyrénées-Orientales au conseil régional du Languedoc-Roussillon pour création d''un musée mémorial sur le camp (notification le 14/05/2012). ', 'Salses-le-Château (Pyrénées-Orientales)', '42.8095488976615, 2.89254910940167');
INSERT INTO lieux VALUES (11, 'Théatre', 'théâtre', 'Sous l''impulsion de la duchesse de Berry, qui lance à Dieppe la vogue des bains de mer, l''architecte P. F. Frissard dessine en 1826 les plans du théâtre, avec loge et appartement pour la duchesse. En 1900, sous la direction de l''architecte Pierre Chevalier, le théâtre est agrandi d''un foyer vers la mer, dont la façade est ornée d''un décor rocaille (Belle Epoque). La salle est remaniée et décorée de toiles dues à Gaston Jobbe-Duval. L''édifice est endommagé lors du débarquement allié du 19 août 1942. La couverture est partiellement remise en état en 1949, tandis que des travaux de restauration assurent en 1962 la mise hors d''eau de l''édifice, mais achèvent de défigurer les deux façades restantes. ', 'Dieppe (Seine-Maritime)', '49.9253375884065, 1.07193095839203');
INSERT INTO lieux VALUES (12, 'Camp du Moulin du Lot', 'camp de concentration', 'Le camp fut aménagé pour servir de cantonnement aux ouvriers employés à la construction d''une poudrerie entre Casseneuil et Sainte-Livrade. Il s''agit d''un des six camps construits pour les besoins de la poudrerie, dont la réalisation fut annulée par l''invasion allemande en 1940. Il accueillit dès lors, successivement, les chantiers de jeunesse, une compagnie d''instruction de fusilliers de l''Air, des soldats russes prisonniers et enfin, les Français d''Indochine. Le camp se composait de 36 bâtiments autour d''une place centrale. ', 'Sainte-Livrade-sur-Lot (Lot-et-Garonne)', '44.4118558709483, 0.588070208772407');
INSERT INTO lieux VALUES (13, 'Point d’appui allemand LGS082', NULL, 'La défaite française face à l''invasion des troupes allemandes, lors de la campagne de France du printemps 1940, conduit à la signature d''un armistice franco-allemand du 22 juillet 1940 entrainant une partition de la France en une zone occupée au nord et une zone libre au sud, administrée par le régime de Vichy, séparées par une ligne de démarcation très contrôlée. Lorsque survient le débarquement allié sur les côtes d''Afrique du Nord le 8 novembre 1942, les Allemands craignent la menace d''un prochain débarquement des alliés sur les côtes méditerranéennes françaises. Ils mettent en place le plan Anton II pour occuper la zone « libre » et protéger la côte méditerranéenne. Le 11 novembre 1942 ils franchissent la ligne de démarcation et rejoignent la côte et les Pyrénées. Dès lors, les Allemands vont entreprendre la création de deux lignes de défense dans le département des Pyrénées-Orientales : - La première, appelée « Südwall » ou Mittelmeerwall (mur de la Méditerranée), est un dispositif semblable au mur de l''Atlantique. De Cerbère au Barcarés, il est constitué de grosses batteries de marine et d''autres ouvrages plus petits de type blockhaus qui abritaient pour la plupart des canons tournés vers la mer afin d''arrêter un débarquement allié. Le secteur fortifié le plus significatif est Port-Vendres, dernier port en eau profonde de la côte. Le mur catalan de la méditerranée aura en fait très peu servi car seuls quelques coups de canons ont été tirés durant cette période contre un sous-marin des forces navales françaises libres au large de Port-Vendres. Les principales constructions défensives étaient réparties et positionnées au Barcarès, à Torreilles, Sainte-Marie-la-Mer, Canet-en-Roussillon, Argelès, Collioure, Banyuls et surtout Port-Vendres où il convient de signaler, outre les ouvrages habituels (postes d''observation, Ringstande, abris, murs antichars, batteries...) l''existence d''un filet anti sous-marin rétractable à l''entrée du port afin de protéger la sixième flottille. - La seconde ligne dénommée « Speerlinie Pyrenäen » (ligne de front fortifiée des Pyrénées) le long de la frontière espagnole d''Hendaye à Cerbère. Moins étoffée que la ligne littorale, la plupart de ses ouvrages est positionnée près des cols et lieux de passage. Les principaux sites étaient Cerbère, les Albères, Maureillas, Céret, Prats de Mollo et la Cerdagne qui, outre la citadelle de Mont-Louis occupée, comprenait au moins 8 ouvrages qui fonctionnaient par paire au col de la Perche, à Eyne, Odeillo et Bolquère. Le Perthus jouissait de la plus forte concentration d''ouvrages de la ligne défensive avec six tourelles de char autour du Fort de Bellegarde. Le département a été rapidement quadrillé par quelques 150 « points d''appui », constitués d''un poste de commandement, renforcé par un canon. Ces fortifications ont été réalisées rapidement, en quelques semaines, soit en béton armé soit en moellons Todt, tantôt par des constructeurs allemands (organisation Todt, firme Müller, Bauleitung...), tantôt par des entreprises françaises avec des personnes volontaires ou réquisitionnées. À la fin de la guerre, le départ des occupants allemands se fit dans la précipitation en août 1944. Seuls furent dynamités les quais de Port-Vendres. Quelques dizaines de soldats allemands furent internés au Camp de Rivesaltes jusqu''à fin 1947. La construction allemande est très standardisée. Malgré tout la fortification allemande en Méditerranée a été plus tardive et moins continue, rendue plus difficile par la côte sableuse. Blockhaus ou Bunker ou Batterie (qui associe forcément l''artillerie) sont forcément des ouvrages de défense en béton armé. Il existait une grande diversité de constructions défensives : une trentaine de types différents : les casemates, les postes de direction, les encuvements, les abris ou soutes à munitions, les « Ringstand », les « tobrouks » pour les mitrailleuses. Au total, sur les 450 à 500 ouvrages érigés dans les Pyrénées-Orientales entre janvier 1942 et août 1944, seuls quelques 250 bunkers ont résisté à la destruction d''après-guerre puis à l''urbanisation moderne du littoral. Situé à Torreilles-Plage, à l''embouchure de l''Agly, entre la mer et les dunes, le site de défense installé par les Allemands correspond à deux parcelles longilignes AV 42 et 43, certaines des constructions se trouvant partiellement enfouies sur la plage. Ce site a fait l''objet d''une étude de Guilhem Castellvi, spécialiste de bunker archéologie, dans le cadre d''un Inventaire des fortifications allemandes de la seconde guerre mondiale dans les Pyrénées-Orientales (Conseil départemental 66 et SRA). Ce point d''appui est établi pour ralentir un débarquement ennemi : c''est un avant-poste de la ligne de fortification allemande, couverte par des batteries à Torreilles, Saint-Laurent-de-la-Salanque, Le Barcarès, Saint-Hippolyte. Le point d''appui codé Lgs082, comprend 14 constructions : 10 Bf : 1 Ringstand Bf236 pour tourelle de char, 4 Ringstande Bf58c pour mitrailleuse ou mortier, 1 Bf52a abri pour 6 hommes ou soute à munitions, 4 Bf52a abri pour 12 hommes, 3 citernes, 1 R612 casemate. Il pouvait accueillir 50 hommes. Les ouvrages sont dotés d''un camouflage d''incrustations de galets dans le béton frais pour la partie supérieure et les murs sont maçonnés. L''ouvrage le plus important est la casemate R612, qui est communément appelé le « blockhaus de Torreilles », il couvrait l''accès sud du point d''appui. Les Ringstande Bf58c assuraient la défense frontale et nord. Tandis que les abris à l''arrière permettaient la protection du personnel et le stockage des munitions. Le rapport de de Guilhem Castellvi indique que ce point d''appui est le seul subsistant sur le littoral des Pyrénées-Orientales à avoir conservé une casemate pour canon.', 'Torreilles (Pyrénées-Orientales)', '42.773729493481504, 3.0376967545901548');
INSERT INTO lieux VALUES (14, 'Ensemble orthodoxe Saint-Michel-Archange', 'église;presbytère;parc', 'Le quartier de la Californie est investi en premier lieu par les hivernants russes qui sont suivis à la Belle époque par un second foyer d''implantation anglais sur les hauteurs. Alors que le bas du quartier est déjà largement investi par les villas russes, aucune église orthodoxe n''existe à proximité. Comme dans les autres colonies dépourvues de sanctuaire, le culte s''organise dans des chapelles privées, en l''occurrence dans la villa Alexandra, propriété des Tripet-Skrypitzine.  Pour remédier à ce manque, l''archiprêtre Ostrooumoff et le grand-duc Michel de Russie obtiennent d''Alexandra Tripet-Skrypitzine la cession d''une parcelle de terrain. Grâce à une souscription organisée au sein de la communauté russe, la construction d''une église, dont les plans sont confiés à l''architecte Louis Nouveau, est réalisée en 1894. Le clocher-porche est ajouté en 1896 tandis que le presbytère vient compléter l''ensemble en 1897. Plusieurs acquisitions réalisées au début du XXe siècle constituent l''emprise foncière actuelle. Pour la communauté russe, l''église devient un lieu de sociabilité incontournable a fortiori lorsque la villégiature se transforme en lieu d''exil après 1917. Elle est tantôt le théâtre de divergences avec les différentes sensibilités religieuses qui s''expriment (à l''origine de l''église Saint-Tikhon), tantôt le lieu de rassemblement lors de cérémonies (notamment l''inhumation de personnalités russes comme les grand-duc Nicolas Nikolaïevitch et Pierre Nikolaïevitch ou encore la résistante Hélène Vagliano). Elle se dote d''une vocation culturelle notamment avec la constitution d''une chorale qui gagne un rayonnement régional. Le clergé orthodoxe de Cannes joue un rôle important qui dépasse la seule ville de Cannes (administration de la paroisse orthodoxe de Thorenc, participation aux cérémonies de la paroisse de Contrexéville, etc.) et lui vaut d''être élevée au rang d''évêché en 1939 (titre conservé jusqu''en 2014). ', 'Cannes (Alpes-Maritimes)', '43.54611385230668, 7.0394296306742525');
INSERT INTO lieux VALUES (15, 'Fort de Queuleu', 'fort', 'Fort de la première ceinture de Metz construit à partir de 1868 et achevé de 1872 à 1875 par les Allemands sous l''appellation de "Feste Goeben". Entre le 12 octobre 1943 et le 17 août 1944, plus de 1 500 patriotes y sont détenus par la Gestapo, dans la caserne de gorge, avant leur envoi en camp de concentration. C''est un ouvrage en béton avec parement en pierre de Jaumont comprenant deux étages de casemates, dont seul le niveau inférieur a servi de prison. Ce niveau comprend un ensemble de salles voûtées, avec des cellules individuelles aménagées dans l''une d''elles. ', 'Metz (Moselle)', '49.09571736576021, 6.204364388773205');


--
-- Data for Name: utilisateurs; Type: TABLE DATA; Schema: public; Owner: superrezi
--

INSERT INTO utilisateurs VALUES (1, 'tritri', 'tristan', 'font', '2005-06-14', 'tritri@gmail.com', '1945lo1234', 'j');
INSERT INTO utilisateurs VALUES (2, 'aiel', 'quentin', 'pingouin', '2000-10-12', 'aiel.gaming@gmail.com', 'lepgm2024du', 'j');
INSERT INTO utilisateurs VALUES (3, 'jeanm', 'jean', 'mejean', '1978-08-10', 'jean.mejean@gmail.com', '12hist34prof ', 'c');
INSERT INTO utilisateurs VALUES (4, 'admin_rezisten', 'admin', 'admin', '1999-06-12', 'admin.rezisten@rezisten.fr', 'jesuisadmin2025', 'a');


--
-- Data for Name: histoires; Type: TABLE DATA; Schema: public; Owner: superrezi
--

INSERT INTO histoires VALUES (1, 'Un jour de septembre', 0, 4, 8, 'hist0_bg', true);
INSERT INTO histoires VALUES (2, 'Une rencontre fortuite', 1, 4, 2, 'hist1_bg', true);
INSERT INTO histoires VALUES (3, 'Sabotage', 1, 4, 6, 'hist2èbg', true);
INSERT INTO histoires VALUES (4, 'De chaleureuses retrouvailles', 2, 4, 8, 'hist3_bg', true);


--
-- Data for Name: personnages; Type: TABLE DATA; Schema: public; Owner: superrezi
--

INSERT INTO personnages VALUES (1, 'Raymond', 'raymond.webp');
INSERT INTO personnages VALUES (2, 'Pierre', 'pierre');
INSERT INTO personnages VALUES (3, 'Jean', 'jean');
INSERT INTO personnages VALUES (4, 'André', 'andre');
INSERT INTO personnages VALUES (5, 'David', 'david');
INSERT INTO personnages VALUES (6, 'Michel', 'michel');
INSERT INTO personnages VALUES (7, 'Marie', 'marie');
INSERT INTO personnages VALUES (8, 'Milicien', 'milicien');
INSERT INTO personnages VALUES (9, 'Inconnu', 'inconnu');
INSERT INTO personnages VALUES (10, 'Narrateur', 'narrateur');


--
-- Data for Name: apparitions; Type: TABLE DATA; Schema: public; Owner: superrezi
--

INSERT INTO apparitions VALUES (1, 1);
INSERT INTO apparitions VALUES (1, 2);
INSERT INTO apparitions VALUES (1, 3);
INSERT INTO apparitions VALUES (1, 4);
INSERT INTO apparitions VALUES (1, 5);
INSERT INTO apparitions VALUES (1, 9);
INSERT INTO apparitions VALUES (1, 10);
INSERT INTO apparitions VALUES (2, 1);
INSERT INTO apparitions VALUES (2, 3);
INSERT INTO apparitions VALUES (2, 6);
INSERT INTO apparitions VALUES (2, 7);
INSERT INTO apparitions VALUES (2, 8);
INSERT INTO apparitions VALUES (2, 9);
INSERT INTO apparitions VALUES (2, 10);


--
-- Data for Name: demandes; Type: TABLE DATA; Schema: public; Owner: superrezi
--

INSERT INTO demandes VALUES (2, 'aiel-id.png');


--
-- Data for Name: dialogues; Type: TABLE DATA; Schema: public; Owner: superrezi
--

INSERT INTO dialogues VALUES (1, 1, 10, 'Les forces françaises se retirent peu à peu du front alors que le premier ministre a démissionné il y a seulement quelques jours….', false, '11');
INSERT INTO dialogues VALUES (2, 1, 1, 'Éteint ça, on va se faire repérer !', false, '21');
INSERT INTO dialogues VALUES (3, 1, 3, 'Nous étions tous les 5 dans sa chambre car il était le seul à ne pas oser sortir dans les couloirs après le couvre-feu, ce qui n’était pas du tout le cas de Pierre d’ailleurs.', false, '31');
INSERT INTO dialogues VALUES (4, 1, 2, 'Mais non ! Arrête de t’inquiéter pour rien, les surveillants sont tous bien trop occupés à écouter la leur de radio, il n’y a aucun risque pour nous.', false, '41');
INSERT INTO dialogues VALUES (5, 1, 3, 'Je tends alors un verre à Raymond. De la gnôle faite par mon grand-père que j’ai ramenée il y a déjà quelques semaines de ça. Raymond l’accepte à contre-cœur et en prend une gorgée.', false, '51');
INSERT INTO dialogues VALUES (6, 1, 1, 'Ça ne vous fait pas peur vous qu’on ait perdu aussi vite ?', false, '61');
INSERT INTO dialogues VALUES (7, 1, 3, 'Mais non ! Tout va bien, c’est de l’autre coté de la France, il n''y a pas de raison que ça nous impacte.', false, '71');
INSERT INTO dialogues VALUES (8, 1, 2, 'Exactement, maintenant amuse-toi avec nous !', false, '81');
INSERT INTO dialogues VALUES (9, 1, 5, 'Le sort de tes parents ne t’inquiète pas pierre ?', false, '91');
INSERT INTO dialogues VALUES (10, 1, 10, 'David est assis sur un lit dans un coin de la pièce, a son habitude.', false, '101');
INSERT INTO dialogues VALUES (11, 1, 5, 'Ils habitent dans le nord pourtant non ?', false, '111');
INSERT INTO dialogues VALUES (12, 1, 10, 'Pierre garde le sourire, mais son expression se crispe un peu en entendant ces mots. Après quelques moments de réflexion, il rétorque.', false, '121');
INSERT INTO dialogues VALUES (13, 1, 2, 'Non, ils se sont déjà éloignés des conflits depuis quelques mois. Demande plutôt à André, ses parents à lui refusent de se mettre en sécurité', false, '13');
INSERT INTO dialogues VALUES (14, 1, 4, 'Et je les comprends, dans tous les cas personnes n’oserait les y forcer, ils sont bien trop puissants.', false, '141');
INSERT INTO dialogues VALUES (15, 1, 5, 'L’argent ne sauve pas de tout tu sais ?', false, '151');
INSERT INTO dialogues VALUES (16, 1, 4, 'C’est cela, et il ne fait pas le bonheur non plus.', false, '161');
INSERT INTO dialogues VALUES (17, 1, 2, 'Bon ce n’est pas tout ça mais cette radio me déprime... J’ai entendu parler d’une radio qui diffuse encore de la musique sur la fréquence 89.9, je vais essayer de la capter.', false, '171');
INSERT INTO dialogues VALUES (18, 1, 10, 'Vous allez maintenant être confrontés à deux questions pour pouvoir faire avancer nos héros, à vous de choisir laquelle vous convient le mieux. La suite de cette histoire dépend entièrement de vous...', false, '181');
INSERT INTO dialogues VALUES (19, 1, 10, 'limquestion', false, 'none');
INSERT INTO dialogues VALUES (20, 1, 10, 'Pierre commence alors à manipuler la radio pendant un long moment. Jusqu''à ce que quelqu''un l''interrompe soudainement.', false, 'none');
INSERT INTO dialogues VALUES (21, 1, 5, 'Attends !', false, '211');
INSERT INTO dialogues VALUES (22, 1, 3, 'Je crois que j’ai entendu quelque chose moi aussi, reviens en arrière.', false, 'none');
INSERT INTO dialogues VALUES (23, 1, 3, 'La radio grésille jusqu''à ce que retentissent des mots que nous n’oublierions jamais.', false, 'none');
INSERT INTO dialogues VALUES (24, 1, 9, 'Malgré nos efforts, nous avons été submergés par la force terrestre et aérienne de l''ennemi...', false, 'none');
INSERT INTO dialogues VALUES (25, 1, 3, 'Puis... plus rien.', false, 'none');
INSERT INTO dialogues VALUES (26, 1, 3, 'Ce n''est que le lendemain matin en lisant le journal que nous apprendrons que la guerre était déclarée et qu''une mobilisation nationale allait avoir lieu.', false, 'none');
INSERT INTO dialogues VALUES (27, 1, 1, 'Tu ferais mieux d’éteindre avant d’attirer des problèmes…', true, '271');
INSERT INTO dialogues VALUES (28, 1, 3, 'Ah, laisse-le faire. Une petite musique ne va pas nous tuer.', true, '281');
INSERT INTO dialogues VALUES (29, 1, 10, 'La radio grésille un moment, ne produisant que des interférences. Mais peu à peu, une voix s’élève, faible et semblant paniquer.', true, '291');
INSERT INTO dialogues VALUES (30, 1, 9, 'Si quelqu''un... Ils arrivent... ne vous... cachez vous....', true, '301');
INSERT INTO dialogues VALUES (31, 1, 10, 'Le silence dans la pièce devient pesant.', true, '311');
INSERT INTO dialogues VALUES (32, 1, 1, 'C''était quoi ça ?', true, '321');
INSERT INTO dialogues VALUES (33, 1, 5, 'Chut ! Écoutez...', true, '331');
INSERT INTO dialogues VALUES (34, 1, 10, 'Pierre ajuste le bouton, cherchant à améliorer le signal, mais il disparaît presque immédiatement dans un grésillement qui semble interminable.', true, '341');
INSERT INTO dialogues VALUES (35, 1, 1, 'Génial... C''est ça ta fameuse musique ?', true, '351');
INSERT INTO dialogues VALUES (36, 1, 3, 'Ça ressemblait à un appel à l’aide… Non ? ', true, '361');
INSERT INTO dialogues VALUES (37, 1, 5, 'Peut-être une vieille transmission, ça arrive quand la fréquence est inutilisée.', true, '371');
INSERT INTO dialogues VALUES (38, 1, 1, 'Je ne sais pas. Mais je pense qu’il serait plus prudent d’éteindre.', true, '381');
INSERT INTO dialogues VALUES (39, 1, 10, 'Pierre hésite, mais Raymond lui arrache presque la radio des mains pour la mettre hors tension.', true, '391');
INSERT INTO dialogues VALUES (40, 1, 3, 'C''est à ce moment qu''on entend toquer à la porte de notre dortoir, je reconnais facilement la voix de ma propriétaire.', true, '401');
INSERT INTO dialogues VALUES (41, 1, 3, 'Ce qu''elle nous expliqua ensuite nous n''aurions même pas pu l''imaginer... La pologne envahie et l''armée allemande en direction de nos frontières.', true, '411');
INSERT INTO dialogues VALUES (42, 1, 3, 'Le lendemain nous étions tous mobilisés pour la bataille. Mais la bande de rebelles que nous étions n''allions pas accepter cela, on décida donc de fuir et de se cacher.', true, '421');
INSERT INTO dialogues VALUES (43, 1, 3, 'La guerre fût déclarée le 3 septembre deux jours après.', true, '431');
INSERT INTO dialogues VALUES (44, 1, 3, 'Durant un an et demi les combats sévirent, jusqu''à l''armistice du 22 juin 1940.', true, '441');
INSERT INTO dialogues VALUES (45, 1, 5, 'La suite de notre histoire, elle commença un matin de juillet 1940 dans le sud ouest français.', true, '451');
INSERT INTO dialogues VALUES (1, 2, 10, '2 ans après la diffusion radio qui aura changé la vie de ces jeunes hommes....', false, '12');
INSERT INTO dialogues VALUES (2, 2, 3, 'Raymond dégage les fougères derrière lesquelles nous nous sommes cachés pour s''assurer que nous ne soyons pas repérés.', false, '22');
INSERT INTO dialogues VALUES (3, 2, 1, 'Ils arrivent bientôt ? ', false, '32');
INSERT INTO dialogues VALUES (4, 2, 3, 'Sûrement, on est au point de rendez vous prévu de toute façon.', false, '42');
INSERT INTO dialogues VALUES (5, 2, 3, 'Cela va bientôt faire 1 heure que l’on attend nos contacts au point de rendez-vous pour qu’il nous délivre un certain colis. L’ordre de mission était arrivé au maquis ce matin : escorter deux refugiés en lieu sûr. L’ordre avait été émis par Mr Jean Moulin en personne. 10 h plus tard, nous nous retrouvions donc en forêt, cachés derrière des fougères à attendre.', false, '52');
INSERT INTO dialogues VALUES (6, 2, 3, 'Depuis maintenant 2 ans et demi nous avons perdu et la France est désormais coupée en deux. Au début, on se disait que cette situation serait temporaire, et puis ça a tenu et on a commencé a vivre avec.', false, '62');
INSERT INTO dialogues VALUES (7, 2, 3, 'C’est devenu notre quotidien, seulement éclairci par les apparitions occasionnelles à la radio du Général de Gaulle. Jusqu’à ce qu’un jour je croise des lycéens de Valence distribuant des faux journaux pour ce qu’ils appellaient "La Résistance". Et c’est comme ça que nous avons rejoint le maquis voisin.', false, '72');
INSERT INTO dialogues VALUES (71, 2, 3, 'Peu à peu des soldats sortent des buissons et nous encerclent…', false, '712');
INSERT INTO dialogues VALUES (8, 2, 3, 'Nous avons d’abord été surtout assigné à des missions de moindre importance, et un jour mes connaissances de la région m''ont amené à devenir l''acteur principal des escortes qui devaient être réalisées.. Je suis donc devenu le guide qui doit ouvrir des voies pour les refugiés qui fuient le nord et l’occupation. Et aujourd’hui n’était pas une exception.', false, '82');
INSERT INTO dialogues VALUES (9, 2, 3, 'Soudain des bruits de pas nous sortent de notre torpeur...', false, '92');
INSERT INTO dialogues VALUES (10, 2, 3, 'Ce doit être eux.', false, '102');
INSERT INTO dialogues VALUES (11, 2, 3, 'Deux silhouettes se dessinent dans l’ombre et s’approchent de la lumière de notre lampe. Les deux visages que je vois apparaître m''étaient familiers', false, '112');
INSERT INTO dialogues VALUES (12, 2, 3, 'Monsieur et Madame Vasseur ?', false, '122');
INSERT INTO dialogues VALUES (13, 2, 7, 'Jean ? Raymond ?', false, '132');
INSERT INTO dialogues VALUES (14, 2, 6, 'C’est vous mes garçons ? Ça pour une surprise !', false, '142');
INSERT INTO dialogues VALUES (15, 2, 3, 'Les parents de notre ami Pierre étaient apparus à notre lumière. Nous pouvions facilement deviner leur première question.', false, '152');
INSERT INTO dialogues VALUES (16, 2, 6, 'Où est donc Pierre ?', false, '162');
INSERT INTO dialogues VALUES (17, 2, 10, 'Demande Michel en balayant les alentours d''un regard attentif.', false, '172');
INSERT INTO dialogues VALUES (18, 2, 3, 'On a été séparés, mais il va bien ne vous inquiétez pas, vous le connaissez il se débrouille, il a eu sa propre mission avec André.', false, '182');
INSERT INTO dialogues VALUES (19, 2, 1, 'Je suis désolé de vous interrompre, on doit partir rapidement pour éviter les patrouilles de la milice.', false, '192');
INSERT INTO dialogues VALUES (20, 2, 6, 'Allons-y !', false, '202');
INSERT INTO dialogues VALUES (21, 2, 3, 'En traversant la forêt j’explique aux parents de Pierre comment on a été amené à les retrouver, jusqu’à ce qu’un bruit me fasse m’interrompre.', false, '212');
INSERT INTO dialogues VALUES (22, 2, 3, 'Dans le buisson maintenant !', false, '222');
INSERT INTO dialogues VALUES (23, 2, 3, 'Nous nous jetons tous les quatre dans un recoin caché derrière le buisson que je viens de pointer. Peu de temps après, des bruits de pas passent devant nous.', false, '232');
INSERT INTO dialogues VALUES (24, 2, 1, 'Des miliciens... Qu’est-ce qu’ils faisaient là ?', false, '242');
INSERT INTO dialogues VALUES (25, 2, 6, 'Ils étaient sans doute à notre recherche.', false, '252');
INSERT INTO dialogues VALUES (26, 2, 1, 'Non ça n’a aucun sens, pourquoi ils suivraient de simples réfugiés ?', false, '262');
INSERT INTO dialogues VALUES (27, 2, 6, 'Vos supérieurs ne vous ont pas expliqué ?', false, '272');
INSERT INTO dialogues VALUES (28, 2, 3, 'Confus par cette remarque je réponds sans trop réfléchir.', false, '282');
INSERT INTO dialogues VALUES (29, 2, 3, 'Expliqué quoi ?', false, '292');
INSERT INTO dialogues VALUES (30, 2, 7, 'Nous ne sommes pas de simples réfugiés, nous transportons des documents de la plus haute importance pour la Résistance, c’est pour ça que l’on doit arriver au plus vite et vivants !', false, '302');
INSERT INTO dialogues VALUES (31, 2, 3, 'Je regarde Raymond qui semble aussi incrédule que moi.', false, '312');
INSERT INTO dialogues VALUES (32, 2, 3, 'Après un temps à la réflexion je décide de rétablir l''ambiance qui devenait pesante.', false, '322');
INSERT INTO dialogues VALUES (33, 2, 3, 'Et bien, on dirait que cette mission est un peu plus importante que ce que l’on pensait !', false, '332');
INSERT INTO dialogues VALUES (34, 2, 1, 'Où doit on les emmener déjà ?', false, '342');
INSERT INTO dialogues VALUES (35, 2, 3, 'À Meilhan, de l’autre côté de la colline.', false, '352');
INSERT INTO dialogues VALUES (36, 2, 1, 'Alors dépêchons-nous, plus vite ils y seront mieux ce sera visiblement. Après toi Jean.', false, '362');
INSERT INTO dialogues VALUES (37, 2, 3, 'Je tends l’oreille, et, n’entendant aucun bruit qui aurait pu laisser présager une présence humaine, je sors de notre cachette et fais signe à mes compagnons de me suivre', false, '372');
INSERT INTO dialogues VALUES (38, 2, 3, 'Allons-y.', false, '382');
INSERT INTO dialogues VALUES (39, 2, 10, 'Environ une heure plus tard.', false, '392');
INSERT INTO dialogues VALUES (40, 2, 1, 'Enfin !', false, '402');
INSERT INTO dialogues VALUES (41, 2, 3, 'Après presque une heure de marche nous arrivons enfin en vue des lumières de la ville.', false, '412');
INSERT INTO dialogues VALUES (42, 2, 7, 'Nous y sommes ?', false, '422');
INSERT INTO dialogues VALUES (43, 2, 1, 'Oui, on va pouvoir bientôt vous laisser.', false, '432');
INSERT INTO dialogues VALUES (44, 2, 3, 'Alors que l’on s’avance vers l’orée de la forêt, je remarque une agitation inhabituellement tardive dans les rues : des fenêtres allumées, des bruits dans la pénombre.', false, '442');
INSERT INTO dialogues VALUES (45, 2, 3, 'Faites attention, il se passe quelque chose de bizarre, longez les murs et restez dans l’ombre, il ne faut pas se faire repérer.', false, '452');
INSERT INTO dialogues VALUES (46, 2, 6, 'Qu''est-ce qu’il se passe ?', false, '462');
INSERT INTO dialogues VALUES (47, 2, 3, 'Je lui fais signe de faire le moins de bruit possible.', false, '472');
INSERT INTO dialogues VALUES (48, 2, 3, 'Les rues et ruelles du petit village défilent alors que nous nous approchons de notre destination.', false, '482');
INSERT INTO dialogues VALUES (49, 2, 3, 'Mais arrivés au dernier bloc ce que je vois me permet d''enfin comprendre l’agitation : un groupe de miliciens arpente les rues, visiblement à la recherche de quelque chose.', false, '492');
INSERT INTO dialogues VALUES (50, 2, 3, 'Je fais signe aux autres de s’arrêter et leur explique la situation.', false, '502');
INSERT INTO dialogues VALUES (51, 2, 3, 'Probablement ceux qu’on a vu tout à l’heure', false, '512');
INSERT INTO dialogues VALUES (52, 2, 10, 'Vous allez maintenant être confrontés à deux questions pour pouvoir aider nos héros, à vous de choisir laquelle vous convient le mieux. La suite de cette histoire dépend entièrement de vous...', false, '522');
INSERT INTO dialogues VALUES (53, 2, 10, 'limquestion', false, 'none');
INSERT INTO dialogues VALUES (54, 2, 1, 'Allons y alors, ne trainons pas.', false, '542');
INSERT INTO dialogues VALUES (55, 2, 3, 'Nous revenons sur nos pas, tournons quelques rues plus loin et arrivons à quelques mètres de la cabine.', false, '552');
INSERT INTO dialogues VALUES (56, 2, 3, 'Je vais les appeler, ne faites rien qui pourrait attirer l’attention et restez silencieux.', false, '562');
INSERT INTO dialogues VALUES (57, 2, 3, 'Je rentre dans l’espace exigu, compose le numéro et attend. Le téléphone sonne quelques secondes puis quelqu’un décroche', false, '572');
INSERT INTO dialogues VALUES (58, 2, 9, 'Vous ne deviez pas utiliser ce numéro.', false, '582');
INSERT INTO dialogues VALUES (59, 2, 3, 'Je sais, mais le point de chute est compromis, la milice est là.', false, '592');
INSERT INTO dialogues VALUES (60, 2, 9, 'Alors amenez-les nous.', false, '602');
INSERT INTO dialogues VALUES (61, 2, 3, 'Très bien.', false, '612');
INSERT INTO dialogues VALUES (62, 2, 3, 'Je raccroche et ressors. Marie et Michel m’attendaient, de même pour Raymond qui s’était visiblement écarté quelques temps. Je le préviens des nouveautés de la situation.', false, '622');
INSERT INTO dialogues VALUES (63, 2, 3, 'On doit les amener au maquis.', false, '632');
INSERT INTO dialogues VALUES (64, 2, 1, 'On a un peu de route, on devrait y aller sans plus tarder', false, '642');
INSERT INTO dialogues VALUES (65, 2, 3, 'Quelques temps plus tard dans la forêt, je sens Raymond nerveux.', false, '652');
INSERT INTO dialogues VALUES (66, 2, 3, 'Quelque chose ne va pas Raymond ?', false, '662');
INSERT INTO dialogues VALUES (67, 2, 1, 'Non, je n’aime juste pas quand les plans changent à la dernière minute.', false, '672');
INSERT INTO dialogues VALUES (68, 2, 3, 'Je comprends, mais ne t’inquiète pas, tout va bien se passer.', false, '682');
INSERT INTO dialogues VALUES (69, 2, 6, 'Euh… Jean ? On a un problème...', false, '692');
INSERT INTO dialogues VALUES (70, 2, 3, 'Sur le chemin un homme nous barre la route, armé. Pendant ma discussion avec Raymond j’ai laissé
les vasseurs prendre de l’avance et j’ai relâché ma garde.', false, '702');
INSERT INTO dialogues VALUES (72, 2, 3, 'Des amis à moi ont vécus dans le village, leur maison devrait toujours être inoccupée, allons-y.', true, '722');
INSERT INTO dialogues VALUES (73, 2, 3, 'Je les dirige vers les abords de la ville. Sur la route Raymond s’approche de moi, nerveux.', true, '732');
INSERT INTO dialogues VALUES (74, 2, 1, 'Donc on les garde ?', true, '742');
INSERT INTO dialogues VALUES (75, 2, 3, 'Pour l’instant du moins. On les amènera demain au point de chute initial.', true, '752');
INSERT INTO dialogues VALUES (76, 2, 3, 'La maison, bien qu’inhabitée depuis plusieurs années, est restée dans un bon état. Je pousse la porte et
allume la lumière.', true, '762');
INSERT INTO dialogues VALUES (77, 2, 3, 'Il n’y a sûrement plus rien a mangé mais les matelas devraient être là, vous devriez pouvoir vous
installer dans une chambre pour dormir.', true, '772');
INSERT INTO dialogues VALUES (78, 2, 3, 'Les vasseurs montent à l’étage pendant que Raymond et moi nous installons dans le salon, sur ce qui semble être des 
canapés, difficile à dire au vu de la dégradation.', true, '782');
INSERT INTO dialogues VALUES (79, 2, 3, 'Soudain, j’entends frapper à la porte. Je regarde avec angoisse à travers les rideaux, et reste figé de
peur tandis que les formes des miliciens se dessinent dans le noir.', true, '792');
INSERT INTO dialogues VALUES (80, 2, 3, 'Je fais signe à Raymond de s’occuper de nos amis et de s’enfuir, puis m’approche de la porte et l’ouvre.', true, '802');
INSERT INTO dialogues VALUES (81, 2, 3, 'Bonsoir messieurs, en quoi puis-je vous aider ?', true, '812');
INSERT INTO dialogues VALUES (82, 2, 8, 'Bien le bonsoir mon brave, excusez-nous de vous déranger si tardivement mais nous sommes à la recherche d’un couple de fugitifs. Est-ce que vous les auriez vus ?', true, '822');
INSERT INTO dialogues VALUES (83, 2, 3, 'Des fugitifs, vous dites ? Non, je n’ai vu personne, désolé.', true, '832');
INSERT INTO dialogues VALUES (84, 2, 8, 'Voilà qui est bien dommage. Mais dites-moi, nous pensions la maison abandonnée, et nous avons été étonnés de voir de la lumière. Vous êtes arrivé récemment ?', true, '842');
INSERT INTO dialogues VALUES (85, 2, 3, 'Oh, oui effectivement, il y a quelques jours seulement. Je ne suis que de passage, je voyage vers les Pyrénées pour y retrouver de la famille. Cela faisait plusieurs jours que je marchais, aussi ai-je décidé de m’arrêter quelques temps ici.', true, '852');
INSERT INTO dialogues VALUES (86, 2, 8, 'Mais voyez-vous, il y a quelque chose qui me dérange : des fugitifs, une maison abandonnée qui ne l’est plus, et un voyageur que personne n’a vu... et tout ça en une journée, cela fait beaucoup de coïncidences. Et je ne crois pas aux coïncidences...', true, '862');
INSERT INTO dialogues VALUES (87, 2, 8, 'Fouillez la maison ! Et vous !', true, '872');
INSERT INTO dialogues VALUES (88, 2, 8, '.    .    .', true, '882');
INSERT INTO dialogues VALUES (89, 2, 8, 'Vous allez venir avec nous.', true, '892');
INSERT INTO dialogues VALUES (90, 2, 3, 'Il semblerait que je n’ai plus qu’à espérer que Raymond ait réussi à s’enfuir avec les Vasseurs.', true, '902');
INSERT INTO dialogues VALUES (1, 3, 2, 'Le train arrive dépêche toi !', false, '13');
INSERT INTO dialogues VALUES (2, 3, 4, 'Voilà le pont, commençons les préparatifs, il faut placer des explosifs !', false, '13');
INSERT INTO dialogues VALUES (1, 4, 10, 'Déjà quelques mois que André et Pierre n''ont plus de nouvelles de leurs amis Jean et Raymond.', false, '14');


--
-- Data for Name: progression; Type: TABLE DATA; Schema: public; Owner: superrezi
--

INSERT INTO progression VALUES (1, 1, true);
INSERT INTO progression VALUES (2, 1, false);


--
-- Data for Name: questions; Type: TABLE DATA; Schema: public; Owner: superrezi
--

INSERT INTO questions VALUES (1, 'Combien de jours ont passés entre la prise de la Pologne et la déclaration de la Guerre ?', '2', 'g');
INSERT INTO questions VALUES (1, 'Le 6 juillet 1944, combien de maquisards furent éxecutés là où se trouvent nos héros ?', '76', 's');
INSERT INTO questions VALUES (2, 'En quel année fût ériger le camp que fuient nos héros ?', '1939', 'g');
INSERT INTO questions VALUES (2, 'Ce camp fût un camp de travail intensif dès juillet 1942. Combien de prisonniers étaient encore
internés en mars 1943 ? ', '70', 's');


--
-- Name: apparitions_id_histoire_seq; Type: SEQUENCE SET; Schema: public; Owner: superrezi
--

SELECT pg_catalog.setval('apparitions_id_histoire_seq', 1, false);


--
-- Name: apparitions_id_perso_seq; Type: SEQUENCE SET; Schema: public; Owner: superrezi
--

SELECT pg_catalog.setval('apparitions_id_perso_seq', 1, false);


--
-- Name: histoires_id_seq; Type: SEQUENCE SET; Schema: public; Owner: superrezi
--

SELECT pg_catalog.setval('histoires_id_seq', 4, true);


--
-- Name: lieux_id_seq; Type: SEQUENCE SET; Schema: public; Owner: superrezi
--

SELECT pg_catalog.setval('lieux_id_seq', 15, true);


--
-- Name: personnages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: superrezi
--

SELECT pg_catalog.setval('personnages_id_seq', 10, true);


--
-- Name: utilisateurs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: superrezi
--

SELECT pg_catalog.setval('utilisateurs_id_seq', 4, true);


--
-- PostgreSQL database dump complete
--


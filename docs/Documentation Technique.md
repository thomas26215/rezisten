# **Groupe 11**

**Documentation Technique du Projet [Rezisten]**

1. [Introduction](#introduction)
2. [Aperçu du Projet](#aperçu-du-projet)
3. [Bases de Données](#bases-de-données)
    - 3.1. [Structure des Tables SQL](#31-structure-des-tables-sql)
        - 3.1.1. [Fichier create.sql](#311-fichier-createsql)
    - 3.2. [Relations entre les Tables](#32-relations-entre-les-tables)
    - 3.3. [Cas d'utilisations des tables](#33cas-dutilisations-des-tables)
4. [Fonctions de classe](#fonctions-de-classes)
    - 4.1. [Bases de données]()
5. [Fonctionnalités](#fonctionnalités)
6. [Scénarios d'Utilisation](#scénarios-dutilisation)
7. [Conclusion](#conclusion)

## Introduction

Ce document présente les spécifications techniques et fonctionnelles du projet [Rezisten]. Il décrit la structure des bases de données, les principales fonctionnalités et le déroulement des interactions utilisateur.

## Aperçu du Projet

Description à fournir .

## Bases de Données

### 3.1 Structure des tables SQL

#### 3.1.1. **Fichier `create.sql**

- **TABLE** `Utilisateurs` :

    - `id` **SERIAL PRIMARY KEY** : Identifiant de l'utilisateur
    - `pseudo` **VARCHAR(20) NOT NULL** : Pseudo de l'utilisateur
    - `datenaiss` **DATE NOT NULL** : Date de naissance de l'utilisateur
    - `mail` **VARCHAR(255) NOT NULL** : Adresse Mail de l'utilisateur
    - `mot_de_passe` **TEXT NOT NULL** : Mot de passe haché
    - `role` **CHAR(1) NOT NULL** : Indique si l'utilisateur est un joueur, un créateur ou un administrateur (_j_, *c*, ou *a*)

- **TABLE** `DEMANDES` :

    - `id_utilisateur` **INTEGER PRIMARY KEY** : Référence un utilisateur de la table UTILISATEURS
    - `doc` **VARCHAR(50) NOT NULL** : Nom d'un fichier image qui contient la carte d'identité de la personne

- **TABLE** `LIEUX` :

    - `id` **SERIAL PRIMARY KEY** : Identifiant unique auto-incrémenté pour chaque lieu
    - `nom` **VARCHAR**
    - `type_lieu` **VARCHAR**
    - `description` **VARCHAR**
    - `commune` **VARCHAR**
    - `coordonnee` **VARCHAR**

- **TABLE** `CHAPITRES` :

    - `numchap` **INT PRIMARY KEY** : Numéro unique pour chaque chapitre
    - `titre` **VARCHAR(50) NOT NULL** : Titre du chapitre

- **TABLE** `HISTOIRES` :

    - `id` **SERIAL PRIMARY KEY** : Identifiant unique au sein d'un chapitre
    - `titre` **VARCHAR(50) NOT NULL** : Titre de l'histoire
    - `numchap` **INTEGER NOT NULL** : Numéro du chapitre associé à cette histoire
    - `createur` **INTEGER** : Référence à l'identifiant du créateur dans la table CREATEURS
    - `id_lieu` **INTEGER** : Référence à l'identifiant du lieu dans la table LIEUX
    - `background` **VARCHAR(50) NOT NULL** : Nom de l'image d'arrière plan de l'histoire stockée sur le serveur web
    - `visible` **BOOLEAN** : vrai si le chapitre a été validé, faux sinon

- **TABLE** `PERSONNAGES` :

    - `id` **SERIAL PRIMARY KEY** : Identifiant du personnage pour faciliter l'unicité des n-uplets
    - `prenom` **VARCHAR(50) NOT NULL** : Prénom du personnage
    - `createur` **INTEGER**
    - `img` **VARCHAR(50) NOT NULL** : Nom de l'image (le modèle) du personnage stockée ailleurs

- **TABLE** `DIALOGUES` :

    - `id` **INTEGER**
    - `id_histoire` **INTEGER**
    - `interlocuteur` **INTEGER**
    - `contenu` **VARCHAR(400)**
    - `bonus` **BOOLEAN NOT NULL**
    - `doublage` **VARCHAR(10)**
    - **PRIMARY KEY**(`id_histoire`, `id`)

- **TABLE** `APPARITIONS` :

    - `id_histoire` **SERIAL**
    - `id_perso` **SERIAL**
    - **PRIMARY KEY**(`id_histoire`, `id_perso`)

- **TABLE** `QUESTIONS` :

    - `id_histoire` **INTEGER**
    - `question` **VARCHAR(200) NOT NULL**
    - `reponse` **VARCHAR(50) NOT NULL**
    - `type` **CHAR CHECK (type IN('g','s'))**
    - **PRIMARY KEY**(`id_histoire`, `type`)

- **TABLE** `PROGRESSION` :

    - `id_utilisateur` **INTEGER**
    - `id_hist` **INTEGER**
    - `statut` **BOOLEAN DEFAULT false**
    - **PRIMARY KEY** (`id_utilisateur`, `id_hist`)

- **TABLE** `verifications_email` :

    - `id` **SERIAL PRIMARY KEY**
    - `utilisateur_id` **INTEGER NOT NULL**
    - `token` **VARCHAR(255) NOT NULL UNIQUE**
    - `date_expiration` **TIMESTAMP NOT NULL DEFAULT (CURRENT_TIMESTAMP + INTERVAL '30 minutes')**

- **TABLE** `recuperation_mot_de_passe` :

    - `id` **SERIAL PRIMARY KEY**
    - `utilisateur_id` **INTEGER NOT NULL**
    - `token` **VARCHAR(255) NOT NULL UNIQUE**
    - `date_expiration` **TIMESTAMP NOT NULL DEFAULT (CURRENT_TIMESTAMP + INTERVAL '30 minutes')**

## **3.2.** Relations entre les Tables

1. Relation one-to-many entre `UTILISATEURS` et `DEMANDES` via `id_utilisateur`:
    - Un utilisateur peut avoir une seule demande de créateur.
    - Pertinence : Permet aux utilisateurs de demander le statut de créateur.
2. Relation one-to-many entre `CHAPITRES` et `HISTOIRES` via `numchap`:
    - Un chapitre peut contenir plusieurs histoires.
    - Pertinence : Organise les histoires en chapitres.
3. Relation one-to-many entre `LIEUX` et `HISTOIRES` via `id_lieu`:
    - Un lieu peut être associé à plusieurs histoires.
    - Pertinence : Permet de situer les histoires dans des lieux spécifiques.
4. Relation one-to-many entre `UTILISATEURS` et `HISTOIRES` via `createur`:
    - Un utilisateur (créateur) peut créer plusieurs histoires.
    - Pertinence : Associe les histoires à leurs créateurs.
5. Relation one-to-many entre `UTILISATEURS` et `PERSONNAGES` via `createur`:
    - Un utilisateur peut créer plusieurs personnages.
    - Pertinence : Permet aux utilisateurs de créer et gérer leurs propres personnages.
6. Relation one-to-many entre `HISTOIRES` et `DIALOGUES` via `id_histoire`:
    - Une histoire peut avoir plusieurs dialogues.
    - Pertinence : Associe les dialogues à leurs histoires respectives.
7. Relation one-to-many entre `PERSONNAGES` et `DIALOGUES` via `interlocuteur`:
    - Un personnage peut avoir plusieurs dialogues.
    - Pertinence : Lie les dialogues aux personnages qui les prononcent.
8. Relation many-to-many entre `HISTOIRES` et `PERSONNAGES` via la table `APPARITIONS`:
    - Une histoire peut avoir plusieurs personnages et un personnage peut apparaître dans plusieurs histoires.
    - Pertinence : Gère les apparitions des personnages dans différentes histoires.
9. Relation one-to-many entre `HISTOIRES` et `QUESTIONS` via `id_histoire`:
    - Une histoire peut avoir plusieurs questions associées.
    - Pertinence : Permet d'ajouter des questions spécifiques à chaque histoire.
10. Relation many-to-many entre `UTILISATEURS` et `HISTOIRES` via la table `PROGRESSION`:
    - Un utilisateur peut progresser dans plusieurs histoires et une histoire peut être suivie par plusieurs utilisateurs.
    - Pertinence : Suit la progression des utilisateurs dans les différentes histoires.
11. Relation one-to-many entre `UTILISATEURS` et `verifications_email` via `utilisateur_id`:
    - Un utilisateur peut avoir plusieurs tokens de vérification d'email.
    - Pertinence : Gère le processus de vérification d'email pour les utilisateurs.
12. Relation one-to-many entre `UTILISATEURS` et `recuperation_mot_de_passe` via `utilisateur_id`:
    - Un utilisateur peut avoir plusieurs demandes de récupération de mot de passe.
    - Pertinence : Gère le processus de récupération de mot de passe pour les utilisateurs.

## **3.3.** Cas d'utilisations des tables

# Fonctions de classes

## 4.1 Méthode générales

Toutes les classes de modèle implémentent les méthodes **CRUD** (Create, Read, Update, Delete). De plus, chaque modèle définit des getters et setters spécifiques pour tous ses attributs.

### 4.1.1 Méthodes **CRUD**

1. **Create** : Insère une nouvelle entrée dans la table correspondante.
2. **Read** : Récupère une ou plusieurs entrées de la table.
3. **Update** : Met à jour une entrée existante dans la table.
4. **Delete** : Supprime une entrée de la table.

### 4.1.2 Getters et Setters

Chaque modèle définit ses propres getters et setters pour tous ses attributs. Ces méthodes sont spécifiques à chaque classe et permettent un accès contrôlé aux données, incluant des validations lorsque nécessaire.

### 4.1.3 Les modèles et les attributs

Chaque modèle correspond à une table de la base de données. Egalement, chaque modèle possède les attributs qui correspondent aux colonnes dans la base de données.

> [!info] L'attribut ID
>
> - Pour les tables avec un ID autoincrémenté comme clé primaire, l'attribut `id` du modèle est initialisé à -1. Cela permet d'identifier les nouveaux objets non encore insérés dans la base de données et facilite l'implémentation de la méthode CRUD, notamment pour la création de nouveaux enregistrements.

## 4.2 Méthodes spécifiques

### 4.2.1 Modèle `User`

- `readWithMail` : Permet de récupérer un utilisateur grâce à son mail

### 4.2.2 Modèle `Chapitres`

- `readAllChapter` : Renvoie tous les chapitres de la base de données

### 4.2.3 Modèle `Dialogues`

- `readBonusDialog(int $id, int $idStory): ?Dialog` : Renvoie un dialogue bonus
- `readFirstBonus(int $idStory): int` : Renvoie les premier bonus
- `readLimit(int $idStory): int` : Renvoie l'emplacement de la question
- `countDialogs(int $idStory): int` : Compte le nombre de dialogues
- `readAllByStory(int $storyId): array` : Renvoie toutes les histoires grâce à l'id d'une histoire
- `updateAfterDeletion($idDeleted, $idStory): bool` : Actualise les histoires après suppression
- `swapDialogsIds(int $id1, int $id2, int $idStory): bool` : Inverse les ids de 2 dialogues

### 4.2.4 Modèles `Histoires`

- `getNumberStory(int $idChapter): int` : Renvoie le nombre d'histoire
- `getStoryIdsByChapter(int $idChapter): array` : Renvoie toutes les hstoires d'un chapitre
- `getAllStoryIds(): array` : Renvoie les ids des toutes les histoires

### 4.2.5 Modèle `Personnages`

- `readAllCharacters(): array` : Renvoie tous les personnages

### 4.2.6 Modèle `Progression`

- `areChapterUnlocked(int $userId, int $chapterId): bool` : Permet de savoir si un utilisateur a un chapitre de débloqué

### 4.2.7 Modèle `recuperationMotDePasse`

- `generate(int $userId): ?PasswordRecuperation` : renvoie un objet `PasswordRecuperation`. avec un token généré aléatoirement pour l'utilisateur rentré en paramètres. Supprime par la même occasion tous les utilisateurs dont le temps d'expiration est dépassé.
- `generateRandomString` : **Méthode privée** qui renvoie un token de 10 caractères généré aléatoirement.
- `checkAndDeleteCode(string $token): void` : Vérifie si le code existe dans la table et le supprime. Si le code est invalide, ça renvoie une exception.

### 4.2.8 Modèle `VerificationEmail`

- `generate(int $userId): ?PasswordRecuperation` : renvoie un objet `VerificationEmail`. avec un token généré aléatoirement pour l'utilisateur rentré en paramètres. Supprime par la même occasion tous les utilisateurs dont le temps d'expiration est dépassé.
- `generateRandomString` : **Méthode privée** qui renvoie un token de 10 caractères généré aléatoirement.
- `checkAndDeleteCode(string $token): void` : Vérifie si le code existe dans la table et le supprime. Si le code est invalide, ça renvoie une exception.

## 4.3 Contraintes

Il est nécessaire de comprendre que si une contrainte existe sur une colonne de la table correspondant au modèle, la contrainte existe pour le setter sur le modèle (Exemple : Si nous avons `username NOT NULL` dans la BDD, il est évident que nous vérifions également que `username!=NULL` dans le modèle). Nous ne préciserons pas ce genre d'évidence dans la suite de cette doc technique

### 4.3.1 Modèle `User`

- `birthDate` :
    - Le format doit être **jj-mm-aaaa**
    - L'utilisateur doit avoir + de 16 ans

### 4.3.2 `recuperationMotDePasse`

- `setToken` : Le token doit faire exactmenent 10 caractères

### 4.3.3 `recuperationMotDePasse`

- `setToken` : Le token doit faire exactement 10 caractères

# Fonctionnalités

## 5.1 Authentification

### 5.1.1 Connexion au compte

- **Fonctionnalité** : Permet aux utilisateurs de se connecter à leur compte existant.
  **Interface utilisateur** : - Champ de saisie pour l'adresse e-mail - Champ de saisie pour le mot de passe (masqué) - Bouton "Se connecter" - Lien "Mot de passe oublié ?" - Lien "Créer un compte"
- **Gestion des erreurs** :
    - Message d'erreur en rouge : "Email ou mot de passe incorrect"
    - [TODO] Encadrement en rouge des champs d'email et de mot de passe
- **Sécurité** :
    - Hachage du mot de passe côté serveur
    - Protection contre les attaques XSS (HTMLSpecialchars)
- **Redirection** :
    - Vers le dashboard si les identifiants sont corrects et le compte vérifié
    - Vers la page de vérification si le compte n'est pas vérifié (avec envoi d'un e-mail de vérification)

### 5.1.2 Création de compte

- **Fonctionnalité** : Permet aux nouveaux utilisateurs de créer un compte.
- **Interface utilisateur** :
    - Champs de saisie : nom, prénom, date de naissance, nom d'utilisateur, e-mail, mot de passe, confirmation du mot de passe
    - Case à cocher pour accepter les conditions d'utilisation
    - Bouton "Créer un compte"
- **Vérification d'unicité** :
    - Message d'erreur si l'e-mail est déjà utilisé
- **Processus de création** :
    - Envoi d'un e-mail de confirmation avec lien et code de vérification
    - Compte créé mais inactif jusqu'à la vérification
- **Redirection** :
    - Vers la page de connexion après création réussie

### 5.1.3 E-mail envoyé

- **Fonctionnalité** : Informe l'utilisateur qu'un e-mail de vérification a été envoyé.

- **Interface utilisateur** :
    - Texte d'information
    - Lien pour demander un nouveau code de confirmation

### 5.1.4 Vérification du compte

- **Fonctionnalité** : Permet à l'utilisateur de vérifier son compte.
- **Interface utilisateur** :
    - Champs de saisie : code de vérification, e-mail, mot de passe
    - Bouton "Vérifier compte"
    - Lien vers la page de connexion
- **Gestion des erreurs** :
    - Affichage d'erreurs pour code, e-mail ou mot de passe invalides
- **Redirection** :
    - Vers la page de connexion après vérification réussie

### 5.1.5 Mot de passe oublié

- **Fonctionnalité** : Permet à l'utilisateur de demander un nouveau mot de passe.
  **Interface utilisateur** : - Champ de saisie pour l'e-mail - Bouton "Mot de passe oublié" - Lien vers la page de connexion
- **Gestion des erreurs** :
    - Message d'erreur si l'adresse e-mail n'existe pas dans la base de données

## 5.2 Navigation

### 5.2.1 MainController

- **Fonctionnalité** : Permet à l'utilisateur d'utiliser l'application.
  **Interface utilisateur** : - Bouton "Lire les histoires" - Bouton "Créer une histoire" - Bouton "Consulter les histoires"
- **Sécurité** :
    - Restriction d'accès pour les non-créateurs
- **Redirection** :
    - Vers la liste des histoires, la création d'histoire ou la consultation des histoires

### 5.2.2 Liste des chapitres

- **Fonctionnalités** : Permet à l'utilisateur de choisir et gérer les histoires.
  **Interface utilisateur** : - Boutons des différents chapitres - Bouton "Chapitres des créateurs" - Bouton "Recommencer tout"
- **Redirection** :
    - Vers les histoires prédéfinies ou celles des créateurs

### 5.2.3 Liste des histoires

- **Fonctionnalités** : Permet à l'utilisateur de choisir les histoires d'un chapitre.
  **Interface utilisateur** : - Boutons des différentes histoires
- **Redirection** :
    - Vers le chapitre concerné

### 5.2.4 Chapitres des créateurs

- **Fonctionnalité** : Permet à l'utilisateur de lire les histoires publiées par les créateurs.
- **Interface utilisateur** :
    - Boutons des différentes histoires
- **Redirection** :
    - Vers le chapitre concerné

### 5.2.5 Consulter mes histoires

- **Fonctionnalité** : Permet au créateur de gérer ses histoires.
- **Interface utilisateur** :
    - Boutons des histoires créées avec options de modification et suppression
    - Bouton "Créer une histoire"
- **Redirection** :
    - Vers la page "Modifier une histoire" si l'option est sélectionnée
    - Vers la page "Créer une histoire" si le bouton est cliqué

## 5.3 Profil

## 5.3.1 Page profil

- **Fonctionnalité** : Permet à l'utilisateur ou au créateur de modifier les paramètres de son compte.**Interface utilisateur** :
    - Photo de profil de l'utilisateur
    - Pseudo de l'utilisateur
    - Bouton "Se déconnecter"
    - Section de modification des informations :
        - Champ de saisie pour modifier le pseudo
        - Champ de saisie pour modifier l'adresse e-mail
        - Bouton "Valider les modifications"
    - Bouton "Mode dyslexique" (toggle)
    - Bouton "Faire la demande pour devenir créateur"
    - Bouton "Modifier le mot de passe"
- **Sécurité**
    - Vérification de l'unicité du nouveau pseudo et de la nouvelle adresse e-mail
    - Confirmation par e-mail pour les changements d'adresse e-mail
- **Fonctionnalités spécifiques** :
    - Mise à jour en temps réel des informations modifiées après validation
    - Activation/désactivation du mode dyslexique avec effet immédiat sur l'interface
- **Redirection** :
    - Vers la page de connexion/création de compte lors de la déconnexion
    - Vers la page de demande pour devenir créateur
    - Vers la page de modification du mot de passe

### 5.3.2 Modifier le mot de passe

- **Fonctionnalité** : Permet à l'utilisateur de modifier son mot de passe
- **Interface utilisateur** :
    - Champs de saisie pour l'email, l'ancien mot de passe, le nouveau mot de passe et la confirmation du nouveau mot de passe
    - Bouton "Changer mot de passe"
    - Lien "Retour à la page de connexion"
- **Fonctionnalités spécifiques**
    - Change le mot de passe si les informations sont correctes
- **Redirection** : Page de connexion si l'utilisateur clique sur retour à la page de connexion

## 5.4 Lire une histoire

## 5.4.1 Dialogue

- **Fonctionnalité** : Permet à l'utilisateur de lire le dialogue tout en étant immergé dans l'histoire.
- **Interface utilisateur** :
    - Affichage du numéro du chapitre, de l'histoire et du titre de l'histoire
    - Une image de fond immersive correspondant à l'histoire ou au contexte
    - Présentation des personnages (0, 1 ou 2) avec leurs avatars
    - Affichage du nom du personnage qui parle
    - Bouton "Précédent" pour revenir au dialogue précédent
    - Bouton "Suivant" pour passer au dialogue suivant
    - Texte du dialogue avec une animation de style "machine à écrire" pour une expérience interactive
- **Sécurité** : Si l'utilisateur est sur le premier dialogue, le bouton "Précédent" est masqué ou désactivé pour éviter toute erreur de navigation.
- **Redirection** :
    - Si l'utilisateur appuie sur le bouton "Suivant" :
        - Si le prochain élément est une question, redirection vers la page de la question.
        - Si le prochain élément est un dialogue, redirection vers le dialogue suivant.
    - Si l'utilisateur appuie sur le bouton "Précédent", redirection vers le dialogue précédent.

### 5.4.2 Question générale

- **Fonctionnalité** : Permet à l'utilisateur de répondre à la question générale ou de choisir de répondre à la question spécifique
- **Interface utilisateur** :
    - Affichage du numéro du chapitre, de l'histoire et du titre de l'histoire
    - Une image de fond immersive correspondant à l'histoire ou au contexte
    - Présentation des personnages (0, 1 ou 2) avec leurs avatars
    - Affichage de l'information comme quoi c'est la question générale
    - Bouton "Accéder à l'autre question"
    - Bouton "Consulter le lieu"
    - Bouton "répondre"
    - Champs de saisie pour la réponse de l'utilisateur
    - Texte de la question avec une animation de style "machine à écrire" pour une expérience interactive
- **Redirection** :
    - Vers le dialogue suivant si l'utilisateur répond correctement
    - Vers la question spécifique si l'utilisateur clique sur le bouton "Accéder à l'autre question spécifique"
    - Vers le lieu de l'histoire si l'utilisateur clique sur "Consulter le lieu"

### 5.4.2 Question spécifique

- **Fonctionnalité** : Permet à l'utilisateur de répondre à la question spécifique ou de choisir de répondre à la question générale
- **Interface utilisateur** :
    - Affichage du numéro du chapitre, de l'histoire et du titre de l'histoire
    - Une image de fond immersive correspondant à l'histoire ou au contexte
    - Présentation des personnages (0, 1 ou 2) avec leurs avatars
    - Affichage de l'information comme quoi c'est la question spécifique
    - Bouton "Accéder à l'autre question"
    - Bouton "Consulter le lieu"
    - Bouton "répondre"
    - Champs de saisie pour la réponse de l'utilisateur
    - Texte de la question avec une animation de style "machine à écrire" pour une expérience interactive
- **Redirection** :
    - Vers le dialogue suivant si l'utilisateur répond correctement
    - Vers la question spécifique si l'utilisateur clique sur le bouton "Accéder à l'autre question générale"
    - Vers le lieu de l'histoire si l'utilisateur clique sur "Consulter le lieu"

### 5.4.3 Fin de l'histoire

- **Fonctionnalité** : Permet à l'utilisateur de passer à l'histoire suivante si quand l'utilisateur a finit de lire l'histoire et d'avoir des informations concernant le lieu
- **Interface utilisateur** :
    - Un message concernant le fait que l'utilisateur a finit l'histoire
    - Des informations concernant le lieu
    - Bouton "Visiter le lieu"
    - Bouton "Histoire suivante"
- **Redirection**
    - Vers le lieu si l'utilisateur a cliqué sur "Visiter le lieu"
    - Vers l'histoire suivante si l'utilisateur clique sur "Histoire suivante"

# Conclusion

Ce document fournit vue d'ensemble détaillée aspects techniques fonctionnels projet [Rezisten]. Pour toute question suggestion veuillez nous contacter à [Rezisten.contact@gmail.com].

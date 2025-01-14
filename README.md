### Équipe `Groupe 11`

<dl>
<dt>Chef·fe projet</dt>
<dd>FONTANIERE Tristan</dd>
<dt>Membres</dt>
<dd>
- 
- PEGUIN Quentin
- VENOUIL Thomas
- ARNAUD Sophie
- CELUSNIAK DE SOUZA Maria Luiza
- JOANNIC Elouan
- BILS Brayan

</dd>
</dl>
---

# SAÉ 3·01 (dépôt de rendu)

Ce dépôt est le dépôt de référence de votre équipe pour la SAÉ 3·01.
Vos rendus se feront en déposant tous les fichiers pertinents pour chaque itération ici.

Ce dépôt est initialement organisé comme suit :
```console
rendus
├── docs/
│   └── README.md
├── .gitattributes
├── .gitignore
└── README.md
```

**Vous déposerez vos rendus textuel au format `pdf` dans le dossier `docs/`.<br>
Tout document textuel dans un autre format ne sera pas considéré.**


##### Fichiers particuliers

Les deux fichiers `.gitattributes` et `.gitignore` sont liés à la configuration de git.<br>
Vous pouvez modifier le fichier `.gitignore` en fonction des technologies utilisées et de l'organisation du dépôt choisie.<br>
Il est vivement déconseillé de modifier le fichier `.gitattributes`.



## Table des matières 

- ##### [Introduction](#Introduction)
- ##### [Objectifs](#Objectifs)
- ##### [Technologies utilisées](#Technologies utilisées)
- ##### [Fonctionnalités](#Fonctionnalités)
- ##### [Installation](# Installation)
- ##### [Utilisation](# Utilisation)
- ##### [Idées](# Idées)
- ##### [Droits d'auteur](# Droits-d'auteur)
- ##### [Contact](# Contact)



## Introduction

Notre application permet aux utilisateurs de :
- Devenir un **héros de la Résistance** à travers un jeu narratif
- Découvrir l'histoire locale de manière ludique
- Apprendre sur des événements comme la résistance du Vercors et l'histoire de Jean Moulin



## Objectifs

- **Revaloriser le patrimoine culturel** lié à la Seconde Guerre mondiale
- Intéresser la génération Z à l'histoire
- Transformer l'apprentissage historique en une expérience interactive
- Encourager les jeunes à visiter des sites historiques



## Technologies utilisées

- **HTML** : Structure du contenu web.
- **CSS** : Style et mise en page.
- **PHP** : Traitement côté serveur et gestion des bases de données.
- **Javascript** pour les interactions utilisateur et quelques éléments ajoutant une attractivité visuelle au site (animations,...).
- **PostgreSQL** Système de gestion de base de données pour stocker les informations des utilisateurs et des séances .



## Fonctionnalités

#### Pour les utilisateurs

**Immersion narrative**

- Plongez dans des récits captivants sur la Résistance en Rhône-Alpes
- Vivez l'histoire à travers les yeux de résistants de l'époque

**Apprentissage interactif**

- Répondez à des questions variées intégrées aux histoires
- Relevez des défis qui vous poussent à explorer, rechercher et réfléchir

**Exploration géolocalisée**

- Découvrez des lieux historiques réels liés aux récits

#### Pour les créateurs de contenu

**Création d'histoires**

- Interface intuitive pour les historiens, enseignants et passionnés
- Outils pour créer des récits interactifs et éducatifs

**Validation et publication**

- Processus de révision pour assurer la qualité et l'exactitude historique
- Possibilité de partager vos créations avec la communauté


## Installation
Pour installer le projet localement, suivez ces étapes :

​1. Clonez le dépôt :
 ```Shell
   git clone https://github.com/votre-utilisateur/votre-repo.git
```
2. Accédez au répertoire du projet :
```Shel
   cd votre-repo
```
3. Configurez votre serveur local pour exécuter les fichiers PHP.
// A changer car on doit passer sur postgres je crois
4. Importez la base de données depuis le fichier ```export.sql``` dans votre gestionnaire .



## Utilisation
1. Lancez votre serveur local.
2. Ouvrez votre navigateur et accédez à ```http://localhost/votre-repo```.
3. Connectez-vous avec :
- identifiants : RezistenTest 
- mot de passe bnw92ambm3aib37hzax8 
pour commencer à utiliser l'application .


## Idées
Voici des idées que nous pensons intégrer par la suites :
- Un système social, plus précisément pouvoir ajouter ses amis, et voir où ils en sont dans leurs histoires, mais également les histoires qu'ils ont pu partager
- Un système de vote, grâce au quel on pourrait mettre en avant les histoires que les gens ont le plus aimés.


## Droits d'auteur
Ce projet est protégé par les droits d'auteur. Tous les droits sont réservés à **[L’édition de ce site est assurée par Tristan FONTANIERE, Quentin PEGUIN, Sophie ARNAUD, Thomas VENOUIL, Maria Luiza CELUSNIAK DE SOUZA, Brayan BILS, Elouan JOANNIC, étudiants à l’IUT2 de Grenoble.]**. Aucune partie de ce projet ne peut être reproduite, distribuée ou modifiée sans l'autorisation écrite préalable du titulaire des droits.

## Contact
Pour toute question ou suggestion, n'hésitez pas à me contacter :
- **Nom** : Rezisten
- **Email** : rezisten.contact@gmail.com


Merci d'avoir consulté ce README ! J'espère que vous apprécierez le développement et l'utilisation de cette application web

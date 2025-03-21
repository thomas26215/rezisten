# Architecture serveur de l'application
L'application utilise deux machines serveurs, des machines virtuelles présentes sur assr ayant pour ip respectives :  
192.168.14.118 : serveur postgres et dépot des images.  
192.168.14.126 : héberge le serveur apache contenant l'application.  

### Spécifications du serveur web
La configuration du serveur se trouve dans un fichier spécifique : /etc/apache2/sites-available/rezisten.conf


### Spécifications du serveur postgres/images
La base de donnée est accessible en local et depuis le serveur web uniquement. Etant donnée les mesures de sécurité
un seul utilisateur peut accéder à la base de donnée dont voici les identifiants :   
user : superrezi  
password : 2o*R4ZisT3n%25  
  
La base de donnée a pour nom rezisten, deux commandes peuvent y accéder :   
psql -h 192.168.14.118 -U superrezi rezisten => depuis le serveur web  
psql -h localhost -U superrezi rezisten  => en local  




### Spécifications communes
Les deux serveurs ont un script qui tourne dans le timer de systemd (security-rezisten) pour gérer les mises à jour
de sécurité Debian tous les jours à 10h. Les fichiers permettant de gérer ces mises à jours sont : 
/etc/systemd/system/security-rezisten.service et /etc/systemd/system/security-rezisten.timer

Les deux serveurs sont en https accessibles uniquement sur le port 443 grâce à des certificats autosignés.

Les versions des logiciels utilisés sont les suivantes à la date du 20/01/2025 :  
- postgres 15.10
- apache 2.4.62
- php 8.4.3 
- noyau linux 6.1.0-28-amd64
- OpenSSH_9.2p1 Debian-2+deb12u4 
- openSSL 3.0.15

# Guide de déploiement de l'application

## 1- Mise en place des serveurs 
Avant de pouvoir faire fonctionner l'application il vous faudra installer les serveurs comme précisés ci-dessous.
Au minimum 1 serveur et au maximum 3 serveurs sont requis. Il y a 3 structures principales : le code, la base de données et le dépôt des fichiers.

### A- Installer le serveur web
Une fois apache installé, il faudra créer un fichier de configuration lié au dossier /var/www/html (on suppose que seule cette application tourne sur le serveur web)
Voici les commandes à suivre :   
`cd /etc/apache2/sites-available/  `
`cat default-ssl.conf >> rezisten.conf`   

Il faudra ensuite éditer ce fichier en remplaçant ServerAdmin par l'e-mail de votre choix.
On suppose, pour des raisons de sécurité, que ce site tournera en https uniquement, il faut alors remplacer ":80" par ":443"

Les règles SSLCertificateFile et SSLCertificateKeyFile doivent être remplacés par les chemins absolus de votre certificat et de votre clé (Se référer à un guide pour réaliser un certificat autosigné).

Une fois ce fichier complété, il faut activer le site avec :  
`a2ensite rezisten.conf`  
`systemctl restart apache2`  

Si tout s'est bien passé, vous pouvez accéder à votre site avec : https://[votreip] qui devrait afficher le fichier index.html

Il faut ensuite récupérer les données du site sur le dépôt git avec le lien : https://gricad-gitlab.univ-grenoble-alpes.fr/iut2-info-stud/2024-s3/s3.01/team-11/rendus.git
Pour ce faire suivez les commandes suivantes : 
`cd /var/www/html`  
`git clone [lien_https_du_dossier_au_dessus]`  
`scp rendus/code/index.php .`  
`scp -r rendus/code/* .`  
`rm index.html`  
`rm -r rendus/`  

Entrez vos identifiants gricad. Normalement le dossier "rendus" existe dans /var/www/html maintenant. Le dossier doit seulemnent contenir les fichiers et sous-dossiers présents dans rendus/code/ initialement
En accédant à https://[ip_votre_serveur] vous devriez être envoyé vers l'index qui affiche "Se connecter" ou "Créer un compte".
	
### B- Installer la BDD
Maintenant que le serveur web est prêt, il faut lui permettre d'accéder aux données. Sur le même serveur ou sur un serveur distant, installez postgres. Faites la configuration voulue de /etc/postgresql/15/main/postgresql.conf, notamment concernant le paramètre listen_addresses.
Vous pouvez mettre ce paramètre de la façon suivante : listen_addresses = '*'. Nous limiterons les adresses ip dans le prochain fichier de configuration.  
Il faut maintenant ouvrir /etc/postgresql/15/main/pg_hba.conf, je conseille d'utiliser la configuration comme sur la capture suivante, **bien remplacer l'IPv4 par celle de votre serveur**.

![Config pg_hba](./config_pg_hba.png)

On peut alors redémarrer postgres pour appliquer la configuration : `systemctl reload postgresql.`  
Il va maintenant falloir créer l'utilisateur que vous voulez utiliser, le fichier que nous utiliserons après pour exporter la base est prévu pour que l'utilisateur s'appelle superrezi mais vous pouvez le changer. Voici les commandes à utiliser :  
`su - postgres`  
`psql`   
`CREATE USER superrezi WITH SUPERUSER PASSWORD '[votre_mot_de_passe]';`  

Nous utilisons ici un superuser ce qui peut être assez dangereux, mais comme les ip sont limitées il est presque impossible que cela pose quelconque problème. Maintenant vous pouvez utiliser le fichier qui est fourni dans le dépôt git : data/dump.sql.  
Récupérez ce fichier dans le homedir du user postgres. 
Ensuitez reconnectez vous à la base, changez le format des dates avec la commande : `set datestyle = 'ISO, European';`   
Ensuite on peut créer la base avec les données appropriées, utilisez simplement la commande : `\i dump.sql;`  
Toutes les tables devraient être créées avec les données initiales. Dans le cas où les données seraient modifiées, un script tourne une fois par semaine pour recréer ce fichier dump.sql et mettre à jour les données.
Ce script est : /rendus/code/docs/dump_database. Vous pouvez configurer ce scrips dans crontab ou list-timers en suivant un guide adapté sur internet.  

Nous mettons à jour régulièrement le fichier issu de ce script, le script lui-même est disponible dans rendus/code/docs mais pour des raisons de sécurité nous n'envoyons pas automatiquement les nouvelles versions
du fichier sur le dépôt git.

Si tout se passe bien votre serveur base de données est prêt. Il faut simplement modifier model/dao.class.php et modifier les caractéristiques de connexion dans l'entête de la classe. Par exemple modifier l'utilisateur, le mot de passe ou autre.  

### C- Installer les fichiers utilisés par l'application
Pour ce qui est des images et fichiers audios utilisés, nous avons décidé de les mettre sur le serveur postgres pour alléger l'application. Vous pouvez très bien configurer un autre serveur web qui contiendra uniquement ces fichiers. Le dossier à mettre sur le serveur web est rendus/rezisten/, il contient les images et fichiers audios.  
Il faudra par la suite modifier dans le code tous les endroits où est utilisée l'adresse : https://192.168.14.118/rezisten/x pour donner le bon lien. Pour cela vous avez le script rendus/code/docs/update_links qui s'occupe de remplacer tous ces liens. Si une image ou un fichier audio ne charge pas, vérifiez à la main que le lien demandé mène bien quelque part.

Vous pouvez ensuite placer le dossier où vous le souhaitez mais de manière classique nous proposons d'accéder aux images et audios avec :  
https://[ip_machine]/rezisten/  
Les liens sont gérés ensuite dans le code.

Sur le serveur web qui contient l'application, il y a également un script /usr/local/bin/send_images qui met à jour les images des créateurs et les envoie vers ce serveur dans le dossier imgPersonnages, cela permet de faire
de la place dans l'application.

## 2- Résumé 
Pour clarifier tout cela, voici une liste des fichiers et/ou dossiers nécessaires au fonctionnement de l'application sur chaque serveur.

#### Serveur web
**/etc/apache2/sites-available/rezisten.conf** => configuration apache du serveur  
	      **/sites-enabled**
#FIXME : AJOUTER UNE IMAGE ICI
**/var/www/html/** => contient le code de l'application récupéré sur le dépôt git

#### Serveur Base de donnée et images
**/etc/postgresql/15/main/pg_hba.conf**  => configuration de postgres (voir illustrations plus haut)  
		         **/postgres.conf**
**/var/www/html/rezisten/** => contient les images et fichiers audios des histoires et de l'application en général

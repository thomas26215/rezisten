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


# Guide de déploiement de l'application

## 1- Mise en place des serveurs 
Avant de pouvoir faire fonctionner l'application il vous faudra installer les serveurs comme précisés ci-dessous.
Au minimum 1 serveur et au maximum 3 serveurs sont requis. Il y a 3 structures principales : le code, la base de données et le dépôt des fichiers.

### A- Installer le serveur web
Une fois apache installé, il faudra créer un fichier de configuration lié au dossier /var/www/html (on suppose que seule cette application tourne sur le serveur web)
Voici les commandes à suivre : 
cd /etc/apache2/sites-available/
cat default-ssl.conf >> rezisten.conf 

Il faudra ensuite éditer ce fichier en remplaçant ServerAdmin par l'e-mail de votre choix.
On suppose, pour des raisons de sécurité, que ce site tournera en https uniquement, il faut alors remplacer ":80" par ":443"

Les règles SSLCertificateFile et SSLCertificateKeyFile doivent être remplacés par les chemins absolus de votre certificat et de votre clé (Se référer à un guide pour réaliser un certificat autosigné).

Une fois ce fichier complété, il faut activer le site avec :
a2ensite rezisten.conf
systemctl restart apache2

Si tout s'est bien passé, vous pouvez accéder à votre site avec : https://[votreip] qui devrait afficher le fichier index.html

Il faut ensuite récupérer les données du site sur le dépôt git avec le lien : https://gricad-gitlab.univ-grenoble-alpes.fr/iut2-info-stud/2024-s3/s3.01/team-11/rendus.git
Pour ce faire suivez les commandes suivantes : 
cd /var/www/html
git clone [lien_https_du_dossier_au_dessus]

Entrez vos identifiants gricad


	

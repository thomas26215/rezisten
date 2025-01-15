[1mdiff --git a/code/index.php b/code/index.php[m
[1mindex 581b7df..e3d3d18 100644[m
[1m--- a/code/index.php[m
[1m+++ b/code/index.php[m
[36m@@ -8,7 +8,7 @@[m [merror_reporting(E_ALL);[m
 $ctrl = $_REQUEST['ctrl'] ?? '';[m
 [m
 //Nécessaire de compléter quand on crée une vue pour vérifier que la vue appelée existe bien[m
[31m-const CTRLS = array('loginAccount', 'createAccount', 'authentification', 'mainNonConnecte', 'main','mesHistoires', 'histoire','question', 'listeChapitre', "listeHistoire", 'creation', 'personnages', 'profil', 'demandeCreateur', 'consulterLieu', 'motdepasseoublie', 'changermotdepasse');[m
[32m+[m[32mconst CTRLS = array('loginAccount', 'createAccount', 'authentification', 'mainNonConnecte', 'main','mesHistoires', 'histoire','question', 'listeChapitre', "listeHistoire", 'creation', 'personnages', 'profil', 'demandeCreateur', 'consulterLieu', 'motdepasseoublie', 'changermotdepasse', 'emailEnvoye');[m
 // Démarre la session[m
 session_start();[m
 [m
[1mdiff --git a/code/model/recuperationMotDePasse.class.php b/code/model/recuperationMotDePasse.class.php[m
[1mindex 9cf600f..15c9cdb 100644[m
[1m--- a/code/model/recuperationMotDePasse.class.php[m
[1m+++ b/code/model/recuperationMotDePasse.class.php[m
[36m@@ -3,6 +3,7 @@[m
 [m
 require_once(__DIR__ . "/dao.class.php");[m
 require_once(__DIR__ . "/users.class.php");[m
[32m+[m[32mrequire_once(__DIR__ . "/composer/sendMail.utilitaire.php");[m
 [m
 class PasswordRecuperation {[m
     private int $id;[m
[1mdiff --git a/code/model/verificationEmail.class.php b/code/model/verificationEmail.class.php[m
[1mindex b64c537..cb30bf5 100644[m
[1m--- a/code/model/verificationEmail.class.php[m
[1m+++ b/code/model/verificationEmail.class.php[m
[36m@@ -1,14 +1,15 @@[m
 <?php[m
[32m+[m[32m// Fichier: model/checkEmail.class.php[m
 [m
 require_once(__DIR__ . "/dao.class.php");[m
 require_once(__DIR__ . "/users.class.php");[m
[32m+[m[32mrequire_once(__DIR__ . "/composer/sendMail.utilitaire.php");[m
 [m
 class CheckEmail {[m
     private int $id;[m
     private User $user;[m
     private string $token;[m
     private string $expirationDate;[m
[31m-[m
     private DAO $dao;[m
 [m
     public function __construct(User $user, string $token, string $expirationDate = "00-00-00", int $id = -1) {[m
[36m@@ -47,7 +48,6 @@[m [mclass CheckEmail {[m
         $this->user = $user;[m
     }[m
 [m
[31m-    // Le token doit faire 10 caractères[m
     public function setToken(string $token): void {[m
         if($token == "") {[m
             throw new Exception("Impossible de mettre le token car vide");[m
[36m@@ -62,28 +62,6 @@[m [mclass CheckEmail {[m
         $this->expirationDate = $expirationDate;[m
     }[m
 [m
[31m-    public static function generate(int $userId){[m
[31m-        $user = User::read($userId);[m
[31m-        if (!$user) {[m
[31m-            throw new Exception("Utilisateur non trouvé");[m
[31m-        }[m
[31m-        [m
[31m-        $token = self::genererChaineAleatoire(10); // Appel statique[m
[31m-        $checkEmail = new CheckEmail($user, $token);[m
[31m-        [m
[31m-        if($checkEmail->create()) {[m
[31m-            return CheckEmail::read($userId);[m
[31m-        } else {[m
[31m-            throw new Exception("Impossible de créer la récupération de mot de passe");[m
[31m-        }[m
[31m-    }[m
[31m-[m
[31m-    [m
[31m-    public static function isUserCodeDefined(int $id): bool {[m
[31m-        return CheckEmail::read($id) !== null;[m
[31m-    }[m
[31m-[m
[31m-[m
     /* --- Méthodes CRUD --- */[m
 [m
     public function create(): bool {[m
[36m@@ -135,7 +113,35 @@[m [mclass CheckEmail {[m
         }[m
         return false;[m
     }[m
[31m-    public static function genererChaineAleatoire(int $longueur = 10): string {[m
[32m+[m
[32m+[m[32m    /* --- Méthodes utilitaires --- */[m
[32m+[m
[32m+[m[32m    public static function generate(int $userId): ?CheckEmail {[m
[32m+[m[32m        $user = User::read($userId);[m
[32m+[m[32m        if (!$user) {[m
[32m+[m[32m            throw new Exception("Utilisateur non trouvé");[m
[32m+[m[32m        }[m
[32m+[m[32m        CheckEmail::delete($userId);[m
[32m+[m[41m        [m
[32m+[m[32m        $token = self::genererChaineAleatoire(10);[m
[32m+[m[32m        $checkEmail = new CheckEmail($user, $token);[m
[32m+[m[41m        [m
[32m+[m[32m        if($checkEmail->create()) {[m
[32m+[m[32m            var_dump($checkEmail->getUser()->getId());[m
[32m+[m[32m            $emailSender =  new EmailSender();[m
[32m+[m[32m            $emailSender->welcome($checkEmail->getUser()->getMail(), $checkEmail->getToken());[m
[32m+[m
[32m+[m[32m            return CheckEmail::read($userId);[m
[32m+[m[32m        } else {[m
[32m+[m[32m            throw new Exception("Impossible de créer la vérification d'email");[m
[32m+[m[32m        }[m
[32m+[m[32m            }[m
[32m+[m
[32m+[m[32m    public static function isUserCodeDefined(int $id): bool {[m
[32m+[m[32m        return CheckEmail::read($id) !== null;[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    private static function genererChaineAleatoire(int $longueur = 10): string {[m
         $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';[m
         $chaineAleatoire = '';[m
         for ($i = 0; $i < $longueur; $i++) {[m
[36m@@ -144,4 +150,5 @@[m [mclass CheckEmail {[m
         return $chaineAleatoire;[m
     }[m
 }[m
[32m+[m[32m?>[m
 [m
[1mdiff --git a/code/view/emailEnvoye.view.php b/code/view/emailEnvoye.view.php[m
[1mindex 5eb39ca..54da9e5 100644[m
[1m--- a/code/view/emailEnvoye.view.php[m
[1m+++ b/code/view/emailEnvoye.view.php[m
[36m@@ -12,8 +12,8 @@[m
     <main>[m
         <form method="post" class="formContainer">[m
             <h1>Email Envoyé</h1>[m
[31m-            <p class="texte">Nous avons envoyé un email d'activation à </p>[m
[31m-            <p class="texte">*mail de l'utilisateur*</p>[m
[32m+[m[32m            <p class="texte" style="margin-bottom: 0px">Nous avons envoyé un email d'activation à </p>[m
[32m+[m[32m            <h2 style="margin-top: 0px;"><?=$email?></h2>[m
         [m
             <?php[m
             if (isset($message)) {[m
[36m@@ -23,15 +23,8 @@[m
                 echo "<p class='error'>$error</p>";[m
             }[m
             ?>[m
[31m-[m
             <div class="formContainer">[m
[31m-                <p class="texte">Merci de renseigner le code ici :</p>[m
[31m-                <a href="">Page de vérification</a>[m
[31m-            </div>[m
[31m-[m
[31m-            <div class="formContainer">[m
[31m-                <p>Vous n'avez pas reçu l'e-mail ?</p>[m
[31m-                <a class="lienVerif" href="">Renvoyer l'e-mail de vérification</a>[m
[32m+[m[32m                <button style="color: red; margin-top: 80px;" class="lienVerif" name="send" value="newCode">Renvoyer l'e-mail de vérification</button>[m
             </div>[m
         </form>[m
     </main>[m

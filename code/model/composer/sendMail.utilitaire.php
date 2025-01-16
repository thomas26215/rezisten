<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';


class EmailSender {
    private $mail;
    private $destination;
    private $subject;
    private $body;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->configureSMTP();
    }

    private function configureSMTP() {
        $this->mail->isSMTP();
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "venouilthomas123456@gmail.com";
        $this->mail->Password = "fvmb zele kayh ynej";
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
        $this->mail->setFrom("venouilthomas123456@gmail.com", "rezisten");
    }

    public function setDestination(string $destination) {
        $this->destination = $destination;
    }

    public function setSubject(string $subject) {
        $this->subject = $subject;
    }

    public function setBody(string $body) {
        $this->body = $body;
    }

    public function sendMail() {
        if (!$this->destination || !$this->subject || !$this->body) {
            throw new Exception("Destination, subject, and body must be set before sending an email.");
        }

        try {
            $this->mail->addAddress($this->destination, "Vous");
            $this->mail->Subject = $this->subject;
            $this->mail->Body = $this->body;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Erreur d'envoi d'email : " . $this->mail->ErrorInfo);
            return false;
        }
    }

    public function welcome(string $destination, string $code) {
        $link = "https://votredomaine.com/activation?code=" . urlencode($code);

        $welcomeTemplate = <<<HTML
        <html>
        <body style="background-color:#ebe6d6;">
            <div style="text-align:center;background-color:#221818;color: green;padding:20px;">
                <h1>🎮 MISSION RECRUTEMENT 🕹️</h1>
            </div>
            
            <div style="padding:20px;">
                <p>Agent détecté ! Bienvenue dans la matrice de la résistance.</p>
                
                <div style="background-color:#e0ffe0;padding:15px;border-radius:10px;">
                    <h2>🔑 Clé d'activation requise</h2>
                    
                    <p>Pour débloquer votre compte et accéder aux ressources sécurisées, 
                    utilisez le code d'activation top-secret : {$code}</p>
                    
                    <a href="http://localhost/rendus/code/index.php?ctrl=verifierCompte" style="display:block;background-color:#33553d;color:white;padding:10px;text-decoration:none;text-align:center;">
                    ACTIVER MON COMPTE</a>
                </div>
                
                <p>Temps restant avant expiration : 30 mins</p>
                
                <footer style="font-size:small;color:gray;">
                    Ce message est auto-destructeur après lecture. 🕵️‍♂️
                </footer>
            </div>
        </body>
        </html>
        HTML;

        $this->mail->setFrom('resistance@example.com', 'La Resistance');
        $this->mail->addAddress($destination);
        $this->mail->isHTML(true);
        $this->mail->Subject = "=?UTF-8?B?" . base64_encode("🚨 Mission Recrutement - Activation Requise") . "?=";
        $this->mail->Body = $welcomeTemplate;

        return $this->mail->send();
    }

    public function sendPasswordRecoveryEmail(string $destination, string $code) {
        $link = "https://votredomaine.com/recovery?code=" . urlencode($code);

        $emailTemplate = <<<HTML
        <html>
        <body style="background-color:#ebe6d6;">
            <div style="text-align:center;background-color:#221818;color: green;padding:20px;">
                <h1>🔐 RÉCUPÉRATION DE MOT DE PASSE 🔐</h1>
            </div>
            
            <div style="padding:20px;">
                <p>Salut ! On dirait que tu ne te souviens plus de ton mot de passe.</p>
                <p>Pas de panique ! Ton pote de confiance s'en souvient encore. Pour prouver ta confiance, il te faut un code.</p>
                
                <div style="background-color:#e0ffe0;padding:15px;border-radius:10px;">
                    <h2>🔑 Code de récupération</h2>
                    
                    <p>Voici le code que tu dois donner à ton ami : <strong>{$code}</strong></p>
                    
                    <p>Une fois qu'il a ce code, il pourra t'aider à réinitialiser ton mot de passe.</p>

                    <a href="{$link}" style="display:block;background-color:#33553d;color:white;padding:10px;text-decoration:none;text-align:center;">
                    RÉINITIALISER MON MOT DE PASSE</a>
                </div>
                
                <p>Temps restant avant expiration : 30 mins</p>
                
                <footer style="font-size:small;color:gray;">
                    Ce message est auto-destructeur après lecture. 🕵️‍♂️
                </footer>
            </div>
        </body>
        </html>
        HTML;

        $this->mail->setFrom('support@example.com', 'Support Technique');
        $this->mail->addAddress($destination);
        $this->mail->isHTML(true);
        $this->mail->Subject = "=?UTF-8?B?" . base64_encode("🔐 Récupération de Mot de Passe") . "?=";
        $this->mail->Body = $emailTemplate;

        return $this->mail->send();
    }


}



// Exemple d'utilisation :
// $emailSender = new EmailSender();
// $emailSender->setDestination("destinataire@example.com");
// $emailSender->setSubject("Mon sujet");
// $emailSender->setBody("Contenu de l'email");
// $emailSender->sendMail();
// 
// Ou pour le mail de bienvenue :
// $emailSender->sendMailWelcome("destinataire@example.com");


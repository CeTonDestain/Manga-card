<?php
require("../vendor/autoload.php");
use PHPMailer\PHPMailer\PHPMailer;
    class ResetView{
        public function __construct(ResetController $controller)
        {
            $this->controller=$controller;
            $this->template=DIR_TEMPLATES_ACCOUNT."reset.php";
        }
        public function render()
        {
            $error="";
            
            session_start();
            if (isset($_POST["email"])) {

                $verifEmail = $this->controller->verifEmail($this->controller->model->email);
                if ($verifEmail) {
                    $token = bin2hex(random_bytes(50));
                    $validity = time() + 900;
                    $succeedToken = $this->controller->sendToken($token, $this->controller->model->email,$validity);
                    if ($succeedToken) {
                        $phpmailer = new PHPMailer();
                        $phpmailer->isSMTP();
                        // information du compte mailtrap
                        $phpmailer->Host = 'smtp.mailtrap.io';
                        $phpmailer->SMTPAuth = true;
                        $phpmailer->Port = 2525;
                        $phpmailer->Username = 'd36eeb08543f6a';
                        $phpmailer->Password = '22c48e886d57e0';
    
    
                        // Expediteur
                        $phpmailer->From = "manga-card@support.fr";
                        $phpmailer->FromName = "TEAM Manga-Card";
    
                        // email du destinataire
                        $phpmailer->addAddress($this->controller->model->email);
    
                        // on indique que le contenu du mail sera du code HTML
                        $phpmailer->isHTML();
                        $phpmailer->CharSet = "UTF-8";
    
                        // sujet du mail
                        $phpmailer->Subject = "reinitialisation du mot de passe";
                        $phpmailer->Body = " cliquer sur le lien afin de reinitialiser votre mot de passe
                        <a href=\"" . HOST . "index.php?page=new_account&token={$token}\">cliquez ici</a>
                        si vous n'etes pas a l'origine de cette demande, veuillez nous contacté dans les plus bref delais";
    
                        // envoi du mail
                        $phpmailer->send();
                    }
                }
            }
            
            require($this->template);
        }
    }

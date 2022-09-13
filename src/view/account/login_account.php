<?php
    class LoginView{
        public function __construct(LoginController $controller)
        {
            $this->controller=$controller;
            $this->template=DIR_TEMPLATES_ACCOUNT."login.php";
        }
        public function render()
        {
            session_start();
            $error = "";
            if (!empty($_POST)) {
                $result = $this->controller->verifyEmail($this->controller->model->email);

                if (!empty($result) && password_verify($this->controller->model->password, $result["password"])) {
                    $_SESSION["username"] = $result["pseudo"];
                    $_SESSION["profilePicture"] = $result["img"];
                    $_SESSION["userIp"] = $_SERVER["REMOTE_ADDR"];
                    header("LOCATION:./index.php");
                } else {
                    $error = "Mot de passe ou adresse mail est invalide";
                }
            }
            
            require($this->template);
        }
    }
?>
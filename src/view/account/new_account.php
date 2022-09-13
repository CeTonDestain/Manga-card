<?php
    class NewView{
        public function __construct(NewController $controller)
        {
            $this->controller=$controller;
            $this->template=DIR_TEMPLATES_ACCOUNT."new.php";
        }
        public function render()
        {
            session_start();
            $errors = [];

            if (isset($_GET["token"])) {
                $result=$this->controller->ValideToken($this->controller->model->token);
            }

            if (empty($result) || $result["validity"]< time()) {
                $errors["token"]="lien de recuperation invalide ou expiré";
                if($result["validity"]< time()){
                $this->controller->destroyToken($this->controller->model->token);
                }
            }
            if (isset($_POST["password"])) {
                if ($this->controller->model->password != $this->controller->model->retypePassword) {
                    $errors["retypePassword"] = "mot de passe doit etre identique";
                }
        
                $uppercase = preg_match("/[A-Z]/", $this->controller->model->password);
                $lowercase = preg_match("/[a-z]/", $this->controller->model->password);
                $numbercase = preg_match("/[0-9]/", $this->controller->model->password);
        
                if (strlen($this->controller->model->password) < 8 || !$uppercase || !$lowercase || !$numbercase) {
                    $errors["password"] = "le mot de passe doit contenir plus de 8 caractere au minimum et 1 majuscule , 1 minuscule et un chiffre";
                }
        
                if(empty($errors)){
                    $this->controller->model->password=password_hash($this->controller->model->password, PASSWORD_DEFAULT);
                    $this->controller->updatePassword($this->controller->model->password,$result);
                    $this->controller->destroyToken($this->controller->model->token);
        
                    header("Location: ./index.php?page=login_account");
                }
            }

            require($this->template);
        }
    }
?>
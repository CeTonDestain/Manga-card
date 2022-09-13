<?php
class RegisterView
{
    public function __construct(RegisterController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES_ACCOUNT . "register.php";
    }
    public function render()
    {
        session_start();

        if (!empty($_POST)) {
            $errors = [];

            if (!filter_var($this->controller->model->email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "l'email n'est pas valide";
            }

            if ($this->controller->verifyExistingEmail($this->controller->model->email)) {
                $errors["email"] = "l'email existe deja ";
            }

            if ($this->controller->model->email != $this->controller->model->ConfirmEmail) {
                $errors["ConfirmEmail"] = "l'email doit etre identique";
            }

            if ($this->controller->model->password != $this->controller->model->retypePassword) {
                $errors["retypePassword"] = "mot de passe doit etre identique";
            }

            $uppercase = preg_match("/[A-Z]/", $this->controller->model->password);
            $lowercase = preg_match("/[a-z]/", $this->controller->model->password);
            $numbercase = preg_match("/[0-9]/", $this->controller->model->password);

            if (strlen($this->controller->model->password) < 8 || !$uppercase || !$lowercase || !$numbercase) {
                $errors["password"] = "le mot de passe doit contenir plus de 8 caractere au minimum et 1 majuscule , 1 minuscule et un chiffre";
            }
            $specialecase_pseudo = preg_match("/[^A-Za-z0-9]/", $this->controller->model->pseudo);
            if (strlen($this->controller->model->pseudo) < 5 || $specialecase_pseudo) {
                $errors["pseudo"] = "le pseudo doit contenir au moin 5 caracteres sans caractere special";
            }

            if ($this->controller->verifyExistingPseudo($this->controller->model->pseudo)) {
                $errors["pseudo"] = "le pseudo existe deja ";
            }
            if(empty($errors)){
                //cryptage du mot de passe
                $this->controller->model->password=password_hash($this->controller->model->password, PASSWORD_DEFAULT);
                $this->controller->register($this->controller->model->pseudo,$this->controller->model->password,$this->controller->model->email);
        
                header("Location:./index.php?page=login_account");
             }

        }

        require($this->template);
    }
}

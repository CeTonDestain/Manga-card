<?php
class RegisterModel{
    public function __construct(PDO $db)
    {
        $this->db=$db;

        if (!empty($_POST)) {
            $this->pseudo = trim(strip_tags($_POST["pseudo"]));
            $this->email = trim(strip_tags($_POST["email"]));
            $this->ConfirmEmail = trim(strip_tags($_POST["ConfirmEmail"]));
            $this->password = trim(strip_tags($_POST["password"]));
            $this->retypePassword = trim(strip_tags($_POST["retypePassword"]));
        }
    }
}
?>
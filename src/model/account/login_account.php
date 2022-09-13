<?php
class LoginModel{
    public function __construct(PDO $db)
    {
        $this->db=$db;

        if(!empty($_POST)){
            $this->email=trim(strip_tags($_POST["email"]));
            $this->password=trim(strip_tags($_POST["password"]));
        }
    }
}
?>
<?php
class NewModel{
    public function __construct(PDO $db)
    {
        $this->db=$db;

        if (isset($_GET["token"])) {
            $this->token = trim(strip_tags($_GET["token"]));
        }
        if (isset($_POST["password"])) {
            $this->password = trim(strip_tags($_POST["password"]));
            $this->retypePassword = trim(strip_tags($_POST["retypePassword"]));
        }
    }
}
?>
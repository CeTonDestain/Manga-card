<?php
class DuelModel{
    public function __construct(PDO $db)
    {
        $this->db=$db;
        $this->id=$_GET["id"];

        if (isset($_GET["attack"])) {
            $this->attackJoueur=$_GET["attack"];
        }
    }
}
?>
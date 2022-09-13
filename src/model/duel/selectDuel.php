<?php
class SelectDuelModel{
    public function __construct(PDO $db)
    {
        $this->db=$db;

        if(isset($_GET["p"])){
            $this->p=intval($_GET["p"]);
        }

        if (isset($_GET["q"])) {
            $this->q=$_GET["q"];
        }
    }
}
?>
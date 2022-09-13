<?php
class HomeModel{
    public function __construct(PDO $db)
    {
        $this->db=$db;
    }
}
?>
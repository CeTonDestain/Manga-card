<?php
class ProfileModel{
    public function __construct(PDO $db)
    {
        $this->db=$db;
        if(isset($_GET["pseudo"])){
            $this->pseudo=trim(strip_tags($_GET["pseudo"]));
        }
        if(isset($_GET["profilePicture"])){
            $this->profilePicture=trim(strip_tags($_GET["profilePicture"]));
        }
        if(isset($_POST["bio"])){
            $this->bio=trim(strip_tags($_POST["bio"]));
        }
    }

}
?>